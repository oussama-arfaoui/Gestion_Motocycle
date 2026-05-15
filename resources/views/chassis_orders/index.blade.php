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


    /* ── Table rows ── */
    .orders-table { border-collapse: separate; border-spacing: 0; }
    .orders-table thead th {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border: none;
        color: #475569;
        font-weight: 700;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        padding: 16px 12px;
        position: sticky;
        top: 0;
        z-index: 10;
    }
    .orders-table tbody tr {
        border-bottom: 1px solid #e2e8f0;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .orders-table tbody tr:hover {
        background: linear-gradient(90deg, #f8fafc 0%, #f1f5f9 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    .orders-table tbody td {
        padding: 12px;
        vertical-align: middle;
        border: none;
        line-height: 1.4;
    }
    .orders-table tr.order-row.status-pending   { border-left: 4px solid #f59e0b; }
    .orders-table tr.order-row.status-validated { border-left: 4px solid #10b981; }
    .orders-table tr.order-row.status-rejected  { border-left: 4px solid #ef4444; }

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
        font-family: 'SF Mono', 'Monaco', 'Inconsolata', 'Roboto Mono', monospace;
        font-size: 13px;
        font-weight: 700;
        color: #1e293b;
        letter-spacing: 0.5px;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        padding: 4px 8px;
        border-radius: 6px;
        border: 1px solid #cbd5e1;
        display: inline-block;
        line-height: 1.2;
    }
    .order-num small { 
        font-size: 9px; 
        color: #64748b; 
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; 
        font-weight: 400;
        display: block;
        margin-top: 1px;
    }

    /* ── Item chips ── */
    .item-chip {
        display: inline-flex; align-items: center; gap: 3px;
        background: linear-gradient(135deg, #f0f4ff 0%, #e0e7ff 100%);
        border: 1px solid #c7d2fe;
        border-radius: 6px; padding: 2px 6px;
        font-size: 10px; font-weight: 600; color: #4338ca;
        margin: 1px 3px 1px 0;
        box-shadow: 0 1px 2px rgba(0,0,0,0.08);
        transition: all 0.2s;
    }
    .item-chip:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0,0,0,0.12);
    }
    .price-chip {
        display: inline-block;
        background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
        border: 1px solid #bbf7d0;
        border-radius: 6px; padding: 2px 6px;
        font-size: 10px; font-weight: 700; color: #166534;
        box-shadow: 0 1px 2px rgba(0,0,0,0.08);
    }

    /* ── Total ── */
    .total-val { 
        font-size: 14px; 
        font-weight: 800; 
        color: #1e293b;
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        padding: 4px 8px;
        border-radius: 6px;
        border: 1px solid #cbd5e1;
        display: inline-block;
        line-height: 1.2;
    }
    .tva-note  { 
        font-size: 10px; 
        color: #64748b; 
        margin-top: 4px;
        font-style: italic;
    }

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


{{-- ── MAIN TABLE CARD ── --}}
<div class="card border-0 shadow-lg" style="border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0;">
    <div class="card-header bg-white border-bottom-0 pb-0 pt-3 px-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0 fw-bold">{{ __('Liste des Commandes') }}</h5>
            <div class="d-flex gap-2 align-items-center">
                <div class="input-group input-group-sm" style="max-width: 300px;">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="ti ti-calendar text-muted"></i>
                    </span>
                    <input type="date" id="dateFilterStart" class="form-control border-start-0" placeholder="Début">
                    <span class="input-group-text bg-light border-start-0 border-end-0">→</span>
                    <input type="date" id="dateFilterEnd" class="form-control border-start-0" placeholder="Fin">
                    <button class="btn btn-sm btn-outline-secondary" type="button" id="clearDateFilter">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body p-3">
        <div class="table-responsive">
            <table class="table table-hover orders-table mb-0" id="orders-table">
                <thead style="background:#f8f9fa;">
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
                        <tr class="order-row status-{{ $order->status }}" data-status="{{ $order->status }}">
                            <td>
                                <div class="order-num">{{ $order->order_number }}</div>
                                <small class="text-muted">{{ $order->items->count() }} article(s)</small>
                            </td>
                            <td>
                                @if($order->customer_name)
                                    <div class="fw-semibold">{{ $order->customer_name }}</div>
                                    @if($order->customer_phone)
                                        <small class="text-muted d-block"><i class="ti ti-phone" style="font-size:10px;"></i> {{ $order->customer_phone }}</small>
                                    @endif
                                    @if($order->doc_type && $order->doc_number)
                                        <small class="text-muted d-block">
                                            <span class="badge bg-light text-dark border" style="font-size:10px;">{{ $order->doc_type }}</span>
                                            {{ $order->doc_number }}
                                        </small>
                                    @endif
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                @foreach($order->items as $item)
                                    <div style="margin-bottom: 4px;">
                                        <div style="font-size:10px;color:#666; margin-bottom: 2px;">{{ $item->brand_name }} → {{ $item->model_name }}</div>
                                        <div class="d-flex align-items-center gap-1 flex-wrap">
                                            <span class="item-chip"><i class="ti ti-key" style="font-size:9px;"></i>{{ $item->chassis_number }}</span>
                                            <span class="price-chip">{{ \App\Models\Utility::priceFormat($item->price) }}</span>
                                        </div>
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
                            <td class="text-end">
                                <div class="d-flex justify-content-end gap-1 flex-wrap">
                                    @if(in_array(\Auth::user()->type, ['super admin', 'admin']))
                                    <a href="{{ route('chassis-orders.invoice', $order->id) }}"
                                       class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="{{ __('Facture') }}" target="_blank">
                                        <i class="ti ti-file-invoice"></i>
                                    </a>
                                    @endif
                                    <button class="btn btn-sm btn-outline-info view-order-btn"
                                            data-id="{{ $order->id }}" data-bs-toggle="tooltip" title="{{ __('Voir') }}">
                                        <i class="ti ti-eye"></i>
                                    </button>
                                    @if($order->status == 'pending')
                                        @if(\Auth::user()->type == 'Owner' || \Auth::user()->can('Manage Orders') || \Auth::user()->can('Edit Order'))
                                        <button class="btn btn-sm btn-outline-warning edit-order-btn"
                                                data-id="{{ $order->id }}" data-bs-toggle="tooltip" title="{{ __('Modifier') }}">
                                            <i class="ti ti-pencil"></i>
                                        </button>
                                        @endif
                                        @if(\Auth::user()->type == 'Owner' || \Auth::user()->can('Manage Orders') || \Auth::user()->can('Validate Order'))
                                        <button class="btn btn-sm btn-outline-success validate-order-btn"
                                                data-id="{{ $order->id }}" data-bs-toggle="tooltip" title="{{ __('Valider') }}">
                                            <i class="ti ti-check"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger reject-order-btn"
                                                data-id="{{ $order->id }}" data-bs-toggle="tooltip" title="{{ __('Rejeter') }}">
                                            <i class="ti ti-x"></i>
                                        </button>
                                        @endif
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

    // ── Date filter ──
    function applyDateFilter() {
        const startDate = document.getElementById('dateFilterStart').value;
        const endDate = document.getElementById('dateFilterEnd').value;

        document.querySelectorAll('#orders-table tbody tr.order-row').forEach(row => {
            let dateMatch = true;
            if (startDate || endDate) {
                const orderDate = row.querySelector('td:nth-child(6) div')?.textContent; // Format: d/m/Y
                if (orderDate) {
                    const [day, month, year] = orderDate.split('/');
                    const orderDateObj = new Date(`${year}-${month}-${day}`);

                    if (startDate) {
                        const start = new Date(startDate);
                        dateMatch = dateMatch && orderDateObj >= start;
                    }
                    if (endDate) {
                        const end = new Date(endDate);
                        dateMatch = dateMatch && orderDateObj <= end;
                    }
                }
            }

            row.style.display = dateMatch ? '' : 'none';
        });
    }

    // Date filter event listeners
    document.getElementById('dateFilterStart')?.addEventListener('change', applyDateFilter);
    document.getElementById('dateFilterEnd')?.addEventListener('change', applyDateFilter);
    document.getElementById('clearDateFilter')?.addEventListener('click', function() {
        document.getElementById('dateFilterStart').value = '';
        document.getElementById('dateFilterEnd').value = '';
        applyDateFilter();
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
                const docBadge = order.doc_type
                    ? `<span class="badge bg-light text-dark border me-1">${order.doc_type}</span>${order.doc_number || ''}`
                    : '-';
                let html = `
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>{{ __('N° Commande') }}:</strong> ${order.order_number}<br>
                            <strong>{{ __('Client') }}:</strong> ${order.customer_name || '-'}<br>
                            <strong>{{ __('Téléphone') }}:</strong> ${order.customer_phone || '-'}<br>
                            <strong>{{ __('Document') }}:</strong> ${docBadge}
                        </div>
                        <div class="col-md-6 text-end">
                            <strong>{{ __('Statut') }}:</strong>
                            <span class="badge bg-${order.status === 'validated' ? 'success' : (order.status === 'rejected' ? 'danger' : 'warning')}">${order.status}</span><br>
                            <strong>{{ __('Total') }}:</strong> ${parseFloat(order.total_price).toLocaleString()}<br>
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
