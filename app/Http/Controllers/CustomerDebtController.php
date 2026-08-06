<?php

namespace App\Http\Controllers;

use App\Models\CustomerDebt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerDebtController extends Controller
{
    public function index(Request $request)
    {
        $storeId = Auth::user()->current_store;
        $query = CustomerDebt::where('store_id', $storeId)
            ->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $term = '%' . $request->search . '%';
            $query->where(function ($q) use ($term) {
                $q->where('customer_name', 'like', $term)
                  ->orWhere('customer_phone', 'like', $term)
                  ->orWhere('doc_number', 'like', $term);
            });
        }

        $debts = $query->get();

        return response()->json([
            'debts' => $debts,
            'total_remaining' => $debts->sum('remaining_amount'),
            'total_paid' => $debts->sum('paid_amount'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name'   => 'nullable|string|max:191',
            'customer_phone'  => 'nullable|string|max:191',
            'doc_type'        => 'nullable|in:CIN,RC,ICE',
            'doc_number'      => 'nullable|string|max:100',
            'total_amount'    => 'required|numeric|min:0',
            'paid_amount'     => 'nullable|numeric|min:0',
            'order_info'      => 'nullable|string|max:255',
            'notes'           => 'nullable|string',
        ]);

        $debt = CustomerDebt::create([
            'customer_name'   => $request->customer_name,
            'customer_phone'  => $request->customer_phone,
            'doc_type'        => $request->doc_type,
            'doc_number'      => $request->doc_number,
            'total_amount'    => $request->total_amount,
            'paid_amount'     => $request->paid_amount ?? 0,
            'order_info'      => $request->order_info,
            'notes'           => $request->notes,
            'user_id'         => Auth::id(),
            'store_id'        => Auth::user()->current_store,
        ]);

        return response()->json(['success' => true, 'debt' => $debt]);
    }

    public function update(Request $request, $id)
    {
        $debt = CustomerDebt::where('store_id', Auth::user()->current_store)->findOrFail($id);

        $request->validate([
            'paid_amount' => 'nullable|numeric|min:0',
            'notes'       => 'nullable|string',
        ]);

        $updates = [];
        if ($request->has('paid_amount')) {
            $updates['paid_amount'] = min($debt->total_amount, max(0, (float)$request->paid_amount));
        }
        if ($request->has('notes')) {
            $updates['notes'] = $request->notes;
        }
        $debt->update($updates);

        return response()->json(['success' => true, 'debt' => $debt->fresh()]);
    }

    public function destroy($id)
    {
        $debt = CustomerDebt::where('store_id', Auth::user()->current_store)->findOrFail($id);
        $debt->delete();
        return response()->json(['success' => true]);
    }
}
