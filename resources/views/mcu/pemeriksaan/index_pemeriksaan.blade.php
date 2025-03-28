@extends('templates/template')
@section('content')
    <style>
        .disabled-div {
            pointer-events: none;
            opacity: 0.8;
        }
    </style>
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
                                <div class="col-2">
                                    <h6>NIK Peserta</h6>
                                    <h5>{{ !empty($employee_data['nik']) ? $employee_data['nik'] : '-' }}</h5>
                                </div>
                                <div class="col-2">
                                    <h6>Nama Peserta</h6>
                                    <h5>{{ !empty($employee_data['employee_name']) ? $employee_data['employee_name'] : '-' }}
                                    </h5>
                                </div>
                                <div class="col-2">
                                    <h6>No. MCU</h6>
                                    <h5>{{ $mcu_code }}
                                    </h5>
                                </div>
                                <div class="col-2">
                                    <h6>Jenis Kelamin</h6>
                                    <h5>{{ !empty($employee_data['sex']) ? $employee_data['sex'] : '-' }}</h5>
                                </div>
                                <div class="col-2">
                                    <h6>Tanggal MCU</h6>
                                    <h5>{{ $mcu_date }}</h5>
                                </div>
                                <div class="col-2">
                                    <h6>Paket MCU</h6>
                                    <h5>{{ $mcu_package_name }}</h5>
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
                        @foreach ($examinations as $key => $examination)
                            <li class="nav-item">
                                <a class="nav-link {{ $key === 0 ? 'active' : '' }}" id="{{ $examination['tab_name'] }}-tab"
                                    data-toggle="pill" href="#{{ $examination['tab_name'] }}" role="tab"
                                    aria-controls="{{ $examination['tab_name'] }}"
                                    aria-selected="{{ $key === 0 ? 'true' : 'false' }}">
                                    {{ $examination['lookup_name'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <div class="tab-content" id="tab-anamnesis-tab">
                        <div class="tab-pane fade {{ Auth::user()->id_role != 3 ? 'show active' : '' }} {{ (Auth::user()->id_role == 3 && Auth::user()->examination_type == \App\Helpers\ConstantsHelper::LOOKUP_EXAMINATION_TYPE_ANAMNESIS) ? 'show active' : '' }}" id="tab-anamnesis" role="tabpanel"
                            aria-labelledby="tab-anamnesis-tab"><br>
                            @if(in_array(\App\Helpers\ConstantsHelper::LOOKUP_EXAMINATION_TYPE_ANAMNESIS, array_column($examinations->toArray(), 'lookup_id')))
                                @include('mcu.pemeriksaan.partials.anamnesis')
                            @endif
                        </div>
                        <div class="tab-pane fade {{ (Auth::user()->id_role == 3 && Auth::user()->examination_type == \App\Helpers\ConstantsHelper::LOOKUP_EXAMINATION_TYPE_REFRACTION) ? 'show active' : '' }}" id="tab-refraction" role="tabpanel" aria-labelledby="tab-refraction-tab">
                            <br>
                            @if(in_array(\App\Helpers\ConstantsHelper::LOOKUP_EXAMINATION_TYPE_REFRACTION, array_column($examinations->toArray(), 'lookup_id')))
                                @include('mcu.pemeriksaan.partials.refraction')
                            @endif
                        </div>
                        <div class="tab-pane fade {{ (Auth::user()->id_role == 3 && Auth::user()->examination_type == \App\Helpers\ConstantsHelper::LOOKUP_EXAMINATION_TYPE_LAB) ? 'show active' : '' }}" id="tab-lab" role="tabpanel" aria-labelledby="tab-lab-tab"><br>
                            @if(in_array(\App\Helpers\ConstantsHelper::LOOKUP_EXAMINATION_TYPE_LAB, array_column($examinations->toArray(), 'lookup_id')))
                                @include('mcu.pemeriksaan.partials.laboratorium')
                            @endif
                        </div>
                        <div class="tab-pane fade {{ (Auth::user()->id_role == 3 && Auth::user()->examination_type == \App\Helpers\ConstantsHelper::LOOKUP_EXAMINATION_TYPE_RONTGEN) ? 'show active' : '' }}" id="tab-rontgen" role="tabpanel" aria-labelledby="tab-rontgen-tab"><br>
                            @if(in_array(\App\Helpers\ConstantsHelper::LOOKUP_EXAMINATION_TYPE_RONTGEN, array_column($examinations->toArray(), 'lookup_id')))
                                @include('mcu.pemeriksaan.partials.rontgen')
                            @endif
                        </div>
                        <div class="tab-pane fade {{ (Auth::user()->id_role == 3 && Auth::user()->examination_type == \App\Helpers\ConstantsHelper::LOOKUP_EXAMINATION_TYPE_AUDIOMETRY) ? 'show active' : '' }}" id="tab-audiometri" role="tabpanel" aria-labelledby="tab-audiometri-tab">
                            <br>
                            @if(in_array(\App\Helpers\ConstantsHelper::LOOKUP_EXAMINATION_TYPE_AUDIOMETRY, array_column($examinations->toArray(), 'lookup_id')))
                                @include('mcu.pemeriksaan.partials.audiometri')
                            @endif
                        </div>
                        <div class="tab-pane fade {{ (Auth::user()->id_role == 3 && Auth::user()->examination_type == \App\Helpers\ConstantsHelper::LOOKUP_EXAMINATION_TYPE_SPIROMETRY) ? 'show active' : '' }}" id="tab-spirometri" role="tabpanel" aria-labelledby="tab-spirometri-tab">
                            <br>
                            @if(in_array(\App\Helpers\ConstantsHelper::LOOKUP_EXAMINATION_TYPE_SPIROMETRY, array_column($examinations->toArray(), 'lookup_id')))
                                @include('mcu.pemeriksaan.partials.spirometri')
                            @endif
                        </div>
                        <div class="tab-pane fade {{ (Auth::user()->id_role == 3 && Auth::user()->examination_type == \App\Helpers\ConstantsHelper::LOOKUP_EXAMINATION_TYPE_EKG) ? 'show active' : '' }}" id="tab-ekg" role="tabpanel" aria-labelledby="tab-ekg-tab"><br>
                            @if(in_array(\App\Helpers\ConstantsHelper::LOOKUP_EXAMINATION_TYPE_EKG, array_column($examinations->toArray(), 'lookup_id')))
                                @include('mcu.pemeriksaan.partials.ekg')
                            @endif
                        </div>
                        <div class="tab-pane fade {{ (Auth::user()->id_role == 3 && Auth::user()->examination_type == \App\Helpers\ConstantsHelper::LOOKUP_EXAMINATION_TYPE_USG) ? 'show active' : '' }}" id="tab-usg" role="tabpanel" aria-labelledby="tab-usg-tab"><br>
                            @if(in_array(\App\Helpers\ConstantsHelper::LOOKUP_EXAMINATION_TYPE_USG, array_column($examinations->toArray(), 'lookup_id')))
                                @include('mcu.pemeriksaan.partials.usg')
                            @endif
                        </div>
                        <div class="tab-pane fade {{ (Auth::user()->id_role == 3 && Auth::user()->examination_type == \App\Helpers\ConstantsHelper::LOOKUP_EXAMINATION_TYPE_TREADMILL) ? 'show active' : '' }}" id="tab-treadmill" role="tabpanel" aria-labelledby="tab-treadmill-tab">
                            <br>
                            @if(in_array(\App\Helpers\ConstantsHelper::LOOKUP_EXAMINATION_TYPE_TREADMILL, array_column($examinations->toArray(), 'lookup_id')))
                                @include('mcu.pemeriksaan.partials.treadmill')
                            @endif
                        </div>
                        <div class="tab-pane fade {{ (Auth::user()->id_role == 3 && Auth::user()->examination_type == \App\Helpers\ConstantsHelper::LOOKUP_EXAMINATION_TYPE_PAPSMEAR) ? 'show active' : '' }}" id="tab-papsmear" role="tabpanel" aria-labelledby="tab-papsmear-tab"><br>
                            @if(in_array(\App\Helpers\ConstantsHelper::LOOKUP_EXAMINATION_TYPE_PAPSMEAR, array_column($examinations->toArray(), 'lookup_id')))
                                @include('mcu.pemeriksaan.partials.papsmear')
                            @endif
                        </div>
                        <div class="tab-pane fade {{ (Auth::user()->id_role == 3 && Auth::user()->examination_type == \App\Helpers\ConstantsHelper::LOOKUP_EXAMINATION_TYPE_RESUME_MCU) ? 'show active' : '' }}" id="tab-resume" role="tabpanel" aria-labelledby="tab-resume-tab"><br>
                            @if(in_array(\App\Helpers\ConstantsHelper::LOOKUP_EXAMINATION_TYPE_RESUME_MCU, array_column($examinations->toArray(), 'lookup_id')))
                                @include('mcu.pemeriksaan.partials.resume')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(function() {
            var role = @json(Auth::user()->id_role);
            if (role == 2) {
                document.querySelectorAll('button, input, textarea, select').forEach(element => {
                    element.disabled = true;
                });
                $('.summernote').each(function() {
                    $(this).summernote('disable');
                });
            }
        });
    </script>
@endsection
