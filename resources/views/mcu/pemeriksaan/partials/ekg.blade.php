<div class="{{ Auth::user()->id_role == 5 || (Auth::user()->id_role == 3 && Auth::user()->examination_type == 30) ? 'card disabled-div' : 'card' }}">
    <div class="card-header">
        <h3 class="card-title">EKG</h3>
    </div>
    <form action="/mcu/program-mcu/detail/pemeriksaan/save-ekg" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="ekg_id" value="{{ !empty($data_ekg->ekg_id) ? $data_ekg->ekg_id : null }}"
            id="">
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
                                <label for="exampleCheck1" class="col-sm-2 col-form-label">Import Hasil</label>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="hidden" name="is_import" value="0">
                                            <input type="checkbox" class="form-check-input" value="1"
                                                name="is_import" <?php
                                                if (isset($data_ekg->is_import)) {
                                                    if ($data_ekg->is_import == true) {
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
                        value="{{ !empty($data_ekg->image_file) ? $data_ekg->image_file : null }}" id="">
                    @if (!empty($data_ekg->image_file))
                        @php
                            $images = collect(json_decode($data_ekg->image_file, true))
                                ->sort()
                                ->values();
                        @endphp
                        @foreach (json_decode($images, true) as $key => $image_file)
                            <div class="row">
                                <div class="col-md-12">
                                    <img src="{{ asset('uploads/ekg/' . $image_file) }}" alt=""
                                        style="width:100%;">
                                </div>
                            </div>
                            <br>
                        @endforeach
                    @endif
                </div>
            </div>
            <button type="button" class="btn btn-outline-info mb-3" onclick="isiNilaiNormalEkg()">
                Nilai Normal
            </button>

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
                                    <input type="text" class="form-control" id="rhythm"" name="rhythm"
                                        value="{{ !empty($data_ekg->rhythm) ? $data_ekg->rhythm : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Rate</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="rate" name="rate"
                                        value="{{ !empty($data_ekg->rate) ? $data_ekg->rate : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Axis</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="axis" name="axis"
                                        value="{{ !empty($data_ekg->axis) ? $data_ekg->axis : '' }}" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kelainan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="abnormality" name="abnormality"
                                        value="{{ !empty($data_ekg->abnormality) ? $data_ekg->abnormality : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Kesimpulan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="kesimpulan" name="conclusion"
                                        value="{{ !empty($data_ekg->conclusion) ? $data_ekg->conclusion : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Saran</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="suggestion" name="suggestion"
                                        value="{{ !empty($data_ekg->suggestion) ? $data_ekg->suggestion : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Abnormal</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="is_abnormal" name="is_abnormal"
                                        value="{{ !empty($data_ekg->is_abnormal) ? $data_ekg->is_abnormal : '' }}"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Normal / Abnormal</label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="is_abnormal" style="width: 100%;">
                                        <option value="0"
                                            {{ isset($data_ekg->is_abnormal) && $data_ekg->is_abnormal == 0 ? 'selected' : '' }}>
                                            Normal</option>
                                        <option value="1"
                                            {{ isset($data_ekg->is_abnormal) && $data_ekg->is_abnormal == 1 ? 'selected' : '' }}>
                                            Abnormal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-4 col-form-label">Pemeriksa</label>
                                <div class="col-sm-8">
                                    <select class="form-control select2 selectDoctorEkg" name="doctor_id"
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
                    <button type="submit" class="btn btn-danger action-delete"
                        {{ empty($data_ekg) ? 'disabled' : '' }}>
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
        let doctorEkg = @json($data_ekg->doctor_id ?? null);
        $('.selectDoctorEkg').select2();
        $('.selectDoctorEkg').val(doctorEkg).trigger('change');

        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });
</script>
<script>
function isiNilaiNormalEkg() {
    document.getElementById('rhythm').value = 'Sinus Rhythm';
    document.getElementById('rate').value = '';
    document.getElementById('axis').value = 'Normal';
    document.getElementById('abnormality').value = '';
    document.getElementById('kesimpulan').value = 'Normal';
    document.getElementById('suggestion').value = '';
    
    // Set select value for is_abnormal
    const abnormalSelect = document.querySelector("select[name='is_abnormal']");
    if (abnormalSelect) {
        abnormalSelect.value = '0'; // Normal
    }

    // Select doctor
    const doctorSelect = document.querySelector('.selectDoctorEkg');
    if (doctorSelect) {
        const targetName = "dr. Yusak Alfrets Porotu'o, Sp. JP";
        const match = [...doctorSelect.options].find(opt => opt.text.trim().toLowerCase() === targetName.toLowerCase());

        if (match) {
            $(doctorSelect).val(match.value).trigger('change');
        } else {
            console.warn('❗ Dokter tidak ditemukan:', targetName);
        }
    }
}
</script>
