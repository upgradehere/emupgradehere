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
            border: 1px solid #ddd;
            border-collapse: collapse;
            table-layout: fixed; /* Ensures equal width for columns */
        }

        .identity-header td {
            width: 50%; /* Makes each cell 50% of the total width */
            padding: 10px;
            vertical-align: top;
        }

        .sub-table {
            width: 100%;
            border-collapse: collapse;
        }

        .sub-table td {
            padding: 5px;
            font-size: 14px;
            vertical-align: middle;
        }

        .sub-table td:first-child {
            font-weight: bold;
            width: 40%; /* Allocates 30% for labels */
        }

        .sub-table td:nth-child(2) {
            width: 5%; /* Small space for the colon */
        }

        .sub-table td:nth-child(3) {
            width: 55%; /* Remaining space for the value */
        }

        .identity-header td:nth-child(2) {
            border-left: 1px solid #ddd; /* Adds a visual separator */
        }

        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(10%,-5%) rotate(-70deg);;
            opacity: 0.1; 
            z-index: -1;
            pointer-events: none;
        }

        .watermark img {
            transform: rotate(45deg);
            width: 120%;
            height: auto;
        }
        
        .logo-left {
            float: left;
            max-width: 300px;
            height: auto;
        }

        .logo-right {
            float: right;
            max-width: 300px;
            height: auto;
        }

        .logo-footer {
            max-width: 800px;
            height: auto;
        }
        
        @page {
           margin-top: 130px;
           margin-bottom: 150px; 
           margin-left: 20px; 
           margin-right: 20px; 
        }

        header { 
            position: fixed;
            top: -100px;
            left: 0px;
            right: 0px;
        }
        footer { 
            position: fixed; 
            bottom: -150px; 
            left: -20px; 
        }
    </style>
</head>
<body>
    <header>
        <img class="logo-left" src="{{ public_path('img-pdf/header.jpeg') }}" alt="Logo Kiri">
        <img class="logo-right" src="{{ public_path('img-pdf/header.jpeg') }}" alt="Logo Kanan">
    </header>
    <div class="watermark">
        <img src="{{ public_path('img-pdf/watermark.jpg') }}" alt="Watermark Logo">
    </div>
    <footer>
        <img class="logo-footer" src="{{ public_path('img-pdf/footer.png') }}" alt="Footer Logo">
    </footer>
    <table class="identity-header">
        <tbody>
            <tr>
                <td>
                    <table class="sub-table">
                        <tbody>
                            <tr>
                                <td>NIK</td>
                                <td></td>
                                <td>{{ $nik }}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td></td>
                                <td>{{ $employee_name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td>
                    <table class="sub-table">
                        <tbody>
                            <tr>
                                <td>Tanggal MCU</td>
                                <td></td>
                                <td>{{ $mcu_date }}</td>
                            </tr>
                            <tr>
                                <td>No. MCU</td>
                                <td></td>
                                <td>{{ $mcu_code }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    <h3><center>Hasil Pemeriksaan MCU</center></h3>
    @if (!empty($anamnesis))
    @include('mcu.pemeriksaan.print.partials.cetak_anamnesis')
    @endif

    @if (!empty($laboratorium))
    @include('mcu.pemeriksaan.print.partials.cetak_lab')
    @endif

    @if (!empty($refraksi))
    @include('mcu.pemeriksaan.print.partials.cetak_refraksi')
    @endif

    @if (!empty($rontgen))
    @include('mcu.pemeriksaan.print.partials.cetak_rontgen')
    @endif

    @if (!empty($audiometri))
    @include('mcu.pemeriksaan.print.partials.cetak_audiometri')
    @endif

    @if (!empty($spirometri))
    @include('mcu.pemeriksaan.print.partials.cetak_spirometri')
    @endif

    @if (!empty($ekg))
    @include('mcu.pemeriksaan.print.partials.cetak_ekg')
    @endif

    @if (!empty($usg))
    @include('mcu.pemeriksaan.print.partials.cetak_usg')
    @endif

    @if (!empty($treadmill))
    @include('mcu.pemeriksaan.print.partials.cetak_treadmill')
    @endif

    @if (!empty($papsmear))
    @include('mcu.pemeriksaan.print.partials.cetak_papsmear')
    @endif

    @if (!empty($resume))
    @include('mcu.pemeriksaan.print.partials.cetak_resume')
    @endif
</body>
</html>
