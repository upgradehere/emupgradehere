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
                    <h1 class="m-0">Dokter</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item active">Dokter</li>
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
                            <h3 class="card-title">Daftar Dokter</h3> <br>
                        </div>
                        <div class="card-header">
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-add">+ Tambah
                                Dokter Baru</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="doctorTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">No</th>
                                        <th>Kode Dokter</th>
                                        <th>Nama Dokter</th>
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
                        <h4 class="modal-title">Tambah Dokter Baru</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('doctor.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Dokter</label>
                                <input type="text" required name="doctor_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Kode Dokter</label>
                                <input type="text" required name="doctor_code" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Tanda Tangan Dokter</label>
                                <input type="file" name="doctor_sign" id="doctor_sign" accept=".jpg,.png" required><br>
                                <span style="color:red">Maksimal size file TTD Dokter adalah 100kb</span>
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
                        Apakah Anda yakin ingin menghapus dokter ini?
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
            let table = $("#doctorTable").DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                searching: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/doctor/data/',
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
                        data: 'doctor_code',
                        name: 'doctor_code',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'doctor_name',
                        name: 'doctor_name',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            var doctor_id = row.id;
                            var delete_url = "{{ route('doctor.delete', ['id' => '__id__']) }}";
                            delete_url = delete_url.replace('__id__', doctor_id);
                            return `<a class="btn btn-primary btn-sm action-detail" href="/doctor/detail/${doctor_id}"><i class="fas fa-eye"></i></a>
                                    <a class="btn btn-danger btn-sm action-delete" data-url="${delete_url}"><i class="fas fa-trash"></i></a>`;
                        }
                    }
                ],
                order: [
                    [1, 'asc']
                ],
            });

            $('#doctorTable tbody').on('click', '.action-delete', function() {
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
