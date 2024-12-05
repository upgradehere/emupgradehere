<h4>Laboratorium</h4>
<table style="width: 100%; border-collapse: collapse; border-spacing: 0 10px;">
    <tbody>
        <tr style="border-bottom: 2px solid black;">
            <td><b>Nama Pemeriksaan</b></td>
            <td><b>Hasil</b></td>
            <td><b>Nilai Rujukan</b></td>
            <td><b>Kesan</b></td>
        </tr>
        @foreach ($laboratorium->detail as $lab)
            <tr>
                <td>{{ $lab->laboratory_examination_name }}</td>
                <td>{{ $lab->result }}</td>
                <td>{{ $lab->reference_value }}</td>
                <td>{{ ($lab->is_abnormal == 1) ? 'Abnormal' : '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
