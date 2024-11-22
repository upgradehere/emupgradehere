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
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
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
                            <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill"
                                href="#custom-content-below-home" role="tab"
                                aria-controls="custom-content-below-home" aria-selected="true">Fisik & Anamnesa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill"
                                href="#custom-content-below-profile" role="tab"
                                aria-controls="custom-content-below-profile" aria-selected="false">Refraksi / Trial Lens</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-content-below-messages-tab" data-toggle="pill"
                                href="#custom-content-below-messages" role="tab"
                                aria-controls="custom-content-below-messages" aria-selected="false">Laboratorium</a>
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
                        <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                            <br>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Pemeriksaan Anamnesa</h3>
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Riwayat Penyakit Sebelumnya</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Asma</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Kencing Manis</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Kejang - Kejang Berulang</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Penyakit Jantung</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Batuk Disertai Dahak Berdarah</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Rheumatik</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Tekanan Darah Tinggi</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Tekanan Darah Rendah</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Sering Bengkak di Wajah/Kaki</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Riwayat Operasi</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Jika Ya, Jenis Operasi Apa</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Apakah anda pernah/sekarang menggunakan obat tertentu secara terus menerus</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Alergi</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Sakit Kuning / Hepatitis</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Kecanduan Obat-Obatan</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Patah Tulang</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Gangguan Pendengaran</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Apakah Anda Perokok</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Apakah Anda Rutin Berolahraga</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Nyeri Saat Buang Air Kecil</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Sering Keputihan (Wanita)</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Epilepsi</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Jika Ya, Catatan Epilepsi</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" style="width: 300px;" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Keluhan Utama Saat Ini</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" style="width: 300px;" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Pemeriksaan Fisik</h3>
                                </div>
                                <div class="card-body">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Pemeriksaan Umum</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Sistol</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            mmHg
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Diastol</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            mmHg
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Denyut Nadi</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            x/menit
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Nafas</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            x/menit
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Tinggi Badan</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            cm
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Berat Badan</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            kg
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">BMI</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Anjuran BB</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            kg
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Suhu Badan</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <span>&#8451;</span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Kesan BMI</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Keadaan Kulit</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-2 col-form-label">Keadaan Kulit</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Mata</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Buta Warna</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Kaca Mata</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">OS</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">OD</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Kelainan Visus</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">OD</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">OS</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Strabismus</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Konjungtiva Anemis</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Sklera Ikterik</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Reflek Pupil</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Kelainan Kelenjar Mata</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Catatan Kelainan Kelenjar Mata</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Exohalmus</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Lain - lain</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Telinga</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Penurunan Kualitas Dengar</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Kelainan Bentuk Telinga</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Perforasi Membran Timpani</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Lain - lain</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Hidung</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Septum Deviasi</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Sekret</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Lain - lain</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Rongga Mulut</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Laboi Palatoschizis</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Kelainan Faring</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Pembesaran Tonsil</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Lain - lain</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Gigi</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Carries Dentis</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Gangren Radix</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Gangren Pulpa</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Calculus Dentis</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Gigi Palsu</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Lain - lain</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Leher</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Struma</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Limfadenopati</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Lain - lain</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Thorax</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Simetris</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Kelainan Paru</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Catatan Kelainan Paru</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Kelainan Jantung</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Catatan Kelainan Jantung</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Lain - lain</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Abdomen</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Kelainan Bentuk Abdomen</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Bekas Operasi</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Catatan Bekas Operasi</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Hepatomegali</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Splenomegali</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Nyeri Tekan Epigastrium</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Nyeri Tekan Titik McBurney</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Striae</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Teraba Tumor</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Lain - lain</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Tulang Belakang</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Skoliosis / Lordosis / Kyposis</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Lain - lain</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Ekstremitas Atas</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Kelainan Bentuk Ekstremitas Atas</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Hemiporasis Ekstremitas Atas</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Pembengkakan Sendi Ekstremitas Atas</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Lain - lain</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Ekstremitas Bawah</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Kelainan Bentuk Ekstremitas Bawah</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Varises</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Polio</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Hemiparesis Ekstremitas Bawah</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Pembengkakan Sendi Ekstremitas Bawah</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" id="exampleFormControlSelect1">
                                                                <option value="0">Tidak</option>
                                                                <option value="1">Ya</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-4 col-form-label">Lain - lain</label>
                                                        <div class="col-sm-8">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Catatan</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group row align-items-center mb-3">
                                                        <label class="col-sm-2 col-form-label">Catatan</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="mcuCode" name="mcu_code" placeholder="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-danger action-export">
                                            <i class="fas fa-trash"></i>&nbsp;&nbsp;Hapus
                                        </button>
                                        &nbsp;&nbsp;
                                        <button type="submit" class="btn btn-success action-export">
                                            <i class="fas fa-save"></i>&nbsp;&nbsp;Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">

                        </div>
                        <div class="tab-pane fade" id="custom-content-below-messages" role="tabpanel" aria-labelledby="custom-content-below-messages-tab">

                        </div>
                        <div class="tab-pane fade" id="custom-content-below-settings" role="tabpanel" aria-labelledby="custom-content-below-settings-tab">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // $(function() {
        //     let table = $("#mcuEmployeeTable").DataTable({
        //         responsive: true,
        //         lengthChange: true,
        //         autoWidth: false,
        //         searching: true,
        //         processing: true,
        //         serverSide: true,
        //         ajax: {
        //             url: '/api/mcu/program-mcu/get-data-mcu-employee',
        //             type: 'GET',
        //             data: function(d) {
        //             }
        //         },
        //         columns: [{
        //                 data: null,
        //                 orderable: false,
        //                 searchable: false,
        //                 render: function(data, type, row, meta) {
        //                     return meta.row + 1;
        //                 }
        //             },
        //             {
        //                 data: 'mcu_code',
        //                 name: 'mcu_code',
        //                 searchable: true,
        //                 orderable: true
        //             },
        //             {
        //                 data: 'nik',
        //                 name: 'nik',
        //                 searchable: true,
        //                 orderable: true
        //             },
        //             {
        //                 data: 'employee_name',
        //                 name: 'employee_name',
        //                 searchable: true,
        //                 orderable: true
        //             },
        //             {
        //                 data: 'departement_name',
        //                 name: 'departement_name',
        //                 searchable: true,
        //                 orderable: true
        //             },
        //             {
        //                 data: 'sex',
        //                 name: 'sex',
        //                 searchable: true,
        //                 orderable: true
        //             },
        //             {
        //                 data: 'age',
        //                 name: 'age',
        //                 searchable: true,
        //                 orderable: true
        //             },
        //             {
        //                 data: 'mcu_date',
        //                 name: 'mcu_date',
        //                 searchable: true,
        //                 orderable: true,
        //                 render: function(data, type, row) {
        //                     if (data) {
        //                         var date = new Date(data);
        //                         var formattedDate = date.getFullYear() + '/' + (date.getMonth() + 1)
        //                             .toString().padStart(2, '0') + '/' + date.getDate().toString()
        //                             .padStart(2, '0');
        //                         return formattedDate;
        //                     }
        //                     return '';
        //                 }
        //             },
        //             {
        //                 data: null,
        //                 orderable: false,
        //                 searchable: false,
        //                 render: function(data, type, row) {
        //                     return `<button class="btn btn-primary btn-sm action-detail"><i class="fas fa-eye"></i></button>
    //                             <button class="btn btn-success btn-sm action-export"><i class="fas fa-file-pdf"></i></button>
    //                             <button class="btn btn-danger btn-sm action-delete"><i class="fas fa-trash"></i></button>`;
        //                 }
        //             }
        //         ],
        //         order: [
        //             [1, 'asc']
        //         ],
        //     });

        //     $('#mcuEmployeeTable tbody').on('click', '.action-delete', function() {
        //         Swal.fire({
        //             title: "Apakah anda akan menghapus data?",
        //             showDenyButton: true,
        //             confirmButtonText: "Ya",
        //             denyButtonText: "Tidak"
        //         }).then((result) => {
        //             if (result.isConfirmed) {
        //                 Swal.fire("Berhasil menghapus data!", "", "success");
        //                 table.ajax.reload();
        //             }
        //         });
        //     });

        //     $('#reservationdatetime').datetimepicker({
        //         format: 'YYYY-MM-DD HH:mm:ss',
        //         icons: {
        //             time: 'far fa-clock'
        //         }
        //     });

        //     $('.selectJenisPemeriksaan').select2();

        //     $(".custom-file-input").on("change", function() {
        //         var fileName = $(this).val().split("\\").pop();
        //         $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        //     });
        // });
    </script>
@endsection
