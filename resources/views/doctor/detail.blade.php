@extends('templates/template')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Dokter</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href={{ route('doctor') }}>Dokter</a></li>
                        <li class="breadcrumb-item active">Detail Dokter</li>
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
                        <form method="POST" action="{{ route('doctor.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $doctor->id }}" name="id">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Nama Dokter</label>
                                    <input type="text" required value="{{ $doctor->doctor_name }}" name="doctor_name"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Kode Dokter</label>
                                    <input type="text" required value="{{ $doctor->doctor_code }}" name="doctor_code"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Tanda Tangan Dokter</label><br>
                                    <img src="/uploads/doctor_sign/{{ $doctor->doctor_sign }}" style="width:10%"
                                        alt=""><br><br>
                                    <input type="file" name="doctor_sign" id="doctor_sign" accept=".jpg,.png"><br>
                                    <span style="color:red">Maksimal size file TTD Dokter adalah 100kb</span>
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
