@extends('layouts.admin')

@section('page-title')
    {{ __('Flux Financier') }}
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Tableau de bord') }}</a></li>
<li class="breadcrumb-item active" aria-current="page">{{ __('Flux Financier') }}</li>
@endsection

@php
    $fmt = fn($v) => number_format((float) $v, 2, ',', ' ') . ' MAD';
@endphp

@section('content')
<!-- Header -->
<div class="row mb-4">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
            <div>
                <h2 class="fw-bold mb-2">{{ __('Flux Financier') }}</h2>
                <p class="text-muted mb-0">{{ __('Suivi des recettes et dépenses, ventes, capital et bénéfice') }}</p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <button class="btn btn-outline-success" onclick="exportFlows()">
                    <i class="ti ti-file-export me-1"></i> {{ __('Exporter') }}
                </button>
                @if($canEdit)
                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#categoriesModal">
                    <i class="ti ti-tags me-1"></i> {{ __('Catégories') }}
                </button>
                <button class="btn btn-primary" onclick="openFlowModal()">
                    <i class="ti ti-plus me-1"></i> {{ __('Nouvelle ligne') }}
                </button>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Summary cards -->
<div class="row mb-4">
    <div class="col-md-4 col-sm-6 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted mb-1">{{ __('Total Recettes') }}</h6>
                <h4 class="fw-bold text-success mb-0">{{ $fmt($summary['total_recette']) }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted mb-1">{{ __('Total Dépenses') }}</h6>
                <h4 class="fw-bold text-danger mb-0">{{ $fmt($summary['total_depense']) }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted mb-1">{{ __('Solde') }}</h6>
                <h4 class="fw-bold {{ $summary['solde'] >= 0 ? 'text-success' : 'text-danger' }} mb-0">{{ $fmt($summary['solde']) }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted mb-1">{{ __('Capital (Achats)') }}</h6>
                <h4 class="fw-bold text-info mb-0">{{ $fmt($summary['capital']) }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted mb-1">{{ __("Chiffre d'affaires (Ventes)") }}</h6>
                <h4 class="fw-bold text-primary mb-0">{{ $fmt($summary['chiffre']) }}</h4>
            </div>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 mb-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-muted mb-1">{{ __('Bénéfice') }}</h6>
                <h4 class="fw-bold {{ $summary['benefice'] >= 0 ? 'text-success' : 'text-danger' }} mb-0">{{ $fmt($summary['benefice']) }}</h4>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('flux-financier.index') }}" class="row g-3 align-items-end">
            <div class="col-md-2">
                <label class="form-label">{{ __('Du') }}</label>
                <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">{{ __('Au') }}</label>
                <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label">{{ __('Catégorie') }}</label>
                <select name="category_id" class="form-control">
                    <option value="">{{ __('Toutes') }}</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">{{ __('Mode de paiement') }}</label>
                <select name="payment_mode" class="form-control">
                    <option value="">{{ __('Tous') }}</option>
                    @foreach($paymentModes as $mode)
                        <option value="{{ $mode }}" {{ request('payment_mode') == $mode ? 'selected' : '' }}>{{ $mode }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">{{ __('Type') }}</label>
                <select name="type" class="form-control">
                    <option value="">{{ __('Tous') }}</option>
                    <option value="recette" {{ request('type') == 'recette' ? 'selected' : '' }}>{{ __('Recette') }}</option>
                    <option value="depense" {{ request('type') == 'depense' ? 'selected' : '' }}>{{ __('Dépense') }}</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label">{{ __('Recherche') }}</label>
                <input type="text" name="search" class="form-control" placeholder="{{ __('Désignation / référence') }}" value="{{ request('search') }}">
            </div>
            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="ti ti-filter me-1"></i>{{ __('Filtrer') }}</button>
                <a href="{{ route('flux-financier.index') }}" class="btn btn-outline-secondary"><i class="ti ti-x me-1"></i>{{ __('Réinitialiser') }}</a>
            </div>
        </form>
    </div>
</div>

<!-- Grid -->
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle" id="flowsTable">
                <thead class="table-light">
                    <tr>
                        <th>{{ __('Désignation') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Catégorie') }}</th>
                        <th>{{ __('Mode de paiement') }}</th>
                        <th>{{ __('Référence') }}</th>
                        <th class="text-end">{{ __('Montant') }}</th>
                        @if($canEdit)<th class="text-center">{{ __('Actions') }}</th>@endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($flows as $flow)
                        <tr>
                            <td>
                                {{ $flow->designation }}
                                @if($flow->source === 'sale')<span class="badge bg-primary ms-1">{{ __('Vente') }}</span>@endif
                            </td>
                            <td>{{ $flow->date ? $flow->date->format('d/m/Y') : '' }}</td>
                            <td>{{ $flow->category->name ?? '-' }}</td>
                            <td>{{ $flow->payment_mode ?? '-' }}</td>
                            <td>{{ $flow->reference ?? '-' }}</td>
                            <td class="text-end fw-semibold {{ $flow->type === 'recette' ? 'text-success' : 'text-danger' }}">
                                {{ $flow->type === 'recette' ? '+' : '-' }}{{ $fmt($flow->amount) }}
                            </td>
                            @if($canEdit)
                            <td class="text-center">
                                <button class="btn btn-sm btn-icon bg-info text-white" onclick="openFlowModal({{ $flow->id }})" title="{{ __('Éditer') }}">
                                    <i class="ti ti-pencil"></i>
                                </button>
                                <button class="btn btn-sm btn-icon bg-danger text-white" onclick="deleteFlow({{ $flow->id }})" title="{{ __('Supprimer') }}">
                                    <i class="ti ti-trash"></i>
                                </button>
                            </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ $canEdit ? 7 : 6 }}" class="text-center text-muted py-4">
                                <i class="ti ti-inbox" style="font-size:2rem;"></i>
                                <div class="mt-2">{{ __('Aucune ligne trouvée') }}</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if($canEdit)
<!-- Flow Create/Edit Modal -->
<div class="modal fade" id="flowModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="flowModalTitle">{{ __('Nouvelle ligne') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="flowId">
                <div class="mb-3">
                    <label class="form-label">{{ __('Désignation') }}</label>
                    <input type="text" class="form-control" id="flowDesignation" placeholder="{{ __('Ex: Vidange huile, achat pièce...') }}">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('Date') }}</label>
                        <input type="date" class="form-control" id="flowDate" value="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('Catégorie') }}</label>
                        <select class="form-control" id="flowCategory">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" data-type="{{ $cat->type }}">{{ $cat->name }} ({{ $cat->type === 'recette' ? __('Recette') : __('Dépense') }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('Mode de paiement') }}</label>
                        <select class="form-control" id="flowPaymentMode">
                            <option value="">{{ __('—') }}</option>
                            @foreach($paymentModes as $mode)
                                <option value="{{ $mode }}">{{ $mode }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">{{ __('Montant') }}</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="flowAmount" min="0" step="0.01" placeholder="0.00">
                            <span class="input-group-text">MAD</span>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">{{ __('Référence') }}</label>
                        <input type="text" class="form-control" id="flowReference" placeholder="{{ __('Numéro / châssis / référence (optionnel)') }}">
                    </div>
                    <div class="col-12 mb-3">
                        <label class="form-label">{{ __('Notes') }}</label>
                        <textarea class="form-control" id="flowNotes" rows="2"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                <button type="button" class="btn btn-primary" onclick="saveFlow()">{{ __('Enregistrer') }}</button>
            </div>
        </div>
    </div>
</div>

<!-- Categories Modal -->
<div class="modal fade" id="categoriesModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Gestion des catégories') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-2 align-items-end mb-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('Nom') }}</label>
                        <input type="text" class="form-control" id="newCatName" placeholder="{{ __('Nom de la catégorie') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">{{ __('Type') }}</label>
                        <select class="form-control" id="newCatType">
                            <option value="recette">{{ __('Recette') }}</option>
                            <option value="depense">{{ __('Dépense') }}</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-primary w-100" onclick="addCategory()">{{ __('Ajouter') }}</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-sm align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('Nom') }}</th>
                                <th>{{ __('Type') }}</th>
                                <th class="text-center">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $cat)
                            <tr data-cat-id="{{ $cat->id }}">
                                <td><input type="text" class="form-control form-control-sm cat-name" value="{{ $cat->name }}"></td>
                                <td>
                                    <select class="form-control form-control-sm cat-type">
                                        <option value="recette" {{ $cat->type === 'recette' ? 'selected' : '' }}>{{ __('Recette') }}</option>
                                        <option value="depense" {{ $cat->type === 'depense' ? 'selected' : '' }}>{{ __('Dépense') }}</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-icon bg-info text-white" onclick="updateCategory({{ $cat->id }})" title="{{ __('Enregistrer') }}"><i class="ti ti-device-floppy"></i></button>
                                    <button class="btn btn-sm btn-icon bg-danger text-white" onclick="deleteCategory({{ $cat->id }})" title="{{ __('Supprimer') }}"><i class="ti ti-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@endsection

@push('script-page')
<script>
const FLUX_ROUTES = {
    store: "{{ route('flux-financier.store') }}",
    edit: id => `{{ url('flux-financier') }}/${id}/edit`,
    update: id => `{{ url('flux-financier') }}/${id}`,
    destroy: id => `{{ url('flux-financier') }}/${id}`,
    catStore: "{{ route('flux-financier.categories.store') }}",
    catUpdate: id => `{{ url('flux-financier/categories') }}/${id}`,
    catDestroy: id => `{{ url('flux-financier/categories') }}/${id}`,
};
const CSRF = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function fluxToast(message, type = 'success') {
    const div = document.createElement('div');
    div.className = `alert alert-${type} position-fixed shadow`;
    div.style.cssText = 'top:20px;right:20px;z-index:99999;min-width:280px;';
    div.textContent = message;
    document.body.appendChild(div);
    setTimeout(() => div.remove(), 3000);
}

function openFlowModal(id) {
    document.getElementById('flowId').value = id || '';
    document.getElementById('flowModalTitle').textContent = id ? '{{ __("Éditer la ligne") }}' : '{{ __("Nouvelle ligne") }}';
    if (!id) {
        document.getElementById('flowDesignation').value = '';
        document.getElementById('flowDate').value = '{{ date("Y-m-d") }}';
        document.getElementById('flowAmount').value = '';
        document.getElementById('flowReference').value = '';
        document.getElementById('flowNotes').value = '';
        document.getElementById('flowPaymentMode').value = '';
        new bootstrap.Modal(document.getElementById('flowModal')).show();
        return;
    }
    fetch(FLUX_ROUTES.edit(id), { headers: { 'Accept': 'application/json' } })
        .then(r => r.json())
        .then(data => {
            const f = data.flow;
            document.getElementById('flowDesignation').value = f.designation || '';
            document.getElementById('flowDate').value = f.date ? f.date.substring(0, 10) : '';
            document.getElementById('flowCategory').value = f.flow_category_id || '';
            document.getElementById('flowPaymentMode').value = f.payment_mode || '';
            document.getElementById('flowAmount').value = f.amount || '';
            document.getElementById('flowReference').value = f.reference || '';
            document.getElementById('flowNotes').value = f.notes || '';
            new bootstrap.Modal(document.getElementById('flowModal')).show();
        });
}

function saveFlow() {
    const id = document.getElementById('flowId').value;
    const payload = {
        date: document.getElementById('flowDate').value,
        designation: document.getElementById('flowDesignation').value,
        flow_category_id: document.getElementById('flowCategory').value,
        payment_mode: document.getElementById('flowPaymentMode').value,
        amount: document.getElementById('flowAmount').value,
        reference: document.getElementById('flowReference').value,
        notes: document.getElementById('flowNotes').value,
    };
    const url = id ? FLUX_ROUTES.update(id) : FLUX_ROUTES.store;
    const method = id ? 'PUT' : 'POST';

    fetch(url, {
        method,
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify(payload),
    })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                fluxToast(data.message);
                setTimeout(() => location.reload(), 600);
            } else {
                fluxToast(data.message || '{{ __("Erreur") }}', 'danger');
            }
        })
        .catch(() => fluxToast('{{ __("Erreur réseau") }}', 'danger'));
}

