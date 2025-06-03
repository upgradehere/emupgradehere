@extends('templates/template')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Pegawai</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href={{ route('employee') }}>Pegawai</a></li>
                        <li class="breadcrumb-item active">Detail Pegawai</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="POST" action="{{ route('employee.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $employee->employee_id }}" name="id">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Perusahaan</label>
                                    <select name="company_id" id="" class="form-control" required>
                                        <option value="">-- Pilih Perusahaan --</option>
                                        @foreach ($company as $cp)
                                            <option {{ $cp->company_id == $employee->company_id ? 'selected' : '' }}
                                                value="{{ $cp->company_id }}">{{ $cp->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Pegawai</label>
                                    <input type="text" required value="{{ $employee->employee_name }}"
                                        name="employee_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Kode Pegawai</label>
                                    <input type="text" value="{{ $employee->employee_code }}"
                                        name="employee_code" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">NIK</label>
                                    <input type="text" maxlength="16" required value="{{ $employee->nik }}" name="nik"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">No Whatsapp</label>
                                    <input type="text" value="{{ $employee->phone_number }}"
                                        name="phone_number" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" value="{{ $employee->email }}" name="email"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Lahir</label>
                                    <input type="date" required value="{{ date('Y-m-d', strtotime($employee->dob)) }}"
                                        name="dob" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Jenis Kelamin</label>
                                    <select name="sex" id="" class="form-control" required>
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option {{ $employee->sex == 11 ? 'selected' : '' }} value="11">Laki Laki
                                        </option>
                                        <option {{ $employee->sex == 12 ? 'selected' : '' }} value="12">Perempuan
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Departemen</label>
                                    <select name="departement_id" id="" class="form-control" required>
                                        <option value="">-- Pilih Departemen --</option>
                                        @foreach ($departement as $d)
                                            <option value="{{ $d->departement_id }}"
                                                {{ $employee->departement_id == $d->departement_id ? 'selected' : '' }}>
                                                {{ $d->departement_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Foto</label><br>
                                    <img style="width:10%" src="/uploads/employee-photo/{{ $employee->photo }}"
                                        alt=""><br><br>
                                    <input type="file" accept="image/*" name="photo" class="form-control">
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).on("change", ".select_laboratorium", function() {
            var value = $(this).val();
            var text = $(this).find('option:selected').text();
            var input = $(".laboratory_item");
            var findSame = 0;

            if (value != "") {
                $.each(input, function(i, v) {
                    console.log(v)
                    if (findSame == 0) {
                        if ($(v).val() == value) {
                            findSame = 1;
                        }
                    }
                });

                if (findSame == 0) {
                    $('#tbody_item').append(`
                        <tr>
                            <td><input type='text' name='laboratory_item[]' class="laboratory_item" readonly value='${value}'></td>
                            <td>${text}</td>
                            <td><button class="btn btn-danger btn-sm delete_item" type="button" data-id='${value}'>Hapus</button></td>
                        </tr>
                    `);
                }

                $(this).val("");
            }
        });

        $(document).on("click", ".delete_item", function() {
            var id = $(this).attr("data-id");
            $('#tbody_item tr').filter(function() {
                return $(this).find('td:first input').val() === id;
            }).remove();
        });
    </script>
@endsection
