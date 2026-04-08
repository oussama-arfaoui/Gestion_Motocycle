@extends('layouts.admin')
@section('page-title', __('Commandes'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Home') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Commandes') }}</li>
@endsection
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ __('Liste des Commandes') }}</h5>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="orders-table">
                        <thead>
                            <tr>
                                <th>{{ __('N° Commande') }}</th>
                                <th>{{ __('Client') }}</th>
                                <th>{{ __('Articles') }}</th>
                                <th>{{ __('Total') }}</th>
                                <th>{{ __('Statut') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th class="text-end">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td><strong>{{ $order->order_number }}</strong></td>
                                    <td>{{ $order->customer_name ?? '-' }}</td>
                                    <td>
                                        @foreach($order->items as $item)
                                            <div class="mb-1">
                                                <small class="text-muted">{{ $item->brand_name }}</small> &rarr;
                                                <small>{{ $item->model_name }}</small> &rarr;
                                                <small class="fw-bold">{{ $item->family_name }}</small><br>
                                                <span class="badge bg-info">{{ $item->chassis_number }}</span>
                                                <span class="badge bg-secondary">{{ \App\Models\Utility::priceFormat($item->price) }}</span>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td><strong>{{ \App\Models\Utility::priceFormat($order->total_price) }}</strong></td>
                                    <td>
                                        @if($order->status == 'pending')
                                            <span class="badge bg-warning text-dark">{{ __('En attente') }}</span>
                                        @elseif($order->status == 'validated')
                                            <span class="badge bg-success">{{ __('Validée') }}</span>
                                        @elseif($order->status == 'rejected')
                                            <span class="badge bg-danger">{{ __('Rejetée') }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="text-end">
                                        <div class="d-flex justify-content-end gap-1">
                                            <!-- Invoice -->
                                            <a href="{{ route('chassis-orders.invoice', $order->id) }}" 
                                               class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="{{ __('Facture') }}" target="_blank">
                                                <i class="ti ti-file-invoice"></i>
                                            </a>
                                            <!-- View -->
                                            <button class="btn btn-sm btn-outline-info view-order-btn" 
                                                    data-id="{{ $order->id }}" data-bs-toggle="tooltip" title="{{ __('Voir') }}">
                                                <i class="ti ti-eye"></i>
                                            </button>
                                            @if($order->status == 'pending')
                                                <!-- Edit -->
                                                <button class="btn btn-sm btn-outline-warning edit-order-btn" 
                                                        data-id="{{ $order->id }}" data-bs-toggle="tooltip" title="{{ __('Modifier') }}">
                                                    <i class="ti ti-pencil"></i>
                                                </button>
                                                <!-- Validate -->
                                                <button class="btn btn-sm btn-outline-success validate-order-btn" 
                                                        data-id="{{ $order->id }}" data-bs-toggle="tooltip" title="{{ __('Valider') }}">
                                                    <i class="ti ti-check"></i>
                                                </button>
                                                <!-- Reject -->
                                                <button class="btn btn-sm btn-outline-danger reject-order-btn" 
                                                        data-id="{{ $order->id }}" data-bs-toggle="tooltip" title="{{ __('Rejeter') }}">
                                                    <i class="ti ti-x"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <i class="ti ti-receipt text-muted" style="font-size: 3rem;"></i>
                                        <h6 class="mt-2 text-muted">{{ __('Aucune commande trouvée') }}</h6>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- View Order Modal -->
<div class="modal fade" id="viewOrderModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Détails de la commande') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="viewOrderBody">
                <div class="text-center py-3">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Order Modal -->
<div class="modal fade" id="editOrderModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Modifier la commande') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="editOrderBody">
                <div class="text-center py-3">
                    <div class="spinner-border text-primary" role="status"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                <button type="button" class="btn btn-primary" id="saveOrderEdit">{{ __('Enregistrer') }}</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script-page')
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // View Order
    document.querySelectorAll('.view-order-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const modal = new bootstrap.Modal(document.getElementById('viewOrderModal'));
            modal.show();
            
            fetch(`/chassis-orders/${id}`, {
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }
            })
            .then(r => r.json())
            .then(data => {
                const order = data.order;
                let html = `
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>{{ __('N° Commande') }}:</strong> ${order.order_number}<br>
                            <strong>{{ __('Client') }}:</strong> ${order.customer_name || '-'}<br>
                            <strong>{{ __('Téléphone') }}:</strong> ${order.customer_phone || '-'}
                        </div>
                        <div class="col-md-6 text-end">
                            <strong>{{ __('Statut') }}:</strong> 
                            <span class="badge bg-${order.status === 'validated' ? 'success' : (order.status === 'rejected' ? 'danger' : 'warning')}">${order.status}</span><br>
                            <strong>{{ __('Total') }}:</strong> ${parseFloat(order.total_price).toLocaleString()} <br>
                            <strong>{{ __('Remise') }}:</strong> ${parseFloat(order.discount).toLocaleString()}
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('Marque') }}</th>
                                <th>{{ __('Modèle') }}</th>
                                <th>{{ __('Famille') }}</th>
                                <th>{{ __('N° Châssis') }}</th>
                                <th>{{ __('Emplacement') }}</th>
                                <th>{{ __('Prix') }}</th>
                            </tr>
                        </thead>
                        <tbody>`;
                order.items.forEach(item => {
                    html += `<tr>
                        <td>${item.brand_name || '-'}</td>
                        <td>${item.model_name || '-'}</td>
                        <td>${item.family_name || '-'}</td>
                        <td><span class="badge bg-info">${item.chassis_number}</span></td>
                        <td>${item.location || '-'}</td>
                        <td>${parseFloat(item.price).toLocaleString()}</td>
                    </tr>`;
                });
                html += `</tbody></table>`;
                if (order.notes) {
                    html += `<div class="mt-2"><strong>{{ __('Notes') }}:</strong> ${order.notes}</div>`;
                }
                document.getElementById('viewOrderBody').innerHTML = html;
            });
        });
    });

    // Edit Order
    let editingOrderId = null;
    document.querySelectorAll('.edit-order-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            editingOrderId = this.dataset.id;
            const modal = new bootstrap.Modal(document.getElementById('editOrderModal'));
            modal.show();
            
            fetch(`/chassis-orders/${editingOrderId}`, {
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }
            })
            .then(r => r.json())
            .then(data => {
                const order = data.order;
                let html = `
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">{{ __('Nom du client') }}</label>
                            <input type="text" class="form-control" id="edit_customer_name" value="${order.customer_name || ''}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">{{ __('Téléphone') }}</label>
                            <input type="text" class="form-control" id="edit_customer_phone" value="${order.customer_phone || ''}">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Remise') }}</label>
                        <input type="number" class="form-control" id="edit_discount" value="${order.discount || 0}" min="0" step="0.01">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ __('Notes') }}</label>
                        <textarea class="form-control" id="edit_notes" rows="2">${order.notes || ''}</textarea>
                    </div>
                    <h6>{{ __('Articles - Modifier les prix') }}</h6>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('N° Châssis') }}</th>
                                <th>{{ __('Famille') }}</th>
                                <th>{{ __('Prix') }}</th>
                            </tr>
                        </thead>
                        <tbody>`;
                order.items.forEach(item => {
                    html += `<tr>
                        <td>${item.chassis_number}</td>
                        <td>${item.family_name || '-'}</td>
                        <td><input type="number" class="form-control edit-item-price" data-item-id="${item.id}" value="${item.price}" min="0" step="0.01"></td>
                    </tr>`;
                });
                html += `</tbody></table>`;
                document.getElementById('editOrderBody').innerHTML = html;
            });
        });
    });

    document.getElementById('saveOrderEdit').addEventListener('click', function() {
        if (!editingOrderId) return;
        
        const items = [];
        document.querySelectorAll('.edit-item-price').forEach(input => {
            items.push({ id: parseInt(input.dataset.itemId), price: parseFloat(input.value) });
        });

        fetch(`/chassis-orders/${editingOrderId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                customer_name: document.getElementById('edit_customer_name').value,
                customer_phone: document.getElementById('edit_customer_phone').value,
                discount: parseFloat(document.getElementById('edit_discount').value) || 0,
                notes: document.getElementById('edit_notes').value,
                items: items
            })
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                bootstrap.Modal.getInstance(document.getElementById('editOrderModal')).hide();
                show_toastr('Success', data.message, 'success');
                setTimeout(() => location.reload(), 1000);
            } else {
                show_toastr('Error', data.message, 'error');
            }
        });
    });

    // Validate Order
    document.querySelectorAll('.validate-order-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (!confirm('{{ __("Êtes-vous sûr de vouloir valider cette commande ?") }}')) return;
            const id = this.dataset.id;
            
            fetch(`/chassis-orders/${id}/validate`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    show_toastr('Success', data.message, 'success');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    show_toastr('Error', data.message, 'error');
                }
            });
        });
    });

    // Reject Order
    document.querySelectorAll('.reject-order-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (!confirm('{{ __("Êtes-vous sûr de vouloir rejeter cette commande ? Les châssis seront remis en stock.") }}')) return;
            const id = this.dataset.id;
            
            fetch(`/chassis-orders/${id}/reject`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    show_toastr('Success', data.message, 'success');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    show_toastr('Error', data.message, 'error');
                }
            });
        });
    });
</script>
@endpush
