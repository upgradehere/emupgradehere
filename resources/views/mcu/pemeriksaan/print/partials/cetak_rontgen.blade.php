<h4>Rontgen</h4>
<table class="identity-header">
    <tbody>
        <tr>
            <td>
            	<table>
			        <tr>
			            <td>Diagnosa Klinis</td>
			            <td>{{ $rontgen->clinical_diagnosis ?? 'N/A' }}</td>
			        </tr>
			        <tr>
			            <td>Cor</td>
			            <td>{{ $rontgen->cor ?? 'N/A' }}</td>
			        </tr>
			        <tr>
			            <td>Pulmo</td>
			            <td>{{ $rontgen->pulmo ?? 'N/A' }}</td>
			        </tr>
			        <tr>
			            <td>Oss Costae</td>
			            <td>{{ $rontgen->oss_costae ?? 'N/A' }}</td>
			        </tr>
			    </table>
            </td>
            <td>
            	 <table>
		            <tr>
		                <td>Sinus Diafragma</td>
		                <td>{{ $rontgen->diaphragmatic_sinus ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>Kesimpulan</td>
		                <td>{{ $rontgen->conclusion ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>Status Pemeriksaan</td>
		                <td>{{ $rontgen->examination_status ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>Pemeriksa</td>
		                <td>{{ $rontgen->doctor_id ?? 'N/A' }}</td>
		            </tr>
		            <tr>
		                <td>Catatan</td>
		                <td>{{ $rontgen->notes ?? 'N/A' }}</td>
		            </tr>
		        </table>
            </td>
        </tr>
    </tbody>
</table>
