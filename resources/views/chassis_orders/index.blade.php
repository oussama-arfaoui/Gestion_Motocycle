@extends('layouts.admin')
@section('page-title', __('Commandes'))
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Maison') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Commandes') }}</li>
@endsection
@push('css-page')
<style>
    /* ── Stats cards ── */
    .stat-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: transform .15s, box-shadow .15s;
        cursor: pointer;
    }
    .stat-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,.12); }
    .stat-card .stat-icon {
        width: 48px; height: 48px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px;
    }
    .stat-card .stat-val { font-size: 28px; font-weight: 800; line-height: 1; }
    .stat-card .stat-lbl { font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: .5px; }

    /* ── Validation flow ── */
    .flow-bar {
        display: flex;
        align-items: center;
        gap: 0;
        background: #f8f9fa;
        border-radius: 10px;
        padding: 12px 20px;
        border: 1px solid #e9ecef;
    }
    .flow-step {
        display: flex; align-items: center; gap: 8px;
        font-size: 12px; font-weight: 600;
    }
    .flow-dot {
        width: 12px; height: 12px; border-radius: 50%;
        flex-shrink: 0;
    }
    .flow-arrow {
        width: 40px; height: 2px;
        background: #dee2e6;
        flex-shrink: 0;
        position: relative;
        margin: 0 4px;
    }
    .flow-arrow::after {
        content: '';
        position: absolute;
        right: -4px; top: -4px;
        border: 5px solid transparent;
        border-left-color: #dee2e6;
    }

    /* ── Filter tabs ── */
    .filter-tabs { border-bottom: 2px solid #e9ecef; margin-bottom: 0; }
    .filter-tabs .nav-link {
        border: none; border-bottom: 3px solid transparent;
        padding: 8px 16px; font-size: 13px; font-weight: 600;
        color: #6c757d; margin-bottom: -2px; border-radius: 0;
    }
    .filter-tabs .nav-link.active { color: #e85d04; border-bottom-color: #e85d04; background: none; }
    .filter-tabs .nav-link:hover:not(.active) { color: #495057; background: #f8f9fa; }
    .filter-tabs .badge-count {
        font-size: 10px; padding: 2px 6px; border-radius: 10px;
        margin-left: 4px; font-weight: 700;
    }

    /* ── Table rows ── */
    .orders-table tr.order-row { border-left: 4px solid transparent; transition: background .1s; }
    .orders-table tr.order-row.status-pending   { border-left-color: #f59e0b; }
    .orders-table tr.order-row.status-validated { border-left-color: #10b981; }
    .orders-table tr.order-row.status-rejected  { border-left-color: #ef4444; }
    .orders-table tr.order-row:hover { background: #fafafa; }

    /* ── Status pill ── */
    .status-pill {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 4px 10px; border-radius: 20px;
        font-size: 11px; font-weight: 700; letter-spacing: .3px;
    }
    .status-pill .dot { width: 7px; height: 7px; border-radius: 50%; }
    .pill-pending   { background: #fff8e7; color: #92600a; border: 1px solid #fbbf24; }
    .pill-pending .dot   { background: #f59e0b; }
    .pill-validated { background: #ecfdf5; color: #065f46; border: 1px solid #6ee7b7; }
    .pill-validated .dot { background: #10b981; }
    .pill-rejected  { background: #fef2f2; color: #991b1b; border: 1px solid #fca5a5; }
    .pill-rejected .dot  { background: #ef4444; }

    /* ── Order number ── */
    .order-num {
        font-family: monospace; font-size: 13px; font-weight: 700;
        color: #1a1a2e; letter-spacing: .5px;
    }
    .order-num small { font-size: 10px; color: #999; font-family: sans-serif; font-weight: 400; }

    /* ── Item chips ── */
    .item-chip {
        display: inline-flex; align-items: center; gap: 4px;
        background: #f0f4ff; border: 1px solid #c7d2fe;
        border-radius: 6px; padding: 2px 7px;
        font-size: 11px; font-weight: 600; color: #3730a3;
        margin: 1px 0;
    }
    .price-chip {
        display: inline-block;
        background: #f0fdf4; border: 1px solid #bbf7d0;
        border-radius: 5px; padding: 1px 7px;
        font-size: 11px; font-weight: 600; color: #166534;
    }

    /* ── Total ── */
    .total-val { font-size: 14px; font-weight: 700; color: #1a1a2e; }
    .tva-note  { font-size: 10px; color: #999; }

    /* ── Empty state ── */
    .empty-state { padding: 60px 20px; text-align: center; }
    .empty-state .empty-icon { font-size: 64px; color: #dee2e6; }
</style>
@endpush
@section('content')

{{-- ── STATS CARDS ── --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-md-3">
        <div class="card stat-card h-100 filter-stat" data-filter="all">
            <div class="card-body d-flex align-items-center gap-3" style="background:linear-gradient(135deg,#1a1a2e 60%,#2d2d44);">
                <div class="stat-icon" style="background:rgba(255,255,255,.1);">
                    <i class="ti ti-clipboard-list" style="color:#fff;"></i>
                </div>
                <div>
                    <div class="stat-val" style="color:#fff;">{{ $stats['total'] }}</div>
                    <div class="stat-lbl" style="color:rgba(255,255,255,.6);">Total</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card h-100 filter-stat" data-filter="pending">
            <div class="card-body d-flex align-items-center gap-3" style="background:linear-gradient(135deg,#fffbeb,#fef3c7);">
                <div class="stat-icon" style="background:#fef3c7;">
                    <i class="ti ti-clock" style="color:#d97706;"></i>
                </div>
                <div>
                    <div class="stat-val" style="color:#d97706;">{{ $stats['pending'] }}</div>
                    <div class="stat-lbl" style="color:#92600a;">En attente</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card h-100 filter-stat" data-filter="validated">
            <div class="card-body d-flex align-items-center gap-3" style="background:linear-gradient(135deg,#f0fdf4,#dcfce7);">
                <div class="stat-icon" style="background:#dcfce7;">
                    <i class="ti ti-circle-check" style="color:#16a34a;"></i>
                </div>
                <div>
                    <div class="stat-val" style="color:#16a34a;">{{ $stats['validated'] }}</div>
                    <div class="stat-lbl" style="color:#065f46;">Validées</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card stat-card h-100 filter-stat" data-filter="rejected">
            <div class="card-body d-flex align-items-center gap-3" style="background:linear-gradient(135deg,#fff1f2,#fee2e2);">
                <div class="stat-icon" style="background:#fee2e2;">
                    <i class="ti ti-circle-x" style="color:#dc2626;"></i>
                </div>
                <div>
                    <div class="stat-val" style="color:#dc2626;">{{ $stats['rejected'] }}</div>
                    <div class="stat-lbl" style="color:#991b1b;">Rejetées</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── VALIDATION FLOW ── --}}
<div class="flow-bar mb-4">
    <span style="font-size:11px;font-weight:700;color:#999;text-transform:uppercase;letter-spacing:1px;margin-right:16px;">Flux</span>
    <div class="flow-step">
        <div class="flow-dot" style="background:#f59e0b;"></div>
        <span style="color:#92600a;">Créée</span>
        <span style="color:#bbb;font-weight:400;font-size:11px;">({{ $stats['pending'] }})</span>
    </div>
    <div class="flow-arrow"></div>
    <div class="flow-step">
        <div class="flow-dot" style="background:#3b82f6;"></div>
        <span style="color:#1e40af;">En traitement</span>
    </div>
    <div class="flow-arrow"></div>
    <div class="flow-step">
        <div class="flow-dot" style="background:#10b981;"></div>
        <span style="color:#065f46;">Validée</span>
        <span style="color:#bbb;font-weight:400;font-size:11px;">({{ $stats['validated'] }})</span>
    </div>
    <div class="ms-auto d-flex align-items-center gap-6" style="gap:20px;">
        <div class="flow-step">
            <div class="flow-dot" style="background:#ef4444;"></div>
            <span style="color:#991b1b;">Rejetée</span>
            <span style="color:#bbb;font-weight:400;font-size:11px;">({{ $stats['rejected'] }})</span>
        </div>
    </div>
</div>

{{-- ── MAIN TABLE CARD ── --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom-0 pb-0 pt-3 px-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0 fw-bold">{{ __('Liste des Commandes') }}</h5>
        </div>
        {{-- Filter tabs --}}
        <ul class="nav filter-tabs" id="statusFilterTabs">
            <li class="nav-item">
                <a class="nav-link active" href="#" data-filter="all">
                    Tous <span class="badge-count" style="background:#e9ecef;color:#555;">{{ $stats['total'] }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-filter="pending">
                    En attente <span class="badge-count" style="background:#fef3c7;color:#92600a;">{{ $stats['pending'] }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-filter="validated">
                    Validées <span class="badge-count" style="background:#dcfce7;color:#065f46;">{{ $stats['validated'] }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-filter="rejected">
                    Rejetées <span class="badge-count" style="background:#fee2e2;color:#991b1b;">{{ $stats['rejected'] }}</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover orders-table mb-0" id="orders-table">
                <thead style="background:#f8f9fa;">
                    <tr>
                        <th style="padding-left:20px;">{{ __('N° Commande') }}</th>
                        <th>{{ __('Client') }}</th>
                        <th>{{ __('Articles') }}</th>
                        <th>{{ __('Total') }}</th>
                        <th>{{ __('Statut') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th class="text-end" style="padding-right:20px;">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr class="order-row status-{{ $order->status }}" data-status="{{ $order->status }}">
                            <td style="padding-left:20px;">
                                <div class="order-num">{{ $order->order_number }}</div>
                                <small class="text-muted">{{ $order->items->count() }} article(s)</small>
                            </td>
                            <td>
                                @if($order->customer_name)
                                    <div class="fw-semibold">{{ $order->customer_name }}</div>
                                    @if($order->customer_phone)
                                        <small class="text-muted"><i class="ti ti-phone" style="font-size:10px;"></i> {{ $order->customer_phone }}</small>
                                    @endif
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                @foreach($order->items as $item)
                                    <div class="d-flex align-items-center gap-1 mb-1 flex-wrap">
                                        <span style="font-size:11px;color:#666;">{{ $item->brand_name }} → {{ $item->model_name }}</span><br>
                                    </div>
                                    <div class="d-flex align-items-center gap-1 flex-wrap">
                                        <span class="item-chip"><i class="ti ti-key" style="font-size:10px;"></i>{{ $item->chassis_number }}</span>
                                        <span class="price-chip">{{ \App\Models\Utility::priceFormat($item->price) }}</span>
                                    </div>
                                @endforeach
                            </td>
                            <td>
                                <div class="total-val">{{ \App\Models\Utility::priceFormat($order->total_price) }}</div>
                                @if(($order->tva ?? 0) > 0)
                                    <div class="tva-note">TVA {{ $order->tva }}%</div>
                                @endif
                                @if(($order->discount ?? 0) > 0)
                                    <div class="tva-note text-danger">- {{ \App\Models\Utility::priceFormat($order->discount) }}</div>
                                @endif
                            </td>
                            <td>
                                @if($order->status == 'pending')
                                    <span class="status-pill pill-pending"><span class="dot"></span>En attente</span>
                                @elseif($order->status == 'validated')
                                    <span class="status-pill pill-validated"><span class="dot"></span>Validée</span>
                                @elseif($order->status == 'rejected')
                                    <span class="status-pill pill-rejected"><span class="dot"></span>Rejetée</span>
                                @endif
                            </td>
                            <td>
                                <div style="font-size:13px;">{{ $order->created_at->format('d/m/Y') }}</div>
                                <small class="text-muted">{{ $order->created_at->format('H:i') }}</small>
                            </td>
                            <td class="text-end" style="padding-right:20px;">
                                <div class="d-flex justify-content-end gap-1 flex-wrap">
                                    <a href="{{ route('chassis-orders.invoice', $order->id) }}"
                                       class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="{{ __('Facture') }}" target="_blank">
                                        <i class="ti ti-file-invoice"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-info view-order-btn"
                                            data-id="{{ $order->id }}" data-bs-toggle="tooltip" title="{{ __('Voir') }}">
                                        <i class="ti ti-eye"></i>
                                    </button>
                                    @if($order->status == 'pending')
                                        <button class="btn btn-sm btn-outline-warning edit-order-btn"
                                                data-id="{{ $order->id }}" data-bs-toggle="tooltip" title="{{ __('Modifier') }}">
                                            <i class="ti ti-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-success validate-order-btn"
                                                data-id="{{ $order->id }}" data-bs-toggle="tooltip" title="{{ __('Valider') }}">
                                            <i class="ti ti-check"></i>
                                        </button>
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
                            <td colspan="7">
                                <div class="empty-state">
                                    <div class="empty-icon"><i class="ti ti-receipt-off"></i></div>
                                    <h6 class="mt-3 text-muted">{{ __('Aucune commande trouvée') }}</h6>
                                    <p class="text-muted small">Les commandes créées depuis le POS apparaîtront ici.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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

    // ── Status filter (tabs + stat cards) ──
    function applyFilter(filter) {
        document.querySelectorAll('#statusFilterTabs .nav-link').forEach(l => {
            l.classList.toggle('active', l.dataset.filter === filter);
        });
        document.querySelectorAll('#orders-table tbody tr.order-row').forEach(row => {
            const match = filter === 'all' || row.dataset.status === filter;
            row.style.display = match ? '' : 'none';
        });
    }
    document.querySelectorAll('#statusFilterTabs .nav-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            applyFilter(this.dataset.filter);
        });
    });
    document.querySelectorAll('.filter-stat').forEach(card => {
        card.addEventListener('click', function() {
            applyFilter(this.dataset.filter);
            document.querySelector('.card.border-0')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

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
