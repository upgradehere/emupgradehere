@php
    use Milon\Barcode\DNS1D;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Barcode Pemeriksaan MCU</title>
    <style>
        @page {
            size: 50mm 25mm landscape;
            margin: 2mm 4mm 2mm 2mm; /* keep outer printer margin */
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .page {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            /* quiet zones left/right ≥ 2.5 mm */
            padding-left: 1mm;
            padding-right: 1mm;
            box-sizing: border-box;
            page-break-inside: avoid;
            text-align: center;
        }

        .page:not(:last-child) {
            page-break-after: always;
        }

        .barcode img {
            width: 100%;
            height: auto;
            /* ~15 mm visual bar height (scanner-friendly) */
            max-height: 12mm;
            margin-top: 1mm;
            margin-bottom: 1mm;
            display: block;
        }

        .text {
            font-size: 5px;
            text-align: center;
            line-height: 1;
        }
        .mcu-line {
        font-size: 6pt; 
        letter-spacing: 0.4px;
        margin-bottom: 0.6mm;
        }
    </style>
</head>
<body>

@foreach($pages as $index => $page)
    @if($index === 0)
        @php
            // --- SANITIZE MCU: remove '/', keep A–Z0–9 only, uppercase, length 1..20 ---
            $rawMcu = $page['mcu_code'] ?? '';
            $mcu = strtoupper(preg_replace('/[^A-Z0-9]/', '', str_replace('/', '', $rawMcu)));
            if (strlen($mcu) < 1 || strlen($mcu) > 20) {
                $mcu = 'INVALID';
            }

            // --- BARCODE GEOMETRY ---
            // widthFactor ≈ narrow bar width; 1.2–1.5 typical (increase to thicken bars)
            $widthFactor = 1.8;
            // internal raster height (px); CSS max-height (mm) above is the final limiter
            $heightPx = 180;

            // --- GENERATE CODE 128 AS PNG (dompdf-friendly) ---
            $barcodePng = (new DNS1D)->getBarcodePNG($mcu, 'C128', $widthFactor, $heightPx);
        @endphp

        <div class="page">
            <div class="barcode">
                <img src="data:image/png;base64,{{ $barcodePng }}" alt="barcode">
            </div>
            <div class="text">
                {{-- Human-readable MCU under the bars --}}
                <div class="mcu-line">{{ $mcu }}</div>
                {{-- keep your existing info lines below (optional) --}}
                {{ $page['nik'] ?? '' }} |
                {{ strtoupper($page['employee_name'] ?? '') }} <br>
                {{ strtoupper($page['company_name'] ?? '') }}<br>
                {{ strtoupper($page['package_name'] ?? '') }} | {{ $page['mcu_date'] ?? '' }} | {{ $page['sex'] ?? '' }} | {{ $page['age'] ?? '' }}<br>
            </div>
        </div>
    @endif
@endforeach

</body>
</html>
