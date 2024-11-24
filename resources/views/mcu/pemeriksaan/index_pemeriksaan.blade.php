@extends('templates/template')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pemeriksaan Peserta</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">MCU</li>
                        <li class="breadcrumb-item active">Informasi MCU</li>
                        <li class="breadcrumb-item active">Detail</li>
                        <li class="breadcrumb-item active">Pemeriksaan</li>
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
                            <h3 class="card-title">Data Individu</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <h6>NIK Peserta</h6>
                                    <h5>{{ !empty($employee_data['nik']) ? $employee_data['nik'] : '-' }}</h5>
                                </div>
                                <div class="col-3">
                                    <h6>Nama Peserta</h6>
                                    <h5>{{ !empty($employee_data['employee_name']) ? $employee_data['employee_name'] : '-' }}
                                    </h5>
                                </div>
                                <div class="col-3">
                                    <h6>Jenis Kelamin</h6>
                                    <h5>{{ !empty($employee_data['sex']) ? $employee_data['sex'] : '-' }}</h5>
                                </div>
                                <div class="col-3">
                                    <h6>Tanggal MCU</h6>
                                    <h5>{{ $mcu_date }}</h5>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="tab-anamnesis-tab" data-toggle="pill"
                                href="#tab-anamnesis" role="tab"
                                aria-controls="tab-anamnesis" aria-selected="true">Fisik & Anamnesa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-refraction-tab" data-toggle="pill"
                                href="#tab-refraction" role="tab"
                                aria-controls="tab-refraction" aria-selected="false">Refraksi / Trial Lens</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tab-lab-tab" data-toggle="pill"
                                href="#tab-lab" role="tab"
                                aria-controls="tab-lab" aria-selected="false">Laboratorium</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill"
                                href="#custom-content-below-settings" role="tab"
                                aria-controls="custom-content-below-settings" aria-selected="false">Rontgen</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill"
                                href="#custom-content-below-settings" role="tab"
                                aria-controls="custom-content-below-settings" aria-selected="false">Audiometri</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill"
                                href="#custom-content-below-settings" role="tab"
                                aria-controls="custom-content-below-settings" aria-selected="false">Spirometri</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill"
                                href="#custom-content-below-settings" role="tab"
                                aria-controls="custom-content-below-settings" aria-selected="false">EKG</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill"
                                href="#custom-content-below-settings" role="tab"
                                aria-controls="custom-content-below-settings" aria-selected="false">USG</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill"
                                href="#custom-content-below-settings" role="tab"
                                aria-controls="custom-content-below-settings" aria-selected="false">Treadmill</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-content-below-settings-tab" data-toggle="pill"
                                href="#custom-content-below-settings" role="tab"
                                aria-controls="custom-content-below-settings" aria-selected="false">Resume MCU</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="custom-content-below-tabContent">
                        <div class="tab-pane fade show active" id="tab-anamnesis" role="tabpanel" aria-labelledby="tab-anamnesis-tab"><br>
                            @include('mcu.pemeriksaan.partials.anamnesis')
                        </div>
                        <div class="tab-pane fade" id="tab-refraction" role="tabpanel" aria-labelledby="tab-refraction-tab"><br>
                            @include('mcu.pemeriksaan.partials.refraction')
                        </div>
                        <div class="tab-pane fade" id="tab-lab" role="tabpanel" aria-labelledby="tab-lab-tab"><br>
                            @include('mcu.pemeriksaan.partials.laboratorium')
                        </div>
                        <div class="tab-pane fade" id="custom-content-below-settings" role="tabpanel" aria-labelledby="custom-content-below-settings-tab">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(function() {

        });
    </script>
@endsection
