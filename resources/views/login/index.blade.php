<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AdminLTE 3 | Log in</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('templates/adminlte-3.2.0/plugins/fontawesome-free/css/all.min.css') }}">
        <!-- icheck bootstrap -->
        <link rel="stylesheet" href="{{ asset('templates/adminlte-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('templates/adminlte-3.2.0/dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('templates/adminlte-3.2.0/plugins/toastr/toastr.min.css') }}">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <h1>EM Health</h1>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div id="card_cred" class="card-body login-card-body d-none">
                    <form data-action="{{ route('login.check') }}" id="cred_form" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
                <div id="card_otp" class="card-body login-card-body">
                    <p class="login-box-msg">Kami telah mengirimkan kode OTP ke email anda</p>
                    <form action="{{ route('login.otp') }}" id="otp_form" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="number" name="otp" id="otp" class="form-control" placeholder="OTP">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Submit</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
        <!-- jQuery -->
        <script src="{{ asset('templates/adminlte-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('templates/adminlte-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('templates/adminlte-3.2.0/dist/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('templates/adminlte-3.2.0/plugins/toastr/toastr.min.js') }}"></script>
        <script>
            $(document).ready(function(){
                var cred_form = '#cred_form';

                $(cred_form).on('submit', function(event){
                    event.preventDefault();

                    var email = $("#email").val();
                    var password = $("#password").val();

                    if (email == ""|| password == "") {
                        toastr.warning('Harap isi email dan password.')
                    } else {
                        var url = $(this).attr('data-action');
                        var data = new FormData(this);
                        $.ajax({
                            url: url,
                            method: 'POST',
                            data: new FormData(this),
                            dataType: 'JSON',
                            contentType: false,
                            cache: false,
                            processData: false,
                            success:function(response)
                            {
                                if (response.status == 'error') {
                                    var data = response.data
                                    if (Array.isArray(data)) {
                                        $.each(data, function(index, value){
                                            toastr.warning(value)
                                        })
                                    } else {
                                        toastr.warning(data)
                                    }
                                } else if (response.status == 'success') {

                                }
                            },
                            error: function(response) {
                                toastr.error('Kesalahan terjadi, harap hubungi Admin kami')
                            }
                        });
                    }
                });
            });
        </script>
    </body>
</html>
