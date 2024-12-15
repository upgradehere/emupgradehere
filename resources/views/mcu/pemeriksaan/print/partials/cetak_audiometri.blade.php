@if (!empty($audiometri))
@include('mcu.pemeriksaan.print.partials.header', ['title_header' => 'PEMERIKSAAN AUDIOMETRI'])
@endif

@if (!$audiometri->is_import)
    <table style="padding-top: 20px; border: 1px solid black; width: 100%; border-collapse: collapse; font-size: 10px;" cellpadding="3">
        <thead>
            <tr>
                <th  style="border: 1px solid black;"></th>
                <th  style="border: 1px solid black;" colspan="{{ count($audiometri['right_air_conduction']) }}">RIGHT EAR</th>
                <th  style="border: 1px solid black;" colspan="{{ count($audiometri['left_air_conduction']) }}">LEFT EAR</th>
            </tr>
            <tr>
                <th  style="border: 1px solid black;"></th>
                 @foreach ($audiometri['right_air_conduction'] as $right_key => $right)
                    <th  style="border: 1px solid black;">{{ str_replace("hz_", "", $right_key) }}</th>
                 @endforeach
                 @foreach ($audiometri['left_air_conduction'] as $left_key => $left)
                    <th  style="border: 1px solid black;">{{ str_replace("hz_", "", $left_key) }}</th>
                 @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                <td  style="border: 1px solid black;"> Air Conduction </td>
                 @foreach ($audiometri['right_air_conduction'] as $right_key => $right)
                    <td  style="border: 1px solid black;">{{ $right }}</td>
                 @endforeach
                 @foreach ($audiometri['left_air_conduction'] as $left_key => $left)
                    <td  style="border: 1px solid black;">{{ $left }}</td>
                 @endforeach
            </tr>
            <tr>
                <td  style="border: 1px solid black;">Bone Conductuion</td>
                @foreach ($audiometri['right_bone_conduction'] as $right_key => $right)
                    <td  style="border: 1px solid black;">{{ $right }}</td>
                 @endforeach
                 @foreach ($audiometri['left_bone_conduction'] as $left_key => $left)
                    <td  style="border: 1px solid black;">{{ $left }}</td>
                 @endforeach
            </tr>
        </tbody>
    </table>

    <table style="padding-top:20px; width: 100%; border-collapse: collapse; border-spacing: 0px 10px; font-size: 13px;" cellpadding="3">
        <tbody>
            <tr>
                <th colspan="2" align="left" style="border-bottom: 2px solid black; font-size: 15px;"> Hasil </th>
            </tr>
            <tr style="padding-top: 50px;">
                <td colspan="1">
                    <table cellpadding="3" style="width: 100%;">
                        <tr>
                            <td width="20%"><b>Telinga Kanan</b></td>
                            <td>:</td>
                            <td width="80%" align="left">{{ $audiometri->right_ear }}</td>
                        </tr>
                        <tr>
                            <td width="20%"><b>Telingan Kiri</b></td>
                            <td>:</td>
                            <td width="80%" align="left">{{ $audiometri->left_ear }}</td>
                        </tr>
                        <tr>
                            <td width="20%"><b>Kesimpulan</b></td>
                            <td>:</td>
                            <td width="80%" align="left">{{ $audiometri->conclusion }}</td>
                        </tr>
                    </table>
                </td>
                <td colspan="1">
                    <table cellpadding="3" style="width: 100%;">
                        <tr>
                            <td width="20%"><b>Saran</b></td>
                            <td>:</td>
                            <td width="80%" align="left">{{ $audiometri->suggestion }}</td>
                        </tr>
                        <tr>
                            <td width="20%"><b>Normal / Abnormal</b></td>
                            <td>:</td>
                            <td width="80%" align="left">{{ $audiometri->is_abnormal }}</td>
                        </tr>
                        <tr>
                            <td width="20%"><b>Pemeriksa</b></td>
                            <td>:</td>
                            <td width="80%" align="left">{{ $doctor_list[$audiometri->doctor_id] ?? '' }}</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="page-break"></div>
@endif

@if(!empty($audiometri->image_file))
<div style="text-align: center; padding-top: 20px;">
    <img src="{{ public_path('uploads/audiometry/'.$audiometri->image_file) }}" style="max-width: 710px; max-height: 600px;">
</div>
@endif