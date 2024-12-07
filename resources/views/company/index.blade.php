@extends('templates/template')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Perusahaan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item active">Perusahaan</li>
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
                            <h3 class="card-title">Daftar Perusahaan</h3> <br>
                        </div>
                        <div class="card-header">
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-add">+ Tambah
                                Perusahaan Baru</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="companyTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">No</th>
                                        <th>Nama Perusahaan</th>
                                        <th>Kode Perusahaan</th>
                                        <th>Jumlah Program</th>
                                        <th>Jumlah MCU</th>
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
                        <h4 class="modal-title">Tambah Perusahaan Baru</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('company.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Perusahaan</label>
                                <input type="text" required name="company_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Kode Perusahaan</label>
                                <input type="text" required name="company_code" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">NPWP Perusahaan</label>
                                <input type="text" required name="npwp_company_number" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">PIC Perusahaan</label>
                                <input type="text" required name="pic_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Email PIC Perusahaan</label>
                                <input type="email" required name="pic_email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">No Telp PIC Perusahaan</label>
                                <input type="text" required name="pic_phone_number" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat Perusahaan</label>
                                <textarea required name="company_address" id="" class="form-control" cols="30" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Password Default PIC</label>
                                <input type="password" required name="password" id="password" class="form-control">
                            </div>
                            <ul id="passwordRules" style="color: red;">
                                <li id="minLength">Minimal 8 Karakter</li>
                                <li id="uppercase">Harus memiliki huruf besar dan kecil</li>
                                <li id="number">Harus mengandung angka</li>
                                <li id="specialChar">Harus memiliki spesial karakter (!@#$%^&*)</li>
                            </ul>

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
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Penghapusan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus perusahaan ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(function() {
            const passwordInput = $("#password");
            const rules = {
                minLength: $("#minLength"),
                uppercase: $("#uppercase"),
                number: $("#number"),
                specialChar: $("#specialChar")
            };
            const submitButton = $("#saveButton");

            passwordInput.on("keyup", function() {
                const password = passwordInput.val();

                let isValid = true; // Assume password is valid, check rules to confirm

                // Check each rule
                if (password.length >= 8) {
                    rules.minLength.css("color", "green");
                } else {
                    rules.minLength.css("color", "red");
                    isValid = false;
                }

                if (/[A-Z]/.test(password)) {
                    rules.uppercase.css("color", "green");
                } else {
                    rules.uppercase.css("color", "red");
                    isValid = false;
                }

                if (/[0-9]/.test(password)) {
                    rules.number.css("color", "green");
                } else {
                    rules.number.css("color", "red");
                    isValid = false;
                }

                if (/[!@#$%^&*]/.test(password)) {
                    rules.specialChar.css("color", "green");
                } else {
                    rules.specialChar.css("color", "red");
                    isValid = false;
                }

                // Enable or disable the submit button based on validity
                if (isValid) {
                    submitButton.prop("disabled", false);
                } else {
                    submitButton.prop("disabled", true);
                }
            });

            let table = $("#companyTable").DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                searching: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: 'get-data-company',
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
                        data: 'company_name',
                        name: 'company_name',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'company_code',
                        name: 'company_code',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'total_program',
                        name: 'total_program',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'total_mcu',
                        name: 'total_mcu',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            var company_id = row.company_id;
                            var delete_url = "{{ route('company.delete', ['id' => '__id__']) }}";
                            delete_url = delete_url.replace('__id__', company_id);
                            return `<a class="btn btn-primary btn-sm action-detail" href="/company/detail/${company_id}"><i class="fas fa-eye"></i></a>
                                    <a class="btn btn-danger btn-sm action-delete" data-url="${delete_url}"><i class="fas fa-trash"></i></a>`;
                        }
                    }
                ],
                order: [
                    [1, 'asc']
                ],
            });

            $('#companyTable tbody').on('click', '.action-delete', function() {
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
        });
    </script>
@endsection
