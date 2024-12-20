@if (!empty($spirometri))
@include('mcu.pemeriksaan.print.partials.header', ['title_header' => 'PEMERIKSAAN SPIROMETRI'])
@endif

@if (isset($spirometri->is_import) && !$spirometri->is_import)
	<div class="no-break">
		<table style="width: 100%; border-collapse: collapse; border-spacing: 0px 10px; font-size: 13px;" cellpadding="3">
		    <tbody>
		    	<tr>
		    		<th colspan="2" align="left" style="border-bottom: 2px solid black; font-size: 15px;"> Spirometri </th>
		    	</tr>
		        <tr>
		            <td style="width: 50%; vertical-align: top;">
		            	<table cellpadding="3" style="width: 100%;">
				            <tr>
				                <td align="left" width="35%"><b>Nilai Prediksi</b></td>
				                <td align="right">:</td>
				                <td width="65%" align="left">{{ $spirometri->prediction_value ?? '' }} mL</td>
				            </tr>
				            <tr>
				                <td align="left" width="35%"><b>KVP</b></td>
				                <td align="right">:</td>
				                <td width="65%" align="left">{{ $spirometri->kvp ?? '' }} mL</td>
				            </tr>
				            <tr>
				                <td align="left" width="35%"><b>Percentage KVP</b></td>
				                <td align="right">:</td>
				                <td width="65%" align="left">{{ $spirometri->kvp_percentage ?? '' }} %</td>
				            </tr>
				            <tr>
				                <td align="left" width="35%"><b>VEP</b></td>
				                <td align="right">:</td>
				                <td width="65%" align="left">{{ $spirometri->vep ?? '' }} mL</td>
				            </tr>
				            <tr>
				                <td align="left" width="35%"><b>Percentage VEP</b></td>
				                <td align="right">:</td>
				                <td width="65%" align="left">{{ $spirometri->vep_percetage ?? '' }} %</td>
				            </tr>
				        </table>
		            </td>
		            <td style="width: 50%; vertical-align: top;">
		            	<table cellpadding="3" style="width: 100%;">
				            <tr>
				                <td align="left" width="35%"><b>APE</b></td>
				                <td align="right">:</td>
				                <td width="65%" align="left">{{ $spirometri->ape ?? '' }} L</td>
				            </tr>
				            <tr>
				                <td align="left" width="35%"><b>Total APE</b></td>
				                <td align="right">:</td>
				                <td width="65%" align="left">{{ $spirometri->ape_total ?? '' }} L/min </td>
				            </tr>
				            <tr>
				                <td align="left" width="35%"><b>Kesan</b></td>
				                <td align="right">:</td>
				                <td width="65%" align="left">{{ $spirometri->classification ?? '' }}</td>
				            </tr>
				            <tr>
				                <td align="left" width="35%"><b>Kesimpulan</b></td>
				                <td align="right">:</td>
				                <td width="65%" align="left">{{ $spirometri->conclusion ?? '' }}</td>
				            </tr>
				            <tr>
				                <td align="left" width="35%"><b>Pemeriksa</b></td>
				                <td align="right">:</td>
				                <td width="65%" align="left">{{ $doctor_list[$spirometri->doctor_id] ?? '' }}</td>
				            </tr>
				        </table>
		            </td>
		        </tr>
		    </tbody>
		</table>
	</div>
	@if(isset($doctor_sign[$refraksi->doctor_id]))
	<div style="padding-top: 50px;">
	    <table style="width: 100%; font-size: 13px;" cellpadding="3">
	         <tr>
	            <td style="width: 60%; text-align: center; vertical-align: bottom;">
	            </td>
	            <td style="width: 40%; text-align: center; vertical-align: bottom;">
	                <img src="{{ public_path('uploads/doctor_sign/'.$doctor_sign[$refraksi->doctor_id]) }}" style="max-width: 150px;"><br>
	                <b>{{ $doctor_list[$refraksi->doctor_id] ?? '' }} </b>
	                <p style="border-top: 1px solid black; padding-top: 10px;"></p>
	            </td>
	        </tr>
	    </table>
	</div>
	@endif
@endif

@if((isset($spirometri->is_import) && !$spirometri->is_import) && !empty($spirometri->image_file))
    <div class="page-break"></div>
@endif

@if(!empty($spirometri->image_file))
    @foreach (json_decode($spirometri->image_file,true) as $key => $image_file)
        <div style="text-align: center; padding-top: 20px;">
            <img src="{{ public_path('uploads/spirometry/'.$image_file) }}" style="max-width: 710px; max-height: 600px;">
        </div>
        @if(count(json_decode($spirometri->image_file,true)) == $key)
                <div class="page-break"></div>
        @endif
    @endforeach
@endif
