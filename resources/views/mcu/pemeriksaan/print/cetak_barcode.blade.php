<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barcode Pemeriksaan - {{ $mcu_code }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding-top: 100px;
            padding-bottom: 100px;
        }

        @page {
            margin-top: 145px;
            margin-bottom: 145px;
            margin-left: 19px;
            margin-right: 20px;
        }

        .cover {
            width: 100%;
            max-width: 650px;
            padding: 30px;
            text-align: center;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="cover" style="margin-top:-180px;margin-bottom:-180px">
        <div class="content" style="margin-left: -60px; text-align: center;">
            @php
                echo '<img src="data:image/png;base64,' .
                    DNS1D::getBarcodePNG($mcu_code, 'C39+') .
                    '" alt="barcode" style="width:200px;height:50px"   />';
            @endphp
            <br>
            {{ $employee_name }} - {{ $mcu_code }}
        </div>
    </div>
</body>

</html>
