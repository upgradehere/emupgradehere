@extends('templates/template')
@section('content')
    <style>
        .custom-hr {
            height: 3px;
            background-color: black;
            border: none;
            margin: 10px 0;
        }
    </style>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pegawai</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item">Perusahaan</li>
                        <li class="breadcrumb-item active">Pegawai</li>
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
                            <h3 class="card-title">Daftar Pegawai</h3> <br>
                        </div>
                        <div class="card-header">
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-add">+ Tambah
                                Pegawai Baru</button>
                            @if (isset($_GET['company-id']))
                                <a href="{{ route('employee') }}" class="btn btn-primary btn-sm">Tampilkan Semua Pegawai
                                    Dari
                                    Semua Perusahaan</a>
                            @endif
                            <button class="btn btn-warning btn-sm" id="btnImportPhoto">Import Zip
                                Foto Pegawai</button>
                            <form action="{{ route('employee.import-photo') }}" style="display:none" id="importPhoto"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="file" accept=".zip" name="photos" id="import_photo">
                            </form>
                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalImportExcel">Import
                                Excel Data Pegawai</button>
                            <a href="#" id="btnDownloadTemplate">Download Template Excel</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="employeeTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">No</th>
                                        <th>NIK</th>
                                        <th>Nama Pegawai</th>
                                        <th>Perusahaan</th>
                                        <th style="width: 80px;"><i class="fas fa-cogs"></i></th>
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
        <div class="modal fade" id="modal-add">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Pegawai Baru</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('employee.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Perusahaan</label>
                                <select name="company_id" id="company_id" class="form-control" required>
                                    <option value="">-- Pilih Perusahaan --</option>
                                    @foreach ($company as $cp)
                                        <option value="{{ $cp->company_id }}">{{ $cp->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Pegawai</label>
                                <input type="text" required name="employee_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Kode Pegawai</label>
                                <input type="text" required name="employee_code" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">NIK</label>
                                <input type="text" required name="nik" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">No Whatsapp</label>
                                <input type="text" required name="phone_number" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" required name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Lahir</label>
                                <input type="date" required name="dob" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <select name="sex" id="" class="form-control" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="11">Laki Laki</option>
                                    <option value="12">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Departemen</label>
                                <select name="departement_id" id="departement_id" class="form-control" required>
                                    <option value="">-- Pilih Departement --</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Foto</label>
                                <input type="file" name="photo" accept="image/*" class="form-control">
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Penghapusan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus pegawai ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalImportExcel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalImportExcelLabel">Import Excel Pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('employee.import-employee') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <select name="company_id" required class="form-control" id="">
                                <option value="">-- Pilih Perusahaan --</option>
                                @foreach ($company as $c)
                                    <option value="{{ $c->company_id }}"
                                        {{ isset($_GET['company-id']) && $_GET['company-id'] == $c->company_id ? 'selected' : '' }}>
                                        {{ $c->company_name }}</option>
                                @endforeach
                            </select>
                            <br>
                            <input type="file" name="file" class="form-control" required accept=".xls,.xlsx">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(function() {
            const urlParams = new URLSearchParams(window.location.search);
            const companyId = urlParams.get('company-id');

            if (companyId) {
                setTimeout(function() {
                    $('#company_id').val(companyId).trigger('change');
                }, 100);
            }

            let table = $("#employeeTable").DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                searching: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/employee/data/<?php echo $company_id; ?>',
                    type: 'GET',
                    data: function(d) {

                    }
                },
                columns: [{
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            console.log(data)
                            return meta.row + 1;
                        }
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
                        data: 'company.company_name',
                        name: 'company.company_name',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            var employee_id = row.employee_id;
                            var delete_url = "{{ route('employee.delete', ['id' => '__id__']) }}";
                            delete_url = delete_url.replace('__id__', employee_id);
                            return `<a class="btn btn-primary btn-sm action-detail" href="/employee/detail/${employee_id}"><i class="fas fa-eye"></i></a>
                                    <a class="btn btn-danger btn-sm action-delete" data-url="${delete_url}"><i class="fas fa-trash"></i></a>`;
                        }
                    }
                ],
                order: [
                    [1, 'asc']
                ],
            });

            $('#employeeTable tbody').on('click', '.action-delete', function() {
                Swal.fire({
                    title: "Apakah anda akan menghapus data?",
                    showDenyButton: true,
                    confirmButtonText: "Ya",
                    denyButtonText: "Tidak"
                }).then((result) => {
                    if (result.isConfirmed) {
                        var url = $(this).attr('data-url');
                        $.ajax({
                            url: url,
                            method: 'GET',
                            success: function(response) {
                                if (response.status == 'error') {
                                    var data = response.data
                                    if (Array.isArray(data)) {
                                        $.each(data, function(index, value) {
                                            toastr.warning(value)
                                        })
                                    } else {
                                        toastr.warning(data)
                                    }
                                } else if (response.status == 'success') {
                                    toastr.success('Data berhasil dihapus!')
                                    table.ajax.reload();
                                }
                            },
                            error: function(response) {
                                toastr.error(
                                    'Kesalahan terjadi, harap hubungi Admin kami')
                            }
                        });
                    }
                });
            });

            $('#company_id').on('change', function() {
                var val = $(this).val();
                $.ajax({
                    url: 'departement/show/' + val,
                    method: 'GET',
                    success: function(response) {
                        if (response.status == 'error') {
                            var data = response.data
                            if (Array.isArray(data)) {
                                $.each(data, function(index, value) {
                                    toastr.warning(value)
                                })
                            } else {
                                toastr.warning(data)
                            }
                        } else if (response.status == 'success') {
                            const newOptions = response.data;

                            updateSelectOptions('#departement_id', newOptions);
                        }
                    },
                    error: function(response) {
                        toastr.error('Kesalahan terjadi, harap hubungi Admin kami')
                    }
                });
            });

            $('#btnDownloadTemplate').click(function() {
                const data = [
                    ['Kode Pegawai', 'Nama Pegawai', 'NIK', 'Kode Departemen', 'Tanggal Lahir',
                        'No Telp', 'Jenis Kelamin', 'Email'
                    ],
                    ['XX01', 'Putra', '1234567890', 'D01', '2000-12-31', '081234567890', 'Pria',
                        'xx@xx.com'
                    ],
                    ['XX02', 'Putri', '1234567890', 'D02', '2000-12-31', '081234567890', 'Wanita',
                        'xx@xx.com'
                    ],
                ];

                const ws = XLSX.utils.aoa_to_sheet(data);
                const wb = XLSX.utils.book_new();
                XLSX.utils.book_append_sheet(wb, ws, 'template');

                XLSX.writeFile(wb, 'EM Health - Import Excel Pegawai.xlsx');
            });

            const btnImportPhoto = document.getElementById("btnImportPhoto");
            const importPhotoInput = document.getElementById("import_photo");
            const importPhotoForm = document.getElementById("importPhoto");

            btnImportPhoto.addEventListener("click", function() {
                importPhotoInput.click();
            });

            importPhotoInput.addEventListener("change", function() {
                if (this.files.length > 0) {
                    importPhotoForm.submit();
                }
            });

            function updateSelectOptions(selectId, options) {
                const $select = $(selectId);

                $select.empty();

                $.each(options, function(index, option) {
                    $select.append(
                        $('<option>', {
                            value: option.departement_id,
                            text: option.departement_name
                        })
                    );
                });
            }

            @if (session('swal'))
                const data = @json(session('swal'))

                const content = data.map((item, index) => `${index + 1}. ${item}`).join('<br>');

                Swal.fire({
                    title: 'NIK Yang Tidak Ditemukan',
                    html: content,
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
@endsection
