@extends('templates/template')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Perusahaan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href={{ route('company') }}>Perusahaan</a></li>
                        <li class="breadcrumb-item active">Detail Perusahaan</li>
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
                        <form method="POST" action="{{ route('company.update') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{ $company->company_id }}" name="id">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Nama Perusahaan</label>
                                    <input type="text" required name="company_name" value="{{ $company->company_name }}"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Kode Perusahaan</label>
                                    <input type="text" required name="company_code" value="{{ $company->company_code }}"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">NPWP Perusahaan</label>
                                    <input type="text" required name="npwp_company_number"
                                        value="{{ $company->npwp_company_number }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">PIC Perusahaan</label>
                                    <input type="text" required name="pic_name" value="{{ $company->pic_name }}"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Email PIC Perusahaan</label>
                                    <input type="email" required name="pic_email" value="{{ $company->pic_email }}"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">No Telp PIC Perusahaan</label>
                                    <input type="text" required name="pic_phone_number"
                                        value="{{ $company->pic_phone_number }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat Perusahaan</label>
                                    <textarea required name="company_address" id="" class="form-control" cols="30" rows="10">{{ $company->company_address }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Kop Perusahaan</label><br>
                                    <img style="width:10%" src="/uploads/letterhead/{{ $company->letterhead }}"
                                        alt=""><br><br>
                                    <input type="file" name="letterhead" id="letterhead" accept=".jpg,.png"><br>
                                    <span style="color:red">Maksimal size file Kop adalah 100kb</span>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
