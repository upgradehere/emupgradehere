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
            border-radius: 2px;
            /* Optional: for square corners */
        }

        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            /* Semi-transparent white */
            z-index: 1050;
            /* Above other content */
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    <div id="loading-overlay" class="d-none">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden"></span>
        </div>
    </div>
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
                        <div class="card-header">
                            @if (Auth::user()->id_role == 1 || Auth::user()->id_role == 4)
                                <a class="btn btn-primary btn-sm me-2 mb-2" data-toggle="modal" data-target="#modal-insert-manual"><i class="fas fa-edit"></i>&nbsp;&nbsp;Input Manual</a>
                                @if (Auth::user()->id_role == 1)
                                    <a class="btn btn-primary btn-sm me-2 mb-2" data-toggle="modal" data-target="#modal-import-mcu"><i class="fas fa-file-import"></i>&nbsp;&nbsp;Import MCU</a>
                                    <a class="btn btn-primary btn-sm me-2 mb-2" data-toggle="modal" data-target="#modal-upload-rekap"><i class="fas fa-file-import"></i>&nbsp;&nbsp;Import Pemeriksaan</a>
                                    <a class="btn btn-primary btn-sm me-2 mb-2" data-toggle="modal" data-target="#modal-upload-hasil"><i class="fas fa-images"></i>&nbsp;&nbsp;Upload Hasil</a>
                                    <a class="btn btn-primary btn-sm me-2 mb-2" data-toggle="modal" data-target="#modalConclusionSuggestion"><i class="fas fa-edit"></i>&nbsp;&nbsp;Kesimpulan & Saran</a>
                                    <a class="btn btn-primary btn-sm me-2 mb-2" id="sendPdf" data-url="{{ route('send-batch-pemeriksaan-mcu') }}"><i class="fas fa-paper-plane"></i>&nbsp;&nbsp;Kirim Hasil Pemeriksaan</a>
                                    <a class="btn btn-primary btn-sm me-2 mb-2" href="/mcu/program-mcu/download-template-pemeriksaan?company_id={{$company_id}}&mcu_program_id={{$mcu_program_id}}"><i class="fas fa-download"></i>&nbsp;&nbsp;Unduh Template Excel</a>
                                    <a href="{{ route('program-mcu.export-excel', ['program_id' => $mcu_program_name->mcu_program_id]) }}" class="btn btn-success"><i class="fa fa-file-excel"></i> Export Hasil MCU (.xlsx)</a>

                                @endif
                            @endif
                        </div>
                        <div class="card-body">
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
                                                <th style="width: 10px;">No</th>
                                                <th>No. MCU</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Departemen</th>
                                                <th>Jenis Kelamin</th>
                                                <th>Tanggal Lahir</th>
                                                <th>Tanggal MCU</th>
                                                <th style="width: 200px;">Aksi</th>
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
        <div class="modal fade" id="modalPrint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">

                    <!-- Header Modal -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cetak PDF</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <!-- Body Modal -->
                    <div class="modal-body text-center">
                        @if (Auth::user()->id_role == 1 || Auth::user()->id_role == 4)
                            <a id="btnCetakQrcode" target="_blank" href="" class="btn btn-success"><i
                                    class="fas fa-qrcode"></i>
                                Cetak  Barode</a>
                            <a id="btnCetakBlanko" target="_blank" href="" class="btn btn-success"><i
                                    class="fas fa-file"></i> Cetak
                                Blanko
                                Pemeriksaan</a>
                        @endif
                        <a id="btnCetakHasil" target="_blank" href="" class="btn btn-success"><i
                                class="fas fa-file-pdf"></i>
                            Cetak Hasil
                            Pemeriksaan</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    @include('mcu.partials.insert_manual')
    @include('mcu.partials.import_mcu')
    @include('mcu.partials.import_file_excel')
    @include('mcu.partials.upload_hasil')
    <script>
        $(function() {
            $('.summernote').summernote()

            let companyId = "{{ $company_id }}";
            let mcuProgramId = "{{ $mcu_program_id }}";
            let chartType = "{{ $chart_type }}";
            let chartValue = "{{ $chart_value }}";
            let chartAdditional = "{{ $chart_additional }}";
            var role = @json(Auth::user()->id_role);

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
                        d.chart_type = chartType;
                        d.chart_value = chartValue;
                        d.chart_additional = chartAdditional;
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
                        searchable: false,
                        orderable: true
                    },
                    {
                    data: 'dob',
                    name: 'dob',
                    searchable: false,
                    orderable: true,
                    render: function (data, type, row) {
                        if (!data) return '';

                        // Handle "YYYY-MM-DD HH:MM:SS" atau "YYYY-MM-DD"
                        var iso = data.split(' ')[0];             // ambil bagian tanggal saja
                        var p = iso.split('-');                   // ["YYYY","MM","DD"]

                        // Untuk sorting/type, kembalikan format ISO agar urutan benar
                        if (type === 'sort' || type === 'type') return iso;

                        if (p.length === 3) {
                        return p[2].padStart(2,'0') + '-' + p[1].padStart(2,'0') + '-' + p[0];
                        }
                        return data; // fallback kalau format tak terduga
                    }
                    },

                    {
                        data: 'mcu_date',
                        name: 'mcu_date',
                        searchable: false,
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
                            let sendPdfLink = "{{ route('send-single-pemeriksaan-mcu', ':id') }}";
                            sendPdfLink = sendPdfLink.replace(':id', mcuId);
                            var url =
                                "/mcu/program-mcu/detail/pemeriksaan/cetak-pemeriksaan?mcu_id=";
                            if (role == 1) {
                                return `<center>
                                    <a class="btn btn-primary btn-sm action-detail" href="/mcu/program-mcu/detail/pemeriksaan?mcu_id=${mcuId}&employee_id=${employeeId}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a class="btn btn-success btn-print-pdf btn-sm action-export" data-toggle="modal" data-target="#modalPrint" data-mcuid="${mcuId}" data-url="/mcu/program-mcu/detail/pemeriksaan" target="_blank">
                                        <i class="fas fa-file-pdf"></i>
                                    </a>
                                    <a class="btn btn-info btn-sm action-edit-employee" href="/employee/detail/${employeeId}">
                                        <i class="fas fa-user-edit"></i>
                                    </a>
                                    <a class="btn btn-warning btn-sm action-send-mcu" href="${sendPdfLink}">
                                        <i class="fas fa-paper-plane"></i>
                                    </a>
                                    <a class="btn btn-danger btn-sm action-delete-mcu" data-mcu-id="${mcuId}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </center>`;
                            } else if (role == 2) {
                                return `<center><a class="btn btn-primary btn-sm action-detail" href="/mcu/program-mcu/detail/pemeriksaan?mcu_id=${mcuId}&employee_id=${employeeId}"><i class="fas fa-eye"></i></a>
                                        <a href="${url}${mcuId}" class="btn btn-success btn-print-pdf btn-sm action-export" data-toggle="" data-target="" data-mcuid="${mcuId}" target="_blank"><i class="fas fa-file-pdf"></i></a></center>`
                            } else if (role == 3 || role == 5) {
                                return `<center><a class="btn btn-primary btn-sm action-detail" href="/mcu/program-mcu/detail/pemeriksaan?mcu_id=${mcuId}&employee_id=${employeeId}"><i class="fas fa-eye"></i></a>
                                        <a href="${url}${mcuId}" class="btn btn-success btn-print-pdf btn-sm action-export" data-toggle="" data-target="" data-mcuid="${mcuId}" target="_blank"><i class="fas fa-file-pdf"></i></a></center>`
                            } else {
                                return `<center><a class="btn btn-primary btn-sm action-detail" href="/mcu/program-mcu/detail/pemeriksaan?mcu_id=${mcuId}&employee_id=${employeeId}"><i class="fas fa-eye"></i></a>
                                        <a class="btn btn-success btn-print-pdf btn-sm action-export" data-toggle="modal" data-target="#modalPrint" data-mcuid="${mcuId}" data-url="/mcu/program-mcu/detail/pemeriksaan" target="_blank"><i class="fas fa-file-pdf"></i></a></center>`;
                            }
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
                drawCallback: function() {
                    var role = @json(Auth::user()->id_role);
                    if (role == 2) {
                        $('.action-delete-mcu').hide();
                    }
                }
            });

            $(document).on('click', '.btn-print-pdf', function() {
                var url = $(this).attr("data-url");
                var mcuId = $(this).attr("data-mcuid");

                $("#btnCetakQrcode").attr("href", url + "/cetak-barcode?mcu_id=" + mcuId);
                $("#btnCetakBlanko").attr("href", url + "/cetak-blanko?mcu_id=" + mcuId);
                $("#btnCetakHasil").attr("href", url + "/cetak-pemeriksaan?mcu_id=" + mcuId);
            });

            $(document).on('click', '#sendPdf', function() {
                Swal.fire({
                    title: "Perhatian",
                    html: "Apakah anda yakin akan mengirim semua hasil pemeriksaan pada semua karyawan di program ini?",
                    icon: "warning",
                    showDenyButton: true,
                    confirmButtonText: "Ya",
                    denyButtonText: "Tidak"
                }).then((result) => {
                    if (result.isConfirmed) {
                        const loadingOverlay = document.getElementById('loading-overlay');
                        const showLoaderBtn = document.getElementById('show-loader');
                        loadingOverlay.classList.remove('d-none');
                        var url = $(this).attr('data-url');
                        $.ajax({
                            url: url,
                            method: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}",
                                mcu_program_id: "{{ $mcu_program_id }}"
                            },
                            success: function(response) {
                                loadingOverlay.classList.add('d-none');
                                var data = response.data
                                if (response.status == 'error') {
                                    toastr.error(data)
                                } else if (response.status == 'success') {
                                    toastr.success(data)
                                }
                            },
                            error: function(response) {
                                loadingOverlay.classList.add('d-none');
                                toastr.error(
                                    'Kesalahan terjadi, harap hubungi Admin kami.')
                            }
                        });
                    }
                });
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
