<div class="no-break">
	<h4>Spirometri</h4>
	<table style="width: 100%; border-collapse: collapse; border-spacing: 0px 10px; font-size: 13px;" cellpadding="3">
	    <tbody>
	    	<tr>
	    		<th colspan="2" align="left" style="border-bottom: 2px solid black; font-size: 15px;"> Gambar Hasil Audiometri </th>
	    	</tr>
	    	<tr style="padding-bottom: 50px;">
	    		<td colspan="2"> {{ '-' }} <br><br></td>
	    	</tr>
	    	<tr>
	    		<th colspan="2" align="left" style="border-bottom: 2px solid black; font-size: 15px;"> Spirometri </th>
	    	</tr>
	        <tr>
	            <td style="width: 50%; vertical-align: top;">
	            	<table cellpadding="3" style="width: 100%;">
			            <tr>
			                <td align="left" width="35%"><b>Nilai Prediksi</b></td>
			                <td align="right">:</td>
			                <td width="65%" align="right">{{ $spirometri->prediction_value ?? 'N/A' }} mL</td>
			            </tr>
			            <tr>
			                <td align="left" width="35%"><b>KVP</b></td>
			                <td align="right">:</td>
			                <td width="65%" align="right">{{ $spirometri->kvp ?? 'N/A' }} mL</td>
			            </tr>
			            <tr>
			                <td align="left" width="35%"><b>Percentage KVP</b></td>
			                <td align="right">:</td>
			                <td width="65%" align="right">{{ $spirometri->kvp_percentage ?? 'N/A' }} %</td>
			            </tr>
			            <tr>
			                <td align="left" width="35%"><b>VEP</b></td>
			                <td align="right">:</td>
			                <td width="65%" align="right">{{ $spirometri->vep ?? 'N/A' }} mL</td>
			            </tr>
			            <tr>
			                <td align="left" width="35%"><b>Percentage VEP</b></td>
			                <td align="right">:</td>
			                <td width="65%" align="right">{{ $spirometri->vep_percetage ?? 'N/A' }} %</td>
			            </tr>
			        </table>
	            </td>
	            <td style="width: 50%; vertical-align: top;">
	            	<table cellpadding="3" style="width: 100%;">
			            <tr>
			                <td align="left" width="35%"><b>APE</b></td>
			                <td align="right">:</td>
			                <td width="65%" align="right">{{ $spirometri->ape ?? 'N/A' }} L</td>
			            </tr>
			            <tr>
			                <td align="left" width="35%"><b>Total APE</b></td>
			                <td align="right">:</td>
			                <td width="65%" align="right">{{ $spirometri->ape_total ?? 'N/A' }} L/min </td>
			            </tr>
			            <tr>
			                <td align="left" width="35%"><b>Kesan</b></td>
			                <td align="right">:</td>
			                <td width="65%" align="right">{{ $spirometri->classification ?? 'N/A' }}</td>
			            </tr>
			            <tr>
			                <td align="left" width="35%"><b>Kesimpulan</b></td>
			                <td align="right">:</td>
			                <td width="65%" align="right">{{ $spirometri->conclusion ?? 'N/A' }}</td>
			            </tr>
			            <tr>
			                <td align="left" width="35%"><b>Pemeriksa</b></td>
			                <td align="right">:</td>
			                <td width="65%" align="right">{{ $spirometri->doctor_id ?? 'N/A' }}</td>
			            </tr>
			        </table>
	            </td>
	        </tr>
	    </tbody>
	</table>
</div>
