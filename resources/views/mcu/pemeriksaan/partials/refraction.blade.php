<div class="card">
    <div class="card-header">
        <h3 class="card-title">Refraksi/Trial Lens</h3>
    </div>
    <form action="/mcu/program-mcu/detail/pemeriksaan/save-refraction" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="refraction_id" value="{{ !empty($data_refraction->refraction_id) ? $data_refraction->refraction_id : null }}" id="">
        <input type="hidden" name="mcu_id" value="{{ $mcu_id }}" id="">
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gambar Hasil</h3>
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
                    @if(!empty($data_refraction->image_file))
                        <div class="row">
                            <div class="col-md-12">
                                <img src="{{ asset('uploads/refraction/'.$data_refraction->image_file) }}" alt="" style="width:100%;">
                            </div>
                        </div>
                    @endif
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
                                <label class="col-sm-4 col-form-label">Spheris Kiri</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="left_spherical" value="{{ !empty($data_refraction->left_spherical) ? $data_refraction->left_spherical : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Cylinder Kiri</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="left_cylinder" value="{{ !empty($data_refraction->left_cylinder) ? $data_refraction->left_cylinder : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Axis Kiri</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="left_axis" value="{{ !empty($data_refraction->left_axis) ? $data_refraction->left_axis : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">ADD Kiri</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="left_add" value="{{ !empty($data_refraction->left_add) ? $data_refraction->left_add : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">PD Kiri</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="left_pd" value="{{ !empty($data_refraction->left_pd) ? $data_refraction->left_pd : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Visus Tanpa Koreksi, OD Kiri</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="uncorrected_vision_left_od" value="{{ !empty($data_refraction->uncorrected_vision_left_od) ? $data_refraction->uncorrected_vision_left_od : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Visus Tanpa Koreksi, OS Kiri</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="uncorrected_vision_left_os" value="{{ !empty($data_refraction->uncorrected_vision_left_os) ? $data_refraction->uncorrected_vision_left_os : '' }}" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Spheris Kanan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="right_spherical" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Cylinder Kanan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="right_cylinder" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Axis Kanan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="right_axis" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">ADD Kanan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="right_add" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">PD Kanan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="right_pd" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Visus Tanpa Koreksi, OD Kanan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="uncorrected_vision_right_od" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Visus Tanpa Koreksi, OS Kanan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="uncorrected_vision_right_os" placeholder="">
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
                                <label class="col-sm-2 col-form-label">Terapi Hasil Refraksi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="mcuCode" name="refraction_therapy_result" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Kesimpulan & Saran</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="mcuCode" name="conclusion" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Catatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="mcuCode" name="notes" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Pemeriksa</label>
                                <div class="col-sm-10">
                                    {{-- <select class="form-control select2" name="employee_id" style="width: 100%;">
                                        <option selected="selected" value="">- Pilih Peserta -</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->employee_id }}">
                                                {{ $employee->employee_name }}
                                            </option>
                                        @endforeach
                                    </select> --}}
                                    <select class="form-control select2 selectDoctor" name="doctor_id" style="width: 100%;">
                                        <option selected="selected" value="">- Dokter Pemeriksa -</option>
                                        <option value="1">Test Dokter</option>
                                        <option value="2">Test Dokter</option>
                                    </select>
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
                <button type="submit" class="btn btn-success action-export action-save">
                    <i class="fas fa-save"></i>&nbsp;&nbsp;Simpan
                </button>
            </div>
        </div>
    </form>
</div>
<script>
    $(function() {
        $('.selectDoctor').select2();
        $('.action-save').on('click', function(e) {
            e.preventDefault();
            let form = $(this).closest('form');
            Swal.fire({
                title: 'Perhatian!',
                text: "Apakah anda akan menyimpan data?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Simpan',
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.value) {
                    form.submit();
                }
            });
        });

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });
</script>
