<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Barcode Pemeriksaan MCU</title>
    <style>
        @page {
            size: 50mm 25mm landscape;
            margin: 2mm 4mm 2mm 2mm;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .page {
            width: 100%;
            height: 100%;
            page-break-after: always;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            padding: 0;
            box-sizing: border-box;
        }

        .barcode img {
            width: 100%;
            max-height: 34px;
            margin-top: 2mm;
            margin-bottom: 1mm;
        }

        .text {
            font-size: 8px;
            text-align: center;
            line-height: 1.3;
        }
    </style>
</head>
<body>
@foreach($pages as $page)
    <div class="page">
        <div class="barcode">
            <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($page['mcu_code'], 'C39+', 2, 34) }}" alt="barcode">
        </div>
        <div class="text">
            {{ $page['mcu_code'] }} | {{ $page['nik'] }}<br>
            {{ strtoupper($page['employee_name']) }} | {{ $page['sex'] }} | {{ $page['age'] }}<br>
            {{ strtoupper($page['company_name']) }}<br>
            {{ strtoupper($page['package_name']) }} | {{ $page['mcu_date'] }}
        </div>
    </div>
@endforeach
</body>
</html> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Barcode Pemeriksaan MCU</title>
    <style>
        @page {
            size: 50mm 25mm landscape;
            margin: 2mm 4mm 2mm 2mm;
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
            padding: 0;
            box-sizing: border-box;
        }

        .page:not(:last-child) {
            page-break-after: always;
        }

        .barcode img {
            width: 100%;
            max-height: 34px;
            margin-top: 2mm;
            margin-bottom: 1mm;
        }

        .text {
            font-size: 8px;
            text-align: center;
            line-height: 1.3;
        }
    </style>

</head>
<body>
@foreach($pages as $index => $page)
    @if($index === 0)
    <div class="page">
        <div class="barcode">
            <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($page['mcu_code'], 'C39+', 2, 34) }}" alt="barcode">
        </div>
        <div class="text">
            {{ $page['mcu_code'] }} | {{ $page['nik'] }}<br>
            {{ strtoupper($page['employee_name']) }} | {{ $page['sex'] }} | {{ $page['age'] }}<br>
            {{ strtoupper($page['company_name']) }}<br>
            {{ strtoupper($page['package_name']) }} | {{ $page['mcu_date'] }}
        </div>
    </div>
    @endif
@endforeach
</body>
</html>
