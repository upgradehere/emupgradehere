@if (!empty($ekg))
@include('mcu.pemeriksaan.print.partials.header', ['title_header' => 'PEMERIKSAAN EKG'])
@endif

@if (isset($ekg->is_import) && !$ekg->is_import)
	<div class="no-break">
		<table style="width: 100%; border-collapse: collapse; border-spacing: 0px 10px; font-size: 13px;" cellpadding="3">
		    <tbody>
		    	<tr>
		    		<th colspan="2" align="left" style="border-bottom: 2px solid black; font-size: 15px;"> Hasil EKG </th>
		    	</tr>
		        <tr>
		            <td>
		            	<table cellpadding="3" style="width: 100%;">
				            <tr>
				                <td align="left" width="20%"><b>Irama</b></td>
				                <td>:</td>
				                <td align="left" width="80%">{{ $ekg->rhythm ?? '' }}</td>
				            </tr>
				            <tr>
				                <td align="left" width="20%"><b>Rate</b></td>
				                <td>:</td>
				                <td align="left" width="80%">{{ $ekg->rate ?? '' }}</td>
				            </tr>
				            <tr>
				                <td align="left" width="20%"><b>Axis</b></td>
				                <td>:</td>
				                <td align="left" width="80%">{{ $ekg->axis ?? '' }}</td>
				            </tr>
				            <tr>
				                <td align="left" width="20%"><b>Kelainan</b></td>
				                <td>:</td>
				                <td align="left" width="80%">{{ $ekg->abnormality ?? '' }}</td>
				            </tr>
				        </table>
		            </td>
		            <td>
		            	<table cellpadding="3" style="width: 100%;">
				            <tr>
				                <td align="left" width="20%"><b>Kesimpulan</b></td>
				                <td>:</td>
				                <td align="left" width="80%">{{ $ekg->conclusion ?? '' }}</td>
				            </tr>
				            <tr>
				                <td align="left" width="20%"><b>Saran</b></td>
				                <td>:</td>
				                <td align="left" width="80%">{{ $ekg->suggestion ?? '' }}</td>
				            </tr>
				            <tr>
				                <td align="left" width="20%"><b>Abnormal</b></td>
				                <td>:</td>
				                <td align="left" width="80%">{{ $ekg->is_abnormal == 1 ? "Abnormal" : Normal }}</td>
				            </tr>
				            <tr>
				                <td align="left" width="20%"><b>Pemeriksa</b></td>
				                <td>:</td>
				                <td align="left" width="80%">{{ $doctor_list[$ekg->doctor_id] ?? '' }}</td>
				            </tr>
				        </table>
		            </td>
		        </tr>
		    </tbody>
		</table>
	</div>
	@if(isset($doctor_sign[$ekg->doctor_id]))
	<div style="padding-top: 50px;">
	    <table style="width: 100%; font-size: 13px;" cellpadding="3">
	         <tr>
	            <td style="width: 60%; text-align: center; vertical-align: bottom;">
	            </td>
	            <td style="width: 40%; text-align: center; vertical-align: bottom;">
	                <img src="{{ public_path('uploads/doctor_sign/'.$doctor_sign[$ekg->doctor_id]) }}" style="max-width: 150px;"><br>
	                <b>{{ $doctor_list[$ekg->doctor_id] ?? '' }} </b>
	                <p style="border-top: 1px solid black; padding-top: 10px;"></p>
	            </td>
	        </tr>
	    </table>
	</div>
	@endif
@endif

@if((isset($ekg->is_import) && !$ekg->is_import) && !empty($ekg->image_file))
    <div class="page-break"></div>
@endif

@if(!empty($ekg->image_file))
<div style="text-align: center; padding-top: 20px;">
    <img src="{{ public_path('uploads/ekg/'.$ekg->image_file) }}" style="max-width: 710px; max-height: 600px;">
</div>
@endif
