@if (!empty($rontgen))
@include('mcu.pemeriksaan.print.partials.header', ['title_header' => 'PEMERIKSAAN RONTGEN'])
@endif

@if (!$rontgen->is_import)
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
				                <td width="60%" align="left">{{ $rontgen->doctor_id ?? '' }}</td>
				            </tr>
				            <tr>
				                <td width="40%"><b>Catatan</b></td>
				                <td>:</td>
				                <td width="60%" align="left">{{ $doctor_list[$rontgen->doctor_id] ?? '' }}</td>
				            </tr>
				        </table>
		            </td>
		        </tr>
		    </tbody>
		</table>
	</div>
	<div class="page-break"></div>
@endif

@if(!empty($rontgen->image_file))
<div style="text-align: center; padding-top: 20px;">
	<img src="{{ public_path('uploads/rontgen/'.$rontgen->image_file) }}" style="max-width: 710px; max-height: 600px;">
</div>
@endif
