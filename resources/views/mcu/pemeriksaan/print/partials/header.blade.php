<table class="identity-header">
    <thead>
        <tr>
            <th align="center" colspan="3">{{ $title_header}}</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td width="40%">
                <table>
                    <tr>
                        <td>NIK</td>
                        <td>:</td>
                        <td align="left">{{ $nik }}</td>
                    </tr>
                    <tr>
                        <td>NAMA</td>
                        <td>:</td>
                        <td align="left">{{ $employee_name }}</td>
                    </tr>
                    <tr>
                        <td>PERUSAHAAN</td>
                        <td>:</td>
                        <td align="left">{{ $company_name }}</td>
                    </tr>
                    <tr>
                        <td>BAGIAN</td>
                        <td>:</td>
                        <td align="left">-</td>
                    </tr>
                </table>
            </td>
            <td width="30%" class="border-left">
                <table>
                    <tr>
                        <td>TGL MCU</td>
                        <td>:</td>
                        <td align="left">{{ $mcu_date }}</td>
                    </tr>
                    <tr>
                        <td>J.KEL</td>
                        <td>:</td>
                        <td align="left">{{ $sex }}</td>
                    </tr>
                    <tr>
                        <td>TGL LAHIR</td>
                        <td>:</td>
                        <td align="left">{{ $dob }}</td>
                    </tr>
                </table>
            </td>
            <td width="30%" class="border-left">
                <table>
                    <tr>
                        <td>No.MCU</td>
                        <td>:</td>
                        <td align="left">{{ $mcu_code }}</td>
                    </tr>
                    <tr>
                        <td>UMUR</td>
                        <td>:</td>
                        <td align="left">{{ $age }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </tbody>
</table>