function deleteFlow(id) {
    if (!confirm('{{ __("Supprimer cette ligne ?") }}')) return;
    fetch(FLUX_ROUTES.destroy(id), {
        method: 'DELETE',
        headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
    })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                fluxToast(data.message);
                setTimeout(() => location.reload(), 500);
            } else {
                fluxToast(data.message || '{{ __("Erreur") }}', 'danger');
            }
        });
}

function addCategory() {
    const name = document.getElementById('newCatName').value.trim();
    const type = document.getElementById('newCatType').value;
    if (!name) { fluxToast('{{ __("Le nom est requis") }}', 'danger'); return; }
    fetch(FLUX_ROUTES.catStore, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({ name, type }),
    })
        .then(r => r.json())
        .then(data => {
            if (data.success) { fluxToast(data.message); setTimeout(() => location.reload(), 500); }
            else fluxToast(data.message || '{{ __("Erreur") }}', 'danger');
        });
}

function updateCategory(id) {
    const row = document.querySelector(`tr[data-cat-id="${id}"]`);
    const name = row.querySelector('.cat-name').value.trim();
    const type = row.querySelector('.cat-type').value;
    fetch(FLUX_ROUTES.catUpdate(id), {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
        body: JSON.stringify({ name, type }),
    })
        .then(r => r.json())
        .then(data => {
            if (data.success) { fluxToast(data.message); }
            else fluxToast(data.message || '{{ __("Erreur") }}', 'danger');
        });
}

