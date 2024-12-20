@extends('templates/template')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Departement</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href={{ route('doctor') }}>Departement</a></li>
                        <li class="breadcrumb-item active">Detail Departement</li>
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
                        <form method="POST" action="{{ route('departement.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $departement->departement_id }}" name="id">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Perusahaan</label>
                                    <select class="form-control" name="company_id" required id="">
                                        <option value="">-- Pilih Perusahaan --</option>
                                        @foreach ($company as $c)
                                            <option value="{{ $c->company_id }}"
                                                {{ $departement->company_id == $c->company_id ? 'selected' : '' }}>
                                                {{ $c->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Departement</label>
                                    <input type="text" required value="{{ $departement->departement_name }}"
                                        name="departement_name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Kode Departement</label>
                                    <input type="text" required value="{{ $departement->departement_code }}"
                                        name="departement_code" class="form-control">
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
