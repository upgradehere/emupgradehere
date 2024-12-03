@extends('templates/template')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Paket</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item"><a href={{ route('package') }}>Paket</a></li>
                        <li class="breadcrumb-item active">Detail Paket</li>
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
                        <form method="POST" action="{{ route('package.update') }}">
                            @csrf
                            <input type="hidden" value="{{ $package->id }}" name="id">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Nama Paket</label>
                                    <input type="text" class="form-control" id="" required placeholder=""
                                        name="package_name" value="{{ $package->package_name }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Harga</label>
                                    <input type="text" class="form-control" id="" required placeholder=""
                                        name="price" value="{{ $package->price }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea name="desc" id="" cols="30" rows="10" class="form-control">{{ $package->desc }}</textarea>
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
