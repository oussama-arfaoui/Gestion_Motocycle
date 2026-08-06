<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture {{ $order->order_number }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

        :root {
            --primary: #1a1a2e;
            --accent: #f4791e;
            --accent2: #f48c06;
            --light: #f8f9fa;
            --border: #dee2e6;
            --text: #212529;
            --muted: #6c757d;
            --white: #ffffff;
            --cream: #f4efe4;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background: #f0f2f5;
            color: #212529;
            font-size: 13px;
            line-height: 1.5;
        }

        /* ── Print / PDF buttons ── */
        .print-button-bar {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            padding: 16px 40px;
            background: #1a1a2e;
        }
        .btn-print, .btn-download {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 24px;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            letter-spacing: .3px;
            transition: background .2s;
            text-decoration: none;
        }
        .btn-print { background: #f4791e; }
        .btn-print:hover { background: #f48c06; }
        .btn-download { background: #198754; }
        .btn-download:hover { background: #157347; }

        /* ── Page wrapper ── */
        .page {
            max-width: 860px;
            margin: 24px auto;
            background: #ffffff;
            box-shadow: 0 4px 30px rgba(0,0,0,.12);
            border-radius: 4px;
            overflow: hidden;
        }

        /* ── TOP HEADER ── */
        .inv-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 36px 40px 0;
        }
        .inv-header-left { max-width: 60%; }
        .mobinardo-logo {
            height: 60px;
            width: auto;
            object-fit: contain;
            display: block;
            margin-bottom: 14px;
        }
        .company-block { font-size: 12.5px; color: #212529; line-height: 1.75; }
        .company-block .company-name {
            font-weight: 800;
            font-size: 13.5px;
            letter-spacing: .3px;
        }
        .inv-header-right { text-align: right; white-space: nowrap; padding-top: 8px; }
        .inv-header-right .facture-title {
            font-size: 22px;
            font-weight: 700;
            color: #212529;
        }
        .inv-header-right .facture-title b { font-weight: 800; }
        /* ── Electronic Signature ── */
        .sig-section {
            margin-top: 28px;
        }
        .sig-section-title {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #6c757d;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .sig-section-title::before {
            content: '';
            display: inline-block;
            width: 16px; height: 2px;
            background: #f4791e;
        }
        .sig-canvas-wrap {
            border: 1.5px dashed #ced4da;
            border-radius: 8px;
            background: #f8f9fa;
            position: relative;
            display: inline-block;
        }
        .sig-canvas-wrap canvas {
            display: block;
            border-radius: 8px;
            cursor: crosshair;
        }
        .sig-canvas-placeholder {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
            font-size: 12px;
            color: #adb5bd;
            font-style: italic;
        }
        .sig-actions {
            display: flex;
            gap: 8px;
            margin-top: 8px;
        }
        .btn-sig-clear {
            padding: 7px 16px;
            border: 1.5px solid #dee2e6;
            background: #fff;
            border-radius: 6px;
            font-size: 12px;
            cursor: pointer;
            color: #6c757d;
            transition: all .15s;
        }
        .btn-sig-clear:hover { border-color: #adb5bd; color: #212529; }
        .btn-sig-validate {
            padding: 7px 20px;
            background: #1a1a2e;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: .3px;
            transition: background .15s;
        }
        .btn-sig-validate:hover { background: #f4791e; }
        .btn-sig-validate:disabled { opacity: .6; cursor: not-allowed; }
        .sig-saved-wrap { text-align: center; }
        .sig-verified-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
            border-radius: 20px;
            padding: 4px 12px;
            font-size: 11px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .sig-saved-img {
            display: block;
            border: 1.5px solid #dee2e6;
            border-radius: 6px;
            max-width: 260px;
            max-height: 90px;
            background: #fff;
        }
        .sig-meta {
            font-size: 10px;
            color: #6c757d;
            margin-top: 5px;
        }
        #sigMsg {
            font-size: 12px;
            margin-top: 6px;
            padding: 6px 10px;
            border-radius: 4px;
            display: none;
        }

        /* ── STATUS bar ── */
        .status-bar {
            display: flex;
            justify-content: flex-end;
            padding: 8px 40px 0;
            gap: 8px;
            align-items: center;
            font-size: 12px;
            color: #6c757d;
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
        .invoice-body { padding: 24px 40px 36px; }

        /* ── Client box: "Facture à l'attention de" ── */
        .client-row {
            display: flex;
            align-items: stretch;
            gap: 0;
            border-bottom: 2.5px solid #212529;
            padding-bottom: 18px;
            margin-bottom: 26px;
        }
        .client-box-left {
            background: #f4efe4;
            flex: 0 0 42%;
            display: flex;
            align-items: center;
            padding: 18px 22px;
            font-weight: 700;
            font-size: 13px;
        }
        .client-box-right {
            flex: 1;
            padding: 18px 0 18px 24px;
            font-size: 13px;
            line-height: 2;
        }
        .client-box-right strong { font-weight: 700; }

        /* ── Items table ── */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0;
            font-size: 13px;
        }
        .items-table thead tr {
            background: #f4791e;
            color: #212529;
        }
        .items-table th {
            padding: 12px 14px;
            font-weight: 700;
            font-size: 12px;
            text-decoration: underline;
        }
        .items-table td {
            padding: 14px 14px;
            border: 1px solid #212529;
            vertical-align: top;
            background: #f4efe4;
        }
        .item-designation { font-weight: 700; font-size: 13px; }
        .item-designation .sub-line { font-weight: 400; font-size: 13px; margin-top: 2px; }
        .item-designation .sub-line strong { font-weight: 700; }
        .chassis-badge { font-weight: 400; }
        .loc-badge { display: none; }

        /* ── Totals section ── */
        .totals-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
            margin-top: 0;
        }
        .totals-table td {
            padding: 10px 16px;
            border: 1px solid #212529;
            border-top: none;
        }
        .totals-table .label-col { font-weight: 700; width: 70%; }
        .totals-table .val-col { text-align: right; background: #f4efe4; }
        .totals-table .total-ttc .label-col { font-weight: 700; text-decoration: underline; }

        /* ── Notes / Comment ── */
        .notes-section {
            margin-top: 24px;
            border-left: 3px solid #f4791e;
            padding: 10px 16px;
            background: #fffbf5;
            border-radius: 0 6px 6px 0;
        }
        .notes-section .notes-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #f4791e;
            margin-bottom: 4px;
        }
        .notes-section p { font-size: 13px; color: #212529; }

        /* ── Signature / validation zone (between totals and footer) ── */
        .validation-zone {
            margin-top: 34px;
            display: flex;
            justify-content: flex-end;
        }

        /* ── Footer ── */
        .invoice-footer {
            margin-top: 60px;
            padding: 16px 40px 26px;
            text-align: center;
            font-size: 11px;
            color: #212529;
            line-height: 1.8;
        }
        .invoice-footer .footer-line2 { color: #6c757d; }

        /* ── Divider ── */
        .section-divider {
            height: 1px;
            background: #dee2e6;
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
                position: relative;
                min-height: 100vh;
                padding-bottom: 70px;
            }
            .status-bar { display: none !important; }
            .client-box-left { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .items-table thead tr { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .items-table td { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .totals-table .val-col { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
            .invoice-footer {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                margin-top: 0;
            }
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

    $logo        = \App\Models\Utility::get_file('uploads/logo');
    $company_logo = \App\Models\Utility::GetLogo();

    $cur         = $store->currency ?? 'MAD';
    $storeName   = $store->name ?? 'MOBI-NARDO';
    $storeAddr   = $store->address ?? 'RDC LOT N° 816 LOTISSEMENT MAYSSANE OULAD SALEH';
    $storeCity   = $store->city ?? 'NOUACEUR - CASABLANCA';
    $storePhone  = $store->whatsapp_number ?? '+212 664 35 13 12';
    $storeEmail  = 'contact@mobi-nardo.com';
    $storeCountry= trim(($store->city ?? '') . ($store->state ? ', '.$store->state : '') . ($store->country ? ', '.$store->country : ''));

    /* Legal / registration numbers shown in the footer (static company data) */
    $storeIF       = '60220807';
    $storePatente  = '72000550';
    $storeRC       = '611061';
    $storeICE      = '00340264500001';
    $storeFooterTel= '0664.35.13.12';

    $subtotalHT  = $order->items->sum('price');
    $discount    = floatval($order->discount ?? 0);
    $htNet       = $subtotalHT - $discount;
    $tvaRate     = floatval($order->tva ?? 0);
    $tvaAmount   = $htNet * $tvaRate / 100;
    $totalTTC    = $htNet + $tvaAmount;
    $amountWords = numberToFrench($totalTTC, $cur);
?>

    @if(empty($isPdf))
    <!-- Print / PDF buttons -->
    <div class="print-button-bar no-print">
        <a class="btn-download" href="{{ route('chassis-orders.invoice-pdf', ['id' => $order->id, 'simple' => request('simple')]) }}">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"/></svg>
            Télécharger PDF
        </a>
        <button class="btn-print" onclick="window.print()">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 14h12v8H6z"/></svg>
            Imprimer la facture
        </button>
    </div>
    @endif

    <div class="page">

        <!-- ── TOP HEADER ── -->
        <div class="inv-header">
            <div class="inv-header-left">
                <!-- ========   change your logo hear   ============ -->
                <img src="{{ $logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png') . '?timestamp=' . time() }}"
                     alt="{{ $storeName }}"
                     class="mobinardo-logo">
                <div class="company-block">
                    <div class="company-name">{{ strtoupper($storeName) }}</div>
                    @if($storeAddr)<div>{{ $storeAddr }}</div>@endif
                    @if($storeCity)<div>{{ $storeCity }}</div>@endif
                    @if($storePhone)<div>{{ $storePhone }}</div>@endif
                    @if($storeEmail)<div>{{ $storeEmail }}</div>@endif
                </div>
            </div>
            <div class="inv-header-right">
                <div class="facture-title">Facture N° : <b>{{ $order->order_number }}</b></div>
            </div>
        </div>

        @if(!request('simple'))
        <!-- ── STATUS bar (screen only) ── -->
        <div class="status-bar no-print">
            <span>Statut :</span>
            @if($order->status == 'pending')
                <span class="badge badge-pending">En attente</span>
            @elseif($order->status == 'validated')
                <span class="badge badge-validated">Validée</span>
            @else
                <span class="badge badge-rejected">Rejetée</span>
            @endif
        </div>
        @endif

        <!-- ── BODY ── -->
        <div class="invoice-body">

            <!-- Client box -->
            <div class="client-row">
                @if(!request('simple'))
                <div class="client-box-left">Facture à l'attention de :</div>
                @endif
                <div class="client-box-right">
                    <div><strong>Nom du client :</strong> {{ $order->customer_name ?: '—' }}</div>
                    @if($order->doc_type || $order->doc_number)
                    <div><strong>{{ $order->doc_type ?: 'CIN' }} :</strong> {{ $order->doc_number ?: '—' }}</div>
                    @endif
                    @if($order->customer_phone)
                    <div><strong>Téléphone :</strong> {{ $order->customer_phone }}</div>
                    @endif
                </div>
            </div>

            <!-- Items table -->
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Désignation</th>
                        <th style="width:60px;text-align:center;">Qté</th>
                        <th style="width:70px;text-align:center;">TVA</th>
                        <th style="width:110px;text-align:right;">Prix U.N</th>
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
                        <td>
                            <div class="item-designation">{{ $item->brand_name }} {{ $item->model_name }}</div>
                            <div class="sub-line"><strong>N°chassis :</strong> {{ $item->chassis_number }}</div>
                            @if($item->family_name)
                            <div class="sub-line"><strong>Couleur :</strong> {{ $item->family_name }}</div>
                            @endif
                        </td>
                        <td style="text-align:center;">1</td>
                        <td style="text-align:center;">{{ number_format($tvaRate, 0) }}%</td>
                        <td style="text-align:right;">{{ number_format($item->price, 2, ',', ' ') }}</td>
                        <td style="text-align:right;">{{ number_format($itemTTC, 2, ',', ' ') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Totals -->
            <table class="totals-table">
                <tr>
                    <td class="label-col">TOTAL HT</td>
                    <td class="val-col">{{ number_format($htNet, 2, ',', ' ') }}</td>
                </tr>
                @if($discount > 0)
                <tr>
                    <td class="label-col">Remise</td>
                    <td class="val-col" style="color:#dc3545;">− {{ number_format($discount, 2, ',', ' ') }}</td>
                </tr>
                @endif
                <tr>
                    <td class="label-col">TVA</td>
                    <td class="val-col">{{ number_format($tvaAmount, 2, ',', ' ') }}</td>
                </tr>
                <tr class="total-ttc">
                    <td class="label-col">Montant TTC</td>
                    <td class="val-col">{{ number_format($totalTTC, 2, ',', ' ') }}</td>
                </tr>
            </table>

            @if(!request('simple'))
            <!-- Amount in words -->
            <div class="notes-section" style="margin-top:20px;">
                <div class="notes-label">Arrêtée la présente facture à la somme de</div>
                <p>{{ $amountWords }}</p>
            </div>
            @endif

            @if(!request('simple'))
            @if($order->notes || ($order->comment ?? false))
            @if($order->notes)
            <div class="notes-section" style="margin-top:10px;">
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
            @endif

            @if(!request('simple'))
            <!-- Electronic signature -->
            <div class="validation-zone">
                <div class="sig-section" style="margin-top:0;text-align:right;">
                    <div class="sig-section-title" style="justify-content:flex-end;">Signature électronique de validation</div>

                    @if($order->signature)
                        {{-- Already signed: show saved signature --}}
                        <div class="sig-saved-wrap">
                            <div class="sig-verified-badge">
                                <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
                                Facture validée et signée
                            </div>
                            <img src="{{ $order->signature }}" alt="Signature" class="sig-saved-img">
                            <div class="sig-meta">
                                Signé le {{ $order->signed_at ? $order->signed_at->format('d/m/Y \\u00e0 H:i') : '' }}
                                @if($order->signer) &nbsp;&bull;&nbsp; {{ $order->signer->name }} @endif
                            </div>
                        </div>
                    @else
                        @auth
                            @if(Auth::user()->type === 'admin')
                                {{-- Canvas signature pad --}}
                            <div class="sig-canvas-wrap no-print" id="sigWrap">
                                <canvas id="sigCanvas" width="300" height="110"></canvas>
                                <div class="sig-canvas-placeholder" id="sigPlaceholder">Dessinez votre signature ici</div>
                            </div>
                            <div class="sig-actions no-print">
                                <button class="btn-sig-clear" onclick="clearSig()">&#8635; Effacer</button>
                                <button class="btn-sig-validate" id="btnValidate" onclick="saveSig()">
                                    &#10003; Valider &amp; Signer
                                </button>
                            </div>
                            <div id="sigMsg"></div>
                            @else
                                <div style="color:#6c757d;font-size:12px;font-style:italic;">Seul un admin peut signer cette facture.</div>
                            @endif
                        @else
                            <div style="color:#6c757d;font-size:12px;font-style:italic;">Connectez-vous en tant qu'admin pour signer.</div>
                        @endauth
                    @endif
                </div>
            </div>
            @endif

        </div><!-- /invoice-body -->

        <!-- ── FOOTER ── -->
        <div class="invoice-footer">
            <div>{{ $storeAddr }}@if($storeCity) {{ $storeCity }}@endif</div>
            <div class="footer-line2">IF :{{ $storeIF }} Patente :{{ $storePatente }} RC :{{ $storeRC }} ICE :{{ $storeICE }} TEL :{{ $storeFooterTel }}</div>
        </div>
    </div><!-- /page -->

@auth
<script>
(function() {
    const canvas  = document.getElementById('sigCanvas');
    if (!canvas) return;
    const ctx     = canvas.getContext('2d');
    const placeholder = document.getElementById('sigPlaceholder');
    let drawing   = false;
    let hasDrawn  = false;

    ctx.strokeStyle = '#1a1a2e';
    ctx.lineWidth   = 2;
    ctx.lineCap     = 'round';
    ctx.lineJoin    = 'round';

    function getPos(e) {
        const rect = canvas.getBoundingClientRect();
        const src  = e.touches ? e.touches[0] : e;
        return { x: src.clientX - rect.left, y: src.clientY - rect.top };
    }

    function startDraw(e) {
        drawing = true;
        hasDrawn = true;
        if (placeholder) placeholder.style.display = 'none';
        ctx.beginPath();
        const p = getPos(e);
        ctx.moveTo(p.x, p.y);
        e.preventDefault();
    }
    function draw(e) {
        if (!drawing) return;
        const p = getPos(e);
        ctx.lineTo(p.x, p.y);
        ctx.stroke();
        e.preventDefault();
    }
    function stopDraw() { drawing = false; }

    canvas.addEventListener('mousedown',  startDraw);
    canvas.addEventListener('mousemove',  draw);
    canvas.addEventListener('mouseup',    stopDraw);
    canvas.addEventListener('mouseleave', stopDraw);
    canvas.addEventListener('touchstart', startDraw, { passive: false });
    canvas.addEventListener('touchmove',  draw,      { passive: false });
    canvas.addEventListener('touchend',   stopDraw);

    window.clearSig = function() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        hasDrawn = false;
        if (placeholder) placeholder.style.display = 'flex';
    };

    window.saveSig = function() {
        if (!hasDrawn) {
            alert('Veuillez dessiner votre signature avant de valider.');
            return;
        }
        const btn = document.getElementById('btnValidate');
        btn.disabled = true;
        btn.textContent = 'Validation en cours…';

        const sigData = canvas.toDataURL('image/png');

        fetch('{{ route("chassis-orders.sign", $order->id) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN':  '{{ csrf_token() }}'
            },
            body: JSON.stringify({ signature: sigData })
        })
        .then(r => r.json())
        .then(data => {
            const msg = document.getElementById('sigMsg');
            if (data.success) {
                msg.style.display = 'block';
                msg.style.background = '#d1fae5';
                msg.style.color = '#065f46';
                msg.innerHTML = '✓ Facture validée et signée par ' + data.signer + ' le ' + data.signed_at;
                setTimeout(() => window.location.reload(), 1400);
            } else {
                btn.disabled = false;
                btn.textContent = '✓ Valider & Signer';
                msg.style.display = 'block';
                msg.style.background = '#fee2e2';
                msg.style.color = '#991b1b';
                msg.textContent = 'Erreur lors de la validation.';
            }
        })
        .catch(() => {
            btn.disabled = false;
            btn.textContent = '✓ Valider & Signer';
        });
    };
})();
</script>
@endauth

</body>
</html>
