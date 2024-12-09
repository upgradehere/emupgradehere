<div class="card">
    <div class="card-header">
        <h3 class="card-title">Papsmear</h3>
    </div>
    <form action="/mcu/program-mcu/detail/pemeriksaan/save-papsmear" method="POST">
        @csrf
        <input type="hidden" name="papsmear_id" value="{{ !empty($data_papsmear->papsmear_id) ? $data_papsmear->papsmear_id : null }}" id="">
        <input type="hidden" name="mcu_id" value="{{ $mcu_id }}" id="">
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Papsmear</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Kesimpulan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="mcuCode" name="conclusion" value="{{ !empty($data_papsmear->conclusion) ? $data_papsmear->conclusion : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Kesan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="mcuCode" name="classification" value="{{ !empty($data_papsmear->classification) ? $data_papsmear->classification : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Spesimen</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="mcuCode" name="speciment" value="{{ !empty($data_papsmear->speciment) ? $data_papsmear->speciment : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Keterangan Klinis</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="mcuCode" name="clinical_description" value="{{ !empty($data_papsmear->clinical_description) ? $data_papsmear->clinical_description : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Kategori Umum/Rincian</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="mcuCode" name="general_category" value="{{ !empty($data_papsmear->general_category) ? $data_papsmear->general_category : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Anjuran</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="mcuCode" name="recommendations" value="{{ !empty($data_papsmear->recommendations) ? $data_papsmear->recommendations : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Pemeriksa</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2 selectDoctorPapsmear" name="doctor_id" style="width: 100%;">
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
                <button type="submit" class="btn btn-danger action-delete" {{ empty($data_papsmear) ? 'disabled' : '' }}>
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
        let doctorPapsmear = @json($data_papsmear->doctor_id ?? null);
        $('.selectDoctorPapsmear').select2();
        $('.selectDoctorPapsmear').val(doctorPapsmear).trigger('change');

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });
</script>
