<div class="no-break">
	<h4>RONTGEN</h4>
	<table style="width: 100%; border-collapse: collapse; border-spacing: 0px 10px; font-size: 13px;" cellpadding="3">
	    <tbody>
	    	<tr>
	    		<th colspan="2" align="left" style="border-bottom: 2px solid black; font-size: 15px;"> Gambar Hasil Radiologi </th>
	    	</tr>
	    	<tr style="padding-bottom: 50px;">
	    		<td colspan="2"> {{ '-' }} <br><br></td>
	    	</tr>
	    	<tr>
	    		<th colspan="3" align="left" style="border-bottom: 2px solid black; font-size: 15px;"> Hasil Radiologi </th>
	    	</tr>
	        <tr>
	            <td style="width: 50%; vertical-align: top;">
	            	<table cellpadding="3" style="width: 100%;">
				        <tr>
				            <td width="40%"><b>Diagnosa Klinis</b></td>
				            <td>:</td>
				            <td width="60%" align="left">{{ $rontgen->clinical_diagnosis ?? 'N/A' }}</td>
				        </tr>
				        <tr>
				            <td width="40%"><b>Cor</b></td>
				            <td>:</td>
				            <td width="60%" align="left">{{ $rontgen->cor ?? 'N/A' }}</td>
				        </tr>
				        <tr>
				            <td width="40%"><b>Pulmo</b></td>
				            <td>:</td>
				            <td width="60%" align="left">{{ $rontgen->pulmo ?? 'N/A' }}</td>
				        </tr>
				        <tr>
				            <td width="40%"><b>Oss Costae</b></td>
				            <td>:</td>
				            <td width="60%" align="left">{{ $rontgen->oss_costae ?? 'N/A' }}</td>
				        </tr>
				    </table>
	            </td>
	            <td style="width: 50%; vertical-align: top;">
	            	<table cellpadding="3" style="width: 100%;">
			            <tr>
			                <td width="40%"><b>Sinus Diafragma</b></td>
			                <td>:</td>
			                <td width="60%" align="left">{{ $rontgen->diaphragmatic_sinus ?? 'N/A' }}</td>
			            </tr>
			            <tr>
			                <td width="40%"><b>Kesimpulan</b></td>
			                <td>:</td>
			                <td width="60%" align="left">{{ $rontgen->conclusion ?? 'N/A' }}</td>
			            </tr>
			            <tr>
			                <td width="40%"><b>Status Pemeriksaan</b></td>
			                <td>:</td>
			                <td width="60%" align="left">{{ $rontgen->examination_status ?? 'N/A' }}</td>
			            </tr>
			            <tr>
			                <td width="40%"><b>Pemeriksa</b></td>
			                <td>:</td>
			                <td width="60%" align="left">{{ $rontgen->doctor_id ?? 'N/A' }}</td>
			            </tr>
			            <tr>
			                <td width="40%"><b>Catatan</b></td>
			                <td>:</td>
			                <td width="60%" align="left">{{ $rontgen->notes ?? 'N/A' }}</td>
			            </tr>
			        </table>
	            </td>
	        </tr>
	    </tbody>
	</table>
</div>
