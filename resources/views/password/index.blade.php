@extends('templates/template')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Password</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item active">Ganti Password</li>
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
                            <h3 class="card-title">Ganti Password</h3> <br>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('change-password.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Password Lama</label>
                                    <input type="password" required name="old_password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Password Baru</label>
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
                        <!-- /.card-body -->
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
        });
    </script>
@endsection
