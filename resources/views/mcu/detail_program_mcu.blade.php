@extends('templates/template')
@section('content')
    <style>
        .legend-container {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .legend-item {
            display: flex;
            align-items: center;
            font-size: 14px;
            color: #333;
        }

        .legend-color {
            width: 30px;
            height: 20px;
            background-color: #7FFFD4;
            margin-right: 8px;
            border-radius: 2px; /* Optional: for square corners */
        }
    </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Program MCU</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">MCU</li>
                        <li class="breadcrumb-item active">Informasi MCU</li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Perusahaan</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <h6>Nama Perusahaan</h6>
                                    <h5>{{ $company_name }}</h5>
                                </div>
                                <div class="col-3">
                                    <h6>Nama Program</h6>
                                    <h5>{{ $mcu_program_name->mcu_program_name }}</h5>
                                </div>
                                <div class="col-3">
                                    <h6>Jumlah Peserta</h6>
                                    <h5>{{ $employee_sum }}</h5>
                                </div>
                                <div class="col-3">
                                    <h6>Jumlah Hasil MCU</h6>
                                    <h5>{{ $mcu_sum }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pemeriksaan MCU Peserta</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <a class="btn btn-block bg-gradient-primary auto-size-btn" data-toggle="modal"
                                        data-target="#modal-insert-manual"><i class="fas fa-edit"></i>&nbsp;&nbsp;Input
                                        Manual</a>
                                </div>
                                <div class="col-2">
                                    <a class="btn btn-block bg-gradient-primary auto-size-btn" data-toggle="modal"
                                        data-target="#modal-upload-rekap"><i
                                            class="fas fa-file-import"></i>&nbsp;&nbsp;Import Pemeriksaan</a>
                                </div>
                                <div class="col-2">
                                    <a class="btn btn-block bg-gradient-primary auto-size-btn" data-toggle="modal"
                                        data-target="#modal-upload-hasil"><i class="fas fa-images"></i>&nbsp;&nbsp;Upload
                                        Hasil</a>
                                </div>
                                <div class="col-2">
                                    <a data-toggle="modal" data-target="#modalConclusionSuggestion"
                                        class="btn btn-block bg-gradient-primary auto-size-btn"><i
                                            class="fas fa-edit"></i>&nbsp;&nbsp;Kesimpulan & Saran</a>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-12">
                                    <div class="legend-container">
                                        <div class="legend-item">
                                            <span class="legend-color"></span>
                                            <span>Data MCU Import</span>
                                        </div>
                                    </div>
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
                                                <th style="width: 100px;">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalConclusionSuggestion">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Kesimpulan & Saran</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('program-mcu-save-conclusion-suggestion') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $_GET['mcu_program_id'] }}" name="id">
                            <div class="form-group">
                                <label for="">Kesimpulan</label>
                                <div class="card-body">
                                    <textarea required class="summernote" name="conclusion">
                                        {{ $mcu_program_name->conclusion }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Saran</label>
                                <div class="card-body">
                                    <textarea required class="summernote" name="suggestion">
                                        {{ $mcu_program_name->suggestion }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" id="saveButton">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </section>
    @include('mcu.partials.insert_manual')
    @include('mcu.partials.import_file_excel')
    @include('mcu.partials.upload_hasil')
    <script>
        $(function() {
            $('.summernote').summernote()

            let companyId = "{{ $company_id }}";
            let mcuProgramId = "{{ $mcu_program_id }}";
            let table = $("#mcuEmployeeTable").DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                searching: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/get-data-mcu-employee',
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
                                var formattedDate = date.getFullYear() + '/' + (date.getMonth() + 1)
                                    .toString().padStart(2, '0') + '/' + date.getDate().toString()
                                    .padStart(2, '0');
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
                            let mcuId = row.mcu_id;
                            let employeeId = row.employee_id;
                            return `<a class="btn btn-primary btn-sm action-detail" href="/mcu/program-mcu/detail/pemeriksaan?mcu_id=${mcuId}&employee_id=${employeeId}"><i class="fas fa-eye"></i></a>
                                    <a class="btn btn-success btn-sm action-export" href="/mcu/program-mcu/detail/pemeriksaan/cetak-pemeriksaan?mcu_id=${mcuId}" target="_blank"><i class="fas fa-file-pdf"></i></a>
                                    <a class="btn btn-danger btn-sm action-delete-mcu" data-mcu-id="${mcuId}"><i class="fas fa-trash"></i></a>`;
                        }
                    }
                ],
                order: [
                    [1, 'asc']
                ],
                rowCallback: function(row, data) {
                    if (data.is_import == true) {
                        $(row).css('background-color', '#7FFFD4');
                    }
                },
                drawCallback: function(){
                    var role = @json(Auth::user()->id_role);
                    console.log(role);
                    if (role == 2) {
                        $('.action-delete-mcu').hide();
                    }
                }
            });

            $('#mcuEmployeeTable tbody').on('click', '.action-delete-mcu', function() {
                let button = $(this);
                let mcuId = button.data('mcu-id');

                Swal.fire({
                    icon: 'warning',
                    title: 'Perhatian!',
                    text: "Apakah anda akan menghapus data?",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Hapus',
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/mcu/program-mcu/detail/pemeriksaan/delete-pemeriksaan?mcu_id=${mcuId}`,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function(response) {
                                Swal.fire("Berhasil!", "Data telah dihapus.",
                                    "success");
                                table.ajax.reload();
                            },
                            error: function() {
                                Swal.fire("Gagal!",
                                    "Terjadi kesalahan saat menghapus data.",
                                    "error");
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
