<div class="card">
    <div class="card-header">
        <h3 class="card-title">Spirometri</h3>
    </div>
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
                                    <input type="file" class="custom-file-input" name="import_file" id="customFile">
                                    <label class="custom-file-label" for="customFile">Upload File Gambar</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                            <div class="col-sm-2">
                                mL
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-4 col-form-label">KVP</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                            <div class="col-sm-2">
                                mL
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-4 col-form-label">Percentage KVP</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                            <div class="col-sm-2">
                                %
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-4 col-form-label">VEP</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                            <div class="col-sm-2">
                                mL
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-4 col-form-label">Percentage VEP</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
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
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                            <div class="col-sm-2">
                                L
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-4 col-form-label">Total APE</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                            <div class="col-sm-2">
                                L/min
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-4 col-form-label">Kesan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-4 col-form-label">Kesimpulan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-4 col-form-label">Pemeriksa</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-danger action-export">
                <i class="fas fa-trash"></i>&nbsp;&nbsp;Hapus
            </button>
            &nbsp;&nbsp;
            <button type="submit" class="btn btn-success action-export">
                <i class="fas fa-save"></i>&nbsp;&nbsp;Simpan
            </button>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('.selectDoctor').select2();
    });
</script>
