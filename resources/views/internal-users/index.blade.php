@extends('templates/template')
@section('content')
    <style>
        .custom-hr {
            height: 3px;
            /* Set the thickness */
            background-color: black;
            /* Set the color */
            border: none;
            /* Remove the default border */
            margin: 10px 0;
            /* Optional: Adjust spacing */
        }
    </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Internal Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item active">Internal Users</li>
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
                            <h3 class="card-title">Daftar Internal User</h3> <br>
                        </div>
                        <div class="card-header">
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-add">+ Tambah
                                Internal User</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="usersTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role</th>
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
                        <h4 class="modal-title">Tambah Internal User Baru</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('internal-users.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama</label>
                                <input type="text" required name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" required name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">No Telp</label>
                                <input type="text" required name="phone_number" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Role</label>
                                <select name="id_role" required class="form-control" id="id_role">
                                    <option value="">-- Pilih Role --</option>
                                    <option value="1">Super Admin</option>
                                    <option value="11">Small Admin</option>
                                    <option value="3">Checker</option>
                                    <option value="4">CSO</option>
                                </select>
                            </div>
                            <div class="form-group d-none" id="examination_type_form">
                                <label for="">Pemeriksaan</label>
                                <select name="examination_type" class="form-control" id="examination_type">
                                    <option value="">-- Pilih Pemeriksaan --</option>
                                    @foreach ($examinations as $ex)
                                        <option value="{{ $ex->lookup_id }}">{{ $ex->lookup_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group d-none" id="id_company_form">
                                <label for="">Perusahaan</label>
                                <select name="id_company" class="form-control" id="id_company">
                                    <option value="">-- Pilih Perusahaan --</option>
                                    @foreach ($company as $cp)
                                        <option value="{{ $cp->company_id }}">{{ $cp->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" required id="password" name="password" class="form-control">
                            </div>
                            <ul id="passwordRules" style="color: red;">
                                <li id="minLength">Minimal 8 Karakter</li>
                                <li id="uppercase">Harus memiliki huruf besar dan kecil</li>
                                <li id="number">Harus mengandung angka</li>
                                <li id="specialChar">Harus memiliki spesial karakter (!@#$%^&*)</li>
                            </ul>
                            

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" id="saveButton" >Simpan</button>
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
                        Apakah Anda yakin ingin menghapus dokter ini?
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
            let table = $("#usersTable").DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                searching: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/internal-users/get-data',
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
                        data: 'name',
                        name: 'name',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'email',
                        name: 'email',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'role',
                        name: 'role',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            var user_id = row.id;
                            var delete_url = "{{ route('internal-users.delete', ['id' => '__id__']) }}";
                            delete_url = delete_url.replace('__id__', user_id);
                            return `<a class="btn btn-primary btn-sm action-detail" href="/internal-users/detail/${user_id}"><i class="fas fa-pencil-alt"></i></a>
                                    <a class="btn btn-danger btn-sm action-delete" data-url="${delete_url}"><i class="fas fa-trash"></i></a>`;
                        }
                    }
                ],
                order: [
                    [1, 'asc']
                ],
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

            $(document).on("change", "#id_role", function(){
                var val = $(this).val();

                if (val == 3) {
                    $("#examination_type_form").removeClass("d-none");
                    $("#examination_type").attr('required', true);

                    $("#id_company_form").addClass("d-none");
                    $("#id_company").attr('required', false);
                } else if (val == 11) {
                    $("#id_company_form").removeClass("d-none");
                    $("#id_company").attr('required', true);

                    $("#examination_type_form").addClass("d-none");
                    $("#examination_type").attr('required', false);
                } else {
                    $("#examination_type_form").addClass("d-none");
                    $("#examination_type").attr('required', false);

                    $("#id_company_form").addClass("d-none");
                    $("#id_company").attr('required', false);
                }
            });

            $('#usersTable tbody').on('click', '.action-delete', function() {
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
