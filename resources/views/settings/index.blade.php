@extends('templates/template')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item active">Settings</li>
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
                            <h3 class="card-title">OTP</h3> <br>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('settings-otp.update') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">OTP</label>
                                    <select name="otp" class="form-control" required>
                                        <option value="">--Pilih Status--</option>
                                        <option value="0" {{ ($otp == 0) ? 'selected' : '' }}>Not Active</option>
                                        <option value="1" {{ ($otp == 1) ? 'selected' : '' }}>Active</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Twilio SID</label>
                                    <input type="text" name="twilio_sid" class="form-control" value="{{ $twilio_sid }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Twilio Auth Token</label>
                                    <input type="text" name="twilio_auth_token" class="form-control" value="{{ $twilio_auth_token }}" required>
                                </div>

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
@endsection
