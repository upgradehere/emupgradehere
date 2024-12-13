@extends('templates/template')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Paket</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href={{ route('package') }}>Paket</a></li>
                        <li class="breadcrumb-item active">Detail Paket</li>
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
                        <form method="POST" action="{{ route('package.update') }}">
                            @csrf
                            <input type="hidden" value="{{ $package->id }}" name="id">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Nama Paket</label>
                                    <input type="text" class="form-control" id="" required placeholder=""
                                        name="package_name" value="{{ $package->package_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Kode Paket</label>
                                    <input type="text" class="form-control" id="" required placeholder=""
                                        name="package_code" value="{{ $package->package_code }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Harga</label>
                                    <input type="text" class="form-control" id="" required placeholder=""
                                        name="price" value="{{ $package->price }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea name="desc" id="" cols="30" rows="10" class="form-control">{{ $package->desc }}</textarea>
                                </div>

                                <label for="">Pemeriksaan</label>
                                <hr>
                                <div class="form-check">
                                    @foreach ($treatment as $t)
                                        <input type="checkbox" name="treatment[]" id="" class="form-check-input"
                                            value="{{ $t->lookup_code }}"
                                            {{ $package[$t->lookup_code] == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="">{{ $t->lookup_name }}</label><br>
                                    @endforeach
                                </div>

                                <br>
                                <label for="">Laboratorium</label>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-check">
                                            @foreach ($laboratorium as $key => $lab)
                                                <h5>{{ $lab->laboratory_examination_group_name }}</h5>
                                                <hr class="custom-hr">
                                                @foreach ($lab->examinationTypes as $key2 => $type)
                                                    <span
                                                        for="">{{ $type->laboratory_examination_type_name }}</span><br>
                                                    <select name="" id="select_laboratorium_{{ $key2 }}"
                                                        class="select_laboratorium form-control">
                                                        <option value="">-- Pilih Item --</option>
                                                        @foreach ($type->examinations as $key3 => $exam)
                                                            <option value="{{ $exam->laboratory_examination_id }}">
                                                                {{ $type->laboratory_examination_type_name . '-' . $exam->laboratory_examination_name }}
                                                            </option>
                                                        @endforeach
                                                    </select><br>
                                                @endforeach
                                                <hr>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID Item</th>
                                                    <th>Item</th>
                                                    <th>Hapus</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_item">
                                                @foreach ($laboratorium_current as $lc)
                                                    <tr>
                                                        <td><input type='text' name='laboratory_item[]'
                                                                class="laboratory_item" readonly
                                                                value="{{ $lc->laboratory_examination_id }}"></td>
                                                        <td>{{ $lc->type->laboratory_examination_type_name . '-' . $lc->laboratory_examination_name }}
                                                        </td>
                                                        <td><button class="btn btn-danger btn-sm delete_item" type="button"
                                                                data-id="{{ $lc->laboratory_examination_id }}">Hapus</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
