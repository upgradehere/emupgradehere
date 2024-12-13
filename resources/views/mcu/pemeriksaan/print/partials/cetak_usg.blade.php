<h4>Usg</h4>
<table class="identity-header">
    <tbody>
        <tr>
            <td>
            	<table>
		            <tr>
		                <td>Hepar</td>
		                <td>{{ $usg->liver ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>Kantong Empedu</td>
		                <td>{{ $usg->gallbladder ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>Pankreas</td>
		                <td>{{ $usg->pancreas ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>Lien</td>
		                <td>{{ $usg->lien ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>Ginjal</td>
		                <td>{{ $usg->kidney ?? 'N/A' }}</td>
		            </tr>
		        </table>
            </td>
            <td>
            	 <table>
		            <tr>
		                <td>Buli Buli</td>
		                <td>{{ $usg->bladder ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>Prostat/Uterus</td>
		                <td>{{ $usg->prostat ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>Kesan</td>
		                <td>{{ $usg->classification ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>Kesimpulan</td>
		                <td>{{ $usg->suggestion ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>Pemeriksa</td>
		                <td>{{ $usg->doctor_id ?? 'N/A' }}</td>
		            </tr>
		        </table>
            </td>
        </tr>
    </tbody>
</table>
