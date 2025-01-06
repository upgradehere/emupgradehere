@extends('templates/template')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Program MCU</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item active">Program MCU</li>
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
                            <h3 class="card-title">Daftar Program MCU</h3><br>
                            <br>
                            @if (Auth::user()->id_company == null)
                                <button class="btn btn-success" data-toggle="modal" data-target="#modal_add_program">+
                                    Tambah
                                    Program Baru</button>
                                @if (request()->has('company-id'))
                                    <a href="{{ route('program-mcu') }}" class="btn btn-primary">Tampilkan Semua Program
                                        Dari Semua Perusahaan</a>
                                @endif
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="mcuProgramTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">No</th>
                                        <th>Program MCU</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Jumlah MCU</th>
                                        <th style="width: 120px;"><i class="fas fa-cogs"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal_add_program">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Program Baru</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('program-mcu-save-program') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Perusahaan</label>
                                <select name="company_id" class="form-control">
                                    <option value="">-- Pilih Perusahaan --</option>
                                    @foreach ($company as $item)
                                        <option value="{{ $item->company_id }}">{{ $item->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Kode Program</label>
                                <input type="text" required name="mcu_program_code" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Program</label>
                                <input type="text" required name="mcu_program_name" class="form-control">
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" id="">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="modal_edit_program">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Program</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('program-mcu-update-program') }}" method="POST">
                            @csrf
                            <input type="hidden" name="mcu_program_id" id="mcu_program_id">
                            <div class="form-group">
                                <label for="">Kode Program</label>
                                <input type="text" required name="mcu_program_code" id="mcu_program_code"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Nama Program</label>
                                <input type="text" required name="mcu_program_name" id="mcu_program_name"
                                    class="form-control">
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" id="">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </section>
    <script>
        $(function() {
            var urlParams = new URLSearchParams(window.location.search);
            urlParams = urlParams.get('company-id');
            companyId = (urlParams == null) ? 'A' : urlParams;

            let table = $("#mcuProgramTable").DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                searching: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/get-data-mcu-program-company/' + companyId,
                    type: 'GET',
                    data: function(d) {

                    }
                },
                columns: [{
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'mcu_program_name',
                        name: 'mcu_program_name',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'company_name',
                        name: 'company_name',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'mcu_sum',
                        name: 'mcu_sum',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            let companyId = row.company_id;
                            let mcuProgramId = row.mcu_program_id;
                            return `<a class="btn btn-primary btn-sm action-detail" href="/mcu/program-mcu/detail?company_id=${companyId}&mcu_program_id=${mcuProgramId}"><i class="fas fa-eye"></i></a>
                                    <a class="btn btn-danger btn-sm action-delete"><i class="fas fa-trash"></i></a>
                                    <a class="btn btn-success btn-sm action-edit" data-id="${mcuProgramId}"><i class="fas fa-edit"></i></a>`;
                        }
                    }
                ],
                order: [
                    [1, 'asc']
                ],
                drawCallback: function(){
                    var role = @json(Auth::user()->id_role);
                    console.log(role);
                    if (role == 2) {
                        $('.action-delete').hide();
                    }
                }
            });

            $('#mcuProgramTable tbody').on('click', '.action-delete', function() {
                Swal.fire({
                    title: "Apakah anda akan menghapus data?",
                    showDenyButton: true,
                    confirmButtonText: "Ya",
                    denyButtonText: "Tidak"
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire("Berhasil menghapus data!", "", "success");
                        table.ajax.reload();
                    }
                });
            });

            $('#mcuProgramTable tbody').on('click', '.action-detail', function() {

            });

            $('#mcuProgramTable tbody').on('click', '.action-edit', function() {
                var company_id = $(this).attr('data-id');
                $.ajax({
                    url: '/mcu/program-mcu/detail/name/' + company_id,
                    method: 'GET',
                    success: function(response) {
                        if (response.status == 'error') {
                            var data = response.data
                            toastr.warning(data)
                        } else if (response.status == 'success') {
                            var data = response.data
                            console.log(data)
                            $("#modal_edit_program").modal("show");
                            $("#mcu_program_id").val(data.mcu_program_id);
                            $("#mcu_program_code").val(data.mcu_program_code);
                            $("#mcu_program_name").val(data.mcu_program_name);
                        }
                    },
                    error: function(response) {
                        toastr.error(
                            'Kesalahan terjadi, harap hubungi Admin kami')
                    }
                });
            });
        });
    </script>
@endsection
