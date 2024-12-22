@if (isset($rontgen->is_import) && !$rontgen->is_import)
	@if (!empty($rontgen))
	@include('mcu.pemeriksaan.print.partials.header', ['title_header' => 'PEMERIKSAAN RONTGEN'])
	@endif
	<div class="no-break">
		<h4>RONTGEN</h4>
		<table style="width: 100%; border-collapse: collapse; border-spacing: 0px 10px; font-size: 13px;" cellpadding="3">
		    <tbody>
		    	<tr>
		    		<th colspan="3" align="left" style="border-bottom: 2px solid black; font-size: 15px;"> Hasil Radiologi </th>
		    	</tr>
		        <tr>
		            <td style="width: 50%; vertical-align: top;">
		            	<table cellpadding="3" style="width: 100%;">
					        <tr>
					            <td width="40%"><b>Diagnosa Klinis</b></td>
					            <td>:</td>
					            <td width="60%" align="left">{{ $rontgen->clinical_diagnosis ?? '' }}</td>
					        </tr>
					        <tr>
					            <td width="40%"><b>Cor</b></td>
					            <td>:</td>
					            <td width="60%" align="left">{{ $rontgen->cor ?? '' }}</td>
					        </tr>
					        <tr>
					            <td width="40%"><b>Pulmo</b></td>
					            <td>:</td>
					            <td width="60%" align="left">{{ $rontgen->pulmo ?? '' }}</td>
					        </tr>
					        <tr>
					            <td width="40%"><b>Oss Costae</b></td>
					            <td>:</td>
					            <td width="60%" align="left">{{ $rontgen->oss_costae ?? '' }}</td>
					        </tr>
					    </table>
		            </td>
		            <td style="width: 50%; vertical-align: top;">
		            	<table cellpadding="3" style="width: 100%;">
				            <tr>
				                <td width="40%"><b>Sinus Diafragma</b></td>
				                <td>:</td>
				                <td width="60%" align="left">{{ $rontgen->diaphragmatic_sinus ?? '' }}</td>
				            </tr>
				            <tr>
				                <td width="40%"><b>Kesimpulan</b></td>
				                <td>:</td>
				                <td width="60%" align="left">{{ $rontgen->conclusion ?? '' }}</td>
				            </tr>
				            <tr>
				                <td width="40%"><b>Status Pemeriksaan</b></td>
				                <td>:</td>
				                <td width="60%" align="left">{{ $rontgen->examination_status ?? '' }}</td>
				            </tr>
				            <tr>
				                <td width="40%"><b>Pemeriksa</b></td>
				                <td>:</td>
				                <td width="60%" align="left">{{ $doctor_list[$rontgen->doctor_id] ?? '' }}</td>
				            </tr>
				            <tr>
				                <td width="40%"><b>Catatan</b></td>
				                <td>:</td>
				                <td width="60%" align="left">{{ $rontgen->notes ?? '' }}</td>
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

@if((isset($rontgen->is_import) && !$rontgen->is_import) && !empty($rontgen->image_file))
    <div class="page-break"></div>
@endif

@if(!empty($rontgen->image_file))
    @foreach (json_decode($rontgen->image_file,true) as $key => $image_file)
		<div style="text-align: center; padding-top: 20px;">
			<img src="{{ public_path('uploads/rontgen/'.$image_file) }}" style="max-width: 710px; max-height: 600px;">
		</div>
		@if(count(json_decode($rontgen->image_file,true)) == $key)
				<div class="page-break"></div>
		@endif
    @endforeach
@endif
