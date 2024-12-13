<h4>Spirometri</h4>
<table class="identity-header">
    <tbody>
        <tr>
            <td>
            	<table>
		            <tr>
		                <td>Nilai Prediksi</td>
		                <td>{{ $spirometri->prediction_value ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>KVP</td>
		                <td>{{ $spirometri->kvp ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>Percentage KVP</td>
		                <td>{{ $spirometri->kvp_percentage ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>VEP</td>
		                <td>{{ $spirometri->vep ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>Percentage VEP</td>
		                <td>{{ $spirometri->vep_percetage ?? 'N/A' }}</td>
		            </tr>
		        </table>
            </td>
            <td>
            	 <table>
		            <tr>
		                <td>APE</td>
		                <td>{{ $spirometri->ape ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>Total APE</td>
		                <td>{{ $spirometri->ape_total ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>Kesan</td>
		                <td>{{ $spirometri->classification ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>Kesimpulan</td>
		                <td>{{ $spirometri->conclusion ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>Pemeriksa</td>
		                <td>{{ $spirometri->doctor_id ?? 'N/A' }}</td>
		            </tr>
		        </table>
            </td>
        </tr>
    </tbody>
</table>
