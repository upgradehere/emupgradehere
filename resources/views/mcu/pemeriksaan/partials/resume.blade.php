<div class="card">
    <div class="card-header">
        <h3 class="card-title">Resume MCU</h3>
    </div>
    <div class="card-body">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Hasil Pemeriksaan</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-2 col-form-label">Kesan Fisik</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-2 col-form-label">Kesan Rontgen</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-2 col-form-label">Kesan EKG</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-2 col-form-label">Kesan Audiometri</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-2 col-form-label">Kesan USG</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-2 col-form-label">Kesan Spirometri</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-2 col-form-label">Kesan Refraksi</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-2 col-form-label">Kesan Laboratorium</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
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
                    <div class="col-md-12">
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-2 col-form-label">Kesimpulan Hasil</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-2 col-form-label">Saran</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                            </div>
                        </div>
                        <div class="form-group row align-items-center mb-3">
                            <label class="col-sm-2 col-form-label">Pemeriksa</label>
                            <div class="col-sm-10">
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
