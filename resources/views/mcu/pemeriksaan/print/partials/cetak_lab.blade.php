<h4>LABORATORIUM</h4>
<table style="width: 100%; border-collapse: collapse; border-spacing: 0px 10px; font-size: 13px;" cellpadding="3">
    <tbody>
        <tr style="border-bottom: 2px solid black; font-size: 15px;">
            <td width="240px" align="left"><b>Nama Pemeriksaan</b></td>
            <td align="left"><b>Hasil</b></td>
            <td align="left"><b>Nilai Rujukan</b></td>
            <td align="center"><b>Kesan</b></td>
        </tr>
        @foreach ($laboratorium->detail as $lab)
            <tr>
                <td width="240px" align="left"><b>{{ $lab->laboratory_examination_name }} </b></td>
                <td align="left">{{ $lab->result }}</td>
                <td align="left">{{ $lab->reference_value }}</td>
                <td align="center">{{ ($lab->is_abnormal == 1) ? 'Abnormal' : '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
