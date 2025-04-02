@if (!empty($anamnesis))
@include('mcu.pemeriksaan.print.partials.header', ['title_header' => 'PEMERIKSAAN FISIK ANAMNESA'])
@endif

@if (!empty($anamnesis))
    <h4>PEMERIKSAAN ANAMNESA</h4>
    <table style="border:none; width: 100%;">
        <tbody>
            <tr>
                <th colspan="2" align="left" style="border-bottom: 2px solid black; font-size: 15px;">
                    Riwayat Penyakit Sebelumnya
                </th>
            </tr>
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <thead>
                            <tr>
                                <th width="200px"></th>
                                <th >Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Asma</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['asthma'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['asthma'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Kencing Manis</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['diabetes'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['diabetes'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Kejang - Kejang Berulang</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['recurrent_seizures'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['recurrent_seizures'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Penyakit Jantung</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['heart_disease'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['heart_disease'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Batuk Disertai Dahak Berdarah</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['haemoptysis'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['haemoptysis'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Rheumatik</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['rheumatism'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['rheumatism'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Tekanan Darah Tinggi</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['hypertension'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['hypertension'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Tekanan Darah Rendah</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['hypotension'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['hypotension'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Sering Bengkak di Wajah/Kaki</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['angioedema'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['angioedema'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Riwayat Operasi</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['surgical_history'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['surgical_history'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Jika Ya, Jenis Operasi Apa</td>
                                <td colspan="2">{{ optional(json_decode($anamnesis['medical_history'],true))['surgical_history_notes'] ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Apakah anda pernah/sekarang menggunakan obat tertentu secara terus menerus</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['drug_continously'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['drug_continously'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <thead>
                            <tr>
                                <th width="200px"></th>
                                <th>Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Alergi</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['allergy'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['allergy'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Sakit Kuning / Hepatitis</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['hepatitis'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['hepatitis'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Kecanduan Obat-Obatan</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['drug_addiction'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['drug_addiction'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Patah Tulang</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['fracture'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['fracture'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Gangguan Pendengaran</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['hearing_disorders'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['hearing_disorders'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Nyeri Saat Buang Air Kecil</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['pain_when_urinating'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['pain_when_urinating'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Sering Keputihan (Wanita)</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['white_discharge'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['white_discharge'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Epilepsi</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['epilepsy'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['medical_history'],true))['epilepsy'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td>Jika Ya, Catatan Epilepsi</td>
                                <td colspan="2">{{ optional(json_decode($anamnesis['medical_history'],true))['epilepsy_notes'] ?? '' }}</td>
                            </tr>
                            <tr>
                                <td>Keluhan Utama Saat Ini</td>
                                <td colspan="2">{{ optional(json_decode($anamnesis['medical_history'],true))['main_complaint'] ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="border:none; width: 100%;">
        <tbody>
            <tr>
                <th colspan="2" align="left" style="border-bottom: 1px solid black; font-size: 15px;">
                    Faktor Kebiasaan
                </th>
            </tr>
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <table style="border: none; font-size: 13px; width: 100%">
                        <tbody>
                            <tr>
                                <td colspan="2" style="padding-top:20px"></td>
                            </tr>
                            <tr>
                                <td width="10%">Merokok</td>
                                <td width="1%">:</td>
                                <td align="left">
                                    @if(optional(json_decode($anamnesis['habit_factor'], true))['smoking'] == '1')
                                        Kadang - Kadang (Kurang Dari 3 Batang/hari)
                                    @elseif(optional(json_decode($anamnesis['habit_factor'], true))['smoking'] == 2)
                                        Aktif (Lebih Dari 3 Batang/hari)
                                    @else
                                        Tidak Merokok
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td width="10%">Olahraga</td>
                                <td width="1%">:</td>
                                <td align="left">
                                    @if(optional(json_decode($anamnesis['habit_factor'], true))['exercise'] == '1')
                                        Teratur Setiap 1 Minggu
                                    @elseif(optional(json_decode($anamnesis['habit_factor'], true))['smoking'] == 2)
                                        Teratur Setiap 2 Minggu
                                    @else
                                        Jarang Olahraga
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <table style="border: none; font-size: 13px; width: 100%;">
                        <thead>
                            <tr>
                                <th width="200px"></th>
                                <th>Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">Alhohol {{ optional($anamnesis['habit_factor'])['alcohol'] }}</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['habit_factor'], true))['alcohol'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center" >
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['habit_factor'], true))['alcohol'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Jika Ya, Berapa Kali</td>
                                <td colspan="2" align="left" width="30%">: {{ optional(json_decode($anamnesis['habit_factor'], true))['alcohol_note'] ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="page-break"></div>

    @if (!empty($anamnesis))
    @include('mcu.pemeriksaan.print.partials.header', ['title_header' => 'PEMERIKSAAN FISIK ANAMNESA'])
    @endif

    <table style="border:none; width: 100%;">
        <tbody>
            <tr>
                <th colspan="2" align="left" style="border-bottom: 2px solid black; font-size: 15px;">
                    Riwayat Hazard Lingkungan Kerja
                </th>
            </tr>
            <tr>
                <td style="width: 100%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <thead>
                            <tr>
                                <th width="200px"></th>
                                <th width="50px">Ya</th>
                                <th width="50px">Tidak</th>
                                <th colspan="2">Jika Ya, berapa jam/hari -> dan selama berapa tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Bising</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['work_hazard_history'],true))['noise'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['work_hazard_history'],true))['noise'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    {{ optional(json_decode($anamnesis['work_hazard_history'], true))['noise_hours'] . '   jam/hari' ?? '' }}
                                </td>
                                <td align="center">
                                    {{ optional(json_decode($anamnesis['work_hazard_history'], true))['noise_years'] . '   Tahun' ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Getaran</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['work_hazard_history'],true))['vibration'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['work_hazard_history'],true))['vibration'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    {{ optional(json_decode($anamnesis['work_hazard_history'], true))['vibration_hours'] . '   jam/hari' ?? '' }}
                                </td>
                                <td align="center">
                                    {{ optional(json_decode($anamnesis['work_hazard_history'], true))['vibration_years'] . '   Tahun' ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Debu</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['work_hazard_history'],true))['dust'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['work_hazard_history'],true))['dust'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    {{ optional(json_decode($anamnesis['work_hazard_history'], true))['dust_hours'] . '   jam/hari' ?? '' }}
                                </td>
                                <td align="center">
                                    {{ optional(json_decode($anamnesis['work_hazard_history'], true))['dust_years'] . '   Tahun' ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Zat Kimia</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['work_hazard_history'],true))['chemicals'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['work_hazard_history'],true))['chemicals'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    {{ optional(json_decode($anamnesis['work_hazard_history'], true))['chemicals_hours'] . '   jam/hari' ?? '' }}
                                </td>
                                <td align="center">
                                    {{ optional(json_decode($anamnesis['work_hazard_history'], true))['chemicals_years'] . '   Tahun' ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Panas</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['work_hazard_history'],true))['heat'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['work_hazard_history'],true))['heat'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    {{ optional(json_decode($anamnesis['work_hazard_history'], true))['heat_hours'] . '   jam/hari' ?? '' }}
                                </td>
                                <td align="center">
                                    {{ optional(json_decode($anamnesis['work_hazard_history'], true))['heat_years'] . '   Tahun' ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Asap</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['work_hazard_history'],true))['smoke'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['work_hazard_history'],true))['smoke'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    {{ optional(json_decode($anamnesis['work_hazard_history'], true))['smoke_hours'] . '   jam/hari' ?? '' }}
                                </td>
                                <td align="center">
                                    {{ optional(json_decode($anamnesis['work_hazard_history'], true))['smoke_years'] . '   Tahun' ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Monitor Komputer</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['work_hazard_history'],true))['computer_monitor'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['work_hazard_history'],true))['computer_monitor'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    {{ optional(json_decode($anamnesis['work_hazard_history'], true))['computer_monitor_hours'] . '   jam/hari' ?? '' }}
                                </td>
                                <td align="center">
                                    {{ optional(json_decode($anamnesis['work_hazard_history'], true))['computer_monitor_years'] . '   Tahun' ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Gerakan Berulang</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['work_hazard_history'],true))['repetitive_motion'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['work_hazard_history'],true))['repetitive_motion'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    {{ optional(json_decode($anamnesis['work_hazard_history'], true))['repetitive_motion_hours'] . '   jam/hari' ?? '' }}
                                </td>
                                <td align="center">
                                    {{ optional(json_decode($anamnesis['work_hazard_history'], true))['repetitive_motion_years'] . '   Tahun' ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Mendorong / Menarik</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['work_hazard_history'],true))['push_pull'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['work_hazard_history'],true))['push_pull'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    {{ optional(json_decode($anamnesis['work_hazard_history'], true))['push_pull_hours'] . '   jam/hari' ?? '' }}
                                </td>
                                <td align="center">
                                    {{ optional(json_decode($anamnesis['work_hazard_history'], true))['push_pull_years'] . '   Tahun' ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td>Angkat Beban</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['work_hazard_history'],true))['weightlifting'] == '1' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['work_hazard_history'],true))['weightlifting'] == '0' ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    {{ optional(json_decode($anamnesis['work_hazard_history'], true))['weightlifting_hours'] . '   jam/hari' ?? '' }}
                                </td>
                                <td align="center">
                                    {{ optional(json_decode($anamnesis['work_hazard_history'], true))['weightlifting_years'] . '   Tahun' ?? '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                {{-- <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <thead>
                            <tr>
                                <th colspan="2">Jika Ya, Berapa jam/hari -> berapa tahun</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="center">
                                    {{ optional(json_decode($anamnesis['work_hazard_history'], true))['noise_hours'] ?? '' }}
                                </td>
                                <td align="center">
                                    {{ optional(json_decode($anamnesis['work_hazard_history'], true))['noise_years'] ?? '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td> --}}
            </tr>
        </tbody>
    </table>

    <h4>PEMERIKSAAN FISIK</h4>
    <table style="border:none; width: 100%; padding-left: 10px; padding-right: 10px;">
        <tbody>
            <tr>
                <th colspan="2" align="left" style="border-bottom: 1px solid black; font-size: 15px;">
                    1. Pemeriksaan Umum
                </th>
            </tr>
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <tbody>
                            <tr>
                                <td width="30%">Sistol</td>
                                <td>:</td>
                                <td align="left">{{ $anamnesis->systolic ?? '-' }} mmHg</td>
                            </tr>
                            <tr>
                                <td width="30%">Diastol</td>
                                <td>:</td>
                                <td align="left">{{ $anamnesis->diastolic ?? '-' }} mmHg</td>
                            </tr>
                            <tr>
                                <td width="30%">Denyut Nadi</td>
                                <td>:</td>
                                <td align="left">{{ $anamnesis->pulse_rate ?? '-' }} x/menit</td>
                            </tr>
                            <tr>
                                <td width="30%">Nafas</td>
                                <td>:</td>
                                <td align="left">{{ $anamnesis->breathing ?? '-' }} x/menit</td>
                            </tr>
                            <tr>
                                <td width="30%">Tinggi Badan</td>
                                <td>:</td>
                                <td align="left">{{ $anamnesis->height ?? '-' }} cm</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <tbody>
                            <tr>
                                <td width="30%">Berat Badan</td>
                                <td>:</td>
                                <td align="left">{{ $anamnesis->weight ?? '-' }} kg</td>
                            </tr>
                            <tr>
                                <td width="30%">BMI</td>
                                <td>:</td>
                                <td align="left">{{ $anamnesis->bmi ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td width="30%">Suhu Tubuh</td>
                                <td>:</td>
                                <td align="left">{{ $anamnesis->body_temprature ?? '-' }} C</td>
                            </tr>
                            <tr>
                                <td width="30%">Anjuran BB</td>
                                <td>:</td>
                                <td align="left">{{ $anamnesis->weight_recommended ?? '-' }} kg</td>
                            </tr>
                             <tr>
                                <td width="30%">Kesan BMI</td>
                                <td>:</td>
                                <td align="left">{{ $anamnesis->bmi_classification ?? '-' }}</td>
                            </tr>
                            <tr>
                                <td width="30%">Lingkar Perut</td>
                                <td>:</td>
                                <td align="left">{{ $anamnesis->waist_circum ?? '-' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <th colspan="2" align="left" style="border-bottom: 1px solid black; font-size: 15px; padding-top: 3px;">
                    2. Keadaan Kulit
                </th>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 13px;">{{ $anamnesis->skin_condition ?? "-" }}</td>
            </tr>
            <tr>
                <th colspan="2" align="left" style="border-bottom: 1px solid black; font-size: 15px; padding-top: 3px;">
                    3. Mata
                </th>
            </tr>
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <thead>
                            <tr>
                                <th></th>
                                <th >Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">Buta Warna</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['eyes'], true))['color_blind'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['eyes'], true))['color_blind'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Kaca Mata</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['eyes'], true))['eyeglasses'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['eyes'], true))['eyeglasses'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">OD</td>
                                <td align="left" colspan="2">: {{ optional(json_decode($anamnesis['eyes'], true))['visus_od'] }}</td>
                            </tr>
                            <tr>
                                <td width="30%">OS</td>
                                <td align="left" colspan="2">: {{ optional(json_decode($anamnesis['eyes'], true))['visus_os'] }}</td>
                            </tr>
                            <tr>
                                <td width="30%">Kelainan Visus</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['eyes'], true))['visus'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['eyes'], true))['visus'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                             <tr>
                                <td width="30%">OD</td>
                                <td align="left" colspan="2">: {{ optional(json_decode($anamnesis['eyes'], true))['strabismus_od'] }}</td>
                            </tr>
                            <tr>
                                <td width="30%">OS</td>
                                <td align="left" colspan="2">: {{ optional(json_decode($anamnesis['eyes'], true))['strabismus_os'] }}</td>
                            </tr>
                            <tr>
                                <td width="30%">Strabismus</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['eyes'], true))['strabismus'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['eyes'], true))['strabismus'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <thead>
                            <tr>
                                <th></th>
                                <th >Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">Konjungtiva Anemis</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['eyes'], true))['anemic_conjunctiva'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['eyes'], true))['anemic_conjunctiva'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>

                            <tr>
                                <td width="30%">Sklera Ikterik</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['eyes'], true))['icteric_sclera'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['eyes'], true))['icteric_sclera'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>

                            <tr>
                                <td width="30%">Reflek Pupil</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['eyes'], true))['pupillary_reflex'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['eyes'], true))['pupillary_reflex'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>

                            <tr>
                                <td width="30%">Catatan Kelainan Kelenjar Mata</td>
                                <td align="left" colspan="2">: {{ optional(json_decode($anamnesis['eyes'], true))['eye_gland_disorders_notes'] ?? '-' }}</td>
                            </tr>

                            <tr>
                                <td width="30%">Exohalmus</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['eyes'], true))['exohalmus'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['eyes'], true))['exohalmus'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>

                            <tr>
                                <td width="30%">Lain - lain</td>
                                <td align="left" colspan="2">: {{ optional(json_decode($anamnesis['eyes'], true))['eyes_other'] ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="page-break"></div>

    @if (!empty($anamnesis))
    @include('mcu.pemeriksaan.print.partials.header', ['title_header' => 'PEMERIKSAAN FISIK ANAMNESA'])
    @endif

    <table style="border:none; width: 100%; padding-left: 10px; padding-right: 10px;">
        <tbody>
            <tr>
                <th colspan="2" align="left" style="border-bottom: 1px solid black; font-size: 15px; padding-top: 3px;">
                    4. Telinga
                </th>
            </tr>
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <thead>
                            <tr>
                                <th></th>
                                <th >Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">Penurunan Kualitas Dengar</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['ears'], true))['hearing_loss'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['ears'], true))['hearing_loss'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Kelainan Bentuk Telinga</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['ears'], true))['ear_deformity'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['ears'], true))['ear_deformity'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <thead>
                            <tr>
                                <th></th>
                                <th >Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">Perforasi Membran Timpani</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['ears'], true))['tympanic_membrane_perforation'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['ears'], true))['tympanic_membrane_perforation'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Lain - lain</td>
                                <td align="left" colspan="2">: {{ optional(json_decode($anamnesis['ears'], true))['ears_other'] ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <th colspan="2" align="left" style="border-bottom: 1px solid black; font-size: 15px; padding-top: 3px;">
                   5. Hidung
                </th>
            </tr>
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <thead>
                            <tr>
                                <th></th>
                                <th >Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">Septum Deviasi</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['nose'], true))['septal_deviation'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['nose'], true))['septal_deviation'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Septum Deviasi</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['nose'], true))['secret'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['nose'], true))['secret'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                         <thead>
                            <tr>
                                <th style="padding-top: 25px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">Lain - lain</td>
                                <td align="left" colspan="2">: {{ optional(json_decode($anamnesis['nose'], true))['nose_other'] ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <th colspan="2" align="left" style="border-bottom: 1px solid black; font-size: 15px; padding-top: 3px;">
                   6. Rongga Mulut
                </th>
            </tr>
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <thead>
                            <tr>
                                <th></th>
                                <th >Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">Laboi Palatoschizis</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['oral_cavity'], true))['laboi_palatoschizis'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['oral_cavity'], true))['laboi_palatoschizis'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Kelainan Faring</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['oral_cavity'], true))['pharyngeal_disorder'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['oral_cavity'], true))['pharyngeal_disorder'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <thead>
                            <tr>
                                <th></th>
                                <th >Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">Pembesaran Tonsil</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['oral_cavity'], true))['tonsil_enlargement'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['oral_cavity'], true))['tonsil_enlargement'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Lain - lain</td>
                                <td align="left" colspan="2">: {{ optional(json_decode($anamnesis['oral_cavity'], true))['oral_cavity_other'] ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <th colspan="2" align="left" style="border-bottom: 1px solid black; font-size: 15px; padding-top: 3px;">
                   7. Gigi
                </th>
            </tr>
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <thead>
                            <tr>
                                <th></th>
                                <th >Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">Carries Dentis</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['teeth'], true))['carries_dentis'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['teeth'], true))['carries_dentis'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Gangren Radix</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['teeth'], true))['gangren_radix'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['teeth'], true))['gangren_radix'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Gangren Pulpa</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['teeth'], true))['gangren_pulpa'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['teeth'], true))['gangren_pulpa'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <thead>
                            <tr>
                                <th></th>
                                <th >Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">Calculus Dentis</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['teeth'], true))['calculus_dentis'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['teeth'], true))['calculus_dentis'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Gigi Palsu</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['teeth'], true))['dentures'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['teeth'], true))['dentures'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Lain - lain</td>
                                <td align="left" colspan="2">: {{ optional(json_decode($anamnesis['teeth'], true))['teeth_other'] ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <th colspan="2" align="left" style="border-bottom: 1px solid black; font-size: 15px; padding-top: 3px;">
                    8. Leher
                </th>
            </tr>
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <thead>
                            <tr>
                                <th></th>
                                <th >Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">Struma</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['neck'], true))['struma'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['neck'], true))['struma'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Limfadenopati</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['neck'], true))['limfadenopati'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['neck'], true))['limfadenopati'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                         <thead>
                            <tr>
                                <th style="padding-top: 25px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">Lain - lain</td>
                                <td align="left" colspan="2">: {{ optional(json_decode($anamnesis['neck'], true))['neck_other'] ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <th colspan="2" align="left" style="border-bottom: 1px solid black; font-size: 15px; padding-top: 3px;">
                    9. Thorax
                </th>
            </tr>
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <thead>
                            <tr>
                                <th></th>
                                <th >Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">Simetris</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['thorax'], true))['symmetrical'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['thorax'], true))['symmetrical'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Kelainan Paru</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['thorax'], true))['lung_disorder'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['thorax'], true))['lung_disorder'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Catatan Kelainan Paru</td>
                                <td align="left" colspan="2">: {{ optional(json_decode($anamnesis['thorax'], true))['lung_disorder_notes'] ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <thead>
                            <tr>
                                <th></th>
                                <th >Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">Kelainan Jantung</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['thorax'], true))['heart_disorder'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['thorax'], true))['heart_disorder'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Catatan Kelainan Jantung</td>
                                <td align="left" colspan="2">: {{ optional(json_decode($anamnesis['thorax'], true))['heart_disorder_notes'] ?? '' }}</td>
                            </tr>
                            <tr>
                                <td width="30%">Lain - lain</td>
                                <td align="left" colspan="2">: {{ optional(json_decode($anamnesis['thorax'], true))['thorax_other'] ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="page-break"></div>

    @if (!empty($anamnesis))
    @include('mcu.pemeriksaan.print.partials.header', ['title_header' => 'PEMERIKSAAN FISIK ANAMNESA'])
    @endif

    <table style="border:none; width: 100%; padding-left: 10px; padding-right: 10px;">
        <tbody>
            <tr>
                <th colspan="2" align="left" style="border-bottom: 1px solid black; font-size: 15px; padding-top: 3px;">
                   10. Abdomen
                </th>
            </tr>
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <thead>
                            <tr>
                                <th></th>
                                <th >Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">Kelainan Bentuk Abdomen</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['abdomen'], true))['abdominal_deformity'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['abdomen'], true))['abdominal_deformity'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Bekas Operasi</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['abdomen'], true))['surgical_scar'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['abdomen'], true))['surgical_scar'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Catatan Bekas Operasi</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['abdomen'], true))['surgical_scar_notes'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['abdomen'], true))['surgical_scar_notes'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Hepatomegali</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['abdomen'], true))['hepatomegaly'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['abdomen'], true))['hepatomegaly'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Splenomegali</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['abdomen'], true))['splenomegaly'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['abdomen'], true))['splenomegaly'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <thead>
                            <tr>
                                <th></th>
                                <th >Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">Nyeri Tekan Epigastrium</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['abdomen'], true))['epigastric_pain'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['abdomen'], true))['epigastric_pain'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Nyeri Tekan Titik McBurney</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['abdomen'], true))['mcburney_point_tenderness'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['abdomen'], true))['mcburney_point_tenderness'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Striae</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['abdomen'], true))['striae'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['abdomen'], true))['striae'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Teraba Tumor</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['abdomen'], true))['palpable_tumor'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['abdomen'], true))['palpable_tumor'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Lain - lain</td>
                                <td align="left" colspan="2">: {{ optional(json_decode($anamnesis['abdomen'], true))['abdomen_other'] ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <th colspan="2" align="left" style="border-bottom: 1px solid black; font-size: 15px; padding-top: 3px;">
                    11. Tulang Belakang
                </th>
            </tr>
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <thead>
                            <tr>
                                <th></th>
                                <th >Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">Skoliosis / Lordosis / Kyposis</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['spine'], true))['scoliosis_lordosis_kyposis'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['spine'], true))['scoliosis_lordosis_kyposis'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                         <thead>
                            <tr>
                                <th style="padding-top: 25px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">Lain - lain</td>
                                <td align="left" colspan="2">: {{ optional(json_decode($anamnesis['spine'], true))['spine_other'] ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <th colspan="2" align="left" style="border-bottom: 1px solid black; font-size: 15px; padding-top: 3px;">
                    12. Ekstremitas Atas
                </th>
            </tr>
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <thead>
                            <tr>
                                <th></th>
                                <th >Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">Kelainan Bentuk Ekstremitas Atas</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['upper_extremities'], true))['upper_extremity_deformities'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['upper_extremities'], true))['upper_extremity_deformities'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Hemiporasis Ekstremitas Atas</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['upper_extremities'], true))['upper_extremity_hemiparesis'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['upper_extremities'], true))['upper_extremity_hemiparesis'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <thead>
                            <tr>
                                <th></th>
                                <th >Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">Pembengkakan Sendi Ekstremitas Atas</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['upper_extremities'], true))['upper_extremity_joint_swelling'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['upper_extremities'], true))['upper_extremity_joint_swelling'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Lain - lain</td>
                                <td align="left" colspan="2">: {{ optional(json_decode($anamnesis['upper_extremities'], true))['upper_extremities_other'] ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <th colspan="2" align="left" style="border-bottom: 1px solid black; font-size: 15px; padding-top: 3px;">
                    13. Ekstremitas Bawah
                </th>
            </tr>
            <tr>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <thead>
                            <tr>
                                <th></th>
                                <th >Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">Kelainan Bentuk Ekstremitas Bawah</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['lower_extremities'], true))['lower_extremity_deformities'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['lower_extremities'], true))['lower_extremity_deformities'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Varises</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['lower_extremities'], true))['varises'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['lower_extremities'], true))['varises'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Polio</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['lower_extremities'], true))['polio'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['lower_extremities'], true))['polio'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="width: 50%; vertical-align: top;">
                    <table class="sub-table" style="border: none;">
                        <thead>
                            <tr>
                                <th></th>
                                <th >Ya</th>
                                <th>Tidak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="30%">Hemiparesis Ekstremitas Bawah</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['lower_extremities'], true))['lower_extremity_hemiparesis'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['lower_extremities'], true))['lower_extremity_hemiparesis'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Pembengkakan Sendi Ekstremitas Bawah</td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['lower_extremities'], true))['lower_extremity_joint_swelling'] == 1 ? 'checked' : '' }}
                                           disabled>
                                </td>
                                <td align="center">
                                    <input type="checkbox"
                                           {{ optional(json_decode($anamnesis['lower_extremities'], true))['lower_extremity_joint_swelling'] == 0 ? 'checked' : '' }}
                                           disabled>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">Lain - lain</td>
                                <td align="left" colspan="2">: {{ optional(json_decode($anamnesis['lower_extremities'], true))['lower_extremities_other'] ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <th colspan="2" width="20%" align="left"> Catatan </th>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 13px;"> {{ $anamnesis['notes'] }} </td>
            </tr>
            <tr>
            </tr>
        </tbody>
    </table>
@endif
