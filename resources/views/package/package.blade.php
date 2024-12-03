@extends('templates/template')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Paket</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item active">Paket</li>
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
                            <h3 class="card-title">List Package</h3> <br>
                        </div>
                        <div class="card-header">
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-add">+ Add New
                                Package</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="packageTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">No</th>
                                        <th>Package Name</th>
                                        <th>Price</th>
                                        <th style="width: 80px;">Action</th>
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
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Package</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('package.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Paket</label>
                                <input type="text" required name="package_name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Harga</label>
                                <input type="text" required name="price" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea required name="desc" id="" class="form-control" cols="30" rows="10"></textarea>
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
                        Apakah Anda yakin ingin menghapus paket ini?
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
            let table = $("#packageTable").DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                searching: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: 'api/package/get-data-package',
                    type: 'GET',
                    data: function(d) {

                    }
                },
                columns: [{
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'package_name',
                        name: 'package_name',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'price',
                        name: 'price',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            var package_id = row.id;
                            var delete_url = "{{ route('package.delete', ['id' => '__id__']) }}";
                            delete_url = delete_url.replace('__id__', package_id);
                            return `<a class="btn btn-primary btn-sm action-detail" href="/package/detail/${package_id}"><i class="fas fa-eye"></i></a>
                                    <a class="btn btn-danger btn-sm action-delete" data-url="${delete_url}"><i class="fas fa-trash"></i></a>`;
                        }
                    }
                ],
                order: [
                    [1, 'asc']
                ],
            });

            $('#packageTable tbody').on('click', '.action-delete', function() {
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

            $('#packageTable tbody').on('click', '.action-detail', function() {

            });
        });
    </script>
@endsection
