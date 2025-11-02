<div class="{{ Auth::user()->id_role == 5 || (Auth::user()->id_role == 3 && Auth::user()->examination_type == 30) ? 'card disabled-div' : 'card' }}">
    <div class="card-header">
        <h3 class="card-title">Laboratorium</h3>
    </div>
    <div class="card-body">
        @if (
            !empty($form_lab) &&
                $form_lab['groups']->filter(function ($group) {
                        return $group->examinationTypes->filter(function ($type) {
                                return $type->examinations->isNotEmpty();
                            })->isNotEmpty();
                    })->isNotEmpty())
            {{-- Promote button if there is a pending inbox for this MCU --}}
        @if(!empty($inbox))
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="alert alert-info py-2 px-3 mb-0">
                    Ditemukan hasil dari <strong>{{ $inbox->source }}</strong>
                    untuk MCU <code>{{ $inbox->mcu_code }}</code>
                    (Inbox #{{ $inbox->inbox_id }}, status: {{ $inbox->status }}).
                </div>
                <form method="POST" action="{{ route('lab-results.promote', $inbox->inbox_id) }}">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        Promote
                    </button>
                </form>
            </div>
        @endif
        @if (
        !empty($form_lab) &&
            $form_lab['groups']->filter(function ($group) {
                    return $group->examinationTypes->filter(function ($type) {
                            return $type->examinations->isNotEmpty();
                        })->isNotEmpty();
                })->isNotEmpty())   
        @endif
   
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group row justify-content-center align-items-center mb-3">
                        <b>Nama Pemeriksaan</b>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row justify-content-center align-items-center mb-3">
                        <b>Hasil</b>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row justify-content-center align-items-center mb-3">
                        <b>Nilai Rujukan</b>
                    </div>
                </div>
            </div>
            <form action="/mcu/program-mcu/detail/pemeriksaan/save-lab" method="POST">
                @csrf
                <input type="hidden" name="mcu_id" value="{{ $mcu_id }}" id="">
                <input type="hidden" name="laboratory_id"
                    value="{{ isset($form_lab['laboratory_id']) ? $form_lab['laboratory_id'] : null }}">
                @foreach ($form_lab['groups'] as $group)
                    @if (
                        $group->examinationTypes->isNotEmpty() &&
                            $group->examinationTypes->filter(fn($type) => $type->examinations->isNotEmpty())->isNotEmpty())
                        <div class="card mb-3">
                            <div class="card-header">
                                <h3 class="card-title">{{ $group->laboratory_examination_group_name }}</h3>
                            </div>
                            <div class="card-body">
                                @foreach ($group->examinationTypes as $type)
                                    @if ($type->examinations->isNotEmpty())
                                        <div class="card mb-3">
                                            <div class="card-header">
                                                <h3 class="card-title">{{ $type->laboratory_examination_type_name }}
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                @foreach ($type->examinations as $examination)
                                                    <div class="row mb-3">
                                                        <div class="col-md-8">
                                                            <div class="form-group row align-items-center">
                                                                <label class="col-sm-4 col-form-label">
                                                                    {{ $examination->laboratory_examination_name }}
                                                                </label>
                                                                <div class="col-sm-6">
                                                                    <input type="hidden"
                                                                        name="results[{{ $examination->laboratory_examination_id }}][laboratory_examination_id]"
                                                                        value="{{ $examination->laboratory_examination_id }}"
                                                                        id="">
                                                                    <input type="text" class="form-control"
                                                                        name="results[{{ $examination->laboratory_examination_id }}][result]"
                                                                        value="{{ old('results.' . $examination->laboratory_examination_id, $examination->result) }}"
                                                                        placeholder="">
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    {{ $examination->unit }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div
                                                                class="form-group row justify-content-center align-items-center mb-3">
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control"
                                                                        value="{{ $examination->reference_value }}"
                                                                        disabled>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    Abnormal&nbsp;&nbsp;<input type="checkbox"
                                                                        name="results[{{ $examination->laboratory_examination_id }}][is_abnormal]"
                                                                        value="1" @checked($examination->is_abnormal)>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Catatan</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row align-items-center mb-3">
                                            <label class="col-sm-2 col-form-label">Catatan</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="notes" name="notes"
                                                    value="{{ isset($data_header_lab->notes) ? $data_header_lab->notes : '' }}"
                                                    placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row align-items-center mb-3">
                                            <label class="col-sm-2 col-form-label">Pemeriksa</label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2 selectDoctorLab" name="doctor_id"
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
                            {{ empty($form_lab) ? 'disabled' : '' }}>
                            <i class="fas fa-trash"></i>&nbsp;&nbsp;Hapus
                        </button>
                        &nbsp;&nbsp;
                        <button type="submit" class="btn btn-success action-export action-save">
                            <i class="fas fa-save"></i>&nbsp;&nbsp;Simpan
                        </button>
                    </div>
                @endif
            </form>
        @else
            <h4>Belum Ada Pemeriksaan</h4>
        @endif
    </div>
</div>

<script>
    $(function() {
        let doctorLab = @json($data_header_lab->doctor_id ?? null);
        $('.selectDoctorLab').select2();
        $('.selectDoctorLab').val(doctorLab).trigger('change');
    });

    $(function() {
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
    });
</script>
