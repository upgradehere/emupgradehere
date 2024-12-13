<h4>Papsmear</h4>
<table class="identity-header">
    <tbody>
        <tr>
            <td>Kesimpulan</td>
            <td>{{ $papsmear->conclusion ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td>Kesan</td>
            <td>{{ $papsmear->classification ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td>Spesimen</td>
            <td>{{ $papsmear->speciment ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td>Keterangan Klinis</td>
            <td>{{ $papsmear->clinical_description ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td>Kategori Umum/Rincian</td>
            <td>{{ $papsmear->general_category ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td>Anjuran</td>
            <td>{{ $papsmear->recommendations ?? 'N/A' }}</td>
        </tr>
    </tbody>
</table>