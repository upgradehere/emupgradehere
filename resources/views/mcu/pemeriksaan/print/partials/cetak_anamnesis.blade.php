<h4>Anamnesa</h4>
<h5>Riwayat Penyakit Sebelumnya</h5>
<table class="identity-header">
    <tbody>
        <tr>
            <td>
                <table class="sub-table">
                    <tbody>
                        <tr>
                            <td>Asma</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['asthma'] ?? 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>Kencing Manis</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['diabetes'] ?? 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>Kejang - Kejang Berulang</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['recurrent_seizures'] ?? 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>Penyakit Jantung</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['heart_disease'] ?? 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>Batuk Disertai Dahak Berdarah</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['haemoptysis'] ?? 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>Rheumatik</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['rheumatism'] ?? 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>Tekanan Darah Tinggi</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['hypertension'] ?? 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>Tekanan Darah Rendah</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['hypotension'] ?? 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>Sering Bengkak di Wajah/Kaki</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['angioedema'] ?? 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>Riwayat Operasi</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['surgical_history'] ?? 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>Jika Ya, Jenis Operasi Apa</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['surgical_history_notes'] ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Apakah anda pernah/sekarang menggunakan obat tertentu secara terus menerus</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['drug_continously'] ?? 'Tidak' }}</td>
                        </tr>
                    </tbody>
                </table>
            </td>
            <td>
                <table class="sub-table">
                    <tbody>
                        <tr>
                            <td>Alergi</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['allergy'] ?? 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>Sakit Kuning / Hepatitis</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['hepatitis'] ?? 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>Kecanduan Obat-Obatan</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['drug_addiction'] ?? 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>Patah Tulang</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['fracture'] ?? 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>Gangguan Pendengaran</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['hearing_disorders'] ?? 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>Apakah Anda Perokok</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['smoker'] ?? 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>Apakah Anda Rutin Berolahraga</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['exercise_regularly'] ?? 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>Nyeri Saat Buang Air Kecil</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['pain_when_urinating'] ?? 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>Sering Keputihan (Wanita)</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['white_discharge'] ?? 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>Epilepsi</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['epilepsy'] ?? 'Tidak' }}</td>
                        </tr>
                        <tr>
                            <td>Jika Ya, Catatan Epilepsi</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['epilepsy_notes'] ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Keluhan Utama Saat Ini</td>
                            <td></td>
                            <td>{{ optional($anamnesis['medical_history'])['main_complaint'] ?? '' }}</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
