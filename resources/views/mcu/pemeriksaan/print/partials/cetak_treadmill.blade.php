@if (!empty($treadmill))
@include('mcu.pemeriksaan.print.partials.header', ['title_header' => 'PEMERIKSAAN TREADMMILL'])
@endif

<table style="border:none; width: 100%;">
    <tbody>
        <tr>
            <th colspan="2" align="left" style="border-bottom: 1px solid black; font-size: 15px; padding-top: 3px;">
               Treadmill
            </th>
        </tr>
        <tr>
            <td colspan="2" style="width: 100%; vertical-align: top;">
                <table style="width: 100%; border-collapse: collapse; font-size: 13px;" cellpadding="3">
                    <tbody>
                        <tr>
                            <td width="110px">EKG Saat Istirahat</td>
                            <td width="3px" align="left">:</td>
                            <td align="left">{{ $treadmill->resting_ekg }}</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <th colspan="2" align="left" style="border-bottom: 1px solid black; font-size: 15px; padding-top: 3px;">
                Digunakan Protokol BRUCE
            </th>
        </tr>
        <tr>
            <td colspan="2" style="width: 100%; vertical-align: top;">
                <table style="width: 100%; border-collapse: collapse; font-size: 13px;" cellpadding="3">
                    <tbody>
                        <tr>
                            <td width="110px">Target Denyut Jantung Max</td>
                            <td width="3px" align="left">:</td>
                            <td align="left">{{ $treadmill->max_heart_rate_target }} mmHg/menit</td>
                        </tr> 
                        <tr>
                            <td width="110px">Tercapai</td>
                            <td width="3px" align="left">:</td>
                            <td align="left">{{ $treadmill->reached }}% dari target denyut max</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="width: 50%; vertical-align: top;">
                <table style="width: 100%; border-collapse: collapse; font-size: 13px;" cellpadding="3">
                    <tbody>
                        <tr>
                            <td width="160px">Test diakhiri pada menit ke</td>
                            <td width="3px" align="left">:</td>
                            <td align="left">{{ $treadmill->end_test_minute }}</td>
                        </tr>
                        <tr>
                            <td width="160px">Response Denyut Jantung</td>
                            <td width="3px" align="left">:</td>
                            <td align="left">{{ $treadmill->heart_rate_response }}</td>
                        </tr>
                        <tr>
                            <td width="160px">Response Tekanan Darah</td>
                            <td width="3px" align="left">:</td>
                            <td align="left">{{ $treadmill->blood_preassure_response }}</td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td style="width: 50%; vertical-align: top;">
                <table style="width: 100%; border-collapse: collapse; font-size: 13px;" cellpadding="3">
                    <tbody>
                        <tr>
                            <td width="160px">Aritmia</td>
                            <td width="3px" align="left">:</td>
                            <td align="left">{{ $treadmill->aritmia }}</td>
                        </tr>
                        <tr>
                            <td width="160px">Nyeri Dada</td>
                            <td width="3px" align="left">:</td>
                            <td align="left">{{ $treadmill->chest_pain }} menit pasca latihan</td>
                        </tr>
                        <tr>
                            <td width="160px">Gejala Lain-lain</td>
                            <td width="3px" align="left">:</td>
                            <td align="left">{{ $treadmill->other_symptoms }} menit pasca latihan</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <th colspan="2" align="left" style="border-bottom: 1px solid black; font-size: 15px; padding-top: 3px;">
               Perubahan Maksimal Pada ST
            </th>
        </tr>
        <tr>
            <td style="width: 50%; vertical-align: top;">
                <table class="sub-table" style="border: none;">
                    <tbody>
                        <tr>
                            <td width="30%">Selama/Stl. Uji Latih</td>
                            <td align="left">:</td>
                            <td align="left">{{ $treadmill->during_after_training_test }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Mm, Lead</td>
                            <td align="left">:</td>
                            <td align="left">{{ $treadmill->mm_lead }}</td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td style="width: 50%; vertical-align: top;">
                <table class="sub-table" style="border: none;">
                    <tbody>
                        <tr>
                            <td width="30%">Pada menit ke-</td>
                            <td align="left">:</td>
                            <td align="left">{{ $treadmill->at_the_minute }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Normalisasi setelah</td>
                            <td align="left">:</td>
                            <td align="left">{{ $treadmill->st_normalization_after }} menit pasca latihan</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <th colspan="2" align="left" style="border-bottom: 1px solid black; font-size: 15px; padding-top: 3px;">
               Kesimpulan
            </th>
        </tr>
        <tr>
            <td style="width: 50%; vertical-align: top;">
                <table class="sub-table" style="border: none;">
                    <tbody>
                        <tr>
                            <td width="30%">Functional Class</td>
                            <td align="left">:</td>
                            <td align="left">{{ $treadmill->functional_class }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Tingkat Kesegaran</td>
                            <td align="left">:</td>
                            <td align="left">{{ $treadmill->freshness_level }}</td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td style="width: 50%; vertical-align: top;">
                <table class="sub-table" style="border: none;">
                    <tbody>
                        <tr>
                            <td width="30%">Kapasitas Aerobik</td>
                            <td align="left">:</td>
                            <td align="left">{{ $treadmill->aerobic_capacity }}</td>
                        </tr>
                        <tr>
                            <td width="30%">Normalisasi setelah</td>
                            <td align="left">:</td>
                            <td align="left">{{ $treadmill->conc_normalization_after }} menit pasca latihan</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <th colspan="2" align="left" style="border-bottom: 1px solid black; font-size: 15px; padding-top: 3px;">
               Catatan
            </th>
        </tr>
        <tr>
            <td colspan="2" style="width: 100%; vertical-align: top;">
                <table style="width: 100%; border-collapse: collapse; font-size: 13px;" cellpadding="3">
                    <tbody>
                        <tr>
                            <td width="110px">Catatan</td>
                            <td width="3px" align="left">:</td>
                            <td align="left">{{ $treadmill->notes }}</td>
                        </tr>
                        <tr>
                            <td width="110px">Normal / Abnormal</td>
                            <td width="3px" align="left">:</td>
                            <td align="left">{{ $treadmill->is_abnormal ? 'Abnormal' : 'Normal' }}</td>
                        </tr>
                        <tr>
                            <td width="110px">Pemeriksa</td>
                            <td width="3px" align="left">:</td>
                            <td align="left">{{ $doctor_list[$treadmill->doctor_id] ?? '' }}</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>

@if(!empty($treadmill->image_file))
<div class="page-break"></div>
<div style="text-align: left; padding-top: 20px;">
    <img src="{{ public_path('uploads/treadmill/'.$treadmill->image_file) }}" style="max-width: 710px; max-height: 600px;">
</div>
@endif