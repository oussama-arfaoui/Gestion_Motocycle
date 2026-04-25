<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture {{ $order->order_number }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');

        :root {
            --primary: #1a1a2e;
            --accent: #e85d04;
            --accent2: #f48c06;
            --light: #f8f9fa;
            --border: #dee2e6;
            --text: #212529;
            --muted: #6c757d;
            --white: #ffffff;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background: #f0f2f5;
            color: var(--text);
            font-size: 13px;
            line-height: 1.5;
        }

        /* ── Print button ── */
        .no-print {
            text-align: right;
            padding: 16px 40px;
            background: var(--primary);
        }
        .btn-print {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 24px;
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: .3px;
            transition: background .2s;
        }
        .btn-print:hover { background: var(--accent2); }

        /* ── Page wrapper ── */
        .page {
            max-width: 860px;
            margin: 24px auto;
            background: var(--white);
            box-shadow: 0 4px 30px rgba(0,0,0,.12);
            border-radius: 4px;
            overflow: hidden;
        }

        /* ── TOP HEADER band ── */
        .top-band {
            background: var(--primary);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 28px 40px 24px;
            position: relative;
        }
        .top-band::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent), var(--accent2));
        }
        .company-name {
            font-size: 32px;
            font-weight: 800;
            color: var(--white);
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .company-name span { color: var(--accent); }
        .invoice-label {
            text-align: right;
        }
        .invoice-label .word {
            font-size: 13px;
            font-weight: 600;
            color: rgba(255,255,255,.6);
            letter-spacing: 3px;
            text-transform: uppercase;
        }
        .invoice-label .number {
            font-size: 22px;
            font-weight: 700;
            color: var(--white);
            margin-top: 2px;
        }
        .invoice-label .date-line {
            font-size: 12px;
            color: rgba(255,255,255,.55);
            margin-top: 4px;
        }

        /* ── STATUS bar ── */
        .status-bar {
            display: flex;
            justify-content: flex-end;
            padding: 10px 40px;
            background: #f1f3f8;
            border-bottom: 1px solid var(--border);
            gap: 8px;
            align-items: center;
            font-size: 12px;
            color: var(--muted);
        }
        .badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
        }
        .badge-pending   { background: #fff3cd; color: #92600a; border: 1px solid #ffc107; }
        .badge-validated { background: #d1fae5; color: #065f46; border: 1px solid #34d399; }
        .badge-rejected  { background: #fee2e2; color: #991b1b; border: 1px solid #f87171; }

        /* ── BODY ── */
        .invoice-body { padding: 36px 40px; }

        /* ── Info row: client + location ── */
        .info-row {
            display: flex;
            gap: 24px;
            margin-bottom: 30px;
        }
        .info-box {
            flex: 1;
            border: 1.5px solid var(--border);
            border-radius: 6px;
            padding: 16px 20px;
            position: relative;
        }
        .info-box .box-label {
            position: absolute;
            top: -10px;
            left: 14px;
            background: var(--white);
            padding: 0 6px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--accent);
        }
        .info-box .field-name { font-size: 11px; color: var(--muted); margin-bottom: 2px; }
        .info-box .field-val  { font-size: 14px; font-weight: 600; color: var(--text); }
        .info-box .field-block { margin-bottom: 10px; }
        .info-box .field-block:last-child { margin-bottom: 0; }

        /* ── Items table ── */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
            font-size: 13px;
        }
        .items-table thead tr {
            background: var(--primary);
            color: var(--white);
        }
        .items-table th {
            padding: 11px 14px;
            font-weight: 600;
            font-size: 11px;
            letter-spacing: .5px;
            text-transform: uppercase;
        }
        .items-table th:first-child { border-radius: 0; }
        .items-table td {
            padding: 12px 14px;
            border-bottom: 1px solid #eef0f5;
            vertical-align: middle;
        }
        .items-table tbody tr:last-child td { border-bottom: none; }
        .items-table tbody tr:nth-child(even) { background: #fbfbfd; }
        .items-table tbody tr:hover { background: #f0f2ff; }
        .chassis-badge {
            display: inline-block;
            background: #e8f0fe;
            color: #1a56db;
            border: 1px solid #bfdbfe;
            border-radius: 4px;
            padding: 2px 8px;
            font-size: 11px;
            font-weight: 700;
            font-family: monospace;
            letter-spacing: .5px;
        }
        .loc-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
        }
        .loc-showroom { background: #dcfce7; color: #15803d; }
        .loc-depot    { background: #f3f4f6; color: #4b5563; }

        /* ── Totals section ── */
        .bottom-section {
            display: flex;
            gap: 24px;
            align-items: flex-start;
        }
        .amount-words {
            flex: 1;
            border: 1.5px dashed var(--border);
            border-radius: 6px;
            padding: 14px 18px;
            background: #fafafa;
        }
        .amount-words .aw-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--muted);
            margin-bottom: 6px;
        }
        .amount-words .aw-text {
            font-size: 13px;
            font-style: italic;
            color: var(--text);
            font-weight: 500;
        }
        .totals-box {
            min-width: 280px;
        }
        .totals-box table {
            width: 100%;
            border-collapse: collapse;
            border: 1.5px solid var(--border);
            border-radius: 6px;
            overflow: hidden;
        }
        .totals-box td {
            padding: 10px 16px;
            font-size: 13px;
            border-bottom: 1px solid #eef0f5;
        }
        .totals-box tr:last-child td { border-bottom: none; }
        .totals-box .label-col { color: var(--muted); }
        .totals-box .val-col { text-align: right; font-weight: 600; font-size: 13px; }
        .totals-box .total-ttc td {
            background: var(--primary);
            color: var(--white);
            font-size: 15px;
            font-weight: 700;
            border-bottom: none;
            padding: 13px 16px;
        }
        .totals-box .total-ttc .val-col { color: var(--accent2); font-size: 16px; }

        /* ── Notes / Comment ── */
        .notes-section {
            margin-top: 24px;
            border-left: 3px solid var(--accent);
            padding: 10px 16px;
            background: #fffbf5;
            border-radius: 0 6px 6px 0;
        }
        .notes-section .notes-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--accent);
            margin-bottom: 4px;
        }
        .notes-section p { font-size: 13px; color: var(--text); }

        /* ── Footer ── */
        .invoice-footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1.5px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        .footer-stamp {
            border: 2px solid var(--primary);
            border-radius: 6px;
            padding: 10px 20px;
            text-align: center;
            min-width: 120px;
        }
        .footer-stamp .stamp-name {
            font-size: 14px;
            font-weight: 800;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .footer-stamp .stamp-name span { color: var(--accent); }
        .footer-stamp .stamp-sub {
            font-size: 9px;
            color: var(--muted);
            margin-top: 2px;
        }
        .footer-addr {
            text-align: right;
            font-size: 11px;
            color: var(--muted);
            line-height: 1.8;
        }
        .footer-addr strong { color: var(--text); }

        /* ── Divider ── */
        .section-divider {
            height: 1px;
            background: var(--border);
            margin: 28px 0;
        }

        /* ── PRINT styles ── */
        @media print {
            body { background: #fff; font-size: 11px; }
            .no-print { display: none !important; }
            .page {
                max-width: 100%;
                margin: 0;
                box-shadow: none;
                border-radius: 0;
            }
            .top-band { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .items-table thead tr { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .totals-box .total-ttc td { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body>
<?php
    /* ── Helper: number to French words ── */
    if (!function_exists('invIntToFr')) {
        function invIntToFr($n) {
            $ones = ['', 'un', 'deux', 'trois', 'quatre', 'cinq', 'six', 'sept', 'huit', 'neuf',
                     'dix', 'onze', 'douze', 'treize', 'quatorze', 'quinze', 'seize', 'dix-sept', 'dix-huit', 'dix-neuf'];
            $tens = ['', '', 'vingt', 'trente', 'quarante', 'cinquante', 'soixante', 'soixante', 'quatre-vingt', 'quatre-vingt'];
            if ($n < 20) return $ones[$n];
            if ($n < 70)  { $t=$tens[intval($n/10)]; $o=$n%10; return $t.($o?'-'.$ones[$o]:''); }
            if ($n < 80)  { $o=$n-60; return 'soixante-'.($ones[$o]??''); }
            if ($n < 100) { $o=$n-80; return 'quatre-vingt'.($o?'-'.$ones[$o]:'s'); }
            $c=intval($n/100); $r=$n%100;
            $cp=($c==1?'cent':$ones[$c].' cent').($r==0&&$c>1?'s':'');
            return $cp.($r?' '.invIntToFr($r):'');
        }
    }
    if (!function_exists('numberToFrench')) {
        function numberToFrench($number, $currency = 'MAD') {
            $number   = round(floatval($number), 2);
            $intPart  = intval($number);
            $decPart  = round(($number - $intPart) * 100);
            $millions = intval($intPart / 1000000);
            $thousands= intval(($intPart % 1000000) / 1000);
            $rest     = $intPart % 1000;
            $words = '';
            if ($millions)  $words .= invIntToFr($millions).' million'.($millions>1?'s':'').' ';
            if ($thousands) $words .= ($thousands==1?'mille':invIntToFr($thousands).' mille').' ';
            if ($rest)      $words .= invIntToFr($rest);
            $words = trim($words) ?: 'zéro';
            return ucfirst($words).' '.strtolower($currency).($decPart?' et '.invIntToFr($decPart).' centimes':'');
        }
    }

    $cur         = $store->currency ?? 'MAD';
    $storeName   = $store->name ?? 'MOBI-NARDO';
    $storeAddr   = $store->address ?? '';
    $storeCity   = $store->city ?? 'Casablanca';
    $storePhone  = $store->whatsapp_number ?? '';
    $storeEmail  = $store->email ?? '';
    $storeCountry= trim(($store->city ?? '') . ($store->state ? ', '.$store->state : '') . ($store->country ? ', '.$store->country : ''));

    $subtotalHT  = $order->items->sum('price');
    $discount    = floatval($order->discount ?? 0);
    $htNet       = $subtotalHT - $discount;
    $tvaRate     = floatval($order->tva ?? 0);
    $tvaAmount   = $htNet * $tvaRate / 100;
    $totalTTC    = $htNet + $tvaAmount;
    $amountWords = numberToFrench($totalTTC, $cur);
?>

    <!-- Print button -->
    <div class="no-print">
        <button class="btn-print" onclick="window.print()">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 14h12v8H6z"/></svg>
            Imprimer la facture
        </button>
    </div>

    <div class="page">

        <!-- ── TOP HEADER ── -->
        <div class="top-band">
            <div>
                <div class="company-name">
                    <?php
                        $parts = explode('-', strtoupper($storeName));
                        if (count($parts) >= 2) {
                            echo htmlspecialchars($parts[0]) . '<span>-</span>' . htmlspecialchars(implode('-', array_slice($parts, 1)));
                        } else {
                            echo htmlspecialchars(strtoupper($storeName));
                        }
                    ?>
                </div>
                <div style="font-size:11px;color:rgba(255,255,255,.5);margin-top:6px;letter-spacing:.5px;">
                    {{ $storeCity }}@if($storeAddr), {{ $storeAddr }}@endif
                </div>
            </div>
            <div class="invoice-label">
                <div class="word">Facture</div>
                <div class="number">{{ $order->order_number }}</div>
                <div class="date-line">{{ $storeCity }} le {{ $order->created_at->format('d/m/Y') }}</div>
            </div>
        </div>

        <!-- ── STATUS bar ── -->
        <div class="status-bar">
            <span>Statut :</span>
            @if($order->status == 'pending')
                <span class="badge badge-pending">En attente</span>
            @elseif($order->status == 'validated')
                <span class="badge badge-validated">Validée</span>
            @else
                <span class="badge badge-rejected">Rejetée</span>
            @endif
        </div>

        <!-- ── BODY ── -->
        <div class="invoice-body">

            <!-- Info row: client -->
            <div class="info-row">
                <div class="info-box" style="flex:1.5;">
                    <span class="box-label">Informations client</span>
                    <div class="field-block">
                        <div class="field-name">Nom / Raison sociale</div>
                        <div class="field-val">{{ $order->customer_name ?: '—' }}</div>
                    </div>
                    <div class="field-block">
                        <div class="field-name">Téléphone</div>
                        <div class="field-val">{{ $order->customer_phone ?: '—' }}</div>
                    </div>
                </div>
                <div class="info-box" style="flex:1;">
                    <span class="box-label">Commande</span>
                    <div class="field-block">
                        <div class="field-name">N° Facture</div>
                        <div class="field-val" style="font-family:monospace;font-size:16px;">{{ $order->order_number }}</div>
                    </div>
                    <div class="field-block">
                        <div class="field-name">Date</div>
                        <div class="field-val">{{ $order->created_at->format('d/m/Y') }}</div>
                    </div>
                    @if($order->created_by ?? false)
                    <div class="field-block">
                        <div class="field-name">Commercial</div>
                        <div class="field-val">{{ $order->user->name ?? '—' }}</div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Items table -->
            <table class="items-table">
                <thead>
                    <tr>
                        <th style="width:32px;">#</th>
                        <th>Désignation</th>
                        <th style="width:90px;">N° Châssis</th>
                        <th style="width:80px;">Emplacement</th>
                        <th style="width:50px;text-align:center;">Qté</th>
                        @if($tvaRate > 0)
                        <th style="width:60px;text-align:center;">TVA</th>
                        @endif
                        <th style="width:110px;text-align:right;">Prix H.T</th>
                        <th style="width:120px;text-align:right;">Montant TTC</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $i => $item)
                    <?php
                        $itemTVA    = $item->price * $tvaRate / 100;
                        $itemTTC    = $item->price + $itemTVA;
                    ?>
                    <tr>
                        <td style="color:var(--muted);font-size:11px;">{{ $i + 1 }}</td>
                        <td>
                            <div style="font-weight:600;font-size:13px;">{{ $item->brand_name }} {{ $item->model_name }}</div>
                            <div style="font-size:11px;color:var(--muted);margin-top:2px;">{{ $item->family_name }}</div>
                        </td>
                        <td>
                            <span class="chassis-badge">{{ $item->chassis_number }}</span>
                        </td>
                        <td>
                            @if(strtoupper($item->location ?? '') === 'SHOW-ROOM')
                                <span class="loc-badge loc-showroom">Show-Room</span>
                            @else
                                <span class="loc-badge loc-depot">{{ $item->location ?? 'Dépôt' }}</span>
                            @endif
                        </td>
                        <td style="text-align:center;">1</td>
                        @if($tvaRate > 0)
                        <td style="text-align:center;color:var(--muted);">{{ number_format($tvaRate, 0) }}%</td>
                        @endif
                        <td style="text-align:right;">{{ number_format($item->price, 2, ',', ' ') }} {{ $cur }}</td>
                        <td style="text-align:right;font-weight:600;">{{ number_format($itemTTC, 2, ',', ' ') }} {{ $cur }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Bottom section: amount in words + totals -->
            <div class="bottom-section">
                <div class="amount-words">
                    <div class="aw-label">Arrêtée la présente facture à la somme de :</div>
                    <div class="aw-text">{{ $amountWords }}</div>
                </div>
                <div class="totals-box">
                    <table>
                        <tr>
                            <td class="label-col">Sous-total H.T</td>
                            <td class="val-col">{{ number_format($subtotalHT, 2, ',', ' ') }} {{ $cur }}</td>
                        </tr>
                        @if($discount > 0)
                        <tr>
                            <td class="label-col">Remise</td>
                            <td class="val-col" style="color:#dc3545;">− {{ number_format($discount, 2, ',', ' ') }} {{ $cur }}</td>
                        </tr>
                        <tr>
                            <td class="label-col">Total H.T net</td>
                            <td class="val-col">{{ number_format($htNet, 2, ',', ' ') }} {{ $cur }}</td>
                        </tr>
                        @endif
                        <tr>
                            <td class="label-col">TVA ({{ number_format($tvaRate, 0) }}%)</td>
                            <td class="val-col">{{ number_format($tvaAmount, 2, ',', ' ') }} {{ $cur }}</td>
                        </tr>
                        <tr class="total-ttc">
                            <td class="label-col">TOTAL TTC</td>
                            <td class="val-col">{{ number_format($totalTTC, 2, ',', ' ') }} {{ $cur }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            @if($order->notes || ($order->comment ?? false))
            <div class="section-divider"></div>
            @if($order->notes)
            <div class="notes-section">
                <div class="notes-label">Notes</div>
                <p>{{ $order->notes }}</p>
            </div>
            @endif
            @if(!empty($order->comment))
            <div class="notes-section" style="margin-top:10px;border-left-color:#0ea5e9;background:#f0f9ff;">
                <div class="notes-label" style="color:#0ea5e9;">Commentaire</div>
                <p>{{ $order->comment }}</p>
            </div>
            @endif
            @endif

            <!-- Footer -->
            <div class="invoice-footer">
                <div class="footer-stamp">
                    <?php
                        $fp = explode('-', strtoupper($storeName));
                        if (count($fp) >= 2) {
                            echo '<div class="stamp-name">' . htmlspecialchars($fp[0]) . '<span>-</span>' . htmlspecialchars(implode('-', array_slice($fp, 1))) . '</div>';
                        } else {
                            echo '<div class="stamp-name">' . htmlspecialchars(strtoupper($storeName)) . '</div>';
                        }
                    ?>
                    <div class="stamp-sub">Signature & Cachet</div>
                </div>
                <div class="footer-addr">
                    @if($storeAddr)
                        <div>{{ $storeAddr }}@if($storeCity), {{ $storeCity }}@endif</div>
                    @endif
                    @if($storePhone)
                        <div><strong>Tél :</strong> {{ $storePhone }}</div>
                    @endif
                    @if($storeEmail)
                        <div><strong>Email :</strong> {{ $storeEmail }}</div>
                    @endif
                    <div style="margin-top:6px;font-size:10px;color:#aaa;">{{ __('Merci pour votre confiance') }}</div>
                </div>
            </div>

        </div><!-- /invoice-body -->
    </div><!-- /page -->

</body>
</html>
