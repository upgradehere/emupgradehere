<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blanko Pemeriksaan - {{ $mcu_code }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .table-cover {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            text-align: left;
            border: 2px solid black;
        }

        .table-cover,
        .table-cover th,
        .table-cover td {
            border: none;
        }

        .table-cover th,
        .table-cover td {
            padding: 5px;
        }

        .table-cover th {
            width: 45%;
            text-align: left;
        }

        .table-cover td:nth-child(2) {
            width: 2%;
        }

        .header {
            font-size: 24px;
            margin-bottom: 30px;
            text-align: center;
        }

        .rectangle-wrapper {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-top: 20px;
        }

        .rectangle {
            width: 20px;
            height: 20px;
            border: 2px solid #333;
            margin-right: 10px;
        }

        .rectangle label {
            font-size: 16px;
            margin: 0;
        }

        .cover {
            width: 100%;
            max-width: 650px;
            padding: 30px;
            text-align: center;
            justify-content: center;
            align-items: center;
        }

        @page {
            margin-top: 145px;
            margin-bottom: 145px;
            margin-left: 19px;
            margin-right: 20px;
        }

        input[type="checkbox"] {
            transform: scale(1.2);
        }

        .page-break {
            page-break-before: always;
        }

        .no-break {
            page-break-inside: avoid;
            break-inside: avoid-column;
        }
    </style>
</head>

<body>
    <div class="cover" style="margin-top:-180px">
        <div class="content" style="padding-left: 600px;">
            @php
                echo '<img src="data:image/png;base64,' .
                    DNS2D::getBarcodePNG($nik, 'QRCODE') .
                    '" alt="qrcode-nik"   />';
            @endphp
        </div>
        <div class="content" style="padding-left: 120px;">
            <table class="table-cover">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>{{ $employee_name }}</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>:</td>
                    <td>{{ $nik }}</td>
                </tr>
                <tr>
                    <td>Perusahaan</td>
                    <td>:</td>
                    <td>{{ $company_name }} - ({{ $departement_name }})</td>
                </tr>
                <tr>
                    <td>Tanggal MCU</td>
                    <td>:</td>
                    <td>{{ $mcu_date }}</td>
                </tr>
                <tr>
                    <td>No MCU</td>
                    <td>:</td>
                    <td>{{ $mcu_code }}</td>
                </tr>
            </table>
        </div>
        <hr>
    </div>

    <div class="content" style="padding-left: 30px;">
        @if ($anamnesis == 1)
            <table>
                <tr>
                    <td>
                        <div class="rectangle"></div>
                    </td>
                    <td>
                        <h3>Anamnesa</h3>
                    </td>
                </tr>
            </table>
        @endif
        @if ($rontgen == 1)
            <table>
                <tr>
                    <td>
                        <div class="rectangle"></div>
                    </td>
                    <td>
                        <h3>Rontgen</h3>
                    </td>
                </tr>
            </table>
        @endif
        @if ($audiometry == 1)
            <table>
                <tr>
                    <td>
                        <div class="rectangle"></div>
                    </td>
                    <td>
                        <h3>Audiometri</h3>
                    </td>
                </tr>
            </table>
        @endif
        @if ($spirometry == 1)
            <table>
                <tr>
                    <td>
                        <div class="rectangle"></div>
                    </td>
                    <td>
                        <h3>Spirometri</h3>
                    </td>
                </tr>
            </table>
        @endif
        @if ($ekg == 1)
            <table>
                <tr>
                    <td>
                        <div class="rectangle"></div>
                    </td>
                    <td>
                        <h3>EKG</h3>
                    </td>
                </tr>
            </table>
        @endif
        @if ($usg == 1)
            <table>
                <tr>
                    <td>
                        <div class="rectangle"></div>
                    </td>
                    <td>
                        <h3>USG</h3>
                    </td>
                </tr>
            </table>
        @endif
        @if ($treadmill == 1)
            <table>
                <tr>
                    <td>
                        <div class="rectangle"></div>
                    </td>
                    <td>
                        <h3>Treadmill</h3>
                    </td>
                </tr>
            </table>
        @endif
        @if ($papsmear == 1)
            <table>
                <tr>
                    <td>
                        <div class="rectangle"></div>
                    </td>
                    <td>
                        <h3>Papsmear</h3>
                    </td>
                </tr>
            </table>
        @endif
        @if ($refraction == 1)
            <table>
                <tr>
                    <td>
                        <div class="rectangle"></div>
                    </td>
                    <td>
                        <h3>Refraction</h3>
                    </td>
                </tr>
            </table>
        @endif
        @if (!empty($lab))
            <table>
                <tr>
                    <td>
                        <div class="rectangle"></div>
                    </td>
                    <td>
                        <h3>Laboratorium</h3>
                    </td>
                </tr>
            </table>
        @endif
    </div>
</body>

</html>
