<?php

namespace App\Http\Controllers;

use App\Models\FinancialFlow;
use App\Models\FlowCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinancialFlowController extends Controller
{
    /**
     * Modes de paiement disponibles.
     */
    public static function paymentModes(): array
    {
        return ['Espèces', 'Chèque', 'Virement', 'Carte bancaire', 'Crédit'];
    }

    private function canManage(): bool
    {
        $user = Auth::user();
        return $user && ($user->type === 'Owner' || $user->can('Manage Flux') || $user->can('Show Flux'));
    }

    private function canEdit(): bool
    {
        $user = Auth::user();
        return $user && ($user->type === 'Owner' || $user->can('Create Flux') || $user->can('Edit Flux'));
    }

    public function index(Request $request)
    {
        if (!$this->canManage()) {
            return redirect()->route('profile')->with('error', __('Permission denied.'));
        }

        $query = FinancialFlow::with('category');

        // Filtres
        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }
        if ($request->filled('category_id')) {
            $query->where('flow_category_id', $request->category_id);
        }
        if ($request->filled('payment_mode')) {
            $query->where('payment_mode', $request->payment_mode);
        }
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('designation', 'like', "%{$s}%")
                  ->orWhere('reference', 'like', "%{$s}%");
            });
        }

        $flows = $query->orderBy('date', 'desc')->orderBy('id', 'desc')->get();

        // Synthèse
        $totalRecette = (float) $flows->where('type', 'recette')->sum('amount');
        $totalDepense = (float) $flows->where('type', 'depense')->sum('amount');
        $solde        = $totalRecette - $totalDepense;

        $saleFlows    = $flows->where('source', 'sale');
        $capital      = (float) $saleFlows->sum('purchase_price');
        $chiffre      = (float) $saleFlows->sum('sale_price');
        $benefice     = $chiffre - $capital;

        $summary = [
            'total_recette' => $totalRecette,
            'total_depense' => $totalDepense,
            'solde'         => $solde,
            'capital'       => $capital,
            'chiffre'       => $chiffre,
            'benefice'      => $benefice,
            'count'         => $flows->count(),
        ];

        $categories   = FlowCategory::orderBy('type')->orderBy('name')->get();
        $paymentModes = self::paymentModes();
        $canEdit      = $this->canEdit();

        return view('flux_financier.index', compact('flows', 'summary', 'categories', 'paymentModes', 'canEdit'));
    }

    public function store(Request $request)
    {
        if (!$this->canEdit()) {
            return response()->json(['success' => false, 'message' => __('Permission denied.')], 403);
        }

        $data = $request->validate([
            'date'             => 'required|date',
            'designation'      => 'required|string|max:191',
            'flow_category_id' => 'required|exists:flow_categories,id',
            'payment_mode'     => 'nullable|string|max:50',
            'amount'           => 'required|numeric|min:0',
            'reference'        => 'nullable|string|max:191',
            'notes'            => 'nullable|string',
        ]);

        $category = FlowCategory::find($data['flow_category_id']);

        FinancialFlow::create([
            'date'             => $data['date'],
            'designation'      => $data['designation'],
            'flow_category_id' => $data['flow_category_id'],
            'type'             => $category ? $category->type : 'recette',
            'payment_mode'     => $data['payment_mode'] ?? null,
            'amount'           => $data['amount'],
            'reference'        => $data['reference'] ?? null,
            'source'           => 'manual',
            'store_id'         => Auth::user()->current_store ?? null,
            'user_id'          => Auth::id(),
            'notes'            => $data['notes'] ?? null,
        ]);

        return response()->json(['success' => true, 'message' => __('Ligne ajoutée avec succès.')]);
    }

    public function edit($id)
    {
        if (!$this->canManage()) {
            return response()->json(['success' => false, 'message' => __('Permission denied.')], 403);
        }
        $flow = FinancialFlow::findOrFail($id);
        return response()->json(['flow' => $flow]);
    }

    public function update(Request $request, $id)
    {
        if (!$this->canEdit()) {
            return response()->json(['success' => false, 'message' => __('Permission denied.')], 403);
        }

        $flow = FinancialFlow::findOrFail($id);

        $data = $request->validate([
            'date'             => 'required|date',
            'designation'      => 'required|string|max:191',
            'flow_category_id' => 'required|exists:flow_categories,id',
            'payment_mode'     => 'nullable|string|max:50',
            'amount'           => 'required|numeric|min:0',
            'reference'        => 'nullable|string|max:191',
            'notes'            => 'nullable|string',
        ]);

        $category = FlowCategory::find($data['flow_category_id']);

        $flow->update([
            'date'             => $data['date'],
            'designation'      => $data['designation'],
            'flow_category_id' => $data['flow_category_id'],
            'type'             => $category ? $category->type : $flow->type,
            'payment_mode'     => $data['payment_mode'] ?? null,
            'amount'           => $data['amount'],
            'reference'        => $data['reference'] ?? null,
            'notes'            => $data['notes'] ?? null,
        ]);

        return response()->json(['success' => true, 'message' => __('Ligne mise à jour avec succès.')]);
    }

    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user || ($user->type !== 'Owner' && !$user->can('Delete Flux'))) {
            return response()->json(['success' => false, 'message' => __('Permission denied.')], 403);
        }

        $flow = FinancialFlow::findOrFail($id);
        $flow->delete();

        return response()->json(['success' => true, 'message' => __('Ligne supprimée avec succès.')]);
    }

    // ---------- Gestion des catégories (admin) ----------

    public function storeCategory(Request $request)
    {
        if (!$this->canEdit()) {
            return response()->json(['success' => false, 'message' => __('Permission denied.')], 403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:191',
            'type' => 'required|in:recette,depense',
        ]);

        $category = FlowCategory::create([
            'name'      => $data['name'],
            'type'      => $data['type'],
            'is_active' => true,
        ]);

        return response()->json(['success' => true, 'message' => __('Catégorie ajoutée.'), 'category' => $category]);
    }

    public function updateCategory(Request $request, $id)
    {
        if (!$this->canEdit()) {
            return response()->json(['success' => false, 'message' => __('Permission denied.')], 403);
        }

        $category = FlowCategory::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'type' => 'required|in:recette,depense',
        ]);

        $category->update($data);

        // Garder la cohérence du type sur les lignes existantes
        FinancialFlow::where('flow_category_id', $category->id)->update(['type' => $category->type]);

        return response()->json(['success' => true, 'message' => __('Catégorie mise à jour.')]);
    }

    public function destroyCategory($id)
    {
        $user = Auth::user();
        if (!$user || ($user->type !== 'Owner' && !$user->can('Delete Flux'))) {
            return response()->json(['success' => false, 'message' => __('Permission denied.')], 403);
        }

        $category = FlowCategory::findOrFail($id);
        if ($category->flows()->exists()) {
            return response()->json(['success' => false, 'message' => __('Impossible de supprimer : des lignes utilisent cette catégorie.')], 422);
        }
        $category->delete();

        return response()->json(['success' => true, 'message' => __('Catégorie supprimée.')]);
    }
}
