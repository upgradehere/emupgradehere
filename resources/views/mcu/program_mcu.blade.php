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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
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
            $("#mcuProgramTable").DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                searching: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/api/mcu/program-mcu/get-data-mcu-program-company',
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
                            return `<button class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>`;
                        }
                    }
                ],
                order: [
                    [1, 'asc']
                ],
            });
        });
    </script>
@endsection
