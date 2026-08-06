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


{{-- ── TOTALS WIDGET ── --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius: 12px; overflow: hidden;">
    <div class="card-body p-3">
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div class="d-flex gap-2 align-items-center" id="rangeFilters">
                <button class="btn btn-sm btn-outline-primary" data-range="month">{{ __('Ce mois') }}</button>
                <button class="btn btn-sm btn-primary active" data-range="year">{{ __('Cette année') }}</button>
                <button class="btn btn-sm btn-outline-primary" data-range="custom">{{ __('Personnalisé') }}</button>
            </div>
            <div class="d-flex gap-2 align-items-center" id="customRangeInputs" style="display:none !important;">
                <input type="date" id="customStart" class="form-control form-control-sm">
                <span class="text-muted">→</span>
                <input type="date" id="customEnd" class="form-control form-control-sm">
            </div>
            <div class="ms-auto text-end">
                <div class="text-muted small text-uppercase">{{ __('Total des commandes filtrées') }}</div>
                <div class="fw-bold fs-4 text-primary" id="filteredTotal">0,00</div>
                <div class="small text-muted"><span id="filteredCount">0</span> {{ __('commande(s)') }}</div>
            </div>
        </div>
    </div>
</div>

{{-- ── CUSTOMER DEBTS SUMMARY ── --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius: 12px; overflow: hidden;">
    <div class="card-body p-3">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-warning bg-opacity-10 text-warning rounded d-flex align-items-center justify-content-center" style="width:48px;height:48px;">
                    <i class="ti ti-wallet fs-4"></i>
                </div>
                <div>
                    <h6 class="mb-0 fw-bold">{{ __('Argent dû par les clients') }}</h6>
                    <small class="text-muted">{{ __('Cliquez pour voir le détail') }}</small>
                </div>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end">
                    <div class="text-muted small">{{ __('Total reste dû') }}</div>
                    <div class="fw-bold fs-4 text-danger" id="chassisDebtSummaryRemaining">0,00 MAD</div>
                </div>
                <button type="button" class="btn btn-warning" id="openChassisDebtModalBtn">
                    <i class="ti ti-list me-1"></i>{{ __('Voir / Gérer') }}
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ── MAIN TABLE CARD ── --}}
<div class="card border-0 shadow-lg" style="border-radius: 16px; overflow: hidden; border: 1px solid #e2e8f0;">
    <div class="card-header bg-white border-bottom-0 pb-0 pt-3 px-4">
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <h5 class="mb-0 fw-bold">{{ __('Liste des Commandes') }}</h5>
            <div class="d-flex gap-2 align-items-center flex-wrap">
                <div class="input-group input-group-sm" style="max-width: 260px;">
                    <span class="input-group-text bg-light border-end-0">
                        <i class="ti ti-search text-muted"></i>
                    </span>
                    <input type="text" id="globalSearch" name="global_search_chassis_orders" class="form-control border-start-0" placeholder="{{ __('N° commande, CIN ou châssis') }}" autocomplete="off" inputmode="search" onfocus="this.removeAttribute('readonly')" readonly>
                </div>
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
                <button class="btn btn-sm btn-success" id="exportFilteredBtn" type="button">
                    <i class="ti ti-file-spreadsheet me-1"></i>{{ __('Exporter') }}
                </button>
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
                        <tr class="order-row status-{{ $order->status }}"
                            data-status="{{ $order->status }}"
                            data-order-number="{{ $order->order_number }}"
                            data-customer-name="{{ strtolower($order->customer_name ?? '') }}"
                            data-doc-number="{{ strtolower($order->doc_number ?? '') }}"
                            data-chassis="{{ strtolower($order->items->pluck('chassis_number')->implode(' ')) }}"
                            data-total="{{ $order->total_price }}"
                            data-date="{{ $order->created_at->format('Y-m-d') }}">
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
                                    @if($order->status == 'validated' && (in_array(\Auth::user()->type, ['super admin', 'admin', 'Owner']) || \Auth::user()->can('Validate Orders')))
                                    <a href="{{ route('chassis-orders.invoice', $order->id) }}"
                                       class="btn btn-sm btn-outline-warning" data-bs-toggle="tooltip" title="{{ __('Facture') }}" target="_blank">
                                        <i class="ti ti-file-invoice"></i>
                                    </a>
                                    <a href="{{ route('chassis-orders.invoice', $order->id) . '?simple=1' }}"
                                       class="btn btn-sm btn-outline-success" data-bs-toggle="tooltip" title="{{ __('Facture simple') }}" target="_blank">
                                        <i class="ti ti-file-invoice"></i>
                                    </a>
                                    <button class="btn btn-sm btn-outline-warning edit-validated-order-btn"
                                            data-id="{{ $order->id }}" data-bs-toggle="tooltip" title="{{ __('Modifier') }}">
                                        <i class="ti ti-pencil"></i>
                                    </button>
                                    @endif
                                    <button class="btn btn-sm btn-outline-info view-order-btn"
                                            data-id="{{ $order->id }}" data-bs-toggle="tooltip" title="{{ __('Voir') }}">
                                        <i class="ti ti-eye"></i>
                                    </button>
                                    @if($order->status == 'pending')
                                        @if(\Auth::user()->type == 'Owner' || \Auth::user()->can('Manage Orders') || \Auth::user()->can('Edit Orders') || \Auth::user()->can('Validate Orders'))
                                        <button class="btn btn-sm btn-outline-warning edit-order-btn"
                                                data-id="{{ $order->id }}" data-bs-toggle="tooltip" title="{{ __('Modifier') }}">
                                            <i class="ti ti-pencil"></i>
                                        </button>
                                        @endif
                                        @if(\Auth::user()->type == 'Owner' || \Auth::user()->can('Validate Orders'))
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
                                    @if($order->status != 'validated' && (\Auth::user()->type == 'Owner' || \Auth::user()->can('Delete Orders')))
                                        <button class="btn btn-sm btn-outline-danger delete-order-btn"
                                                data-id="{{ $order->id }}" data-bs-toggle="tooltip" title="{{ __('Supprimer') }}">
                                            <i class="ti ti-trash"></i>
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

<!-- Customer Debts Modal -->
<div class="modal fade" id="chassisDebtModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-warning text-dark">
                <h5 class="modal-title"><i class="ti ti-wallet me-2"></i>{{ __('Créances clients') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="chassis_debt_customer_name" placeholder="{{ __('Nom du client') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="chassis_debt_customer_phone" placeholder="{{ __('Téléphone') }}">
                    </div>
                    <div class="col-md-2">
                        <select class="form-select" id="chassis_debt_doc_type">
                            <option value="CIN">CIN</option>
                            <option value="RC">RC</option>
                            <option value="ICE">ICE</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control" id="chassis_debt_doc_number" placeholder="{{ __('N° doc') }}">
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" id="chassis_debt_total_amount" placeholder="{{ __('Montant total') }}" min="0" step="0.01">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <input type="number" class="form-control" id="chassis_debt_paid_amount" placeholder="{{ __('Montant payé') }}" min="0" step="0.01">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="chassis_debt_order_info" placeholder="{{ __('Commande / Produit') }}">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="chassis_debt_notes" placeholder="{{ __('Notes') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-success w-100" id="addChassisDebtBtn">
                            <i class="ti ti-plus me-1"></i>{{ __('Ajouter') }}
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="chassisDebtsTable">
                        <thead class="table-light">
                            <tr>
                                <th>{{ __('Client') }}</th>
                                <th>{{ __('Document') }}</th>
                                <th>{{ __('Commande / Produit') }}</th>
                                <th>{{ __('Total') }}</th>
                                <th>{{ __('Payé') }}</th>
                                <th>{{ __('Reste') }}</th>
                                <th>{{ __('Notes') }}</th>
                                <th class="text-end">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody id="chassisDebtsTableBody"></tbody>
                        <tfoot>
                            <tr class="table-warning">
                                <th colspan="3">{{ __('Totaux') }}</th>
                                <th id="chassisDebtsTotalTotal">0</th>
                                <th id="chassisDebtsTotalPaid">0</th>
                                <th id="chassisDebtsTotalRemaining">0</th>
                                <th colspan="2"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div id="chassisDebtsEmpty" class="p-3 text-muted text-center small" style="display:none;">
                    {{ __('Aucune créance enregistrée.') }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Fermer') }}</button>
            </div>
        </div>
    </div>
</div>

<!-- PIN Modal -->
<div class="modal fade" id="pinModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Vérification PIN') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="small text-muted">{{ __('Entrez le code PIN pour modifier une commande validée.') }}</p>
                <input type="password" id="editPinInput" class="form-control form-control-lg text-center" maxlength="10" placeholder="PIN" inputmode="numeric">
                <div id="pinError" class="text-danger small mt-2 d-none">{{ __('PIN incorrect') }}</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Annuler') }}</button>
                <button type="button" class="btn btn-primary" id="verifyPinBtn">{{ __('Vérifier') }}</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script-page')
<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Defensive: browsers/password managers may autofill login/email into the search box; clear it.
    const globalSearchInput = document.getElementById('globalSearch');
    function sanitizeSearchInput() {
        if (globalSearchInput && globalSearchInput.value.includes('@')) {
            globalSearchInput.value = '';
            applyFilters();
        }
    }
    ['focus','input','change','blur','click'].forEach(evt => globalSearchInput?.addEventListener(evt, sanitizeSearchInput));
    // Remove the temporary readonly attribute after a short delay so user can type
    setTimeout(() => { globalSearchInput?.removeAttribute('readonly'); sanitizeSearchInput(); }, 300);
    sanitizeSearchInput();

    // ── Filter state ──
    let pendingValidatedEditId = null;
    let lastVerifiedPin = null;
    const editPin = '{{ env("CHASSIS_EDIT_PIN", "1234") }}';

    function parseOrderDate(row) {
        return row.dataset.date ? new Date(row.dataset.date + 'T00:00:00') : null;
    }

    function getActiveRange() {
        const activeBtn = document.querySelector('#rangeFilters button.active');
        const range = activeBtn?.dataset.range || 'year';
        const today = new Date();
        today.setHours(0,0,0,0);
        let start = null, end = null;
        if (range === 'month') {
            start = new Date(today.getFullYear(), today.getMonth(), 1);
            end = new Date(today.getFullYear(), today.getMonth() + 1, 0);
        } else if (range === 'year') {
            start = new Date(today.getFullYear(), 0, 1);
            end = new Date(today.getFullYear(), 11, 31);
        } else if (range === 'custom') {
            start = document.getElementById('customStart')?.value ? new Date(document.getElementById('customStart').value + 'T00:00:00') : null;
            end = document.getElementById('customEnd')?.value ? new Date(document.getElementById('customEnd').value + 'T23:59:59') : null;
        }
        return { start, end };
    }

    // ── Apply all filters and update totals ──
    function applyFilters() {
        let search = (document.getElementById('globalSearch')?.value || '').trim().toLowerCase();
        // If a browser/password manager autofilled an email, ignore it.
        if (search.includes('@')) search = '';
        const dateStart = document.getElementById('dateFilterStart')?.value ? new Date(document.getElementById('dateFilterStart').value + 'T00:00:00') : null;
        const dateEnd = document.getElementById('dateFilterEnd')?.value ? new Date(document.getElementById('dateFilterEnd').value + 'T23:59:59') : null;
        const range = getActiveRange();

        let visibleCount = 0;
        let visibleTotal = 0;

        document.querySelectorAll('#orders-table tbody tr.order-row').forEach(row => {
            let show = true;
            const rowDate = parseOrderDate(row);

            // Range filter
            if (range.start && range.end && rowDate) {
                if (rowDate < range.start || rowDate > range.end) show = false;
            }

            // Date inputs filter (overrides range if set)
            if (dateStart && rowDate && rowDate < dateStart) show = false;
            if (dateEnd && rowDate && rowDate > dateEnd) show = false;

            // Text search
            if (show && search) {
                const orderNum = (row.dataset.orderNumber || '').toLowerCase();
                const customer = (row.dataset.customerName || '').toLowerCase();
                const doc = (row.dataset.docNumber || '').toLowerCase();
                const chassis = (row.dataset.chassis || '').toLowerCase();
                if (!orderNum.includes(search) && !customer.includes(search) && !doc.includes(search) && !chassis.includes(search)) {
                    show = false;
                }
            }

            row.style.display = show ? '' : 'none';
            if (show) {
                visibleCount++;
                visibleTotal += parseFloat(row.dataset.total || 0);
            }
        });

        document.getElementById('filteredCount').textContent = visibleCount;
        document.getElementById('filteredTotal').textContent = visibleTotal.toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' MAD';
    }

    document.getElementById('dateFilterStart')?.addEventListener('change', applyFilters);
    document.getElementById('dateFilterEnd')?.addEventListener('change', applyFilters);
    document.getElementById('clearDateFilter')?.addEventListener('click', function() {
        document.getElementById('dateFilterStart').value = '';
        document.getElementById('dateFilterEnd').value = '';
        applyFilters();
    });
    document.getElementById('globalSearch')?.addEventListener('input', applyFilters);

    // Range filter buttons
    document.querySelectorAll('#rangeFilters button').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('#rangeFilters button').forEach(b => {
                b.classList.remove('active', 'btn-primary');
                b.classList.add('btn-outline-primary');
            });
            this.classList.remove('btn-outline-primary');
            this.classList.add('active', 'btn-primary');
            const isCustom = this.dataset.range === 'custom';
            document.getElementById('customRangeInputs').style.display = isCustom ? 'flex' : 'none';
            document.getElementById('customRangeInputs').style.setProperty('display', isCustom ? 'flex' : 'none', 'important');
            if (!isCustom) {
                document.getElementById('customStart').value = '';
                document.getElementById('customEnd').value = '';
            }
            applyFilters();
        });
    });
    document.getElementById('customStart')?.addEventListener('change', applyFilters);
    document.getElementById('customEnd')?.addEventListener('change', applyFilters);

    // Export visible rows
    document.getElementById('exportFilteredBtn')?.addEventListener('click', function() {
        const rows = Array.from(document.querySelectorAll('#orders-table tbody tr.order-row')).filter(r => r.style.display !== 'none');
        if (!rows.length) return show_toastr('Info', '{{ __("Aucune ligne à exporter") }}', 'info');

        const headers = ['N° Commande','Client','CIN','Châssis','Produit','Couleur','Total TTC','Date','Statut'];
        let csv = '\uFEFF' + headers.join(';') + '\n';
        rows.forEach(row => {
            const tds = row.querySelectorAll('td');
            const orderNum = row.dataset.orderNumber;
            const client = (tds[1]?.querySelector('.fw-semibold')?.textContent || '').trim();
            const cin = row.dataset.docNumber;
            const chassis = row.dataset.chassis;
            const product = (tds[2]?.querySelector('div')?.textContent || '').trim();
            const color = (tds[2]?.querySelector('.item-chip')?.textContent || '').trim();
            const total = (tds[3]?.querySelector('.total-val')?.textContent || '').trim();
            const date = (tds[5]?.querySelector('div')?.textContent || '').trim();
            const status = (tds[4]?.querySelector('.status-pill')?.textContent || '').trim();
            csv += [orderNum, client, cin, chassis, product, color, total, date, status].map(v => '"' + (v || '').replace(/"/g, '""') + '"').join(';') + '\n';
        });

        const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
        const link = document.createElement('a');
        const range = document.querySelector('#rangeFilters button.active')?.dataset.range || 'all';
        link.href = URL.createObjectURL(blob);
        link.download = 'chassis-orders-' + range + '-' + new Date().toISOString().slice(0,10) + '.csv';
        link.click();
        URL.revokeObjectURL(link.href);
    });

    // PIN-protected edit for validated orders (event delegation for robustness)
    document.querySelector('#orders-table')?.addEventListener('click', function(e) {
        const btn = e.target.closest('.edit-validated-order-btn');
        if (!btn) return;
        e.preventDefault();
        e.stopPropagation();
        pendingValidatedEditId = btn.dataset.id;
        console.log('Opening PIN for order', pendingValidatedEditId);
        const pinModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('pinModal'));
        pinModal.show();
        setTimeout(() => document.getElementById('editPinInput')?.focus(), 300);
    });

    document.getElementById('verifyPinBtn')?.addEventListener('click', function() {
        const input = document.getElementById('editPinInput');
        if (input.value === editPin) {
            lastVerifiedPin = input.value;
            document.getElementById('pinError').classList.add('d-none');
            bootstrap.Modal.getOrCreateInstance(document.getElementById('pinModal')).hide();
            input.value = '';
            if (pendingValidatedEditId) {
                openEditModal(pendingValidatedEditId);
                pendingValidatedEditId = null;
            }
        } else {
            document.getElementById('pinError').classList.remove('d-none');
            input.value = '';
            input.focus();
        }
    });

    document.getElementById('editPinInput')?.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') document.getElementById('verifyPinBtn').click();
    });

    function openEditModal(id) {
        editingOrderId = id;
        const modal = new bootstrap.Modal(document.getElementById('editOrderModal'));
        modal.show();

        fetch(`/chassis-orders/${editingOrderId}`, {
            headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }
        })
        .then(r => r.json())
        .then(data => {
            const order = data.order;
            const canEditItemDetails = order.status === 'pending';
            deletedItemIds = [];
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
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">{{ __('Type document') }}</label>
                        <select class="form-select" id="edit_doc_type">
                            <option value="">-</option>
                            <option value="CIN" ${order.doc_type === 'CIN' ? 'selected' : ''}>CIN</option>
                            <option value="RC" ${order.doc_type === 'RC' ? 'selected' : ''}>RC</option>
                            <option value="ICE" ${order.doc_type === 'ICE' ? 'selected' : ''}>ICE</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">{{ __('N° document') }}</label>
                        <input type="text" class="form-control" id="edit_doc_number" value="${order.doc_number || ''}">
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
                <table class="table table-bordered" id="editItemsTable">
                    <thead>
                        <tr>
                            <th>{{ __('N° Châssis') }}</th>
                            <th>{{ __('Famille') }}</th>
                            <th>{{ __('Prix') }}</th>
                            ${canEditItemDetails ? '<th>{{ __("Action") }}</th>' : ''}
                        </tr>
                    </thead>
                    <tbody id="editItemsTbody">`;
            order.items.forEach(item => {
                html += buildEditItemRow(item, canEditItemDetails);
            });
            if (!order.items.length) {
                html += `<tr><td colspan="${canEditItemDetails ? 4 : 3}"><small class="text-muted">{{ __('Aucun article. Ajoutez une ligne ci-dessous.') }}</small></td></tr>`;
            }
            if (!canEditItemDetails) {
                html += `<tr><td colspan="3"><small class="text-muted">{{ __('Le N° Châssis et la Famille ne sont modifiables que pour les commandes en attente.') }}</small></td></tr>`;
            }
            html += `</tbody></table>`;
            if (canEditItemDetails) {
                html += `<button type="button" class="btn btn-sm btn-outline-primary" id="addEditItemRowBtn">
                    <i class="ti ti-plus"></i> {{ __('Ajouter un article') }}
                </button>`;
            }
            document.getElementById('editOrderBody').innerHTML = html;

            document.getElementById('addEditItemRowBtn')?.addEventListener('click', function() {
                document.getElementById('editItemsTbody').insertAdjacentHTML('beforeend', buildEditItemRow({}, true, true));
            });
            document.getElementById('editItemsTbody')?.addEventListener('click', function(e) {
                const btn = e.target.closest('.remove-edit-item-row');
                if (!btn) return;
                const row = btn.closest('tr');
                const itemId = row.dataset.itemId;
                if (itemId && !itemId.startsWith('new-')) {
                    deletedItemIds.push(parseInt(itemId));
                }
                row.remove();
            });
        });
    }

    function buildEditItemRow(item, canEditItemDetails, isNew = false) {
        const itemId = isNew ? ('new-' + Date.now() + Math.floor(Math.random() * 1000)) : item.id;
        const chassisCell = canEditItemDetails
            ? `<input type="text" class="form-control edit-item-chassis" data-item-id="${itemId}" value="${item.chassis_number || ''}">`
            : (item.chassis_number || '-');
        const familyCell = canEditItemDetails
            ? `<input type="text" class="form-control edit-item-family" data-item-id="${itemId}" value="${item.family_name || ''}">`
            : (item.family_name || '-');
        const actionCell = canEditItemDetails
            ? `<td><button type="button" class="btn btn-sm btn-outline-danger remove-edit-item-row"><i class="ti ti-trash"></i></button></td>`
            : '';
        return `<tr data-item-id="${itemId}">
            <td>${chassisCell}</td>
            <td>${familyCell}</td>
            <td><input type="number" class="form-control edit-item-price" data-item-id="${itemId}" value="${item.price || ''}" min="0" step="0.01"></td>
            ${actionCell}
        </tr>`;
    }

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
    let deletedItemIds = [];
    document.querySelectorAll('.edit-order-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            openEditModal(this.dataset.id);
        });
    });

    document.getElementById('saveOrderEdit').addEventListener('click', function() {
        if (!editingOrderId) return;

        const items = [];
        document.querySelectorAll('.edit-item-price').forEach(input => {
            const itemId = input.dataset.itemId;
            const isNew = itemId.startsWith('new-');
            const chassisInput = document.querySelector(`.edit-item-chassis[data-item-id="${itemId}"]`);
            const familyInput = document.querySelector(`.edit-item-family[data-item-id="${itemId}"]`);
            const chassisNumber = chassisInput ? chassisInput.value.trim() : '';
            const familyName = familyInput ? familyInput.value.trim() : '';
            const price = parseFloat(input.value);
            // Skip empty, unfilled new rows.
            if (isNew && !chassisNumber && !familyName && !price) return;

            const itemData = { price: isNaN(price) ? 0 : price };
            if (!isNew) itemData.id = parseInt(itemId);
            if (chassisInput) itemData.chassis_number = chassisNumber;
            if (familyInput) itemData.family_name = familyName;
            items.push(itemData);
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
                doc_type: document.getElementById('edit_doc_type').value,
                doc_number: document.getElementById('edit_doc_number').value,
                discount: parseFloat(document.getElementById('edit_discount').value) || 0,
                notes: document.getElementById('edit_notes').value,
                items: items,
                deleted_item_ids: deletedItemIds,
                pin: lastVerifiedPin
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

    // Delete Order
    document.querySelectorAll('.delete-order-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (!confirm('{{ __("Êtes-vous sûr de vouloir supprimer cette commande ?") }}')) return;
            const id = this.dataset.id;

            fetch(`/chassis-orders/${id}`, {
                method: 'DELETE',
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

    // ── Customer Debts on Chassis Orders ──
    function fmtChassisDebt(value) {
        return (parseFloat(value) || 0).toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' MAD';
    }

    function loadChassisDebtSummary() {
        fetch('/customer-debts')
            .then(r => r.json())
            .then(data => {
                const el = document.getElementById('chassisDebtSummaryRemaining');
                if (el) el.textContent = fmtChassisDebt(data.total_remaining);
            })
            .catch(() => {});
    }
    loadChassisDebtSummary();

    function renderChassisDebts(data) {
        const tbody = document.getElementById('chassisDebtsTableBody');
        const empty = document.getElementById('chassisDebtsEmpty');
        const debts = data.debts || [];
        const totalPaid = debts.reduce((s, d) => s + parseFloat(d.paid_amount), 0);
        const totalTotal = debts.reduce((s, d) => s + parseFloat(d.total_amount), 0);
        const totalRemaining = debts.reduce((s, d) => s + parseFloat(d.remaining_amount), 0);

        document.getElementById('chassisDebtsTotalPaid').textContent = fmtChassisDebt(totalPaid);
        document.getElementById('chassisDebtsTotalTotal').textContent = fmtChassisDebt(totalTotal);
        document.getElementById('chassisDebtsTotalRemaining').textContent = fmtChassisDebt(totalRemaining);

        if (!debts.length) {
            tbody.innerHTML = '';
            document.getElementById('chassisDebtsTable').style.display = 'none';
            if (empty) empty.style.display = 'block';
            return;
        }

        document.getElementById('chassisDebtsTable').style.display = 'table';
        if (empty) empty.style.display = 'none';
        tbody.innerHTML = debts.map(d => `
            <tr data-debt-id="${d.id}">
                <td>
                    <div class="fw-semibold">${(d.customer_name || '-')}</div>
                    <small class="text-muted">${(d.customer_phone || '')}</small>
                </td>
                <td><small>${(d.doc_type || '')}</small> ${(d.doc_number || '')}</td>
                <td><small class="text-muted">${(d.order_info || '')}</small></td>
                <td class="text-end">${fmtChassisDebt(d.total_amount)}</td>
                <td class="text-end">
                    <input type="number" class="form-control form-control-sm text-end debt-paid-input"
                           value="${parseFloat(d.paid_amount).toFixed(2)}" min="0" step="0.01">
                </td>
                <td class="text-end fw-bold text-danger debt-remaining">${fmtChassisDebt(d.remaining_amount)}</td>
                <td><input type="text" class="form-control form-control-sm debt-notes-input" value="${(d.notes || '')}"></td>
                <td class="text-end">
                    <button class="btn btn-sm btn-primary save-debt-btn me-1"><i class="ti ti-check"></i></button>
                    <button class="btn btn-sm btn-danger delete-debt-btn"><i class="ti ti-trash"></i></button>
                </td>
            </tr>
        `).join('');

        tbody.querySelectorAll('.save-debt-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const tr = this.closest('tr');
                const id = tr.dataset.debtId;
                fetch(`/customer-debts/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        paid_amount: parseFloat(tr.querySelector('.debt-paid-input').value) || 0,
                        notes: tr.querySelector('.debt-notes-input').value
                    })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        show_toastr('Success', '{{ __("Créance mise à jour") }}', 'success');
                        refreshChassisDebts();
                    } else {
                        show_toastr('Error', data.message || '{{ __("Erreur") }}', 'error');
                    }
                });
            });
        });

        tbody.querySelectorAll('.delete-debt-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (!confirm('{{ __("Êtes-vous sûr de vouloir supprimer cette créance ?") }}')) return;
                const id = this.closest('tr').dataset.debtId;
                fetch(`/customer-debts/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        show_toastr('Success', '{{ __("Créance supprimée") }}', 'success');
                        refreshChassisDebts();
                    }
                });
            });
        });
    }

    function refreshChassisDebts() {
        fetch('/customer-debts')
            .then(r => r.json())
            .then(data => {
                renderChassisDebts(data);
                loadChassisDebtSummary();
            });
    }

    document.getElementById('openChassisDebtModalBtn')?.addEventListener('click', function() {
        refreshChassisDebts();
        bootstrap.Modal.getOrCreateInstance(document.getElementById('chassisDebtModal')).show();
    });

    document.getElementById('addChassisDebtBtn')?.addEventListener('click', function() {
        fetch('/customer-debts', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                customer_name: document.getElementById('chassis_debt_customer_name').value,
                customer_phone: document.getElementById('chassis_debt_customer_phone').value,
                doc_type: document.getElementById('chassis_debt_doc_type').value,
                doc_number: document.getElementById('chassis_debt_doc_number').value,
                total_amount: parseFloat(document.getElementById('chassis_debt_total_amount').value) || 0,
                paid_amount: parseFloat(document.getElementById('chassis_debt_paid_amount').value) || 0,
                order_info: document.getElementById('chassis_debt_order_info').value,
                notes: document.getElementById('chassis_debt_notes').value
            })
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                show_toastr('Success', '{{ __("Créance ajoutée") }}', 'success');
                document.getElementById('chassis_debt_customer_name').value = '';
                document.getElementById('chassis_debt_customer_phone').value = '';
                document.getElementById('chassis_debt_doc_number').value = '';
                document.getElementById('chassis_debt_total_amount').value = '';
                document.getElementById('chassis_debt_paid_amount').value = '';
                document.getElementById('chassis_debt_order_info').value = '';
                document.getElementById('chassis_debt_notes').value = '';
                refreshChassisDebts();
            } else {
                show_toastr('Error', data.message || '{{ __("Erreur") }}', 'error');
            }
        });
    });

    // Initialize totals and filters on load
    applyFilters();
</script>
@endpush
