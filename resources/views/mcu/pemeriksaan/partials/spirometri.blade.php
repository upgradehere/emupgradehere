<div class="card">
    <div class="card-header">
        <h3 class="card-title">Spirometri</h3>
    </div>
    <form action="/mcu/program-mcu/detail/pemeriksaan/save-spirometry" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="spirometry_id" value="{{ !empty($data_spirometry->spirometry_id) ? $data_spirometry->spirometry_id : null }}" id="">
        <input type="hidden" name="mcu_id" value="{{ $mcu_id }}" id="">
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gambar Hasil Spirometri</h3>
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
                    @if(!empty($data_spirometry->image_file))
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{ asset('uploads/spirometry/'.$data_spirometry->image_file) }}" alt="" style="width:100%;">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Spirometri</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Nilai Prediksi</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="mcuCode" name="prediction_value" value="{{ !empty($data_spirometry->prediction_value) ? $data_spirometry->prediction_value : '' }}" placeholder="">
                                </div>
                                <div class="col-sm-2">
                                    mL
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">KVP</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="mcuCode" name="kvp" value="{{ !empty($data_spirometry->kvp) ? $data_spirometry->kvp : '' }}" placeholder="">
                                </div>
                                <div class="col-sm-2">
                                    mL
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Percentage KVP</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="mcuCode" name="kvp_percentage" value="{{ !empty($data_spirometry->kvp_percentage) ? $data_spirometry->kvp_percentage : '' }}" placeholder="">
                                </div>
                                <div class="col-sm-2">
                                    %
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">VEP</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="mcuCode" name="vep" value="{{ !empty($data_spirometry->vep) ? $data_spirometry->vep : '' }}" placeholder="">
                                </div>
                                <div class="col-sm-2">
                                    mL
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Percentage VEP</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="mcuCode" name="vep_percetage" value="{{ !empty($data_spirometry->vep_percetage) ? $data_spirometry->vep_percetage : '' }}" placeholder="">
                                </div>
                                <div class="col-sm-2">
                                    %
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">APE</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="mcuCode" name="ape" value="{{ !empty($data_spirometry->ape) ? $data_spirometry->ape : '' }}" placeholder="">
                                </div>
                                <div class="col-sm-2">
                                    L
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Total APE</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="mcuCode" name="ape_total" value="{{ !empty($data_spirometry->ape_total) ? $data_spirometry->ape_total : '' }}" placeholder="">
                                </div>
                                <div class="col-sm-2">
                                    L/min
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kesan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="classification" value="{{ !empty($data_spirometry->classification) ? $data_spirometry->classification : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kesimpulan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="conclusion" value="{{ !empty($data_spirometry->conclusion) ? $data_spirometry->conclusion : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Normal / Abnormal</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="is_abnormal" style="width: 100%;">
                                        <option value="0" {{ isset($data_spirometry->is_abnormal) && $data_spirometry->is_abnormal == 0 ? 'selected' : '' }}>Normal</option>
                                        <option value="1" {{ isset($data_spirometry->is_abnormal) && $data_spirometry->is_abnormal == 1 ? 'selected' : '' }}>Abnormal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Pemeriksa</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2 selectDoctorSpirometry" name="doctor_id" style="width: 100%;">
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
                <button type="submit" class="btn btn-danger action-delete" {{ empty($data_spirometry) ? 'disabled' : '' }}>
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
        let doctorSpirometry = @json($data_spirometry->doctor_id ?? null);
        $('.selectDoctorSpirometry').select2();
        $('.selectDoctorSpirometry').val(doctorSpirometry).trigger('change');

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });
</script>
