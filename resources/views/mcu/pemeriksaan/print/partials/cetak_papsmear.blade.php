@if (!empty($papsmear))
@include('mcu.pemeriksaan.print.partials.header', ['title_header' => 'PEMERIKSAAN PAPSMEAR'])
@endif

<div class="no-break">
    <table style="width: 100%; border-collapse: collapse; font-size: 13px;" cellpadding="3">
        <tbody>
            <tr>
                <th colspan="3" align="left" style="border-bottom: 2px solid black; font-size: 15px;">Papsmear</th>
            </tr>
            <tr>
                <td width="25%"><b>Kesimpulan</b></td>
                <td>:</td>
                <td width="75%">{{ $papsmear->conclusion ?? '' }}</td>
            </tr>
            <tr>
                <td width="25%"><b>Kesan</b></td>
                <td>:</td>
                <td width="75%">{{ $papsmear->classification ?? '' }}</td>
            </tr>
            <tr>
                <td width="25%"><b>Spesimen</b></td>
                <td>:</td>
                <td width="75%">{{ $papsmear->speciment ?? '' }}</td>
            </tr>
            <tr>
                <td width="25%"><b>Keterangan Klinis</b></td>
                <td>:</td>
                <td width="75%">{{ $papsmear->clinical_description ?? '' }}</td>
            </tr>
            <tr>
                <td width="25%"><b>Kategori Umum/Rincian</b></td>
                <td>:</td>
                <td width="75%">{{ $papsmear->general_category ?? '' }}</td>
            </tr>
            <tr>
                <td width="25%"><b>Anjuran</b></td>
                <td>:</td>
                <td width="75%">{{ $papsmear->recommendations ?? '' }}</td>
            </tr>
            <tr>
                <td width="25%"><b>Normal / Abnormal</b></td>
                <td>:</td>
                <td width="75%">{{ $papsmear->is_abnormal == 0 ? 'Normal' : 'Abnormal' }}</td>
            </tr>
            <tr>
                <td width="25%"><b>Pemeriksa</b></td>
                <td>:</td>
                <td width="75%">{{ $doctor_list[$papsmear->doctor_id] ?? '' }}</td>
            </tr>
        </tbody>
    </table>
</div>
@if(isset($doctor_sign[$papsmear->doctor_id]))
<div style="padding-top: 50px;">
    <table style="width: 100%; font-size: 13px;" cellpadding="3">
         <tr>
            <td style="width: 60%; text-align: center; vertical-align: bottom;">
            </td>
            <td style="width: 40%; text-align: center; vertical-align: bottom;">
                <img src="{{ public_path('uploads/doctor_sign/'.$doctor_sign[$papsmear->doctor_id]) }}" style="max-width: 150px;"><br>
                <b>{{ $doctor_list[$papsmear->doctor_id] ?? '' }} </b>
                <p style="border-top: 1px solid black; padding-top: 10px;"></p>
            </td>
        </tr>
    </table>
</div>
@endif