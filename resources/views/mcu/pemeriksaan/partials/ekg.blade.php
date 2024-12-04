<div class="card">
    <div class="card-header">
        <h3 class="card-title">EKG</h3>
    </div>
    <form action="/mcu/program-mcu/detail/pemeriksaan/save-ekg" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="ekg_id" value="{{ !empty($data_ekg->ekg_id) ? $data_ekg->ekg_id : null }}" id="">
        <input type="hidden" name="mcu_id" value="{{ $mcu_id }}" id="">
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gambar Hasil EKG</h3>
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
                    @if(!empty($data_ekg->image_file))
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{ asset('uploads/ekg/'.$data_ekg->image_file) }}" alt="" style="width:100%;">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Hasil EKG</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Irama</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="rhythm" value="{{ !empty($data_ekg->rhythm) ? $data_ekg->rhythm : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Rate</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="rate" value="{{ !empty($data_ekg->rate) ? $data_ekg->rate : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Axis</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="axis" value="{{ !empty($data_ekg->axis) ? $data_ekg->axis : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kelainan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="abnormality" value="{{ !empty($data_ekg->abnormality) ? $data_ekg->abnormality : '' }}" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kesimpulan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="conclusion" value="{{ !empty($data_ekg->conclusion) ? $data_ekg->conclusion : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Saran</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="suggestion" value="{{ !empty($data_ekg->suggestion) ? $data_ekg->suggestion : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Abnormal</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="is_abnormal" value="{{ !empty($data_ekg->is_abnormal) ? $data_ekg->is_abnormal : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Pemeriksa</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="doctor_id" placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-danger action-delete" {{ empty($data_ekg) ? 'disabled' : '' }}>
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
    });
</script>
