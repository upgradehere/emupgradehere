@if (!empty($usg))
@include('mcu.pemeriksaan.print.partials.header', ['title_header' => 'RESUME MEDICAL CHECKUP'])
@endif
<table style="width: 100%; border-collapse: collapse; font-size: 13px;" cellpadding="3">
    <tbody>
        <tr>
            <th colspan="3" align="left" style="border-bottom: 2px solid black; font-size: 15px;"> Hasil Pemeriksaan </th>
        </tr>
        <tr>
            <td width="20%">Kesan Fisik</td>
            <td>:</td>
            <td width="80%">{!! $resume->physical_impression ?? '' !!}</td>
        </tr>
        <tr>
            <td width="20%">Kesan Rontgen</td>
            <td>:</td>
            <td width="80%">{!! $resume->rontgen_impression ?? '' !!}</td>
        </tr>
        <tr>
            <td width="20%">Kesan EKG</td>
            <td>:</td>
            <td width="80%">{!! $resume->ekg_impression ?? '' !!}</td>
        </tr>
        <tr>
            <td width="20%">Kesan Audiometri</td>
            <td>:</td>
            <td width="80%">{!! $resume->audiometry_impression ?? '' !!}</td>
        </tr>
        <tr>
            <td width="20%">Kesan USG</td>
            <td>:</td>
            <td width="80%">{!! $resume->usg_impression ?? '' !!}</td>
        </tr>
        <tr>
            <td width="20%">Kesan Spirometri</td>
            <td>:</td>
            <td width="80%">{!! $resume->spirometry_impression ?? '' !!}</td>
        </tr>
        <tr>
            <td width="20%">Kesan Refraksi</td>
            <td>:</td>
            <td width="80%">{!! $resume->refreaction_impression ?? '' !!}</td>
        </tr>
        <tr>
            <td width="20%">Kesan Laboratorium</td>
            <td>:</td>
            <td width="80%">{!! $resume->laboratory_impression ?? '' !!}</td>
        </tr>
    </tbody>
</table>
<br>
<table style="width: 100%; border-collapse: collapse; font-size: 13px;" cellpadding="3">
    <tbody>
        <tr>
            <th colspan="3" align="left" style="border-bottom: 2px solid black; font-size: 15px;"> Kesimpulan </th>
        </tr>
        <tr>
            <td width="20%">Kesimpulan</td>
            <td>:</td>
            <td width="80%">
                @if(isset($resume->result_conclusion))
                    @if($resume->result_conclusion == \App\Helpers\ConstantsHelper::KESIMPULAN_FIT_TO_WORK)
                        {{ \App\Helpers\ConstantsHelper::KESIMPULAN_FIT_TO_WORK_NAME }}
                    @elseif($resume->result_conclusion == \App\Helpers\ConstantsHelper::KESIMPULAN_FIT_TO_WORK_WITH_MEDICAL_NOTE)
                        {{ \App\Helpers\ConstantsHelper::KESIMPULAN_FIT_TO_WORK_WITH_MEDICAL_NOTE_NAME }}
                    @elseif($resume->result_conclusion == \App\Helpers\ConstantsHelper::KESIMPULAN_FIT_TEMPORARY_UNFIT)
                        {{ \App\Helpers\ConstantsHelper::KESIMPULAN_FIT_TEMPORARY_UNFIT_NAME }}
                    @elseif($resume->result_conclusion == \App\Helpers\ConstantsHelper::KESIMPULAN_NEED_FURTHER_EXAMINATION)
                        {{ \App\Helpers\ConstantsHelper::KESIMPULAN_NEED_FURTHER_EXAMINATION_NAME }}
                    @elseif($resume->result_conclusion == \App\Helpers\ConstantsHelper::KESIMPULAN_FIT_WITH_NOTE)
                        {{ \App\Helpers\ConstantsHelper::KESIMPULAN_FIT_WITH_NOTE_NAME }}
                    @endif
                @endif
            </td>
        </tr>
        <tr>
            <td width="20%">Saran</td>
            <td>:</td>
            <td width="80%">{!! $resume->suggestion ?? '' !!}</td>
        </tr>
        <tr>
            <td width="20%">Pemeriksa</td>
            <td>:</td>
            <td width="80%">{{ $doctor_list[$resume->doctor_id] ?? '' }}</td>
        </tr>
    </tbody>
</table>
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

