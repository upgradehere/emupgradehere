<div class="card">
    <div class="card-header">
        <h3 class="card-title">USG</h3>
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Gambar Hasil USG</h3>
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
                <h3 class="card-title">Hasil USG</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-4 col-form-label">Hepar</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-4 col-form-label">Kantong Empedu</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-4 col-form-label">Pankreas</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-4 col-form-label">Lien</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-4 col-form-label">Ginjal</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-4 col-form-label">Buli Buli</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-4 col-form-label">Prostat/Uterus</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
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
