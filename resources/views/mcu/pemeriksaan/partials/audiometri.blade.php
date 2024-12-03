<div class="card">
    <div class="card-header">
        <h3 class="card-title">Audiometri</h3>
    </div>
    <form action="/mcu/program-mcu/detail/pemeriksaan/save-audiometry" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="audiometry_id" value="{{ !empty($data_audiometry->audiometry_id) ? $data_audiometry->audiometry_id : null }}" id="">
        <input type="hidden" name="mcu_id" value="{{ $mcu_id }}" id="">
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gambar Hasil Audiometri</h3>
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
                    @if(!empty($data_audiometry->image_file))
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{ asset('uploads/audiometry/'.$data_audiometry->image_file) }}" alt="" style="width:100%;">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Air Conduction</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-1 d-flex justify-content-center align-items-center">
                                    200 Hz
                                </div>
                                <div class="col-sm-1 d-flex justify-content-center align-items-center">
                                    500 Hz
                                </div>
                                <div class="col-sm-1 d-flex justify-content-center align-items-center">
                                    750 Hz
                                </div>
                                <div class="col-sm-1 d-flex justify-content-center align-items-center">
                                    1000 Hz
                                </div>
                                <div class="col-sm-1 d-flex justify-content-center align-items-center">
                                    1500 Hz
                                </div>
                                <div class="col-sm-1 d-flex justify-content-center align-items-center">
                                    2000 Hz
                                </div>
                                <div class="col-sm-1 d-flex justify-content-center align-items-center">
                                    3000 Hz
                                </div>
                                <div class="col-sm-1 d-flex justify-content-center align-items-center">
                                    4000 Hz
                                </div>
                                <div class="col-sm-1 d-flex justify-content-center align-items-center">
                                    6000 Hz
                                </div>
                                <div class="col-sm-1 d-flex justify-content-center align-items-center">
                                    8000 Hz
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Right</label>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="right_air_conduction[hz_200]" value="{{ isset($data_audiometry->right_air_conduction->hz_200) ? $data_audiometry->right_air_conduction->hz_200 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="right_air_conduction[hz_500]" value="{{ isset($data_audiometry->right_air_conduction->hz_500) ? $data_audiometry->right_air_conduction->hz_500 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="right_air_conduction[hz_750]" value="{{ isset($data_audiometry->right_air_conduction->hz_750) ? $data_audiometry->right_air_conduction->hz_750 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="right_air_conduction[hz_1000]" value="{{ isset($data_audiometry->right_air_conduction->hz_1000) ? $data_audiometry->right_air_conduction->hz_1000 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="right_air_conduction[hz_1500]" value="{{ isset($data_audiometry->right_air_conduction->hz_1500) ? $data_audiometry->right_air_conduction->hz_1500 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="right_air_conduction[hz_2000]" value="{{ isset($data_audiometry->right_air_conduction->hz_2000) ? $data_audiometry->right_air_conduction->hz_2000 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="right_air_conduction[hz_3000]" value="{{ isset($data_audiometry->right_air_conduction->hz_3000) ? $data_audiometry->right_air_conduction->hz_3000 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="right_air_conduction[hz_4000]" value="{{ isset($data_audiometry->right_air_conduction->hz_4000) ? $data_audiometry->right_air_conduction->hz_4000 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="right_air_conduction[hz_6000]" value="{{ isset($data_audiometry->right_air_conduction->hz_6000) ? $data_audiometry->right_air_conduction->hz_6000 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="right_air_conduction[hz_8000]" value="{{ isset($data_audiometry->right_air_conduction->hz_8000) ? $data_audiometry->right_air_conduction->hz_8000 : 0 }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Left</label>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="left_air_conduction[hz_200]" value="{{ isset($data_audiometry->left_air_conduction->hz_200) ? $data_audiometry->left_air_conduction->hz_200 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="left_air_conduction[hz_500]" value="{{ isset($data_audiometry->left_air_conduction->hz_500) ? $data_audiometry->left_air_conduction->hz_500 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="left_air_conduction[hz_750]" value="{{ isset($data_audiometry->left_air_conduction->hz_750) ? $data_audiometry->left_air_conduction->hz_750 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="left_air_conduction[hz_1000]" value="{{ isset($data_audiometry->left_air_conduction->hz_1000) ? $data_audiometry->left_air_conduction->hz_1000 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="left_air_conduction[hz_1500]" value="{{ isset($data_audiometry->left_air_conduction->hz_1500) ? $data_audiometry->left_air_conduction->hz_1500 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="left_air_conduction[hz_2000]" value="{{ isset($data_audiometry->left_air_conduction->hz_2000) ? $data_audiometry->left_air_conduction->hz_2000 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="left_air_conduction[hz_3000]" value="{{ isset($data_audiometry->left_air_conduction->hz_3000) ? $data_audiometry->left_air_conduction->hz_3000 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="left_air_conduction[hz_4000]" value="{{ isset($data_audiometry->left_air_conduction->hz_4000) ? $data_audiometry->left_air_conduction->hz_4000 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="left_air_conduction[hz_6000]" value="{{ isset($data_audiometry->left_air_conduction->hz_6000) ? $data_audiometry->left_air_conduction->hz_6000 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="left_air_conduction[hz_8000]" value="{{ isset($data_audiometry->left_air_conduction->hz_8000) ? $data_audiometry->left_air_conduction->hz_8000 : 0 }}" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Bone Conduction</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-1 d-flex justify-content-center align-items-center">
                                    200 Hz
                                </div>
                                <div class="col-sm-1 d-flex justify-content-center align-items-center">
                                    500 Hz
                                </div>
                                <div class="col-sm-1 d-flex justify-content-center align-items-center">
                                    750 Hz
                                </div>
                                <div class="col-sm-1 d-flex justify-content-center align-items-center">
                                    1000 Hz
                                </div>
                                <div class="col-sm-1 d-flex justify-content-center align-items-center">
                                    1500 Hz
                                </div>
                                <div class="col-sm-1 d-flex justify-content-center align-items-center">
                                    2000 Hz
                                </div>
                                <div class="col-sm-1 d-flex justify-content-center align-items-center">
                                    3000 Hz
                                </div>
                                <div class="col-sm-1 d-flex justify-content-center align-items-center">
                                    4000 Hz
                                </div>
                                <div class="col-sm-1 d-flex justify-content-center align-items-center">
                                    6000 Hz
                                </div>
                                <div class="col-sm-1 d-flex justify-content-center align-items-center">
                                    8000 Hz
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Right</label>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="right_bone_conduction[hz_200]" value="{{ isset($data_audiometry->right_bone_conduction->hz_200) ? $data_audiometry->right_bone_conduction->hz_200 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="right_bone_conduction[hz_500]" value="{{ isset($data_audiometry->right_bone_conduction->hz_500) ? $data_audiometry->right_bone_conduction->hz_500 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="right_bone_conduction[hz_750]" value="{{ isset($data_audiometry->right_bone_conduction->hz_750) ? $data_audiometry->right_bone_conduction->hz_750 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="right_bone_conduction[hz_1000]" value="{{ isset($data_audiometry->right_bone_conduction->hz_1000) ? $data_audiometry->right_bone_conduction->hz_1000 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="right_bone_conduction[hz_1500]" value="{{ isset($data_audiometry->right_bone_conduction->hz_1500) ? $data_audiometry->right_bone_conduction->hz_1500 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="right_bone_conduction[hz_2000]" value="{{ isset($data_audiometry->right_bone_conduction->hz_2000) ? $data_audiometry->right_bone_conduction->hz_2000 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="right_bone_conduction[hz_3000]" value="{{ isset($data_audiometry->right_bone_conduction->hz_3000) ? $data_audiometry->right_bone_conduction->hz_3000 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="right_bone_conduction[hz_4000]" value="{{ isset($data_audiometry->right_bone_conduction->hz_4000) ? $data_audiometry->right_bone_conduction->hz_4000 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="right_bone_conduction[hz_6000]" value="{{ isset($data_audiometry->right_bone_conduction->hz_6000) ? $data_audiometry->right_bone_conduction->hz_6000 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="right_bone_conduction[hz_8000]" value="{{ isset($data_audiometry->right_bone_conduction->hz_8000) ? $data_audiometry->right_bone_conduction->hz_8000 : 0 }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Left</label>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="left_bone_conduction[hz_200]" value="{{ isset($data_audiometry->left_bone_conduction->hz_200) ? $data_audiometry->left_bone_conduction->hz_200 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="left_bone_conduction[hz_500]" value="{{ isset($data_audiometry->left_bone_conduction->hz_500) ? $data_audiometry->left_bone_conduction->hz_500 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="left_bone_conduction[hz_750]" value="{{ isset($data_audiometry->left_bone_conduction->hz_750) ? $data_audiometry->left_bone_conduction->hz_750 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="left_bone_conduction[hz_1000]" value="{{ isset($data_audiometry->left_bone_conduction->hz_1000) ? $data_audiometry->left_bone_conduction->hz_1000 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="left_bone_conduction[hz_1500]" value="{{ isset($data_audiometry->left_bone_conduction->hz_1500) ? $data_audiometry->left_bone_conduction->hz_1500 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="left_bone_conduction[hz_2000]" value="{{ isset($data_audiometry->left_bone_conduction->hz_2000) ? $data_audiometry->left_bone_conduction->hz_2000 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="left_bone_conduction[hz_3000]" value="{{ isset($data_audiometry->left_bone_conduction->hz_3000) ? $data_audiometry->left_bone_conduction->hz_3000 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="left_bone_conduction[hz_4000]" value="{{ isset($data_audiometry->left_bone_conduction->hz_4000) ? $data_audiometry->left_bone_conduction->hz_4000 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="left_bone_conduction[hz_6000]" value="{{ isset($data_audiometry->left_bone_conduction->hz_6000) ? $data_audiometry->left_bone_conduction->hz_6000 : 0 }}" placeholder="">
                                </div>
                                <div class="col-sm-1">
                                    <input type="number" class="form-control" id="mcuCode" name="left_bone_conduction[hz_8000]" value="{{ isset($data_audiometry->left_bone_conduction->hz_8000) ? $data_audiometry->left_bone_conduction->hz_8000 : 0 }}" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Hasil</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Telinga Kanan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="right_ear" value="{{ isset($data_audiometry->right_ear) ? $data_audiometry->right_ear : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Telingan Kiri</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="left_ear" value="{{ isset($data_audiometry->left_ear) ? $data_audiometry->left_ear : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kesimpulan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="conclusion" value="{{ isset($data_audiometry->conclusion) ? $data_audiometry->conclusion : '' }}" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Saran</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="suggestion" value="{{ isset($data_audiometry->suggestion) ? $data_audiometry->suggestion : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Pemeriksa</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="doctor_id" value="{{ isset($data_audiometry->doctor_id) ? $data_audiometry->doctor_id : '' }}" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-danger action-delete" {{ empty($data_audiometry) ? 'disabled' : '' }}>
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
        $('.selectDoctor').select2();
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });
</script>
