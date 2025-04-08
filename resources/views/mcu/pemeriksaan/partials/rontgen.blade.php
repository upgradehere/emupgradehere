<div class="{{ Auth::user()->id_role == 5 ? 'card disabled-div' : 'card' }}">
    <div class="card-header">
        <h3 class="card-title">Rontgen</h3>
    </div>
    <form action="/mcu/program-mcu/detail/pemeriksaan/save-rontgen" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="rontgen_id"
            value="{{ !empty($data_rontgen->rontgen_id) ? $data_rontgen->rontgen_id : null }}" id="">
        <input type="hidden" name="mcu_id" value="{{ $mcu_id }}" id="">
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gambar Hasil Rontgen</h3>
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
                                                if (isset($data_rontgen->is_import)) {
                                                    if ($data_rontgen->is_import == true) {
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
                        value="{{ !empty($data_rontgen->image_file) ? $data_rontgen->image_file : null }}"
                        id="">
                    @if (!empty($data_rontgen->image_file))
                        @php
                            $images = collect(json_decode($data_rontgen->image_file, true))
                                ->sort()
                                ->values();
                        @endphp
                        @foreach (json_decode($images, true) as $key => $image_file)
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="{{ asset('uploads/rontgen/' . $image_file) }}" alt=""
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
                    <h3 class="card-title">Hasil Radiologi</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Jenis Pemeriksaan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="rontgen_examination_type"
                                        name="rontgen_examination_type"
                                        value="{{ !empty($data_rontgen->rontgen_examination_type) ? $data_rontgen->rontgen_examination_type : 'Thorax' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Diagnosa Klinis</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="clinical_diagnosis"
                                        value="{{ !empty($data_rontgen->clinical_diagnosis) ? $data_rontgen->clinical_diagnosis : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Cor</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="cor"
                                        value="{{ !empty($data_rontgen->cor) ? $data_rontgen->cor : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Pulmo</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="pulmo"
                                        value="{{ !empty($data_rontgen->pulmo) ? $data_rontgen->pulmo : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Oss Costae</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="oss_costae"
                                        value="{{ !empty($data_rontgen->oss_costae) ? $data_rontgen->oss_costae : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Sinus Diafragma</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode"
                                        name="diaphragmatic_sinus"
                                        value="{{ !empty($data_rontgen->diaphragmatic_sinus) ? $data_rontgen->diaphragmatic_sinus : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kesimpulan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="conclusion"
                                        value="{{ !empty($data_rontgen->conclusion) ? $data_rontgen->conclusion : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Status Pemeriksaan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode"
                                        name="examination_status"
                                        value="{{ !empty($data_rontgen->examination_status) ? $data_rontgen->examination_status : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Normal / Abnormal</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="is_abnormal" style="width: 100%;">
                                        <option value="0"
                                            {{ isset($data_rontgen->is_abnormal) && $data_rontgen->is_abnormal == 0 ? 'selected' : '' }}>
                                            Normal</option>
                                        <option value="1"
                                            {{ isset($data_rontgen->is_abnormal) && $data_rontgen->is_abnormal == 1 ? 'selected' : '' }}>
                                            Abnormal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Pemeriksa</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2 selectDoctorRontgen" name="doctor_id"
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
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Catatan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="mcuCode" name="notes"
                                        value="{{ !empty($data_rontgen->notes) ? $data_rontgen->notes : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (Auth::user()->id_role == 1 || Auth::user()->id_role == 3)
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-danger action-delete"
                        {{ empty($data_rontgen) ? 'disabled' : '' }}>
                        <i class="fas fa-trash"></i>&nbsp;&nbsp;Hapus
                    </button>
                    &nbsp;&nbsp;
                    <button type="submit" class="btn btn-success action-save">
                        <i class="fas fa-save"></i>&nbsp;&nbsp;Simpan
                    </button>
                </div>
            @endif
        </div>
    </form>
</div>
<script>
    $(function() {
        let doctorRontgen = @json($data_rontgen->doctor_id ?? null);
        $('.selectDoctorRontgen').select2();
        $('.selectDoctorRontgen').val(doctorRontgen).trigger('change');

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });
</script>
