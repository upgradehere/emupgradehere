<div class="no-break">
	<h4>EKG</h4>
	<table style="width: 100%; border-collapse: collapse; border-spacing: 0px 10px; font-size: 13px;" cellpadding="3">
	    <tbody>
	    	<tr>
	    		<th colspan="2" align="left" style="border-bottom: 2px solid black; font-size: 15px;"> Hasil Gambar EKG </th>
	    	</tr>
	    	<tr style="padding-bottom: 50px;">
	    		<td colspan="2"> {{ '-' }} <br><br></td>
	    	</tr>
	    	<tr>
	    		<th colspan="2" align="left" style="border-bottom: 2px solid black; font-size: 15px;"> Hasil EKG </th>
	    	</tr>
	        <tr>
	            <td>
	            	<table cellpadding="3" style="width: 100%;">
			            <tr>
			                <td align="left" width="20%"><b>Irama</b></td>
			                <td>:</td>
			                <td align="left" width="80%">{{ $ekg->rhythm ?? 'N/A' }}</td>
			            </tr>
			            <tr>
			                <td align="left" width="20%"><b>Rate</b></td>
			                <td>:</td>
			                <td align="left" width="80%">{{ $ekg->rate ?? 'N/A' }}</td>
			            </tr>
			            <tr>
			                <td align="left" width="20%"><b>Axis</b></td>
			                <td>:</td>
			                <td align="left" width="80%">{{ $ekg->axis ?? 'N/A' }}</td>
			            </tr>
			            <tr>
			                <td align="left" width="20%"><b>Kelainan</b></td>
			                <td>:</td>
			                <td align="left" width="80%">{{ $ekg->abnormality ?? 'N/A' }}</td>
			            </tr>
			        </table>
	            </td>
	            <td>
	            	<table cellpadding="3" style="width: 100%;">
			            <tr>
			                <td align="left" width="20%"><b>Kesimpulan</b></td>
			                <td>:</td>
			                <td align="left" width="80%">{{ $ekg->conclusion ?? 'N/A' }}</td>
			            </tr>
			            <tr>
			                <td align="left" width="20%"><b>Saran</b></td>
			                <td>:</td>
			                <td align="left" width="80%">{{ $ekg->suggestion ?? 'N/A' }}</td>
			            </tr>
			            <tr>
			                <td align="left" width="20%"><b>Abnormal</b></td>
			                <td>:</td>
			                <td align="left" width="80%">{{ $ekg->is_abnormal ? 'Yes' : 'No' }}</td>
			            </tr>
			            <tr>
			                <td align="left" width="20%"><b>Pemeriksa</b></td>
			                <td>:</td>
			                <td align="left" width="80%">{{ $ekg->doctor_id ?? 'N/A' }}</td>
			            </tr>
			        </table>
	            </td>
	        </tr>
	    </tbody>
	</table>
</div>
