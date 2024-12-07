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
                            <h3 class="card-title">Daftar Program MCU</h3>
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
                                        <th style="width: 80px;">Aksi</th>
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
    </section>
    <script>
        $(function() {
            let table = $("#mcuProgramTable").DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                searching: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/get-data-mcu-program-company',
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
                        <a class="btn btn-danger btn-sm action-delete"><i class="fas fa-trash"></i></a>`;
                        }
                    }
                ],
                order: [
                    [1, 'asc']
                ],
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
        });
    </script>
@endsection
