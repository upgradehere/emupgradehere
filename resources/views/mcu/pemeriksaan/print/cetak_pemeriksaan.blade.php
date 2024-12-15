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
           margin-left: 20px; 
           margin-right: 20px; 
        }
        input[type="checkbox"] {
            transform: scale(1.2); /* Membesarkan ukuran checkbox */
        }
        .page-break {
            page-break-before: always;
        }
        .no-break {
            page-break-inside: avoid; /* Prevent page breaks inside this div */
            break-inside: avoid-column; /* For newer browsers that support break-inside */
        }
    </style>
</head>
<body>
    <div class="watermark">
        <img src="{{ empty($letterhead) ? public_path('img-pdf/default.jpg') : public_path('uplploads/letterhead/'.$letterhead) }}" alt="Template Logo">
    </div>

    @if (!empty($anamnesis))
    @include('mcu.pemeriksaan.print.partials.header', ['title_header' => 'PEMERIKSAAN FISIK ANAMNESA'])
    @endif

    @if (!empty($anamnesis))
    @include('mcu.pemeriksaan.print.partials.cetak_anamnesis')
    @endif
    
    <div class="page-break"></div>


    @if (!empty($anamnesis))
    @include('mcu.pemeriksaan.print.partials.header', ['title_header' => 'PEMERIKSAAN LABORATORIUM'])
    @endif

    @if (!empty($laboratorium))
    @include('mcu.pemeriksaan.print.partials.cetak_lab')
    @endif
    
    <div class="page-break"></div>
    
    @if (!empty($anamnesis))
    @include('mcu.pemeriksaan.print.partials.header', ['title_header' => 'PEMERIKSAAN AUDIOMETRI'])
    @endif

    @if (!empty($audiometri))
    @include('mcu.pemeriksaan.print.partials.cetak_audiometri')
    @endif


    @if (!empty($refraksi))
    @include('mcu.pemeriksaan.print.partials.cetak_refraksi')
    @endif


    
    @if (!empty($rontgen))
    @include('mcu.pemeriksaan.print.partials.cetak_rontgen')
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
