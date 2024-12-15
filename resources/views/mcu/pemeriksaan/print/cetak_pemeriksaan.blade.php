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
            table-layout: fixed; /* Ensures equal width for columns */
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

        .table-cover, .table-cover th, .table-cover td {
            border: none;

        }

        .table-cover th, .table-cover td {
            padding: 15px;
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
        <img src="{{ empty($letterhead) ? public_path('img-pdf/default.jpg') : public_path('upload/letterhead/'.$letterhead) }}" alt="Template Logo">
    </div>

    <div class="header">
        <h3>Healt Screening Result</h3>
    </div>
    <div class="cover">
        <div class="content" style="padding-left: 90px; padding-right: 90px;">

            <!-- Tabel Biodata Karyawan dengan class table-cover -->
            <table class="table-cover">
                <tr>
                    <th>No MCU</th>
                    <td>:</td>
                    <td>{{ $employee_name }}</td>
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
                    <td></td>
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
                    <td>{{ $dob  }} / {{ $age }}</td>
                </tr>
            </table>
        </div>
    </div>
    
    <div class="page-break"></div>

    @if (!empty($anamnesis))
    @include('mcu.pemeriksaan.print.partials.cetak_anamnesis')
    @endif
    
    <div class="page-break"></div>

    @if (!empty($refraksi))
    @include('mcu.pemeriksaan.print.partials.cetak_refraksi')
    @endif

    <div class="page-break"></div>

    @if (!empty($laboratorium))
    @include('mcu.pemeriksaan.print.partials.cetak_lab')
    @endif

    <div class="page-break"></div>

    @if (!empty($rontgen))
    @include('mcu.pemeriksaan.print.partials.cetak_rontgen')
    @endif
    
    <div class="page-break"></div>

    @if (!empty($audiometri))
    @include('mcu.pemeriksaan.print.partials.cetak_audiometri')
    @endif

    <div class="page-break"></div>

    @if (!empty($spirometri))
    @include('mcu.pemeriksaan.print.partials.cetak_spirometri')
    @endif

    <div class="page-break"></div>

    @if (!empty($ekg))
    @include('mcu.pemeriksaan.print.partials.cetak_ekg')
    @endif

    <div class="page-break"></div>

    @if (!empty($usg))
    @include('mcu.pemeriksaan.print.partials.cetak_usg')
    @endif

    <div class="page-break"></div>

    @if (!empty($treadmill))
    @include('mcu.pemeriksaan.print.partials.cetak_treadmill')
    @endif
    
    <div class="page-break"></div>

    @if (!empty($papsmear))
    @include('mcu.pemeriksaan.print.partials.cetak_papsmear')
    @endif

    <div class="page-break"></div>

    @if (!empty($resume))
    @include('mcu.pemeriksaan.print.partials.cetak_resume')
    @endif
</body>
</html>
