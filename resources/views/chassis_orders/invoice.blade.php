<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Facture') }} - {{ $order->order_number }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; padding: 40px; background: #fff; }
        .invoice-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 40px; border-bottom: 3px solid #4e73df; padding-bottom: 20px; }
        .invoice-title { font-size: 28px; font-weight: bold; color: #4e73df; }
        .invoice-meta { text-align: right; }
        .invoice-meta p { margin: 4px 0; font-size: 14px; }
        .section { margin-bottom: 30px; }
        .section-title { font-size: 16px; font-weight: bold; color: #4e73df; margin-bottom: 10px; border-bottom: 1px solid #e3e6f0; padding-bottom: 5px; }
        .customer-info { display: flex; gap: 40px; }
        .customer-info div { flex: 1; }
        .customer-info label { font-weight: bold; font-size: 13px; color: #666; }
        .customer-info p { font-size: 15px; margin-top: 2px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background: #4e73df; color: #fff; padding: 10px 12px; text-align: left; font-size: 13px; }
        td { padding: 10px 12px; border-bottom: 1px solid #e3e6f0; font-size: 14px; }
        tr:nth-child(even) { background: #f8f9fc; }
        .totals { margin-top: 20px; text-align: right; }
        .totals table { width: 300px; margin-left: auto; }
        .totals td { padding: 8px 12px; font-size: 14px; }
        .totals .total-row { font-weight: bold; font-size: 16px; border-top: 2px solid #4e73df; }
        .status-badge { display: inline-block; padding: 4px 12px; border-radius: 12px; font-size: 12px; font-weight: bold; text-transform: uppercase; }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-validated { background: #d4edda; color: #155724; }
        .status-rejected { background: #f8d7da; color: #721c24; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #999; border-top: 1px solid #e3e6f0; padding-top: 15px; }
        @media print {
            body { padding: 20px; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align: right; margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px 24px; background: #4e73df; color: #fff; border: none; border-radius: 6px; cursor: pointer; font-size: 14px;">
            <span>🖨️</span> {{ __('Imprimer') }}
        </button>
    </div>

    <div class="invoice-header">
        <div>
            <div class="invoice-title">{{ __('FACTURE') }}</div>
            <p style="font-size: 14px; color: #666; margin-top: 5px;">{{ $order->order_number }}</p>
        </div>
        <div class="invoice-meta">
            <p><strong>{{ __('Date') }}:</strong> {{ $order->created_at->format('d/m/Y') }}</p>
            <p>
                <strong>{{ __('Statut') }}:</strong>
                @if($order->status == 'pending')
                    <span class="status-badge status-pending">{{ __('En attente') }}</span>
                @elseif($order->status == 'validated')
                    <span class="status-badge status-validated">{{ __('Validée') }}</span>
                @else
                    <span class="status-badge status-rejected">{{ __('Rejetée') }}</span>
                @endif
            </p>
        </div>
    </div>

    <div class="section">
        <div class="section-title">{{ __('Informations client') }}</div>
        <div class="customer-info">
            <div>
                <label>{{ __('Nom') }}</label>
                <p>{{ $order->customer_name ?? '-' }}</p>
            </div>
            <div>
                <label>{{ __('Téléphone') }}</label>
                <p>{{ $order->customer_phone ?? '-' }}</p>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">{{ __('Articles') }}</div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('Marque') }}</th>
                    <th>{{ __('Modèle') }}</th>
                    <th>{{ __('Famille') }}</th>
                    <th>{{ __('N° Châssis') }}</th>
                    <th>{{ __('Emplacement') }}</th>
                    <th style="text-align: right;">{{ __('Prix') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->brand_name ?? '-' }}</td>
                        <td>{{ $item->model_name ?? '-' }}</td>
                        <td>{{ $item->family_name ?? '-' }}</td>
                        <td><strong>{{ $item->chassis_number }}</strong></td>
                        <td>{{ $item->location ?? '-' }}</td>
                        <td style="text-align: right;">{{ \App\Models\Utility::priceFormat($item->price) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="totals">
        <table>
            <tr>
                <td>{{ __('Sous-total') }}</td>
                <td style="text-align: right;">{{ \App\Models\Utility::priceFormat($order->total_price) }}</td>
            </tr>
            @if($order->discount > 0)
                <tr>
                    <td>{{ __('Remise') }}</td>
                    <td style="text-align: right;">-{{ \App\Models\Utility::priceFormat($order->discount) }}</td>
                </tr>
            @endif
            <tr class="total-row">
                <td>{{ __('Total') }}</td>
                <td style="text-align: right;">{{ \App\Models\Utility::priceFormat($order->total_price - $order->discount) }}</td>
            </tr>
        </table>
    </div>

    @if($order->notes)
        <div class="section" style="margin-top: 30px;">
            <div class="section-title">{{ __('Notes') }}</div>
            <p>{{ $order->notes }}</p>
        </div>
    @endif

    <div class="footer">
        <p>{{ __('Merci pour votre confiance') }}</p>
    </div>
</body>
</html>
