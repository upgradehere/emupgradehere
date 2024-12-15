@if (!empty($anamnesis))
@include('mcu.pemeriksaan.print.partials.header', ['title_header' => 'PEMERIKSAAN FISIK REFRAKSI'])
@endif

@if(!empty($refraksi->image_file))
<div style="text-align: center; padding-top: 20px;">
	<img src="{{ public_path('uploads/refraction/'.$refraksi->image_file) }}" style="max-width: 710px; max-height: 600px;">
</div>
<div class="page-break"></div>
@endif

<div class="no-break">
	<table style="width: 100%; border-collapse: collapse; border-spacing: 0px 10px; font-size: 13px;" cellpadding="3">
	    <tbody>
	    	<tr>
	    		<th colspan="2" align="left" style="border-bottom: 2px solid black; font-size: 15px;"> Ukuran Kacamata </th>
	    	</tr>
	        <tr>
	            <td>
	            	<table cellpadding="3" style="width: 100%;">
				        <tr>
				            <td width="80%"><b>Spheris Kiri</b></td>
				            <td>:</td>
				            <td width="20%" align="left">{{ $refraksi->left_spherical }}</td>
				        </tr>
				        <tr>
				            <td width="80%"><b>Cylinder Kiri</b></td>
				            <td>:</td>
				            <td width="20%" align="left">{{ $refraksi->left_cylinder }}</td>
				        </tr>
				        <tr>
				            <td width="80%"><b>Axis Kiri</b></td>
				            <td>:</td>
				            <td width="20%" align="left">{{ $refraksi->left_axis }}</td>
				        </tr>
				        <tr>
				            <td width="80%"><b>ADD Kiri</b></td>
				            <td>:</td>
				            <td width="20%" align="left">{{ $refraksi->left_add }}</td>
				        </tr>
				        <tr>
				            <td width="80%"><b>PD Kiri</b></td>
				            <td>:</td>
				            <td width="20%" align="left">{{ $refraksi->left_pd }}</td>
				        </tr>
				        <tr>
				            <td width="80%"><b>Visus Tanpa Koreksi, OD Kiri</b></td>
				            <td>:</td>
				            <td width="20%" align="left">{{ $refraksi->uncorrected_vision_left_od }}</td>
				        </tr>
				        <tr>
				            <td width="80%"><b>Visus Tanpa Koreksi, OS Kiri</b></td>
				            <td>:</td>
				            <td width="20%" align="left">{{ $refraksi->uncorrected_vision_left_os }}</td>
				        </tr>
				    </table>
	            </td>
	            <td>
		            <table cellpadding="3" style="width: 100%;">
				        <tr>
				            <td width="80%"><b>Spheris Kanan</b></td>
				            <td>:</td>
				            <td width="20%" align="left">{{ $refraksi->right_spherical }}</td>
				        </tr>
				        <tr>
				            <td width="80%"><b>Cylinder Kanan</b></td>
				            <td>:</td>
				            <td width="20%" align="left">{{ $refraksi->right_cylinder }}</td>
				        </tr>
				        <tr>
				            <td width="80%"><b>Axis Kanan</b></td>
				            <td>:</td>
				            <td width="20%" align="left">{{ $refraksi->right_axis }}</td>
				        </tr>
				        <tr>
				            <td width="80%"><b>ADD Kanan</b></td>
				            <td>:</td>
				            <td width="20%" align="left">{{ $refraksi->right_add }}</td>
				        </tr>
				        <tr>
				            <td width="80%"><b>PD Kanan</b></td>
				            <td>:</td>
				            <td width="20%" align="left">{{ $refraksi->right_pd }}</td>
				        </tr>
				        <tr>
				            <td width="80%"><b>Visus Tanpa Koreksi, OD Kanan</b></td>
				            <td>:</td>
				            <td width="20%" align="left">{{ $refraksi->uncorrected_vision_right_od }}</td>
				        </tr>
				        <tr>
				            <td width="80%"><b>Visus Tanpa Koreksi, OS Kanan</b></td>
				            <td>:</td>
				            <td width="20%" align="left">{{ $refraksi->uncorrected_vision_right_os }}</td>
				        </tr>
				    </table>		
	            </td>
	        </tr>
	        <tr>
	    		<th colspan="2" align="left" style="border-bottom: 2px solid black; font-size: 15px;"> Catatan </th>
	    	</tr>
	    	<tr style="padding-top: 50px;">
	    		<td colspan="2">
	    			<table cellpadding="3" style="width: 100%;">
				        <tr>
				            <td width="20%"><b>Terapi Hasil Refraksi</b></td>
				            <td>:</td>
				            <td width="80%" align="left">{{ $refraksi->refraction_therapy_result }}</td>
				        </tr>
				        <tr>
				            <td width="20%"><b>Kesimpulan & Saran</b></td>
				            <td>:</td>
				            <td width="80%" align="left">{{ $refraksi->conclusion }}</td>
				        </tr>
				        <tr>
				            <td width="20%"><b>Catatan</b></td>
				            <td>:</td>
				            <td width="80%" align="left">{{ $refraksi->Catatan }}</td>
				        </tr>
				        <tr>
				            <td width="20%"><b>Pemeriksa</b></td>
				            <td>:</td>
				            <td width="80%" align="left">{{ $doctor_list[$refraksi->doctor_id] ?? '' }}</td>
				        </tr>
				    </table>
	    		</td>
	    	</tr>
	    </tbody>
	</table>
</div>
