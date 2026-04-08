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

class ChassisOrderController extends Controller
{
    public function index()
    {
        $orders = ChassisOrder::with('items')
            ->where('store_id', Auth::user()->current_store)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('chassis_orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = ChassisOrder::with('items')->findOrFail($id);
        return response()->json(['order' => $order]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'nullable|string|max:191',
            'customer_phone' => 'nullable|string|max:191',
            'discount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.chassis_number_id' => 'required|integer',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();
        try {
            $order = ChassisOrder::create([
                'order_number' => ChassisOrder::generateOrderNumber(),
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'discount' => $request->discount ?? 0,
                'status' => 'pending',
                'user_id' => Auth::id(),
                'store_id' => Auth::user()->current_store,
                'notes' => $request->notes,
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

            $order->update(['total_price' => $totalPrice]);

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
        $request->validate([
            'customer_name' => 'nullable|string|max:191',
            'customer_phone' => 'nullable|string|max:191',
            'discount' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
            'items' => 'sometimes|array',
            'items.*.id' => 'sometimes|integer',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        $order = ChassisOrder::findOrFail($id);

        if ($order->status !== 'pending') {
            return response()->json([
                'success' => false,
                'message' => __('Seules les commandes en attente peuvent être modifiées'),
            ], 400);
        }

        DB::beginTransaction();
        try {
            $order->update([
                'customer_name' => $request->customer_name ?? $order->customer_name,
                'customer_phone' => $request->customer_phone ?? $order->customer_phone,
                'discount' => $request->discount ?? $order->discount,
                'notes' => $request->notes ?? $order->notes,
            ]);

            if ($request->has('items')) {
                $totalPrice = 0;
                foreach ($request->items as $item) {
                    if (isset($item['id'])) {
                        $orderItem = ChassisOrderItem::find($item['id']);
                        if ($orderItem && $orderItem->chassis_order_id == $order->id) {
                            $orderItem->update(['price' => $item['price']]);
                        }
                    }
                    $totalPrice += $item['price'];
                }
                $order->update(['total_price' => $totalPrice]);
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
        $order = ChassisOrder::with('items')->findOrFail($id);
        return view('chassis_orders.invoice', compact('order'));
    }

    public function destroy($id)
    {
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
