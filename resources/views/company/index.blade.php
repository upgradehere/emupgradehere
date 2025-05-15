@extends('templates/template')
@section('content')
    <style>
        .disabled-link {
            pointer-events: none;
            color: white;
            border-color: gray;
            background-color: gray;
            text-decoration: none;
        }
    </style>
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
                                        <th>Departemen</th>
                                        <th style="width: 50px;">Program</th>
                                        <th style="width: 150px;"><i class="fas fa-cogs"></i></th>
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
                        <form action="{{ route('company.store') }}" method="POST" enctype="multipart/form-data">
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
                                <label for="">Kop Perusahaan</label><br>
                                <input type="file" name="letterhead" id="letterhead" accept=".jpg,.png" required><br>
                                <i class="fas fa-question-circle" data-toggle="modal" data-target="#modal-panduan"></i><span
                                    style="color:red"> Lihat
                                    panduan file Kop</span>
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
        <div class="modal fade" id="modal-reset">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Reset Password PIC Perusahaan</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('company.reset') }}" method="POST">
                            @csrf
                            <input type="hidden" id="company_id" name="company_id">
                            <div class="form-group">
                                <label for="">Password Default PIC</label>
                                <input type="password" required name="password_reset" id="password_reset"
                                    class="form-control">
                            </div>
                            <ul id="passwordRules_reset" style="color: red;">
                                <li id="minLength_reset">Minimal 8 Karakter</li>
                                <li id="uppercase_reset">Harus memiliki huruf besar dan kecil</li>
                                <li id="number_reset">Harus mengandung angka</li>
                                <li id="specialChar_reset">Harus memiliki spesial karakter (!@#$%^&*)</li>
                            </ul>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" id="saveButton_reset">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="modal-panduan">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Panduan File Kop</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="">Berikut panduan untuk upload file Kop</label><br>
                        <ul>
                            <li>Maksimal file size 100KB</li>
                            <li>Margin atas yang disarankan adalah 4cm</li>
                            <li>Margin bawah yang disarankan adalah 4cm</li>
                            <li>Margin kiri yang disarankan adalah 1cm</li>
                            <li>Margin kanan yang disarankan adalah 1cm</li>
                        </ul>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </section>
    <script>
        $(function() {
            var id_company = "<?php echo $id_company; ?>";

            $('#modal-panduan').on('hidden.bs.modal', function() {
                $('body').removeClass('modal-open');
                $('body').css('overflow', 'auto');
            });

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

            const passwordInput_reset = $("#password_reset");
            const rules_reset = {
                minLength_reset: $("#minLength_reset"),
                uppercase_reset: $("#uppercase_reset"),
                number_reset: $("#number_reset"),
                specialChar_reset: $("#specialChar_reset")
            };
            const submitButton_reset = $("#saveButton_reset");

            passwordInput_reset.on("keyup", function() {
                const password_reset = passwordInput_reset.val();

                let isValid_reset = true; // Assume password is valid, check rules to confirm

                // Check each rule
                if (password_reset.length >= 8) {
                    rules_reset.minLength_reset.css("color", "green");
                } else {
                    rules_reset.minLength_reset.css("color", "red");
                    isValid_reset = false;
                }

                if (/[A-Z]/.test(password_reset)) {
                    rules_reset.uppercase_reset.css("color", "green");
                } else {
                    rules_reset.uppercase_reset.css("color", "red");
                    isValid_reset = false;
                }

                if (/[0-9]/.test(password_reset)) {
                    rules_reset.number_reset.css("color", "green");
                } else {
                    rules_reset.number_reset.css("color", "red");
                    isValid_reset = false;
                }

                if (/[!@#$%^&*]/.test(password_reset)) {
                    rules_reset.specialChar_reset.css("color", "green");
                } else {
                    rules_reset.specialChar_reset.css("color", "red");
                    isValid = false;
                }

                // Enable or disable the submit button based on validity
                if (isValid_reset) {
                    submitButton_reset.prop("disabled", false);
                } else {
                    submitButton_reset.prop("disabled", true);
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
                            if (id_company == company_id) {
                                return `<a class="btn btn-success btn-sm" href="/departement?company-id=${company_id}"><i class="fas fa-list"></i> List</a>`;
                            } else {
                                return `<a class="btn btn-success btn-sm disabled-link" href=""><i class="fas fa-list"></i> List</a>`;
                            }
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            var company_id = row.company_id;
                            if (id_company == company_id) {
                                return `<a class="btn btn-success btn-sm" href="/mcu/program-mcu?company-id=${company_id}"><i class="fas fa-list"></i> List</a>`;
                            } else {
                                return `<a class="btn btn-success btn-sm disabled-link" href=""><i class="fas fa-list"></i> List</a>`;
                            }
                        }
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
                                    <a class="btn btn-warning btn-sm" href="/employee?company-id=${company_id}"><i class="fas fa-users"></i></a>
                                    <a class="btn btn-danger btn-sm action-delete" data-url="${delete_url}"><i class="fas fa-trash"></i></a>
                                    <a class="btn btn-success btn-sm action-reset" data-id="${company_id}"><i class="fas fa-key"></i></a>`;
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

            $(document).on("click", ".action-reset", function() {
                var id = $(this).attr("data-id");
                $("#company_id").val(id);

                $("#modal-reset").modal("show");
            });
        });
    </script>
@endsection
