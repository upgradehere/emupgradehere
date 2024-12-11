<h4>Anamnesa</h4>
<h5>Riwayat Penyakit Sebelumnya</h5>
<table class="identity-header">
    <tbody>
        <tr>
            <td>
                <table class="sub-table">
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
                                       {{ optional($anamnesis['medical_history'])['asthma'] == 'Ya' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['asthma'] == 'Tidak' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Kencing Manis</td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['diabetes'] == 'Ya' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['diabetes'] == 'Tidak' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Kejang - Kejang Berulang</td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['recurrent_seizures'] == 'Ya' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['recurrent_seizures'] == 'Tidak' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Penyakit Jantung</td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['heart_disease'] == 'Ya' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['heart_disease'] == 'Tidak' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Batuk Disertai Dahak Berdarah</td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['haemoptysis'] == 'Ya' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['haemoptysis'] == 'Tidak' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Rheumatik</td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['rheumatism'] == 'Ya' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['rheumatism'] == 'Tidak' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Tekanan Darah Tinggi</td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['hypertension'] == 'Ya' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['hypertension'] == 'Tidak' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Tekanan Darah Rendah</td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['hypotension'] == 'Ya' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['hypotension'] == 'Tidak' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Sering Bengkak di Wajah/Kaki</td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['angioedema'] == 'Ya' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['angioedema'] == 'Tidak' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Riwayat Operasi</td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['surgical_history'] == 'Ya' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['surgical_history'] == 'Tidak' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Jika Ya, Jenis Operasi Apa</td>
                            <td colspan="2">{{ optional($anamnesis['medical_history'])['surgical_history_notes'] ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Apakah anda pernah/sekarang menggunakan obat tertentu secara terus menerus</td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['drug_continously'] == 'Ya' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['drug_continously'] == 'Tidak' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </td>
            <td>
                <table class="sub-table">
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
                                       {{ optional($anamnesis['medical_history'])['allergy'] == 'Ya' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['allergy'] == 'Tidak' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Sakit Kuning / Hepatitis</td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['hepatitis'] == 'Ya' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['hepatitis'] == 'Tidak' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Kecanduan Obat-Obatan</td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['drug_addiction'] == 'Ya' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['drug_addiction'] == 'Tidak' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Patah Tulang</td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['fracture'] == 'Ya' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['fracture'] == 'Tidak' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Gangguan Pendengaran</td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['hearing_disorders'] == 'Ya' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['hearing_disorders'] == 'Tidak' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Apakah Anda Perokok</td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['smoker'] == 'Ya' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['smoker'] == 'Tidak' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Apakah Anda Rutin Berolahraga</td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['exercise_regularly'] == 'Ya' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['exercise_regularly'] == 'Tidak' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Nyeri Saat Buang Air Kecil</td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['pain_when_urinating'] == 'Ya' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['pain_when_urinating'] == 'Tidak' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Sering Keputihan (Wanita)</td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['white_discharge'] == 'Ya' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['white_discharge'] == 'Tidak' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Epilepsi</td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['epilepsy'] == 'Ya' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                            <td align="center">
                                <input type="checkbox" 
                                       {{ optional($anamnesis['medical_history'])['epilepsy'] == 'Tidak' ? 'checked' : '' }} 
                                       disabled>
                            </td>
                        </tr>
                        <tr>
                            <td>Jika Ya, Catatan Epilepsi</td>
                            <td colspan="2">{{ optional($anamnesis['medical_history'])['epilepsy_notes'] ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Keluhan Utama Saat Ini</td>
                            <td colspan="2">{{ optional($anamnesis['medical_history'])['main_complaint'] ?? '' }}</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<br>
