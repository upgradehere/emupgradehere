@extends('templates/template')
@section('content')
    <style>
        .custom-hr {
            height: 3px;
            /* Set the thickness */
            background-color: black;
            /* Set the color */
            border: none;
            /* Remove the default border */
            margin: 10px 0;
            /* Optional: Adjust spacing */
        }
    </style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Departemen</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item active">Departemen</li>
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
                            <h3 class="card-title">Daftar Departemen</h3> <br>
                        </div>
                        <div class="card-header">
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-add">+ Tambah
                                Departemen Baru</button>
                            @if (isset($_GET['company-id']))
                                <a href="{{ route('departement') }}" class="btn btn-primary btn-sm">Tampilkan Semua
                                    Departemen
                                    Dari
                                    Semua Perusahaan</a>
                            @endif
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="departementTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">No</th>
                                        <th>Kode Departemen</th>
                                        <th>Perusahaan</th>
                                        <th>Departemen</th>
                                        <th style="width: 80px;"><i class="fas fa-cogs"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-add">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Departemen Baru</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('departement.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Perusahaan</label>
                                <select class="form-control" name="company_id" required id="">
                                    <option value="">-- Pilih Perusahaan --</option>
                                    @foreach ($company as $c)
                                        <option value="{{ $c->company_id }}">{{ $c->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Departemen</label>
                                <input type="text" required name="departement_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Kode Departemen</label>
                                <input type="text" required name="departement_code" class="form-control">
                            </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Penghapusan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus departemen ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" id="confirmDelete">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(function() {
            let table = $("#departementTable").DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                searching: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/departement/data/<?php echo $company_id; ?>',
                    type: 'GET',
                    data: function(d) {

                    }
                },
                columns: [{
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            console.log(data)
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'departement_code',
                        name: 'departement_code',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'company.company_name',
                        name: 'company.company_name',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'departement_name',
                        name: 'departement_name',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            var departement_id = row.departement_id;
                            var delete_url =
                                "{{ route('departement.delete', ['id' => '__id__']) }}";
                            delete_url = delete_url.replace('__id__', departement_id);
                            return `<a class="btn btn-primary btn-sm action-detail" href="/departement/detail/${departement_id}"><i class="fas fa-eye"></i></a>
                                    <a class="btn btn-danger btn-sm action-delete" data-url="${delete_url}"><i class="fas fa-trash"></i></a>`;
                        }
                    }
                ],
                order: [
                    [1, 'asc']
                ],
            });

            $('#departementTable tbody').on('click', '.action-delete', function() {
                Swal.fire({
                    title: "Apakah anda akan menghapus data?",
                    showDenyButton: true,
                    confirmButtonText: "Ya",
                    denyButtonText: "Tidak"
                }).then((result) => {
                    if (result.isConfirmed) {
                        var url = $(this).attr('data-url');
                        $.ajax({
                            url: url,
                            method: 'GET',
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
                                    toastr.success('Data berhasil dihapus!')
                                    table.ajax.reload();
                                }
                            },
                            error: function(response) {
                                toastr.error(
                                    'Kesalahan terjadi, harap hubungi Admin kami')
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
