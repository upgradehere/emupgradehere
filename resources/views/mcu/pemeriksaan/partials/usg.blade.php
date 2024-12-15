<div class="card">
    <div class="card-header">
        <h3 class="card-title">USG</h3>
    </div>
    <form action="/mcu/program-mcu/detail/pemeriksaan/save-usg" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="usg_id" value="{{ !empty($data_usg->usg_id) ? $data_usg->usg_id : null }}" id="">
        <input type="hidden" name="mcu_id" value="{{ $mcu_id }}" id="">
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gambar Hasil USG</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row align-items-center mb-3">
                                <label for="exampleCheck1" class="col-sm-2 col-form-label">Import Hasil</label>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                        <input type="hidden" name="is_import" value="0">
                                            <input type="checkbox" class="form-check-input" value="1" name="is_import"
                                            <?php
                                                if (isset($data_usg->is_import)) {
                                                    if ($data_usg->is_import == true) {
                                                        echo 'checked';
                                                    } else {
                                                        echo '';
                                                    }
                                                } else {
                                                    echo 'checked';
                                                }
                                            ?>>
                                            <i>*ceklis jika hasil pemeriksaan digabung dengan gambar pemeriksaan</i>
                                        </label>
                                    </div>
                                </div>
                            </div>
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
                    @if(!empty($data_usg->image_file))
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{ asset('uploads/usg/'.$data_usg->image_file) }}" alt="" style="width:100%;">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Hasil USG</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Hepar</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="liver" value="{{ !empty($data_usg->liver) ? $data_usg->liver : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kantong Empedu</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="gallbladder" value="{{ !empty($data_usg->gallbladder) ? $data_usg->gallbladder : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Pankreas</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="pancreas" value="{{ !empty($data_usg->pancreas) ? $data_usg->pancreas : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Lien</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="lien" value="{{ !empty($data_usg->lien) ? $data_usg->lien : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Ginjal</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="kidney" value="{{ !empty($data_usg->kidney) ? $data_usg->kidney : '' }}" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Buli Buli</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="bladder" value="{{ !empty($data_usg->bladder) ? $data_usg->bladder : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Prostat/Uterus</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="prostat" value="{{ !empty($data_usg->prostat) ? $data_usg->prostat : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kesan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="classification" value="{{ !empty($data_usg->classification) ? $data_usg->classification : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kesimpulan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="suggestion" value="{{ !empty($data_usg->suggestion) ? $data_usg->suggestion : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Normal / Abnormal</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="is_abnormal" style="width: 100%;">
                                        <option value="0" {{ isset($data_usg->is_abnormal) && $data_usg->is_abnormal == 0 ? 'selected' : '' }}>Normal</option>
                                        <option value="1" {{ isset($data_usg->is_abnormal) && $data_usg->is_abnormal == 1 ? 'selected' : '' }}>Abnormal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Pemeriksa</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2 selectDoctorUsg" name="doctor_id" style="width: 100%;">
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
                <button type="submit" class="btn btn-danger action-delete" {{ empty($data_usg) ? 'disabled' : '' }}>
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
        let doctorUsg = @json($data_usg->doctor_id ?? null);
        $('.selectDoctorUsg').select2();
        $('.selectDoctorUsg').val(doctorUsg).trigger('change');

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });
</script>
