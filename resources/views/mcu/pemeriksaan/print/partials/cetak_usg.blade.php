@if (!empty($usg))
@include('mcu.pemeriksaan.print.partials.header', ['title_header' => 'PEMERIKSAAN USG'])
@endif

<div class="no-break">
	<table style="width: 100%; border-collapse: collapse; font-size: 13px;" cellpadding="3">
	    <tbody>
	        <tr>
	            <th colspan="2" scope="col" align="left" style="border-bottom: 2px solid black; font-size: 15px;">Hasil USG</th>
	        </tr>
	        <tr>
	            <td>
	                <table cellpadding="3" style="width: 100%;">
	                    <tr>
	                        <td align="left" width="20%"><b>Hepar</b></td>
	                        <td>:</td>
	                        <td align="left" width="80%">{{ $usg->liver ?? '' }}</td>
	                    </tr>
	                    <tr>
	                        <td align="left" width="20%"><b>Kantong Empedu</b></td>
	                        <td>:</td>
	                        <td align="left" width="80%">{{ $usg->gallbladder ?? '' }}</td>
	                    </tr>
	                    <tr>
	                        <td align="left" width="20%"><b>Pankreas</b></td>
	                        <td>:</td>
	                        <td align="left" width="80%">{{ $usg->pancreas ?? '' }}</td>
	                    </tr>
	                    <tr>
	                        <td align="left" width="20%"><b>Lien</b></td>
	                        <td>:</td>
	                        <td align="left" width="80%">{{ $usg->lien ?? '' }}</td>
	                    </tr>
	                    <tr>
	                        <td align="left" width="20%"><b>Ginjal</b></td>
	                        <td>:</td>
	                        <td align="left" width="80%">{{ $usg->kidney ?? '' }}</td>
	                    </tr>
	                </table>
	            </td>
	            <td>
	                <table cellpadding="3" style="width: 100%;">
	                    <tr>
	                        <td align="left" width="20%"><b>Buli Buli</b></td>
	                        <td>:</td>
	                        <td align="left" width="80%">{{ $usg->bladder ?? '' }}</td>
	                    </tr>
	                    <tr>
	                        <td align="left" width="20%"><b>Prostat/Uterus</b></td>
	                        <td>:</td>
	                        <td align="left" width="80%">{{ $usg->prostat ?? '' }}</td>
	                    </tr>
	                    <tr>
	                        <td align="left" width="20%"><b>Kesan</b></td>
	                        <td>:</td>
	                        <td align="left" width="80%">{{ $usg->classification ?? '' }}</td>
	                    </tr>
	                    <tr>
	                        <td align="left" width="20%"><b>Kesimpulan</b></td>
	                        <td>:</td>
	                        <td align="left" width="80%">{{ $usg->suggestion ?? '' }}</td>
	                    </tr>
	                    <tr>
	                        <td align="left" width="20%"><b>Pemeriksa</b></td>
	                        <td>:</td>
	                        <td align="left" width="80%">{{ $doctor_list[$usg->doctor_id] ?? '' }}</td>
	                    </tr>
	                </table>
	            </td>
	        </tr>
	    </tbody>
	</table>
</div>
@if(isset($doctor_sign[$usg->doctor_id]))
<div style="padding-top: 50px;">
    <table style="width: 100%; font-size: 13px;" cellpadding="3">
         <tr>
            <td style="width: 60%; text-align: center; vertical-align: bottom;">
            </td>
            <td style="width: 40%; text-align: center; vertical-align: bottom;">
                <img src="{{ public_path('uploads/doctor_sign/'.$doctor_sign[$usg->doctor_id]) }}" style="max-width: 150px;"><br>
                <b>{{ $doctor_list[$usg->doctor_id] ?? '' }} </b>
                <p style="border-top: 1px solid black; padding-top: 10px;"></p>
            </td>
        </tr>
    </table>
</div>
@endif
@if(!empty($usg->image_file))
<div class="page-break"></div>
<div style="text-align: center; padding-top: 20px;">
    <img src="{{ public_path('uploads/usg/'.$usg->image_file) }}" style="max-width: 710px; max-height: 600px;">
</div>
@endif
