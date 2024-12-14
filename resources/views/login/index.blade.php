<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login | EM Health</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{ asset('templates/login/images/icons/favicon.ico') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('templates/login/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('templates/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('templates/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('templates/login/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('templates/login/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('templates/login/vendor/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('templates/login/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('templates/login/vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('templates/login/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('templates/login/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/adminlte-3.2.0/plugins/toastr/toastr.min.css') }}">

    <!--===============================================================================================-->
</head>

<body style="background-color: #666666;">

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div id="cred_card">
                    <form class="login100-form validate-form" data-action="{{ route('login.check') }}" id="cred_form"
                        method="POST">
                        @csrf
                        <span class="login100-form-title p-b-43">
                            <img src="{{ asset('templates/login/images/bg-02.jpg') }}" style="width:70%"
                                alt="">
                        </span>


                        <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                            <input class="input100" type="text" required name="email" id="email">
                            <span class="focus-input100"></span>
                            <span class="label-input100">Email</span>
                        </div>


                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                            <input class="input100" type="password" id="password" required name="password">
                            <span class="focus-input100"></span>
                            <span class="label-input100">Password</span>
                        </div>


                        <div class="container-login100-form-btn">
                            <button type="submit" class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
                <div id="otp_card">
                    <form class="login100-form validate-form" data-action="{{ route('login.otp') }}" id="otp_form"
                        method="POST">
                        @csrf
                        <span class="login100-form-title p-b-43">
                            <img src="{{ asset('templates/login/images/bg-02.jpg') }}" style="width:70%"
                                alt="">
                        </span>

                        <p class="login-box-msg">Kami telah mengirimkan kode OTP ke email anda</p>

                        <div class="wrap-input100 validate-input" data-validate = "">
                            <input class="input100" required ="text" name="otp" id="otp">
                        </div>
                        <div class="row">
                            <!-- /.col -->
                            <div class="container-login100-form-btn">
                                <button type="submit" class="login100-form-btn">
                                    Submit
                                </button>
                            </div>
                            <br>
                            <br>
                            <div class="container-login100-form-btn mt-3">
                                <button type="button" id="resend" disabled class="login100-form-btn btn-secondary">
                                    Re-send OTP
                                </button>
                                <p>Re-send OTP akan tersedia dalam <span id="countdown"></span> detik.</p>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
                <div class="login100-more" style="background-image: url('templates/login/images/bg-01.jpg');">
                </div>
            </div>
        </div>
    </div>





    <!--===============================================================================================-->
    <script src="{{ asset('templates/login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('templates/login/vendor/animsition/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('templates/login/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('templates/login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('templates/login/vendor/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('templates/login/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('templates/login/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('templates/login/vendor/countdowntime/countdowntime.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('templates/login/js/main.js') }}"></script>
    <script src="{{ asset('templates/adminlte-3.2.0/plugins/toastr/toastr.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var cred_form = '#cred_form';
            var cred_card = '#cred_card';
            var otp_form = '#otp_form';
            var otp_card = '#otp_card';

            $(otp_card).hide();

            $(cred_form).on('submit', function(event) {
                event.preventDefault();

                var email = $("#email").val();
                var password = $("#password").val();

                if (email == "" || password == "") {
                    toastr.warning('Harap isi email dan password.')
                } else {
                    var url = $(this).attr('data-action');
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: new FormData(this),
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
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
                                toastr.success("OTP terkirim");
                                countdown();
                                $("#resend").attr("disabled", true);
                                $(cred_card).hide();
                                $(otp_card).show();
                            } else if (response.status == 'success|pass') {
                                toastr.success("Login berhasil");
                                window.location.href = "{{ route('dashboard') }}";
                            }
                        },
                        error: function(response) {
                            toastr.error('Kesalahan terjadi, harap hubungi Admin kami')
                        }
                    });
                }
            });

            $(otp_form).on('submit', function(event) {
                event.preventDefault();

                var otp = $("#otp").val();
                if (otp == "") {
                    toastr.warning('Harap isi OTP.')
                } else if (isNaN(otp) || otp.length !== 6) {
                    toastr.warning('OTP harus berisi 6 angka.')
                } else {
                    var url = $(this).attr('data-action');
                    var data = new FormData(this);
                    var email = $("#email").val();
                    var password = $("#password").val();

                    data.append("email", email);
                    data.append("password", password);

                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: data,
                        dataType: 'JSON',
                        contentType: false,
                        cache: false,
                        processData: false,
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
                                toastr.success("Login berhasil");
                                window.location.href = "{{ route('dashboard') }}";
                            }
                        },
                        error: function(response) {
                            toastr.error('Kesalahan terjadi, harap hubungi Admin kami')
                        }
                    });
                }
            });

            $(document).on("click", "#resend", function() {
                if ($("#countdown").text() != 0) {
                    $(this).attr("disabled", true);
                } else {
                    $(cred_form).submit();
                }
            });

            function countdown() {
                var countdownTime = 60;
                var countdownInterval = setInterval(function() {
                    // Calculate minutes and seconds
                    var seconds = countdownTime % 60;
                    if (seconds == 0) {
                        seconds = countdownTime;
                    }

                    $('#countdown').text(formatTime(seconds));

                    countdownTime--;

                    if (countdownTime < 0) {
                        clearInterval(countdownInterval);
                        $('#countdown').text(0);
                        $('#resend').attr("disabled", false);
                    }
                }, 1000);
            }

            function formatTime(seconds) {
                return seconds;
            }
        });
    </script>

</body>

</html>
