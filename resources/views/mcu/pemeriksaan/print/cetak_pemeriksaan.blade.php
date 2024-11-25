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
    </style>
</head>
<body>
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
    @include('mcu.pemeriksaan.print.partials.cetak_anamnesis')
</body>
</html>
