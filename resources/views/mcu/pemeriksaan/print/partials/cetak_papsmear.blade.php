<h4>PAPSMEAR</h4>
<div class="no-break">
    <table style="width: 100%; border-collapse: collapse; font-size: 13px;" cellpadding="3">
        <tbody>
            <tr>
                <th colspan="3" align="left" style="border-bottom: 2px solid black; font-size: 15px;">Papsmear</th>
            </tr>
            <tr>
                <td width="25%"><b>Kesimpulan</b></td>
                <td>:</td>
                <td width="75%">{{ $papsmear->conclusion ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td width="25%"><b>Kesan</b></td>
                <td>:</td>
                <td width="75%">{{ $papsmear->classification ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td width="25%"><b>Spesimen</b></td>
                <td>:</td>
                <td width="75%">{{ $papsmear->speciment ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td width="25%"><b>Keterangan Klinis</b></td>
                <td>:</td>
                <td width="75%">{{ $papsmear->clinical_description ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td width="25%"><b>Kategori Umum/Rincian</b></td>
                <td>:</td>
                <td width="75%">{{ $papsmear->general_category ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td width="25%"><b>Anjuran</b></td>
                <td>:</td>
                <td width="75%">{{ $papsmear->recommendations ?? 'N/A' }}</td>
            </tr>
        </tbody>
    </table>
</div>