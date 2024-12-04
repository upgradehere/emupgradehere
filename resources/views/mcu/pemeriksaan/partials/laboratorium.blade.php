<div class="card">
    <div class="card-header">
        <h3 class="card-title">Laboratorium</h3>
    </div>
    <div class="card-body">
        @if (!empty($form_lab) && $form_lab['groups']->filter(function($group) {
            return $group->examinationTypes->filter(function($type) {
                return $type->examinations->isNotEmpty();
            })->isNotEmpty();
        })->isNotEmpty())
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
                <input type="hidden" name="laboratory_id" value="{{ isset($form_lab['laboratory_id']) ? $form_lab['laboratory_id'] : null }}">
                @foreach ($form_lab['groups'] as $group)
                    @if ($group->examinationTypes->isNotEmpty() &&
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
                                                <h3 class="card-title">{{ $type->laboratory_examination_type_name }}</h3>
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
                                                                    <input type="hidden" name="results[{{ $examination->laboratory_examination_id }}][laboratory_examination_id]" value="{{ $examination->laboratory_examination_id }}" id="">
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
                                                            <div class="form-group row justify-content-center align-items-center mb-3">
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control"
                                                                           value="{{ $examination->reference_value }}" disabled>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    Abnormal&nbsp;&nbsp;<input type="checkbox" name="results[{{ $examination->laboratory_examination_id }}][is_abnormal]" value="1" @checked($examination->is_abnormal)>
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

                <div class="d-flex justify-content-end">
                    <button type="submit" name="action" value="delete" class="btn btn-danger action-delete" {{ empty($form_lab) ? 'disabled' : '' }}>
                        <i class="fas fa-trash"></i>&nbsp;&nbsp;Hapus
                    </button>
                    &nbsp;&nbsp;
                    <button type="submit" class="btn btn-success action-export action-save">
                        <i class="fas fa-save"></i>&nbsp;&nbsp;Simpan
                    </button>
                </div>
            </form>
        @else
            <h4>Belum Ada Pemeriksaan</h4>
        @endif
    </div>
</div>

<script>
    $(function() {
        $('.selectDoctor').select2();
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
