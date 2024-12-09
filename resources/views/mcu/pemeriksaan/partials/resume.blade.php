<div class="card">
    <div class="card-header">
        <h3 class="card-title">Resume MCU</h3>
    </div>
    <form action="/mcu/program-mcu/detail/pemeriksaan/save-resume-mcu" method="POST">
        @csrf
        <input type="hidden" name="resume_mcu_id" value="{{ !empty($data_resume_mcu->resume_mcu_id) ? $data_resume_mcu->resume_mcu_id : null }}" id="">
        <input type="hidden" name="mcu_id" value="{{ $mcu_id }}" id="">
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
                                    <textarea required class="summernote" name="physical_impression">
                                        {{ $data_resume_mcu->physical_impression }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Kesan Rontgen</label>
                                <div class="col-sm-10">
                                    <textarea required class="summernote" name="rontgen_impression">
                                        {{ $data_resume_mcu->rontgen_impression }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Kesan EKG</label>
                                <div class="col-sm-10">
                                    <textarea required class="summernote" name="ekg_impression">
                                        {{ $data_resume_mcu->ekg_impression }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Kesan Audiometri</label>
                                <div class="col-sm-10">
                                    <textarea required class="summernote" name="audiometry_impression">
                                        {{ $data_resume_mcu->audiometry_impression }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Kesan USG</label>
                                <div class="col-sm-10">
                                    <textarea required class="summernote" name="ekg_impression">
                                        {{ $data_resume_mcu->ekg_impression }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Kesan Spirometri</label>
                                <div class="col-sm-10">
                                    <textarea required class="summernote" name="spirometry_impression">
                                        {{ $data_resume_mcu->spirometry_impression }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Kesan Refraksi</label>
                                <div class="col-sm-10">
                                    <textarea required class="summernote" name="refreaction_impression">
                                        {{ $data_resume_mcu->refreaction_impression }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Kesan Laboratorium</label>
                                <div class="col-sm-10">
                                    <textarea required class="summernote" name="laboratory_impression">
                                        {{ $data_resume_mcu->laboratory_impression }}
                                    </textarea>
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
                                    <textarea required class="summernote" name="result_conclusion">
                                        {{ $data_resume_mcu->result_conclusion }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Saran</label>
                                <div class="col-sm-10">
                                    <textarea required class="summernote" name="suggestion">
                                        {{ $data_resume_mcu->suggestion }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-2 col-form-label">Pemeriksa</label>
                                <div class="col-sm-10">
                                    <select class="form-control select2 selectDoctorResume" name="doctor_id" style="width: 100%;">
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
                <button type="submit" class="btn btn-danger action-delete" {{ empty($data_resume_mcu) ? 'disabled' : '' }}>
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
        $('.summernote').summernote({
            height: 100,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view', ['codeview', 'help']]
            ],
            callbacks: {
                onImageUpload: function(files) {
                    alert('File uploads are disabled.');
                }
            },
            disableDragAndDrop: true
        });

        let doctorResume = @json($data_resume_mcu->doctor_id ?? null);
        $('.selectDoctorResume').select2();
        $('.selectDoctorResume').val(doctorResume).trigger('change');
    });
</script>
