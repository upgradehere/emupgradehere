<div class="no-break">
    <h4>RESUME MCU</h4>
    <table style="width: 100%; border-collapse: collapse; font-size: 13px;" cellpadding="3">
        <tbody>
            <tr>
                <th colspan="3" align="left" style="border-bottom: 2px solid black; font-size: 15px;"> Hasil Pemeriksaan </th>
            </tr>
            <tr>
                <td width="20%">Kesan Fisik</td>
                <td>:</td>
                <td width="80%">{{ $resume->physical_impression ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td width="20%">Kesan Rontgen</td>
                <td>:</td>
                <td width="80%">{{ $resume->rontgen_impression ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td width="20%">Kesan EKG</td>
                <td>:</td>
                <td width="80%">{{ $resume->ekg_impression ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td width="20%">Kesan Audiometri</td>
                <td>:</td>
                <td width="80%">{{ $resume->audiometry_impression ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td width="20%">Kesan USG</td>
                <td>:</td>
                <td width="80%">{{ $resume->usg_impression ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td width="20%">Kesan Spirometri</td>
                <td>:</td>
                <td width="80%">{{ $resume->spirometry_impression ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td width="20%">Kesan Refraksi</td>
                <td>:</td>
                <td width="80%">{{ $resume->refreaction_impression ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td width="20%">Kesan Laboratorium</td>
                <td>:</td>
                <td width="80%">{{ $resume->laboratory_impression ?? 'N/A' }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <table style="width: 100%; border-collapse: collapse; font-size: 13px;" cellpadding="3">
        <tbody>
            <tr>
                <th colspan="3" align="left" style="border-bottom: 2px solid black; font-size: 15px;"> Kesimpulan </th>
            </tr>
            <tr>
                <td width="20%">Kesimpulan</td>
                <td>:</td>
                <td width="80%">{{ $resume->result_conclusion ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td width="20%">Saran</td>
                <td>:</td>
                <td width="80%">{{ $resume->suggestion ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td width="20%">Pemeriksa</td>
                <td>:</td>
                <td width="80%">{{ $resume->doctor_id ?? 'N/A' }}</td>
            </tr>
        </tbody>
    </table>
</div>
