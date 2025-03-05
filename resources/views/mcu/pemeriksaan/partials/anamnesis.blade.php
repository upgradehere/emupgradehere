<form action="/mcu/program-mcu/detail/pemeriksaan/save-anamnesis" method="POST"
    class="{{ Auth::user()->id_role == 5 ? 'disabled-div' : '' }}">
    @csrf
    <input type="hidden" name="anamnesis_id"
        value="{{ isset($data_anamnesis->anamnesis_id) ? $data_anamnesis->anamnesis_id : null }}">
    <input type="hidden" name="mcu_id" value="{{ $mcu_id }}">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pemeriksaan Anamnesa</h3>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Penyakit Sebelumnya</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Asma</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="asthma" name="medical_history[asthma]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->medical_history->asthma) && $data_anamnesis->medical_history->asthma == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->medical_history->asthma) && $data_anamnesis->medical_history->asthma == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kencing Manis</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="diabetes" name="medical_history[diabetes]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->medical_history->diabetes) && $data_anamnesis->medical_history->diabetes == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->medical_history->diabetes) && $data_anamnesis->medical_history->diabetes == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kejang - Kejang Berulang</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="recurrent_seizures"
                                        name="medical_history[recurrent_seizures]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->medical_history->recurrent_seizures) && $data_anamnesis->medical_history->recurrent_seizures == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->medical_history->recurrent_seizures) && $data_anamnesis->medical_history->recurrent_seizures == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Penyakit Jantung</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="heart_disease"
                                        name="medical_history[heart_disease]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->medical_history->heart_disease) && $data_anamnesis->medical_history->heart_disease == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->medical_history->heart_disease) && $data_anamnesis->medical_history->heart_disease == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Batuk Disertai Dahak Berdarah</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="haemoptysis" name="medical_history[haemoptysis]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->medical_history->haemoptysis) && $data_anamnesis->medical_history->haemoptysis == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->medical_history->haemoptysis) && $data_anamnesis->medical_history->haemoptysis == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Rheumatik</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="rheumatism" name="medical_history[rheumatism]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->medical_history->rheumatism) && $data_anamnesis->medical_history->rheumatism == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->medical_history->rheumatism) && $data_anamnesis->medical_history->rheumatism == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Tekanan Darah Tinggi</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="hypertension" name="medical_history[hypertension]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->medical_history->hypertension) && $data_anamnesis->medical_history->hypertension == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->medical_history->hypertension) && $data_anamnesis->medical_history->hypertension == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Tekanan Darah Rendah</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="hypotension" name="medical_history[hypotension]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->medical_history->hypotension) && $data_anamnesis->medical_history->hypotension == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->medical_history->hypotension) && $data_anamnesis->medical_history->hypotension == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Sering Bengkak di Wajah/Kaki</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="angioedema" name="medical_history[angioedema]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->medical_history->angioedema) && $data_anamnesis->medical_history->angioedema == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->medical_history->angioedema) && $data_anamnesis->medical_history->angioedema == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Riwayat Operasi</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="surgical_history"
                                        name="medical_history[surgical_history]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->medical_history->surgical_history) && $data_anamnesis->medical_history->surgical_history == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->medical_history->surgical_history) && $data_anamnesis->medical_history->surgical_history == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Jika Ya, Jenis Operasi Apa</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="surgical_history_notes"
                                        name="medical_history[surgical_history_notes]"
                                        value="{{ isset($data_anamnesis->medical_history->surgical_history_notes) ? $data_anamnesis->medical_history->surgical_history_notes : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Apakah anda pernah/sekarang menggunakan obat
                                    tertentu secara terus menerus</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="drug_continously"
                                        name="medical_history[drug_continously]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->medical_history->drug_continously) && $data_anamnesis->medical_history->drug_continously == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->medical_history->drug_continously) && $data_anamnesis->medical_history->drug_continously == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Alergi</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="allergy" name="medical_history[allergy]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->medical_history->allergy) && $data_anamnesis->medical_history->allergy == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->medical_history->allergy) && $data_anamnesis->medical_history->allergy == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Sakit Kuning / Hepatitis</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="hepatitis" name="medical_history[hepatitis]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->medical_history->hepatitis) && $data_anamnesis->medical_history->hepatitis == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->medical_history->hepatitis) && $data_anamnesis->medical_history->hepatitis == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kecanduan Obat-Obatan</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="drug_addiction"
                                        name="medical_history[drug_addiction]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->medical_history->drug_addiction) && $data_anamnesis->medical_history->drug_addiction == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->medical_history->drug_addiction) && $data_anamnesis->medical_history->drug_addiction == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Patah Tulang</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="fracture" name="medical_history[fracture]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->medical_history->fracture) && $data_anamnesis->medical_history->fracture == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->medical_history->fracture) && $data_anamnesis->medical_history->fracture == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Gangguan Pendengaran</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="hearing_disorders"
                                        name="medical_history[hearing_disorders]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->medical_history->hearing_disorders) && $data_anamnesis->medical_history->hearing_disorders == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->medical_history->hearing_disorders) && $data_anamnesis->medical_history->hearing_disorders == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Nyeri Saat Buang Air Kecil</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="pain_when_urinating"
                                        name="medical_history[pain_when_urinating]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->medical_history->pain_when_urinating) && $data_anamnesis->medical_history->pain_when_urinating == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->medical_history->pain_when_urinating) && $data_anamnesis->medical_history->pain_when_urinating == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Sering Keputihan (Wanita)</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="white_discharge"
                                        name="medical_history[white_discharge]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->medical_history->white_discharge) && $data_anamnesis->medical_history->white_discharge == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->medical_history->white_discharge) && $data_anamnesis->medical_history->white_discharge == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Epilepsi</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="epilepsy" name="medical_history[epilepsy]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->medical_history->epilepsy) && $data_anamnesis->medical_history->epilepsy == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->medical_history->epilepsy) && $data_anamnesis->medical_history->epilepsy == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Jika Ya, Catatan Epilepsi</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="epilepsy_notes"
                                        name="medical_history[epilepsy_notes]"
                                        value="{{ isset($data_anamnesis->medical_history->epilepsy_notes) ? $data_anamnesis->medical_history->epilepsy_notes : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Keluhan Utama Saat Ini</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="main_complaint"
                                        name="medical_history[main_complaint]"
                                        value="{{ isset($data_anamnesis->medical_history->main_complaint) ? $data_anamnesis->medical_history->main_complaint : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Faktor Kebiasaan</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Merokok</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="smoking" name="habit_factor[smoking]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->habit_factor->smoking) && $data_anamnesis->habit_factor->smoking == 0 ? 'selected' : '' }}>
                                            Tidak Merokok</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->habit_factor->smoking) && $data_anamnesis->habit_factor->smoking == 1 ? 'selected' : '' }}>
                                            Kadang - Kadang (Kurang Dari 3 Batang/hari)</option>
                                        <option value="2"
                                            {{ isset($data_anamnesis->habit_factor->smoking) && $data_anamnesis->habit_factor->smoking == 2 ? 'selected' : '' }}>
                                            Aktif (Lebih Dari 3 Batang/hari)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Olahraga</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="exercise" name="habit_factor[exercise]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->habit_factor->exercise) && $data_anamnesis->habit_factor->exercise == 0 ? 'selected' : '' }}>
                                            Jarang Olahraga</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->habit_factor->exercise) && $data_anamnesis->habit_factor->exercise == 1 ? 'selected' : '' }}>
                                            Teratur Setiap 1 Minggu</option>
                                        <option value="2"
                                            {{ isset($data_anamnesis->habit_factor->exercise) && $data_anamnesis->habit_factor->exercise == 2 ? 'selected' : '' }}>
                                            Teratur Setiap 2 Minggu</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Alkohol</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="alcohol" name="habit_factor[alcohol]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->habit_factor->alcohol) && $data_anamnesis->habit_factor->alcohol == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->habit_factor->alcohol) && $data_anamnesis->habit_factor->alcohol == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Jika Ya, Berapa Kali</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="alcohol_note"
                                        name="habit_factor[alcohol_note]"
                                        value="{{ isset($data_anamnesis->habit_factor->alcohol_note) ? $data_anamnesis->habit_factor->alcohol_note : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Riwayat Hazard Lingkungan Kerja</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                        <div class="col-md-6 d-flex justify-content-center">
                            <p><b>Jika Ya, Berapa jam / hari -> selama berapa tahun</b></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Bising</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="noise" name="work_hazard_history[noise]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->work_hazard_history->noise) && $data_anamnesis->work_hazard_history->noise == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->work_hazard_history->noise) && $data_anamnesis->work_hazard_history->noise == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Getaran</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="vibration"
                                        name="work_hazard_history[vibration]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->work_hazard_history->vibration) && $data_anamnesis->work_hazard_history->vibration == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->work_hazard_history->vibration) && $data_anamnesis->work_hazard_history->vibration == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Debu</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="dust" name="work_hazard_history[dust]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->work_hazard_history->dust) && $data_anamnesis->work_hazard_history->dust == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->work_hazard_history->dust) && $data_anamnesis->work_hazard_history->dust == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Zat Kimia</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="chemicals"
                                        name="work_hazard_history[chemicals]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->work_hazard_history->chemicals) && $data_anamnesis->work_hazard_history->chemicals == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->work_hazard_history->chemicals) && $data_anamnesis->work_hazard_history->chemicals == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Panas</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="heat" name="work_hazard_history[heat]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->work_hazard_history->heat) && $data_anamnesis->work_hazard_history->heat == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->work_hazard_history->heat) && $data_anamnesis->work_hazard_history->heat == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Asap</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="smoke" name="work_hazard_history[smoke]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->work_hazard_history->smoke) && $data_anamnesis->work_hazard_history->smoke == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->work_hazard_history->smoke) && $data_anamnesis->work_hazard_history->smoke == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Monitor Komputer</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="computer_monitor"
                                        name="work_hazard_history[computer_monitor]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->work_hazard_history->computer_monitor) && $data_anamnesis->work_hazard_history->computer_monitor == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->work_hazard_history->computer_monitor) && $data_anamnesis->work_hazard_history->computer_monitor == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Gerakan Berulang</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="repetitive_motion"
                                        name="work_hazard_history[repetitive_motion]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->work_hazard_history->repetitive_motion) && $data_anamnesis->work_hazard_history->repetitive_motion == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->work_hazard_history->repetitive_motion) && $data_anamnesis->work_hazard_history->repetitive_motion == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Mendorong / Menarik</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="push_pull"
                                        name="work_hazard_history[push_pull]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->work_hazard_history->push_pull) && $data_anamnesis->work_hazard_history->push_pull == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->work_hazard_history->push_pull) && $data_anamnesis->work_hazard_history->push_pull == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Angkat Beban</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="weightlifting"
                                        name="work_hazard_history[weightlifting]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->work_hazard_history->weightlifting) && $data_anamnesis->work_hazard_history->weightlifting == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->work_hazard_history->weightlifting) && $data_anamnesis->work_hazard_history->weightlifting == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <div class="form-group row align-items-center mb-3">
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="noise_hours" name="work_hazard_history[noise_hours]" value="{{ isset($data_anamnesis->work_hazard_history->noise_hours) ? $data_anamnesis->work_hazard_history->noise_hours : '' }}" placeholder="">
                                    </div>
                                    <div class="col-sm-2">Jam / Hari</div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="noise_years" name="work_hazard_history[noise_years]" value="{{ isset($data_anamnesis->work_hazard_history->noise_years) ? $data_anamnesis->work_hazard_history->noise_years : '' }}" placeholder="">
                                    </div>
                                    <div class="col-sm-2">Tahun</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row align-items-center mb-3">
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="vibration_hours" name="work_hazard_history[vibration_hours]" value="{{ isset($data_anamnesis->work_hazard_history->vibration_hours) ? $data_anamnesis->work_hazard_history->vibration_hours : '' }}" placeholder="">
                                    </div>
                                    <div class="col-sm-2">Jam / Hari</div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="vibration_years" name="work_hazard_history[vibration_years]" value="{{ isset($data_anamnesis->work_hazard_history->vibration_years) ? $data_anamnesis->work_hazard_history->vibration_years : '' }}" placeholder="">
                                    </div>
                                    <div class="col-sm-2">Tahun</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row align-items-center mb-3">
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="dust_hours" name="work_hazard_history[dust_hours]" value="{{ isset($data_anamnesis->work_hazard_history->dust_hours) ? $data_anamnesis->work_hazard_history->dust_hours : '' }}" placeholder="">
                                    </div>
                                    <div class="col-sm-2">Jam / Hari</div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="dust_years" name="work_hazard_history[dust_years]" value="{{ isset($data_anamnesis->work_hazard_history->dust_years) ? $data_anamnesis->work_hazard_history->dust_years : '' }}" placeholder="">
                                    </div>
                                    <div class="col-sm-2">Tahun</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row align-items-center mb-3">
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="chemicals_hours" name="work_hazard_history[chemicals_hours]" value="{{ isset($data_anamnesis->work_hazard_history->chemicals_hours) ? $data_anamnesis->work_hazard_history->chemicals_hours : '' }}" placeholder="">
                                    </div>
                                    <div class="col-sm-2">Jam / Hari</div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="chemicals_years" name="work_hazard_history[chemicals_years]" value="{{ isset($data_anamnesis->work_hazard_history->chemicals_years) ? $data_anamnesis->work_hazard_history->chemicals_years : '' }}" placeholder="">
                                    </div>
                                    <div class="col-sm-2">Tahun</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row align-items-center mb-3">
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="heat_hours" name="work_hazard_history[heat_hours]" value="{{ isset($data_anamnesis->work_hazard_history->heat_hours) ? $data_anamnesis->work_hazard_history->heat_hours : '' }}" placeholder="">
                                    </div>
                                    <div class="col-sm-2">Jam / Hari</div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="heat_years" name="work_hazard_history[heat_years]" value="{{ isset($data_anamnesis->work_hazard_history->heat_years) ? $data_anamnesis->work_hazard_history->heat_years : '' }}" placeholder="">
                                    </div>
                                    <div class="col-sm-2">Tahun</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row align-items-center mb-3">
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="smoke_hours" name="work_hazard_history[smoke_hours]" value="{{ isset($data_anamnesis->work_hazard_history->smoke_hours) ? $data_anamnesis->work_hazard_history->smoke_hours : '' }}" placeholder="">
                                    </div>
                                    <div class="col-sm-2">Jam / Hari</div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="smoke_years" name="work_hazard_history[smoke_years]" value="{{ isset($data_anamnesis->work_hazard_history->smoke_years) ? $data_anamnesis->work_hazard_history->smoke_years : '' }}" placeholder="">
                                    </div>
                                    <div class="col-sm-2">Tahun</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row align-items-center mb-3">
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="computer_monitor_hours" name="work_hazard_history[computer_monitor_hours]" value="{{ isset($data_anamnesis->work_hazard_history->computer_monitor_hours) ? $data_anamnesis->work_hazard_history->computer_monitor_hours : '' }}" placeholder="">
                                    </div>
                                    <div class="col-sm-2">Jam / Hari</div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="computer_monitor_years" name="work_hazard_history[computer_monitor_years]" value="{{ isset($data_anamnesis->work_hazard_history->computer_monitor_years) ? $data_anamnesis->work_hazard_history->computer_monitor_years : '' }}" placeholder="">
                                    </div>
                                    <div class="col-sm-2">Tahun</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row align-items-center mb-3">
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="repetitive_motion_hours" name="work_hazard_history[repetitive_motion_hours]" value="{{ isset($data_anamnesis->work_hazard_history->repetitive_motion_hours) ? $data_anamnesis->work_hazard_history->repetitive_motion_hours : '' }}" placeholder="">
                                    </div>
                                    <div class="col-sm-2">Jam / Hari</div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="repetitive_motion_years" name="work_hazard_history[repetitive_motion_years]" value="{{ isset($data_anamnesis->work_hazard_history->repetitive_motion_years) ? $data_anamnesis->work_hazard_history->repetitive_motion_years : '' }}" placeholder="">
                                    </div>
                                    <div class="col-sm-2">Tahun</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row align-items-center mb-3">
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="push_pull_hours" name="work_hazard_history[push_pull_hours]" value="{{ isset($data_anamnesis->work_hazard_history->push_pull_hours) ? $data_anamnesis->work_hazard_history->push_pull_hours : '' }}" placeholder="">
                                    </div>
                                    <div class="col-sm-2">Jam / Hari</div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="push_pull_years" name="work_hazard_history[push_pull_years]" value="{{ isset($data_anamnesis->work_hazard_history->push_pull_years) ? $data_anamnesis->work_hazard_history->push_pull_years : '' }}" placeholder="">
                                    </div>
                                    <div class="col-sm-2">Tahun</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row align-items-center mb-3">
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="weightlifting_hours" name="work_hazard_history[weightlifting_hours]" value="{{ isset($data_anamnesis->work_hazard_history->weightlifting_hours) ? $data_anamnesis->work_hazard_history->weightlifting_hours : '' }}" placeholder="">
                                    </div>
                                    <div class="col-sm-2">Jam / Hari</div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" id="weightlifting_years" name="work_hazard_history[weightlifting_years]" value="{{ isset($data_anamnesis->work_hazard_history->weightlifting_years) ? $data_anamnesis->work_hazard_history->weightlifting_years : '' }}" placeholder="">
                                    </div>
                                    <div class="col-sm-2">Tahun</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Pemeriksaan Fisik</h3>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pemeriksaan Umum</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Sistol</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="systolic" name="systolic"
                                        value="{{ isset($data_anamnesis->systolic) ? $data_anamnesis->systolic : '' }}"
                                        placeholder="">
                                </div>
                                <div class="col-sm-2">
                                    mmHg
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Diastol</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="diastolic" name="diastolic"
                                        value="{{ isset($data_anamnesis->diastolic) ? $data_anamnesis->diastolic : '' }}"
                                        placeholder="">
                                </div>
                                <div class="col-sm-2">
                                    mmHg
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Denyut Nadi</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="pulse_rate" name="pulse_rate"
                                        value="{{ isset($data_anamnesis->pulse_rate) ? $data_anamnesis->pulse_rate : '' }}"
                                        placeholder="">
                                </div>
                                <div class="col-sm-2">
                                    x/menit
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Nafas</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="breathing" name="breathing"
                                        value="{{ isset($data_anamnesis->breathing) ? $data_anamnesis->breathing : '' }}"
                                        placeholder="">
                                </div>
                                <div class="col-sm-2">
                                    x/menit
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Tinggi Badan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="height" name="height"
                                        value="{{ isset($data_anamnesis->height) ? $data_anamnesis->height : '' }}"
                                        placeholder="">
                                </div>
                                <div class="col-sm-2">
                                    cm
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Berat Badan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="weight" name="weight"
                                        value="{{ isset($data_anamnesis->weight) ? $data_anamnesis->weight : '' }}"
                                        placeholder="">
                                </div>
                                <div class="col-sm-2">
                                    kg
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">BMI</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="bmi" name="bmi"
                                        value="{{ isset($data_anamnesis->bmi) ? $data_anamnesis->bmi : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Anjuran BB</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="weight_recommended"
                                        name="weight_recommended"
                                        value="{{ isset($data_anamnesis->weight_recommended) ? $data_anamnesis->weight_recommended : '' }}"
                                        placeholder="">
                                </div>
                                <div class="col-sm-2">
                                    kg
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Suhu Badan</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="body_temprature"
                                        name="body_temprature"
                                        value="{{ isset($data_anamnesis->body_temprature) ? $data_anamnesis->body_temprature : '' }}"
                                        placeholder="">
                                </div>
                                <div class="col-sm-2">
                                    <span>&#8451;</span>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kesan BMI</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="bmi_classification"
                                        name="bmi_classification"
                                        value="{{ isset($data_anamnesis->bmi_classification) ? $data_anamnesis->bmi_classification : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Keadaan Kulit</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Keadaan Kulit</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="skin_condition"
                                        name="skin_condition"
                                        value="{{ isset($data_anamnesis->skin_condition) ? $data_anamnesis->skin_condition : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Mata</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Buta Warna</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="color_blind" name="eyes[color_blind]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->eyes->color_blind) && $data_anamnesis->eyes->color_blind == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->eyes->color_blind) && $data_anamnesis->eyes->color_blind == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kaca Mata</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="eyeglasses" name="eyes[eyeglasses]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->eyes->eyeglasses) && $data_anamnesis->eyes->eyeglasses == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->eyes->eyeglasses) && $data_anamnesis->eyes->eyeglasses == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">OD</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="visus_od" name="eyes[visus_od]"
                                        value="{{ isset($data_anamnesis->eyes->visus_od) ? $data_anamnesis->eyes->visus_od : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">OS</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="visus_os" name="eyes[visus_os]"
                                        value="{{ isset($data_anamnesis->eyes->visus_os) ? $data_anamnesis->eyes->visus_os : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kelainan Visus</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="visus" name="eyes[visus]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->eyes->visus) && $data_anamnesis->eyes->visus == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->eyes->visus) && $data_anamnesis->eyes->visus == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">OD</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="strabismus_od"
                                        name="eyes[strabismus_od]"
                                        value="{{ isset($data_anamnesis->eyes->strabismus_od) ? $data_anamnesis->eyes->strabismus_od : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">OS</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="strabismus_os"
                                        name="eyes[strabismus_os]"
                                        value="{{ isset($data_anamnesis->eyes->strabismus_os) ? $data_anamnesis->eyes->strabismus_os : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Strabismus</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="strabismus" name="eyes[strabismus]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->eyes->strabismus) && $data_anamnesis->eyes->strabismus == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->eyes->strabismus) && $data_anamnesis->eyes->strabismus == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Konjungtiva Anemis</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="anemic_conjunctiva"
                                        name="eyes[anemic_conjunctiva]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->eyes->anemic_conjunctiva) && $data_anamnesis->eyes->anemic_conjunctiva == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->eyes->anemic_conjunctiva) && $data_anamnesis->eyes->anemic_conjunctiva == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Sklera Ikterik</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="icteric_sclera" name="eyes[icteric_sclera]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->eyes->icteric_sclera) && $data_anamnesis->eyes->icteric_sclera == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->eyes->icteric_sclera) && $data_anamnesis->eyes->icteric_sclera == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Reflek Pupil</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="pupillary_reflex" name="eyes[pupillary_reflex]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->eyes->pupillary_reflex) && $data_anamnesis->eyes->pupillary_reflex == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->eyes->pupillary_reflex) && $data_anamnesis->eyes->pupillary_reflex == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kelainan Kelenjar Mata</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="eye_gland_disorders"
                                        name="eyes[eye_gland_disorders]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->eyes->eye_gland_disorders) && $data_anamnesis->eyes->eye_gland_disorders == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->eyes->eye_gland_disorders) && $data_anamnesis->eyes->eye_gland_disorders == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Catatan Kelainan Kelenjar Mata</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="eye_gland_disorders_notes"
                                        name="eyes[eye_gland_disorders_notes]"
                                        value="{{ isset($data_anamnesis->eyes->eye_gland_disorders_notes) ? $data_anamnesis->eyes->eye_gland_disorders_notes : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Exohalmus</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="exohalmus" name="eyes[exohalmus]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->eyes->exohalmus) && $data_anamnesis->eyes->exohalmus == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->eyes->exohalmus) && $data_anamnesis->eyes->exohalmus == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Lain - lain</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="eyes_other"
                                        name="eyes[eyes_other]"
                                        value="{{ isset($data_anamnesis->eyes->eyes_other) ? $data_anamnesis->eyes->eyes_other : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Telinga</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Penurunan Kualitas Dengar</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="hearing_loss" name="ears[hearing_loss]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->ears->hearing_loss) && $data_anamnesis->ears->hearing_loss == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->ears->hearing_loss) && $data_anamnesis->ears->hearing_loss == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kelainan Bentuk Telinga</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="ear_deformity" name="ears[ear_deformity]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->ears->ear_deformity) && $data_anamnesis->ears->ear_deformity == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->ears->ear_deformity) && $data_anamnesis->ears->ear_deformity == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Perforasi Membran Timpani</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="tympanic_membrane_perforation"
                                        name="ears[tympanic_membrane_perforation]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->ears->tympanic_membrane_perforation) && $data_anamnesis->ears->tympanic_membrane_perforation == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->ears->tympanic_membrane_perforation) && $data_anamnesis->ears->tympanic_membrane_perforation == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Lain - lain</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="ears_other"
                                        name="ears[ears_other]"
                                        value="{{ isset($data_anamnesis->ears->ears_other) ? $data_anamnesis->ears->ears_other : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Hidung</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Septum Deviasi</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="septal_deviation" name="nose[septal_deviation]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->nose->septal_deviation) && $data_anamnesis->nose->septal_deviation == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->nose->septal_deviation) && $data_anamnesis->nose->septal_deviation == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Sekret</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="secret" name="nose[secret]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->nose->secret) && $data_anamnesis->nose->secret == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->nose->secret) && $data_anamnesis->nose->secret == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Lain - lain</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nose_other"
                                        name="nose[nose_other]"
                                        value="{{ isset($data_anamnesis->nose->nose_other) ? $data_anamnesis->nose->nose_other : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Rongga Mulut</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Laboi Palatoschizis</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="laboi_palatoschizis"
                                        name="oral_cavity[laboi_palatoschizis]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->oral_cavity->laboi_palatoschizis) && $data_anamnesis->oral_cavity->laboi_palatoschizis == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->oral_cavity->laboi_palatoschizis) && $data_anamnesis->oral_cavity->laboi_palatoschizis == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kelainan Faring</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="pharyngeal_disorder"
                                        name="oral_cavity[pharyngeal_disorder]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->oral_cavity->pharyngeal_disorder) && $data_anamnesis->oral_cavity->pharyngeal_disorder == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->oral_cavity->pharyngeal_disorder) && $data_anamnesis->oral_cavity->pharyngeal_disorder == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Pembesaran Tonsil</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="tonsil_enlargement"
                                        name=oral_cavity[tonsil_enlargement]>
                                        <option value="0"
                                            {{ isset($data_anamnesis->oral_cavity->tonsil_enlargement) && $data_anamnesis->oral_cavity->tonsil_enlargement == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->oral_cavity->tonsil_enlargement) && $data_anamnesis->oral_cavity->tonsil_enlargement == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Lain - lain</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="oral_cavity_other"
                                        name="oral_cavity[oral_cavity_other]"
                                        value="{{ isset($data_anamnesis->oral_cavity->oral_cavity_other) ? $data_anamnesis->oral_cavity->oral_cavity_other : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gigi</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Carries Dentis</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="carries_dentis" name="teeth[carries_dentis]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->teeth->carries_dentis) && $data_anamnesis->teeth->carries_dentis == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->teeth->carries_dentis) && $data_anamnesis->teeth->carries_dentis == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Gangren Radix</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="gangren_radix" name="teeth[gangren_radix]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->teeth->gangren_radix) && $data_anamnesis->teeth->gangren_radix == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->teeth->gangren_radix) && $data_anamnesis->teeth->gangren_radix == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Gangren Pulpa</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="gangren_pulpa" name="teeth[gangren_pulpa]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->teeth->gangren_pulpa) && $data_anamnesis->teeth->gangren_pulpa == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->teeth->gangren_pulpa) && $data_anamnesis->teeth->gangren_pulpa == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Calculus Dentis</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="calculus_dentis" name="teeth[calculus_dentis]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->teeth->calculus_dentis) && $data_anamnesis->teeth->calculus_dentis == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->teeth->calculus_dentis) && $data_anamnesis->teeth->calculus_dentis == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Gigi Palsu</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="dentures" name="teeth[dentures]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->teeth->dentures) && $data_anamnesis->teeth->dentures == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->teeth->dentures) && $data_anamnesis->teeth->dentures == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Lain - lain</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="teeth_other"
                                        name="teeth[teeth_other]"
                                        value="{{ isset($data_anamnesis->teeth->teeth_other) ? $data_anamnesis->teeth->teeth_other : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Leher</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Struma</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="struma" name="neck[struma]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->neck->struma) && $data_anamnesis->neck->struma == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->neck->struma) && $data_anamnesis->neck->struma == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Limfadenopati</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="limfadenopati" name="neck[limfadenopati]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->neck->limfadenopati) && $data_anamnesis->neck->limfadenopati == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->neck->limfadenopati) && $data_anamnesis->neck->limfadenopati == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Lain - lain</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="neck_other"
                                        name="neck[neck_other]"
                                        value="{{ isset($data_anamnesis->neck->neck_other) ? $data_anamnesis->neck->neck_other : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Thorax</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Simetris</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="symmetrical" name="thorax[symmetrical]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->thorax->symmetrical) && $data_anamnesis->thorax->symmetrical == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->thorax->symmetrical) && $data_anamnesis->thorax->symmetrical == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kelainan Paru</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="lung_disorder" name="thorax[lung_disorder]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->thorax->lung_disorder) && $data_anamnesis->thorax->lung_disorder == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->thorax->lung_disorder) && $data_anamnesis->thorax->lung_disorder == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Catatan Kelainan Paru</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="lung_disorder_notes"
                                        name="thorax[lung_disorder_notes]"
                                        value="{{ isset($data_anamnesis->thorax->lung_disorder_notes) ? $data_anamnesis->thorax->lung_disorder_notes : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kelainan Jantung</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="heart_disorder" name="thorax[heart_disorder]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->thorax->heart_disorder) && $data_anamnesis->thorax->heart_disorder == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->thorax->heart_disorder) && $data_anamnesis->thorax->heart_disorder == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Catatan Kelainan Jantung</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="heart_disorder_notes"
                                        name="thorax[heart_disorder_notes]"
                                        value="{{ isset($data_anamnesis->thorax->heart_disorder_notes) ? $data_anamnesis->thorax->heart_disorder_notes : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Lain - lain</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="thorax_other"
                                        name="thorax[thorax_other]"
                                        value="{{ isset($data_anamnesis->thorax->thorax_other) ? $data_anamnesis->thorax->thorax_other : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Abdomen</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kelainan Bentuk Abdomen</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="abdominal_deformity"
                                        name="abdomen[abdominal_deformity]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->abdomen->abdominal_deformity) && $data_anamnesis->abdomen->abdominal_deformity == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->abdomen->abdominal_deformity) && $data_anamnesis->abdomen->abdominal_deformity == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Bekas Operasi</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="surgical_scar" name="abdomen[surgical_scar]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->abdomen->surgical_scar) && $data_anamnesis->abdomen->surgical_scar == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->abdomen->surgical_scar) && $data_anamnesis->abdomen->surgical_scar == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Catatan Bekas Operasi</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="surgical_scar_notes"
                                        name="abdomen[surgical_scar_notes]"
                                        value="{{ isset($data_anamnesis->abdomen->surgical_scar_notes) ? $data_anamnesis->abdomen->surgical_scar_notes : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Hepatomegali</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="hepatomegaly" name="abdomen[hepatomegaly]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->abdomen->hepatomegaly) && $data_anamnesis->abdomen->hepatomegaly == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->abdomen->hepatomegaly) && $data_anamnesis->abdomen->hepatomegaly == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Splenomegali</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="splenomegaly" name="abdomen[splenomegaly]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->abdomen->splenomegaly) && $data_anamnesis->abdomen->splenomegaly == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->abdomen->splenomegaly) && $data_anamnesis->abdomen->splenomegaly == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Nyeri Tekan Epigastrium</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="epigastric_pain"
                                        name="abdomen[epigastric_pain]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->abdomen->epigastric_pain) && $data_anamnesis->abdomen->epigastric_pain == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->abdomen->epigastric_pain) && $data_anamnesis->abdomen->epigastric_pain == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Nyeri Tekan Titik McBurney</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="mcburney_point_tenderness"
                                        name="abdomen[mcburney_point_tenderness]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->abdomen->mcburney_point_tenderness) && $data_anamnesis->abdomen->mcburney_point_tenderness == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->abdomen->mcburney_point_tenderness) && $data_anamnesis->abdomen->mcburney_point_tenderness == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Striae</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="striae" name="abdomen[striae]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->abdomen->striae) && $data_anamnesis->abdomen->striae == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->abdomen->striae) && $data_anamnesis->abdomen->striae == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Teraba Tumor</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="palpable_tumor" name="abdomen[palpable_tumor]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->abdomen->palpable_tumor) && $data_anamnesis->abdomen->palpable_tumor == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->abdomen->palpable_tumor) && $data_anamnesis->abdomen->palpable_tumor == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Lain - lain</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="abdomen_other"
                                        name="abdomen[abdomen_other]"
                                        value="{{ isset($data_anamnesis->abdomen->abdomen_other) ? $data_anamnesis->abdomen->abdomen_other : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Tulang Belakang</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Skoliosis / Lordosis / Kyposis</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="scoliosis_lordosis_kyposis"
                                        name="spine[scoliosis_lordosis_kyposis]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->spine->scoliosis_lordosis_kyposis) && $data_anamnesis->spine->scoliosis_lordosis_kyposis == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->spine->scoliosis_lordosis_kyposis) && $data_anamnesis->spine->scoliosis_lordosis_kyposis == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Lain - lain</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="spine_other"
                                        name="spine[spine_other]"
                                        value="{{ isset($data_anamnesis->spine->spine_other) ? $data_anamnesis->spine->spine_other : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ekstremitas Atas</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kelainan Bentuk Ekstremitas Atas</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="upper_extremity_deformities"
                                        name="upper_extremities[upper_extremity_deformities]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->upper_extremities->upper_extremity_deformities) && $data_anamnesis->upper_extremities->upper_extremity_deformities == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->upper_extremities->upper_extremity_deformities) && $data_anamnesis->upper_extremities->upper_extremity_deformities == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Hemiporasis Ekstremitas Atas</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="upper_extremity_hemiparesis"
                                        name="upper_extremities[upper_extremity_hemiparesis]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->upper_extremities->upper_extremity_hemiparesis) && $data_anamnesis->upper_extremities->upper_extremity_hemiparesis == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->upper_extremities->upper_extremity_hemiparesis) && $data_anamnesis->upper_extremities->upper_extremity_hemiparesis == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Pembengkakan Sendi Ekstremitas Atas</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="upper_extremity_joint_swelling"
                                        name="upper_extremities[upper_extremity_joint_swelling]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->upper_extremities->upper_extremity_joint_swelling) && $data_anamnesis->upper_extremities->upper_extremity_joint_swelling == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->upper_extremities->upper_extremity_joint_swelling) && $data_anamnesis->upper_extremities->upper_extremity_joint_swelling == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Lain - lain</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="upper_extremities_other"
                                        name="upper_extremities[upper_extremities_other]"
                                        value="{{ isset($data_anamnesis->upper_extremities->upper_extremities_other) ? $data_anamnesis->upper_extremities->upper_extremities_other : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Ekstremitas Bawah</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kelainan Bentuk Ekstremitas Bawah</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="lower_extremity_deformities"
                                        name="lower_extremities[lower_extremity_deformities]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->lower_extremities->lower_extremity_deformities) && $data_anamnesis->lower_extremities->lower_extremity_deformities == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->lower_extremities->lower_extremity_deformities) && $data_anamnesis->lower_extremities->lower_extremity_deformities == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Varises</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="varises" name="lower_extremities[varises]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->lower_extremities->varises) && $data_anamnesis->lower_extremities->varises == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->lower_extremities->varises) && $data_anamnesis->lower_extremities->varises == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Polio</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="polio" name="lower_extremities[polio]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->lower_extremities->polio) && $data_anamnesis->lower_extremities->polio == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->lower_extremities->polio) && $data_anamnesis->lower_extremities->polio == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Hemiparesis Ekstremitas Bawah</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="lower_extremity_hemiparesis"
                                        name="lower_extremities[lower_extremity_hemiparesis]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->lower_extremities->lower_extremity_hemiparesis) && $data_anamnesis->lower_extremities->lower_extremity_hemiparesis == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->lower_extremities->lower_extremity_hemiparesis) && $data_anamnesis->lower_extremities->lower_extremity_hemiparesis == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Pembengkakan Sendi Ekstremitas Bawah</label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="lower_extremity_joint_swelling"
                                        name="lower_extremities[lower_extremity_joint_swelling]">
                                        <option value="0"
                                            {{ isset($data_anamnesis->lower_extremities->lower_extremity_joint_swelling) && $data_anamnesis->lower_extremities->lower_extremity_joint_swelling == 0 ? 'selected' : '' }}>
                                            Tidak</option>
                                        <option value="1"
                                            {{ isset($data_anamnesis->lower_extremities->lower_extremity_joint_swelling) && $data_anamnesis->lower_extremities->lower_extremity_joint_swelling == 1 ? 'selected' : '' }}>
                                            Ya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Lain - lain</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="lower_extremities_other"
                                        name="lower_extremities[lower_extremities_other]"
                                        value="{{ isset($data_anamnesis->lower_extremities->lower_extremities_other) ? $data_anamnesis->lower_extremities->lower_extremities_other : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Catatan</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Catatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="notes" name="notes"
                                        value="{{ isset($data_anamnesis->medical_history->drug_continously) ? $data_anamnesis->notes : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->id_role == 1 || Auth::user()->id_role == 3)
                <div class="d-flex justify-content-end">
                    <button type="submit" name="action" value="delete" class="btn btn-danger action-delete"
                        {{ empty($data_anamnesis) ? 'disabled' : '' }}>
                        <i class="fas fa-trash"></i>&nbsp;&nbsp;Hapus
                    </button>
                    &nbsp;&nbsp;
                    <button type="submit" class="btn btn-success action-save">
                        <i class="fas fa-save"></i>&nbsp;&nbsp;Simpan
                    </button>
                </div>
            @endif
        </div>
    </div>
</form>
<script>
    $(function() {

    });
</script>
