<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard | EM Health</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('templates/adminlte-3.2.0/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet"
        href="{{ asset('templates/adminlte-3.2.0/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('templates/adminlte-3.2.0/plugins/toastr/toastr.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('templates/adminlte-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('templates/adminlte-3.2.0/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('templates/adminlte-3.2.0//plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet"
        href="{{ asset('templates/adminlte-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('templates/adminlte-3.2.0/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('templates/adminlte-3.2.0/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="{{ asset('templates/adminlte-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('templates/adminlte-3.2.0/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('templates/adminlte-3.2.0/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ asset('templates/adminlte-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('templates/adminlte-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('templates/adminlte-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        .auto-size-btn {
            height: 40px;
            line-height: 40px;
            padding: 0 15px;
            font-size: 14px;
            white-space: nowrap;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('templates/adminlte-3.2.0/dist/img/AdminLTELogo.png') }}"
                alt="AdminLTELogo" height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('templates/adminlte-3.2.0/dist/img/user2-160x160.jpg') }}"
                            class="user-image img-circle elevation-2" alt="User Image">
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            <img src="{{ asset('templates/adminlte-3.2.0/dist/img/user2-160x160.jpg') }}"
                                class="img-circle elevation-2" alt="User Image">
                            <p>{{ Auth::user()->name }}</p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <p>{{ Auth::user()->id_role == 1 ? 'Admin' : 'Company' }}</p>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <a href="#" class="btn btn-default btn-flat">Profil</a>
                            <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right">Keluar</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <!-- /.navbar -->

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="{{ asset('templates/adminlte-3.2.0/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Em Health</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{ route('dashboard') }}"
                                class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        {{-- <li class="nav-header">MCU</li> --}}
                        <li class="nav-item menu-closed">
                            <a href="#"
                                class="nav-link {{ Str::contains(Route::currentRouteName(), 'mcu') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-stethoscope"></i>
                                <p>
                                    MCU
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('/mcu/program-mcu') }}"
                                        class="nav-link {{ Str::contains(Route::currentRouteName(), 'program-mcu') ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Informasi MCU</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @if (Auth::user()->id_role == 1)
                            <li class="nav-item">
                                <a href="{{ route('package') }}"
                                    class="nav-link {{ Route::is('package.*') || Route::is('package') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-box"></i>
                                    <p>
                                        Paket
                                    </p>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->id_role == 1)
                            <li class="nav-item">
                                <a href="{{ route('company') }}"
                                    class="nav-link {{ Route::is('company.*') || Route::is('company') ? 'active' : '' }}">
                                    <i class="nav-icon fas fa-building"></i>
                                    <p>
                                        Perusahaan
                                    </p>
                                </a>
                            </li>
                        @endif

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <div class="content-wrapper">
            <!-- jQuery -->
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
            <!-- jQuery UI 1.11.4 -->
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
            <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
            <script>
                $.widget.bridge('uibutton', $.ui.button)
            </script>
            <!-- Bootstrap 4 -->
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
            <!-- Select2 -->
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/select2/js/select2.full.min.js') }}"></script>
            <!-- SweetAlert2 -->
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
            <!-- Toastr -->
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/toastr/toastr.min.js') }}"></script>
            <script>
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                const messages = {
                    success: @json(session('success')),
                    error: @json(session('error'))
                };
                @if (session('success'))
                    toastr.success(messages.success);
                @elseif (session('error'))
                    if (Array.isArray(messages.error)) {
                        $.each(messages.error, function(index, value) {
                            toastr.error(value)
                        })
                    } else {
                        toastr.error(messages.error)
                    }
                @endif
            </script>
            <!-- ChartJS -->
            {{-- <script src="{{ asset('templates/adminlte-3.2.0/plugins/chart.js/Chart.min.js') }}"></script> --}}
            <!-- Sparkline -->
            {{-- <script src="{{ asset('templates/adminlte-3.2.0/plugins/sparklines/sparkline.js') }}"></script> --}}
            <!-- JQVMap -->
            {{-- <script src="{{ asset('templates/adminlte-3.2.0/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}
            <!-- jQuery Knob Chart -->
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
            <!-- daterangepicker -->
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/moment/moment.min.js') }}"></script>
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/daterangepicker/daterangepicker.js') }}"></script>
            <!-- Tempusdominus Bootstrap 4 -->
            <script
                src="{{ asset('templates/adminlte-3.2.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}">
            </script>
            <!-- Summernote -->
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/summernote/summernote-bs4.min.js') }}"></script>
            <!-- overlayScrollbars -->
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}">
            </script>
            <!-- AdminLTE App -->
            <script src="{{ asset('templates/adminlte-3.2.0/dist/js/adminlte.js') }}"></script>
            <!-- AdminLTE for demo purposes -->
            {{-- <script src="{{ asset('templates/adminlte-3.2.0/dist/js/demo.js') }}"></script> --}}
            <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
            {{-- <script src="{{ asset('templates/adminlte-3.2.0/dist/js/pages/dashboard.js') }}"></script> --}}
            <!-- DataTables  & Plugins -->
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/datatables/jquery.dataTables.min.js') }}"></script>
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}">
            </script>
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}">
            </script>
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/jszip/jszip.min.js') }}"></script>
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/pdfmake/pdfmake.min.js') }}"></script>
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/pdfmake/vfs_fonts.js') }}"></script>
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
            <script src="{{ asset('templates/adminlte-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
            <script src="https://cdn.jsdelivr.net/npm/echarts@5.5.0/dist/echarts.min.js"></script>
            @yield('content')
        </div>
    </div>
</body>

<!-- /.content-wrapper -->
<script>
    $(document).ready(function() {
        var login_success = @json(session('login_success', ''));
        if (login_success) {
            toastr.success(login_success);
        }

        $('.action-save').on('click', function(e) {
            e.preventDefault();
            let form = $(this).closest('form');
            Swal.fire({
                title: 'Perhatian!',
                text: "Apakah anda akan menyimpan data?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Simpan',
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.value) {
                    form.submit();
                }
            });
        });

        $('.action-delete').on('click', function(e) {
            e.preventDefault();
            let form = $(this).closest('form');
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
                if (result.value) {
                    const form = e.target.closest('form');
                    const actionInput = document.createElement('input');
                    actionInput.type = 'hidden';
                    actionInput.name = 'action';
                    actionInput.value = 'delete';
                    form.appendChild(actionInput);
                    form.submit();
                }
            });
        });
    });
</script>

</html>