function deleteCategory(id) {
    if (!confirm('{{ __("Supprimer cette catégorie ?") }}')) return;
    fetch(FLUX_ROUTES.catDestroy(id), {
        method: 'DELETE',
        headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': CSRF },
    })
        .then(r => r.json())
        .then(data => {
            if (data.success) { fluxToast(data.message); setTimeout(() => location.reload(), 500); }
            else fluxToast(data.message || '{{ __("Erreur") }}', 'danger');
        });
}

function exportFlows() {
    const rows = [['Designation', 'Date', 'Categorie', 'Mode de paiement', 'Reference', 'Type', 'Montant']];
    document.querySelectorAll('#flowsTable tbody tr').forEach(tr => {
        const cells = tr.querySelectorAll('td');
        if (cells.length < 6) return;
        rows.push([
            cells[0].innerText.trim(),
            cells[1].innerText.trim(),
            cells[2].innerText.trim(),
            cells[3].innerText.trim(),
            cells[4].innerText.trim(),
            cells[5].innerText.includes('+') ? 'Recette' : 'Depense',
            cells[5].innerText.replace(/[+\-]/g, '').replace('MAD', '').trim(),
        ]);
    });
    const csv = rows.map(r => r.map(c => `"${String(c).replace(/"/g, '""')}"`).join(',')).join('\n');
    const blob = new Blob(["\uFEFF" + csv], { type: 'text/csv;charset=utf-8;' });
    const a = document.createElement('a');
    a.href = URL.createObjectURL(blob);
    a.download = 'flux-financier-' + new Date().toISOString().slice(0, 10) + '.csv';
    a.click();
}
</script>
@endpush
