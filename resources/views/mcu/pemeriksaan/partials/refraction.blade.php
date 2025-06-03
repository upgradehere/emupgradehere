<div class="{{ Auth::user()->id_role == 5 || (Auth::user()->id_role == 3 && Auth::user()->examination_type == 30) ? 'card disabled-div' : 'card' }}">
    <div class="card-header">
        <h3 class="card-title">Refraksi/Trial Lens</h3>
    </div>
    <form action="/mcu/program-mcu/detail/pemeriksaan/save-refraction" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="refraction_id"
            value="{{ !empty($data_refraction->refraction_id) ? $data_refraction->refraction_id : null }}" id="">
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
                                <label for="exampleCheck1" class="col-sm-2 col-form-label">Import Hasil</label>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="hidden" name="is_import" value="0">
                                            <input type="checkbox" class="form-check-input" value="1"
                                                name="is_import" <?php
                                                if (isset($data_refraction->is_import)) {
                                                    if ($data_refraction->is_import == true) {
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
                                        <input type="file" class="custom-file-input" name="image_file"
                                            id="customFile">
                                        <label class="custom-file-label" for="customFile">Upload File Gambar</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="existing_images"
                        value="{{ !empty($data_refraction->image_file) ? $data_refraction->image_file : null }}"
                        id="">
                    @if (!empty($data_refraction->image_file))
                        @php
                            $images = collect(json_decode($data_refraction->image_file, true))
                                ->sort()
                                ->values();
                        @endphp
                        @foreach (json_decode($images, true) as $key => $image_file)
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="{{ asset('uploads/refraction/' . $image_file) }}" alt=""
                                        style="width:100%;">
                                </div>
                            </div>
                            <br>
                        @endforeach
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
                                    <input type="text" class="form-control" id="mcuCode" name="left_spherical"
                                        value="{{ !empty($data_refraction->left_spherical) ? $data_refraction->left_spherical : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Cylinder Kiri</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="left_cylinder"
                                        value="{{ !empty($data_refraction->left_cylinder) ? $data_refraction->left_cylinder : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Axis Kiri</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="left_axis"
                                        value="{{ !empty($data_refraction->left_axis) ? $data_refraction->left_axis : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">ADD Kiri</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="left_add"
                                        value="{{ !empty($data_refraction->left_add) ? $data_refraction->left_add : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">PD Kiri</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="left_pd"
                                        value="{{ !empty($data_refraction->left_pd) ? $data_refraction->left_pd : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Visus Tanpa Koreksi, OD Kiri</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode"
                                        name="uncorrected_vision_left_od"
                                        value="{{ !empty($data_refraction->uncorrected_vision_left_od) ? $data_refraction->uncorrected_vision_left_od : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Visus Tanpa Koreksi, OS Kiri</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode"
                                        name="uncorrected_vision_left_os"
                                        value="{{ !empty($data_refraction->uncorrected_vision_left_os) ? $data_refraction->uncorrected_vision_left_os : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Spheris Kanan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="right_spherical"
                                        value="{{ !empty($data_refraction->right_spherical) ? $data_refraction->right_spherical : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Cylinder Kanan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="right_cylinder"
                                        value="{{ !empty($data_refraction->right_cylinder) ? $data_refraction->right_cylinder : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Axis Kanan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="right_axis"
                                        value="{{ !empty($data_refraction->right_axis) ? $data_refraction->right_axis : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">ADD Kanan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="right_add"
                                        value="{{ !empty($data_refraction->right_add) ? $data_refraction->right_add : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">PD Kanan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="right_pd"
                                        value="{{ !empty($data_refraction->right_pd) ? $data_refraction->right_pd : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Visus Tanpa Koreksi, OD Kanan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode"
                                        name="uncorrected_vision_right_od"
                                        value="{{ !empty($data_refraction->uncorrected_vision_right_od) ? $data_refraction->uncorrected_vision_right_od : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Visus Tanpa Koreksi, OS Kanan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode"
                                        name="uncorrected_vision_right_os"
                                        value="{{ !empty($data_refraction->uncorrected_vision_right_os) ? $data_refraction->uncorrected_vision_right_os : '' }}"
                                        placeholder="">
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
                                    <input type="text" class="form-control" id="mcuCode"
                                        name="refraction_therapy_result"
                                        value="{{ !empty($data_refraction->refraction_therapy_result) ? $data_refraction->refraction_therapy_result : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Kesimpulan & Saran</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="mcuCode" name="conclusion"
                                        value="{{ !empty($data_refraction->conclusion) ? $data_refraction->conclusion : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Catatan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="mcuCode" name="notes"
                                        value="{{ !empty($data_refraction->notes) ? $data_refraction->notes : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Pemeriksa</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2 selectDoctorRefraction" name="doctor_id"
                                        style="width: 100%;">
                                        <option selected="selected" value="">- Dokter Pemeriksa -</option>
                                        @if (!empty($doctor_data))
                                            @foreach ($doctor_data as $doctor)
                                                <option value="{{ $doctor->id }}">{{ $doctor->doctor_name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->id_role == 1 || Auth::user()->id_role == 3)
                <div class="d-flex justify-content-end">
                    <button type="submit" name="action" value="delete" class="btn btn-danger action-delete"
                        {{ empty($data_refraction) ? 'disabled' : '' }}>
                        <i class="fas fa-trash"></i>&nbsp;&nbsp;Hapus
                    </button>
                    &nbsp;&nbsp;
                    <button type="submit" class="btn btn-success action-export action-save">
                        <i class="fas fa-save"></i>&nbsp;&nbsp;Simpan
                    </button>
                </div>
            @endif
        </div>
    </form>
</div>
<script>
    $(function() {
        let doctorRefraction = @json($data_refraction->doctor_id ?? null);
        $('.selectDoctorRefraction').select2();
        $('.selectDoctorRefraction').val(doctorRefraction).trigger('change');

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });
</script>
