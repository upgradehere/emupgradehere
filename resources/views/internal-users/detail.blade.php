@extends('templates/template')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Internal Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('internal-users') }}">Internal Users</a></li>
                        <li class="breadcrumb-item active">Detail Internal Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('internal-users.update') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $user->id }}" name="id">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" required name="name" value="{{ $user->name }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" required name="email" value="{{ $user->email }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">No Telp</label>
                                    <input type="text" required name="phone_number" value="{{ $user->phone_number }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Role</label>
                                    <select name="id_role" required class="form-control" id="id_role">
                                        <option value="">-- Pilih Role --</option>
                                        <option {{ ($user->id_role == 1) ? 'selected' : ''}}  value="1">Super Admin</option>
                                        {{-- <option {{ ($user->id_role == 1 && !empty($user->id_company)) ? 'selected' : ''}}  value="11">Small Admin</option> --}}
                                        <option {{ ($user->id_role == 3) ? 'selected' : ''}}  value="3">Checker</option>
                                        <option {{ ($user->id_role == 4) ? 'selected' : ''}}  value="4">CSO</option>
                                    </select>
                                </div>
                                <div class="form-group {{ ($user->id_role == 3) ? '' : 'd-none' }}" id="examination_type_form">
                                    <label for="">Pemeriksaan</label>
                                    <select name="examination_type" class="form-control" id="examination_type">
                                        <option value="">-- Pilih Pemeriksaan --</option>
                                        @foreach ($examinations as $ex)
                                            <option {{ ($user->id_role == 3 && $user->examination_type == $ex->lookup_id) ? 'selected' : '' }} value="{{ $ex->lookup_id }}">{{ $ex->lookup_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group {{ ($user->id_role == 1 && !empty($user->id_company)) ? '' : 'd-none' }}" id="id_company_form">
                                    <label for="">Perusahaan</label>
                                    <select name="id_company" class="form-control" id="id_company">
                                        <option value="">-- Pilih Perusahaan --</option>
                                        @foreach ($company as $cp)
                                            <option {{ ($user->id_role == 1 && !empty($user->id_company) && $user->id_company == $cp->company_id) ? 'selected' : '' }} value="{{ $cp->company_id }}">{{ $cp->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" placeholder="Isi jika ingin me-reset password user ini" id="password" name="password" class="form-control">
                                </div>
                                <ul id="passwordRules" style="color: red;">
                                    <li id="minLength">Minimal 8 Karakter</li>
                                    <li id="uppercase">Harus memiliki huruf besar dan kecil</li>
                                    <li id="number">Harus mengandung angka</li>
                                    <li id="specialChar">Harus memiliki spesial karakter (!@#$%^&*)</li>
                                </ul>
                            </div>

                            <div class="card-footer">
                                <button type="submit" id="saveButton" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function(){
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
    </script>
@endsection
