<!DOCTYPE html>
<html>

<head>
    <title>Cetak Pemeriksaan MCU</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }

        .identity-header {
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
            table-layout: fixed;
            /* Ensures equal width for columns */
        }

        .identity-header th {
            border: 1px solid black;
        }

        .identity-header td {
            font-size: 12px;
            font-weight: bold;
            vertical-align: top;
        }

        .border-left {
            border-left: 1px solid black;
        }

        .sub-table {
            width: 100%;
            border-collapse: collapse;
        }

        .sub-table td {
            font-size: 13px;
        }

        .sub-table th {
            font-size: 13px;
        }

        .sub-table td:first-child {
            width: 40%;
        }

        .sub-table td:nth-child(2) {
            width: 5%;
        }

        .sub-table td:nth-child(3) {
            width: 55%;
        }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: -1;
            pointer-events: none;
        }

        .watermark img {
            width: 793px;
            height: 1122px;
            height: auto;
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

        .cover {
            width: 100%;
            max-width: 650px;
            padding: 30px;
            text-align: center;
            justify-content: center;
            align-items: center;
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
            padding: 7px;
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
    </style>
</head>

<body>
    <div class="watermark">
        @if (empty($letterhead))
            <img src="{{ public_path('pdf/default.jpg') }}">
        @else
            <img src="{{ public_path('uploads/letterhead/' . $letterhead) }}">
        @endif
    </div>

    <div class="header">
        <h3>Health Screening Result</h3>
        @if (!empty($photo) && file_exists(public_path('uploads/employee-photo/' . $photo)))
            <img src="{{ public_path('uploads/employee-photo/' . $photo) }}" style="width:20%" alt="">
        @endif
    </div>
    <div class="cover" style="margin-top:-50px">
        <div class="content" style="padding-left: 90px; padding-right: 90px;">

            <table class="table-cover">
                <tr>
                    <th>No MCU</th>
                    <td>:</td>
                    <td>{{ $mcu_code }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>:</td>
                    <td>{{ $employee_name }}</td>
                </tr>
                <tr>
                    <th>NIK</th>
                    <td>:</td>
                    <td>{{ $nik }}</td>
                </tr>
                <tr>
                    <th>Perusahaan</th>
                    <td>:</td>
                    <td>{{ $company_name }}</td>
                </tr>
                <tr>
                    <th>Dept / Bagian</th>
                    <td>:</td>
                    <td>{{ $departement_name }}</td>
                </tr>
                <tr>
                    <th>Tanggal MCU</th>
                    <td>:</td>
                    <td>{{ $mcu_date }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>:</td>
                    <td>{{ $sex }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir / Umur</th>
                    <td>:</td>
                    <td>{{ $dob }} / {{ $age }}</td>
                </tr>
            </table>
        </div>
    </div>


    @if (!empty($anamnesis))
        <div class="page-break"></div>
        @include('mcu.pemeriksaan.print.partials.cetak_anamnesis')
    @endif


    @if (!empty($refraksi))
        <div class="page-break"></div>
        @include('mcu.pemeriksaan.print.partials.cetak_refraksi')
    @endif


    @if (!empty($laboratorium))
        <div class="page-break"></div>
        @include('mcu.pemeriksaan.print.partials.cetak_lab')
    @endif


    @if (!empty($rontgen))
        <div class="page-break"></div>
        @include('mcu.pemeriksaan.print.partials.cetak_rontgen')
    @endif


    @if (!empty($audiometri))
        <div class="page-break"></div>
        @include('mcu.pemeriksaan.print.partials.cetak_audiometri')
    @endif


    @if (!empty($spirometri))
        <div class="page-break"></div>
        @include('mcu.pemeriksaan.print.partials.cetak_spirometri')
    @endif


    @if (!empty($ekg))
        <div class="page-break"></div>
        @include('mcu.pemeriksaan.print.partials.cetak_ekg')
    @endif


    @if (!empty($usg))
        <div class="page-break"></div>
        @include('mcu.pemeriksaan.print.partials.cetak_usg')
    @endif


    @if (!empty($treadmill))
        <div class="page-break"></div>
        @include('mcu.pemeriksaan.print.partials.cetak_treadmill')
    @endif


    @if (!empty($papsmear))
        <div class="page-break"></div>
        @include('mcu.pemeriksaan.print.partials.cetak_papsmear')
    @endif


    @if (!empty($resume))
        <div class="page-break"></div>
        @include('mcu.pemeriksaan.print.partials.cetak_resume')
    @endif
</body>

</html>
