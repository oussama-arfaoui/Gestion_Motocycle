@php
    use SimpleSoftwareIO\QrCode\Facades\QrCode;

    // Dimensions reçues du contrôleur (largeur/hauteur en mm, déjà orientées)
    $size = ['w' => $labelWidth, 'h' => $labelHeight];
    $mmW = (float) $labelWidth;   // "50mm" => 50.0
    $mmH = (float) $labelHeight;
    $minDim = min($mmW, $mmH);

    // Tailles adaptatives selon la hauteur de l'étiquette
    $clamp = fn($v, $lo, $hi) => max($lo, min($hi, $v));
    $brandPt = round($clamp($mmH * 0.30, 5, 12), 1);
    $familyPt = round($brandPt * 0.85, 1);
    $pricePt = round($brandPt * 1.05, 1);
    $codePt = round($clamp($mmH * 0.24, 4.5, 9), 1);
    $pad = round($clamp($minDim * 0.06, 0.5, 3), 1);
    // Hauteur du code-barres (px) et bloc QR (px)
    $barcodeH = (int) round($clamp($mmH * 1.3, 18, 70));
    $qrPx = (int) round($clamp($minDim * 3.2, 45, 170));
    $qrPxSmall = (int) round($clamp($minDim * 2.0, 38, 110)); // modèle 3
    $barWidth = round($clamp($mmW * 0.03, 0.8, 2.2), 2);

    $priceFmt = number_format((float) ($family->price ?? 0), 2, ',', ' ') . ' MAD';

    $genBarcode = function ($value) use ($barWidth, $barcodeH) {
        try {
            return \DNS1D::getBarcodeHTML((string) $value, 'C128', $barWidth, $barcodeH);
        } catch (\Throwable $e) {
            return '';
        }
    };
    $genQr = function ($value, $px = 120) {
        try {
            return QrCode::format('svg')->size($px)->margin(0)->generate((string) $value);
        } catch (\Throwable $e) {
            return '';
        }
    };
@endphp
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>{{ __('Impression') }} - {{ $family->name }}</title>
    <style>
        @page {
            size: {{ $size['w'] }} {{ $size['h'] }};
            margin: 0;
        }
        * { box-sizing: border-box; }
        html, body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
            color: #000;
            background: #fff;
        }
        .label {
            width: {{ $size['w'] }};
            height: {{ $size['h'] }};
            padding: {{ $pad }}mm;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
            page-break-after: always;
        }
        .label:last-child { page-break-after: auto; }
        .brand-line { font-size: {{ $brandPt }}pt; font-weight: 700; line-height: 1.05; }
        .brand-line .model { font-weight: 400; }
        .family-line { font-size: {{ $familyPt }}pt; font-weight: 600; line-height: 1.05; }
        .price-line { font-size: {{ $pricePt }}pt; font-weight: 800; margin-top: 1px; }
        .code-value { font-size: {{ $codePt }}pt; letter-spacing: 0.3px; word-break: break-all; line-height: 1.05; }
        .code-label { font-size: {{ round($codePt * 0.85, 1) }}pt; color: #333; text-transform: uppercase; }
        .barcode-box { margin-top: 1px; }
        .barcode-box div { background-color: #000 !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        .qr-box svg { display: block; }
        .codes { display: flex; align-items: center; justify-content: center; gap: {{ round($pad, 1) }}mm; margin-top: 1px; }

        /* Barre d'actions (écran uniquement) */
        .toolbar {
            position: fixed; top: 0; left: 0; right: 0;
            background: #222; color: #fff; padding: 10px 16px;
            display: flex; gap: 10px; align-items: center; justify-content: center;
            font-family: Arial, sans-serif;
        }
        .toolbar button {
            border: 0; border-radius: 6px; padding: 8px 16px; cursor: pointer;
            font-size: 14px; font-weight: 600;
        }
        .toolbar .print-btn { background: #0d6efd; color: #fff; }
        .toolbar .close-btn { background: #6c757d; color: #fff; }
        .sheet { margin-top: 60px; }
        @media print {
            .toolbar { display: none !important; }
            .sheet { margin-top: 0 !important; }
        }
    </style>
</head>
<body>
    <div class="toolbar">
        <span>{{ count($values) }} {{ __('étiquette(s)') }} — {{ __('Modèle') }} {{ $template }} ({{ $size['w'] }} × {{ $size['h'] }})</span>
        <button class="print-btn" onclick="window.print()">{{ __('Imprimer') }}</button>
        <button class="close-btn" onclick="window.close()">{{ __('Fermer') }}</button>
    </div>

    <div class="sheet">
        @foreach ($values as $value)
            <div class="label">
                <div class="brand-line">{{ $brand }} @if($model)<span class="model">({{ $model }})</span>@endif</div>
                <div class="family-line">{{ $family->name }}</div>

                @if ($template === 2)
                    {{-- Modèle 2 : QR uniquement --}}
                    <div class="qr-box">{!! $genQr($value, $qrPx) !!}</div>
                    <div class="code-value"><span class="code-label">{{ $codeLabel }}:</span> {{ $value }}</div>
                @elseif ($template === 3)
                    {{-- Modèle 3 : QR + Code-barres --}}
                    <div class="codes">
                        <div class="qr-box">{!! $genQr($value, $qrPxSmall) !!}</div>
                        <div class="barcode-box">{!! $genBarcode($value) !!}</div>
                    </div>
                    <div class="code-value"><span class="code-label">{{ $codeLabel }}:</span> {{ $value }}</div>
                @else
                    {{-- Modèle 1 : Code-barres uniquement --}}
                    <div class="barcode-box">{!! $genBarcode($value) !!}</div>
                    <div class="code-value">{{ $value }}</div>
                @endif

                @if ($withPrice)
                    <div class="price-line">{{ $priceFmt }}</div>
                @endif
            </div>
        @endforeach
    </div>

    <script>
        window.addEventListener('load', function () {
            setTimeout(function () { window.print(); }, 350);
        });
    </script>
</body>
</html>
