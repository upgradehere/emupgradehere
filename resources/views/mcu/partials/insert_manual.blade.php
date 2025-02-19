<div class="modal fade" id="modal-insert-manual">
    <div class="modal-dialog modal-lg">
        <form action="/mcu/program-mcu/detail/input-manual-mcu/save-input-manual-mcu" method="POST">
            @csrf
            <input type="hidden" name="company_id" value="{{ $company_id }}">
            <input type="hidden" name="mcu_program_id" value="{{ $mcu_program_id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Input Manual MCU</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-3 col-form-label">Peserta</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" name="employee_id" style="width: 100%;">
                                        <option selected="selected" value="">- Pilih Peserta -</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->employee_id }}">
                                                {{ $employee->employee_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-3 col-form-label">Paket</label>
                                <div class="col-sm-9">
                                    <select class="form-control select2" name="package_id" style="width: 100%;">
                                        <option selected="selected" value="">- Pilih Paket -</option>
                                        @foreach ($packages as $package)
                                            <option value="{{ $package->id }}">
                                                {{ $package->package_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row align-items-center mb-3">
                                <label class="col-sm-3 col-form-label">Tanggal MCU</label>
                                <div class="col-sm-9">
                                    <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime" name="mcu_date"/>
                                        <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="company_id" value="{{ $company_id }}">
                            <input type="hidden" name ="mcu_program_id" value="{{ $mcu_program_id }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="#" class="btn btn-danger action-export" data-dismiss="modal">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary action-save">
                        Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(function() {
        $('.select2').select2();
        $('#reservationdatetime').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            icons: { time: 'far fa-clock' }
        });
    });
</script>
