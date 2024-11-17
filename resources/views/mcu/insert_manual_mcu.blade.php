@extends('templates/template')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Input Manual MCU</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">MCU</li>
                        <li class="breadcrumb-item active">Informasi MCU</li>
                        <li class="breadcrumb-item active">Detail</li>
                        <li class="breadcrumb-item active">Input Manual MCU</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tambah MCU</h3>
                        </div>
                        <div class="card-body">
                            <form action="/mcu/program-mcu/detail/input-manual-mcu/save-input-manual-mcu" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row align-items-center mb-3">
                                            <label class="col-sm-3 col-form-label">Nomor MCU</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="Nomor MCU Jika Ada / Otomatis Jika Kosong">
                                            </div>
                                        </div>

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
                                        <div class="form-group row align-items-center mb-3">
                                            <div class="col-sm-12 text-end">
                                                <button type="submit" class="btn btn-success action-export">
                                                    <i class="fas fa-save"></i>&nbsp;&nbsp;Simpan
                                                </button>
                                                <a href="#" class="btn btn-danger action-export">
                                                    <i class="fas fa-times"></i>&nbsp;&nbsp;Batal
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(function() {
            $('.select2').select2();
            $('#reservationdatetime').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss',
                icons: { time: 'far fa-clock' }
            });
        });
    </script>
@endsection
