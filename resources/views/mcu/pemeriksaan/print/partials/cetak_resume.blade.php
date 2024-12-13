<h4>Resume MCU</h4>
<table class="identity-header">
    <tbody>
        <tr>
            <td>Kesan Fisik</td>
            <td>{{ $resume->physical_impression ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td>Kesan Rontgen</td>
            <td>{{ $resume->rontgen_impression ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td>Kesan EKG</td>
            <td>{{ $resume->ekg_impression ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td>Kesan Audiometri</td>
            <td>{{ $resume->audiometry_impression ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td>Kesan USG</td>
            <td>{{ $resume->usg_impression ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td>Kesan Spirometri</td>
            <td>{{ $resume->spirometry_impression ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td>Kesan Refraksi</td>
            <td>{{ $resume->refreaction_impression ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td>Kesan Laboratorium</td>
            <td>{{ $resume->laboratory_impression ?? 'N/A' }}</td>
        </tr>
    </tbody>
</table>
<br>
<table class="identity-header">
    <tbody>
        <tr>
            <td>Kesimpulan</td>
            <td>{{ $resume->result_conclusion ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td>Saran</td>
            <td>{{ $resume->suggestion ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td>Pemeriksa</td>
            <td>{{ $resume->doctor_id ?? 'N/A' }}</td>
        </tr>
    </tbody>
</table>
