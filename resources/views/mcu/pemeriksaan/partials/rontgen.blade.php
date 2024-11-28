<div class="card">
    <div class="card-header">
        <h3 class="card-title">Rontgen</h3>
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Gambar Hasil Rontgen</h3>
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
                <h3 class="card-title">Ukuran Kacamata</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-4 col-form-label">Jenis Pemeriksaan</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-4 col-form-label">Diagnosa Klinis</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-4 col-form-label">Cor</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-4 col-form-label">Pulmo</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-4 col-form-label">Oss Costae</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-4 col-form-label">Sinus Diafragma</label>
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
                            <label class="col-sm-4 col-form-label">Status Pemeriksaan</label>
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
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-4 col-form-label">Catatan</label>
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
