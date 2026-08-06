<?php

namespace App\Http\Controllers;

use App\Models\ChassisOrder;
use App\Models\ChassisOrderItem;
use App\Models\ChassisNumber;
use App\Models\ProductVariant;
use App\Models\Utility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ChassisOrderController extends Controller
{
    public function index()
    {
        if (Auth::user()->type !== 'Owner'
            && !Auth::user()->can('Manage Orders')
            && !Auth::user()->can('Show Orders')
            && !Auth::user()->can('Edit Orders')
            && !Auth::user()->can('Delete Orders')
            && !Auth::user()->can('Validate Orders')
        ) {
            return redirect()->route('profile')->with('error', __('Permission denied.'));
        }
        $storeId = Auth::user()->current_store;

        $orders = ChassisOrder::with('items')
            ->where('store_id', $storeId)
            ->orderBy('order_number', 'desc')
            ->get();

        $stats = [
            'total'     => $orders->count(),
            'pending'   => $orders->where('status', 'pending')->count(),
            'validated' => $orders->where('status', 'validated')->count(),
            'rejected'  => $orders->where('status', 'rejected')->count(),
        ];

        return view('chassis_orders.index', compact('orders', 'stats'));
    }

    public function show($id)
    {
        $order = ChassisOrder::with('items')->findOrFail($id);
        return response()->json(['order' => $order]);
    }

    public function store(Request $request)
    {
        if (Auth::user()->type !== 'Owner' && !Auth::user()->can('Create Order') && !Auth::user()->can('Manage Orders') && !Auth::user()->can('Show Orders')) {
            return response()->json(['success' => false, 'message' => __('Permission denied.')], 403);
        }
        $request->validate([
            'customer_name'              => 'nullable|string|max:191',
            'customer_phone'             => 'nullable|string|max:191',
            'doc_type'                   => 'nullable|in:CIN,RC,ICE',
            'doc_number'                 => 'nullable|string|max:100',
            'discount'                   => 'nullable|numeric|min:0',
            'tva'                        => 'nullable|numeric|min:0|max:100',
            'notes'                      => 'nullable|string',
            'comment'                    => 'nullable|string',
            'items'                      => 'required|array|min:1',
            'items.*.chassis_number_id'  => 'required|integer',
            'items.*.price'              => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $order = ChassisOrder::create([
                'order_number'   => ChassisOrder::generateOrderNumber(),
                'customer_name'  => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'doc_type'       => $request->doc_type,
                'doc_number'     => $request->doc_number,
                'discount'       => $request->discount ?? 0,
                'tva'            => $request->tva ?? 0,
                'status'         => 'pending',
                'user_id'        => Auth::id(),
                'store_id'       => Auth::user()->current_store,
                'notes'          => $request->notes,
                'comment'        => $request->comment,
            ]);

            $totalPrice = 0;

            foreach ($request->items as $item) {
                $chassis = ChassisNumber::findOrFail($item['chassis_number_id']);
                $variant = ProductVariant::findOrFail($chassis->variant_id);
                $category = $variant->category;
                $parentCategory = $category ? $category->parent : null;
                $brand = $category ? $category->brand : ($parentCategory ? $parentCategory->brand : null);

                // Get hierarchy names
                $brandName = $brand ? $brand->name : '';
                $modelName = $parentCategory ? $parentCategory->name : ($category ? $category->name : '');
                $familyName = $variant->name;

                $orderItem = ChassisOrderItem::create([
                    'chassis_order_id' => $order->id,
                    'chassis_number_id' => $chassis->id,
                    'variant_id' => $variant->id,
                    'chassis_number' => $chassis->chassis_number,
                    'model_name' => $modelName,
                    'family_name' => $familyName,
                    'brand_name' => $brandName,
                    'price' => $item['price'],
                    'location' => $chassis->location,
                ]);

                $totalPrice += $item['price'];

                // Remove chassis from stock (quantity already decremented in addToPosCart)
                $chassis->delete();
            }

            $tva = $request->tva ?? 0;
            $tvaAmount = $totalPrice * $tva / 100;
            $order->update(['total_price' => $totalPrice + $tvaAmount]);

            // Clear POS cart session
            $sessionKey = $request->session_key ?? request()->segment(count(request()->segments()));
            if ($sessionKey && session()->has($sessionKey)) {
                session()->forget($sessionKey);
            }
            // Also clear 'pos' session
            session()->forget('pos');

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => __('Commande créée avec succès'),
                'order' => $order->load('items'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => __('Erreur lors de la création de la commande: ') . $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->type !== 'Owner'
            && !Auth::user()->can('Edit Orders')
            && !Auth::user()->can('Manage Orders')
            && !Auth::user()->can('Validate Orders')
        ) {
            return response()->json(['success' => false, 'message' => __('Permission denied.')], 403);
        }
        $request->validate([
            'customer_name' => 'nullable|string|max:191',
            'customer_phone' => 'nullable|string|max:191',
            'discount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'items' => 'sometimes|array',
            'items.*.id' => 'sometimes|integer',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.chassis_number' => 'nullable|string|max:191',
            'items.*.family_name' => 'nullable|string|max:191',
            'deleted_item_ids' => 'sometimes|array',
            'deleted_item_ids.*' => 'integer',
        ]);

        $order = ChassisOrder::findOrFail($id);

        // Validated orders can only be edited with the configured PIN.
        if ($order->status !== 'pending') {
            $pin = $request->input('pin');
            $expectedPin = env('CHASSIS_EDIT_PIN', '1234');
            if (empty($pin) || (string)$pin !== (string)$expectedPin) {
                return response()->json([
                    'success' => false,
                    'message' => __('Code PIN incorrect ou manquant.'),
                ], 403);
            }
        }

        DB::beginTransaction();
        try {
            $order->update([
                'customer_name' => $request->customer_name ?? $order->customer_name,
                'customer_phone' => $request->customer_phone ?? $order->customer_phone,
                'doc_type' => $request->has('doc_type') ? $request->doc_type : $order->doc_type,
                'doc_number' => $request->has('doc_number') ? $request->doc_number : $order->doc_number,
                'discount' => $request->discount ?? $order->discount,
                'notes' => $request->notes ?? $order->notes,
            ]);

            $canEditItemDetails = $order->status === 'pending';

            // Deleting items and adding new lines is only allowed while the order is still pending.
            if ($canEditItemDetails && $request->has('deleted_item_ids')) {
                ChassisOrderItem::where('chassis_order_id', $order->id)
                    ->whereIn('id', $request->deleted_item_ids)
                    ->delete();
            }

            if ($request->has('items')) {
                foreach ($request->items as $item) {
                    if (isset($item['id'])) {
                        $orderItem = ChassisOrderItem::find($item['id']);
                        if ($orderItem && $orderItem->chassis_order_id == $order->id) {
                            $itemData = ['price' => $item['price']];
                            // Chassis number and family can only be edited while the order is still pending.
                            if ($canEditItemDetails) {
                                if (isset($item['chassis_number']) && $item['chassis_number'] !== '') {
                                    $itemData['chassis_number'] = $item['chassis_number'];
                                }
                                if (isset($item['family_name']) && $item['family_name'] !== '') {
                                    $itemData['family_name'] = $item['family_name'];
                                }
                            }
                            $orderItem->update($itemData);
                        }
                    } elseif ($canEditItemDetails) {
                        // New line added in the edit modal (only allowed for pending orders).
                        ChassisOrderItem::create([
                            'chassis_order_id' => $order->id,
                            'chassis_number' => $item['chassis_number'] ?? null,
                            'family_name' => $item['family_name'] ?? null,
                            'price' => $item['price'],
                        ]);
                    }
                }
            }

            if ($request->has('items') || $request->has('deleted_item_ids')) {
                $order->update(['total_price' => $order->items()->sum('price')]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => __('Commande mise à jour avec succès'),
                'order' => $order->load('items'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => __('Erreur: ') . $e->getMessage(),
            ], 500);
        }
    }

    public function validate_order($id)
    {
        if (Auth::user()->type !== 'Owner' && !Auth::user()->can('Validate Orders')) {
            return response()->json(['success' => false, 'message' => __('Permission denied.')], 403);
        }
        $order = ChassisOrder::with('items')->findOrFail($id);

        if ($order->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => __('Cette commande ne peut plus être validée'),
            ], 400);
        }

        $order->update(['status' => 'validated']);

        return response()->json([
            'success' => true,
            'message' => __('Commande validée et archivée avec succès'),
            'order' => $order,
        ]);
    }

    public function reject($id)
    {
        if (Auth::user()->type !== 'Owner' && !Auth::user()->can('Validate Orders')) {
            return response()->json(['success' => false, 'message' => __('Permission denied.')], 403);
        }
        $order = ChassisOrder::with('items')->findOrFail($id);

        if ($order->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => __('Cette commande ne peut plus être rejetée'),
            ], 400);
        }

        DB::beginTransaction();
        try {
            foreach ($order->items as $item) {
                // Recreate chassis number in stock
                $chassis = ChassisNumber::create([
                    'chassis_number' => $item->chassis_number,
                    'variant_id' => $item->variant_id,
                    'date' => now()->toDateString(),
                    'location' => $item->location ?? 'DEPOT',
                ]);

                // Increment family quantity
                $variant = ProductVariant::find($item->variant_id);
                if ($variant) {
                    $variant->increment('quantity');
                }
            }

            $order->update(['status' => 'rejected']);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => __('Commande rejetée. Les châssis ont été remis en stock.'),
                'order' => $order,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => __('Erreur: ') . $e->getMessage(),
            ], 500);
        }
    }

    public function invoice($id)
    {
        $order = ChassisOrder::with(['items', 'signer'])->findOrFail($id);

        $canSeeInvoice = in_array(Auth::user()->type, ['super admin', 'admin', 'Owner'])
            || Auth::user()->can('Validate Orders');

        if (!$canSeeInvoice || $order->status !== 'validated') {
            return redirect()->route('chassis-orders.index')->with('error', __('Permission denied.'));
        }

        $store = \App\Models\Store::find(Auth::user()->current_store);
        return view('chassis_orders.invoice', compact('order', 'store'));
    }

    public function downloadInvoicePdf(Request $request, $id)
    {
        $order = ChassisOrder::with(['items', 'signer'])->findOrFail($id);

        $canSeeInvoice = in_array(Auth::user()->type, ['super admin', 'admin', 'Owner'])
            || Auth::user()->can('Validate Orders');

        if (!$canSeeInvoice || $order->status !== 'validated') {
            return redirect()->route('chassis-orders.index')->with('error', __('Permission denied.'));
        }

        $store = \App\Models\Store::find(Auth::user()->current_store);
        $isPdf = true;

        $pdf = Pdf::loadView('chassis_orders.invoice', compact('order', 'store', 'isPdf'))
            ->setPaper('a4', 'portrait')
            ->setOptions([
                'isRemoteEnabled'      => true,
                'isHtml5ParserEnabled' => true,
            ]);

        $filename = 'Facture-' . str_replace('/', '-', $order->order_number) . '.pdf';

        return $pdf->download($filename);
    }

    public function sign(Request $request, $id)
    {
        $request->validate(['signature' => 'required|string']);
        $order = ChassisOrder::findOrFail($id);
        $order->update([
            'signature' => $request->signature,
            'signed_at' => now(),
            'signed_by' => Auth::id(),
            'status'    => 'validated',
        ]);
        return response()->json([
            'success'   => true,
            'signed_at' => $order->signed_at->format('d/m/Y à H:i'),
            'signer'    => Auth::user()->name,
        ]);
    }

    public function destroy($id)
    {
        if (Auth::user()->type !== 'Owner' && !Auth::user()->can('Delete Orders')) {
            return response()->json(['success' => false, 'message' => __('Permission denied.')], 403);
        }
        $order = ChassisOrder::findOrFail($id);

        if ($order->status === 'validated') {
            return response()->json([
                'success' => false,
                'message' => __('Les commandes validées ne peuvent pas être supprimées'),
            ], 400);
        }

        // If pending, return items to stock first
        if ($order->status === 'pending') {
            foreach ($order->items as $item) {
                ChassisNumber::create([
                    'chassis_number' => $item->chassis_number,
                    'variant_id' => $item->variant_id,
                    'date' => now()->toDateString(),
                    'location' => $item->location ?? 'DEPOT',
                ]);

                $variant = ProductVariant::find($item->variant_id);
                if ($variant) {
                    $variant->increment('quantity');
                }
            }
        }

        $order->items()->delete();
        $order->delete();

        return response()->json([
            'success' => true,
            'message' => __('Commande supprimée avec succès'),
        ]);
    }
}
