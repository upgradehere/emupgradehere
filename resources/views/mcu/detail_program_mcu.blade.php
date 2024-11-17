@extends('templates/template')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Program MCU</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">MCU</li>
                        <li class="breadcrumb-item active">Informasi MCU</li>
                        <li class="breadcrumb-item active">Detail</li>
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
                            <h3 class="card-title">Data Perusahaan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <h6>Nama Perusahaan</h6>
                                    <h5>{{ $company_name }}</h5>
                                </div>
                                <div class="col-3">
                                    <h6>Nama Program</h6>
                                    <h5>{{ $mcu_program_name }}</h5>
                                </div>
                                <div class="col-3">
                                    <h6>Jumlah Hasil MCU</h6>
                                    <h5>{{ $mcu_sum }}</h5>
                                </div>
                                <div class="col-3">
                                    <h6>Status Program</h6>
                                    <h5>-</h5>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Input Hasil MCU</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <button type="button" class="btn btn-block bg-gradient-primary">Input Manual Hasil MCU</button>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-block bg-gradient-primary">Upload Data & Rekap Hasil MCU</button>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-block bg-gradient-primary">Upload Foto Pemeriksaan MCU</button>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-block bg-gradient-primary">Upload Foto Peserta MCU</button>
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-block bg-gradient-primary">Edit Kesimpulan & Saran</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pemeriksaan MCU Peserta</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <button type="button" class="btn btn-block bg-gradient-primary">Export</button>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12">
                                    <table id="mcuEmployeeTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 30px;">No</th>
                                                <th>No. MCU</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Departemen</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Umur</th>
                                                <th>Tanggal MCU</th>
                                                <th style="width: 80px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(function() {
            let companyId = "{{ $company_id }}";
            let mcuProgramId = "{{ $mcu_program_id }}";
            console.log(companyId);

            let table = $("#mcuEmployeeTable").DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                searching: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/api/mcu/program-mcu/get-data-mcu-employee',
                    type: 'GET',
                    data: function(d) {
                        d.company_id = companyId;
                        d.mcu_program_id = mcuProgramId;
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
                        data: 'mcu_code',
                        name: 'mcu_code',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'nik',
                        name: 'nik',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'employee_name',
                        name: 'employee_name',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'departement_name',
                        name: 'departement_name',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'sex',
                        name: 'sex',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'age',
                        name: 'age',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'mcu_date',
                        name: 'mcu_date',
                        searchable: true,
                        orderable: true,
                        render: function(data, type, row) {
                        if (data) {
                            var date = new Date(data);
                            var formattedDate = date.getFullYear() + '/' + (date.getMonth() + 1).toString().padStart(2, '0') + '/' + date.getDate().toString().padStart(2, '0');
                            return formattedDate;
                        }
                        return '';
                    }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `<button class="btn btn-primary btn-sm action-detail"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-danger btn-sm action-delete"><i class="fas fa-trash"></i></button>`;
                        }
                    }
                ],
                order: [
                    [1, 'asc']
                ],
            });

            $('#mcuEmployeeTable tbody').on('click', '.action-delete', function() {
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
        });
    </script>
@endsection
