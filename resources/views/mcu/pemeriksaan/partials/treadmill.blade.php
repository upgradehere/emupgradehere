<div class="card">
    <div class="card-header">
        <h3 class="card-title">Treadmill</h3>
    </div>
    <form action="/mcu/program-mcu/detail/pemeriksaan/save-treadmill" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="treadmill_id" value="{{ !empty($data_treadmill->treadmill_id) ? $data_treadmill->treadmill_id : null }}" id="">
        <input type="hidden" name="mcu_id" value="{{ $mcu_id }}" id="">
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gambar Hasil Treadmill</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">File Gambar</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image_file" id="customFile">
                                        <label class="custom-file-label" for="customFile">Upload File Gambar</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(!empty($data_treadmill->image_file))
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{ asset('uploads/treadmill/'.$data_treadmill->image_file) }}" alt="" style="width:100%;">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Treadmill</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">EKG Saat Istirahat</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="mcuCode" name="resting_ekg" value="{{ !empty($data_treadmill->resting_ekg) ? $data_treadmill->resting_ekg : '' }}" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Digunakan Protokol BRUCE</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Target Denyut Jantung Max</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="max_heart_rate_target" value="{{ !empty($data_treadmill->max_heart_rate_target) ? $data_treadmill->max_heart_rate_target : '' }}" placeholder="">
                                </div>
                                <div class="col-sm-2">
                                    mmHg/menit
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Tercapai</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="reached" value="{{ !empty($data_treadmill->reached) ? $data_treadmill->reached : '' }}" placeholder="">
                                </div>
                                <div class="col-sm-2">
                                    % dari target denyut max
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Test diakhiri pada menit ke</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="end_test_minute" value="{{ !empty($data_treadmill->end_test_minute) ? $data_treadmill->end_test_minute : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Response Denyut Jantung</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="heart_rate_response" value="{{ !empty($data_treadmill->heart_rate_response) ? $data_treadmill->heart_rate_response : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Response Tekanan Darah</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="blood_preassure_response" value="{{ !empty($data_treadmill->blood_preassure_response) ? $data_treadmill->blood_preassure_response : '' }}" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Aritmia</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="aritmia" value="{{ !empty($data_treadmill->aritmia) ? $data_treadmill->aritmia : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Nyeri Dada</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="chest_pain" value="{{ !empty($data_treadmill->chest_pain) ? $data_treadmill->chest_pain : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Gejala Lain-lain</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="other_symptoms" value="{{ !empty($data_treadmill->other_symptoms) ? $data_treadmill->other_symptoms : '' }}" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Perubahan Maksimal Pada ST</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Selama/Stl. Uji Latih</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="during_after_training_test" value="{{ !empty($data_treadmill->during_after_training_test) ? $data_treadmill->during_after_training_test : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Mm, Lead</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="mm_lead" value="{{ !empty($data_treadmill->mm_lead) ? $data_treadmill->mm_lead : '' }}" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Pada menit ke-</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="at_the_minute" value="{{ !empty($data_treadmill->at_the_minute) ? $data_treadmill->at_the_minute : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Normalisasi setelah</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="mcuCode" name="st_normalization_after" value="{{ !empty($data_treadmill->st_normalization_after) ? $data_treadmill->st_normalization_after : '' }}" placeholder="">
                                </div>
                                <div class="col-sm-2">
                                    menit pasca latihan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kesimpulan</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Functional Class</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="functional_class" value="{{ !empty($data_treadmill->functional_class) ? $data_treadmill->functional_class : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Tingkat Kesegaran</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="freshness_level" value="{{ !empty($data_treadmill->freshness_level) ? $data_treadmill->freshness_level : '' }}" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kapasitas Aerobik</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="aerobic_capacity" value="{{ !empty($data_treadmill->aerobic_capacity) ? $data_treadmill->aerobic_capacity : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Normalisasi setelah</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="mcuCode" name="conc_normalization_after" value="{{ !empty($data_treadmill->conc_normalization_after) ? $data_treadmill->conc_normalization_after : '' }}" placeholder="">
                                </div>
                                <div class="col-sm-2">
                                    menit pasca latihan
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
                                    <input type="text" class="form-control" id="mcuCode" name="notes" value="{{ !empty($data_treadmill->notes) ? $data_treadmill->notes : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Normal / Abnormal</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="is_abnormal" style="width: 100%;">
                                        <option value="0" {{ isset($data_treadmill->is_abnormal) && $data_treadmill->is_abnormal == 0 ? 'selected' : '' }}>Normal</option>
                                        <option value="1" {{ isset($data_treadmill->is_abnormal) && $data_treadmill->is_abnormal == 1 ? 'selected' : '' }}>Abnormal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Pemeriksa</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2 selectDoctorTreadmill" name="doctor_id" style="width: 100%;">
                                        <option selected="selected" value="">- Dokter Pemeriksa -</option>
                                        @if (!empty($doctor_data))
                                            @foreach ($doctor_data as $doctor)
                                            <option value="{{ $doctor->id }}">{{ $doctor->doctor_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-danger action-delete" {{ empty($data_treadmill) ? 'disabled' : '' }}>
                    <i class="fas fa-trash"></i>&nbsp;&nbsp;Hapus
                </button>
                &nbsp;&nbsp;
                <button type="submit" class="btn btn-success action-save">
                    <i class="fas fa-save"></i>&nbsp;&nbsp;Simpan
                </button>
            </div>
        </div>
    </form>
</div>
<script>
    $(function() {
        let doctorTreadmill = @json($data_treadmill->doctor_id ?? null);
        $('.selectDoctorTreadmill').select2();
        $('.selectDoctorTreadmill').val(doctorTreadmill).trigger('change');

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });
</script>
