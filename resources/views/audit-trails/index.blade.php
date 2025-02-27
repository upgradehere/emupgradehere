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
                    <h1 class="m-0">Audit Trails</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Beranda</a></li>
                        <li class="breadcrumb-item active">Audit Trails</li>
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
                            <h3 class="card-title">Audit Trails</h3> <br>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="auditTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">No</th>
                                        <th>Nama User</th>
                                        <th>Event</th>
                                        <th>URL</th>
                                        <th>IP Address</th>
                                        <th>Tanggal</th>
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
                        <h4 class="modal-title">Detail</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </section>
    <script>
        $(function() {
            let table = $("#auditTable").DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                searching: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/audit-trails/get-data',
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
                        data: 'name',
                        name: 'name',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'event',
                        name: 'event',
                        searchable: true,
                        orderable: true,
                        render: function(data, type, row) {
                            if (data == 'created' || data == 'inserted') {
                                return `<span style="color: green;">INSERT</span>`;
                            } else if (data == 'updated') {
                                return `<span style="color: blue;">UPDATE</span>`;
                            } else if (data == 'soft_deleted' || data == 'had_deleted') {
                                return `<span style="color: red;">DELETE</span>`;
                            } else if (data == 'restored') {
                                return `<span style="color: yellow;">RESTORE</span>`;
                            }
                            return data;
                        }
                    },
                    {
                        data: 'url',
                        name: 'url',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'ip_address',
                        name: 'ip_address',
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
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
                            return `<a class="btn btn-primary btn-sm action-detail" data-toggle="modal" data-target="#modal-add"
                                        data-detail="${row}"
                                        data-name="${row.name}"
                                        data-event="${row.event}"
                                        data-url="${row.url}"
                                        data-ip="${row.ip_address}"
                                        data-device="${row.device}"
                                        data-platform="${row.platform}"
                                        data-browser="${row.browser}"
                                        data-oldvalues='${row.old_values ? encodeURIComponent(row.old_values) : "{}"}'
                                        data-newvalues='${row.new_values ? encodeURIComponent(row.new_values) : "{}"}'
                                        data-date="${row.created_at}"><i class="fas fa-eye"></i></a>`;
                        }
                    }
                ],
                order: [
                    [1, 'asc']
                ],
            });

            $('#auditTable tbody').on('click', '.action-detail', function() {
                let name = $(this).data('name');
                let event = $(this).data('event');
                if (event == 'created' || event == 'inserted') {
                    event = `<span style="color: green;">INSERT</span>`;
                } else if (event == 'updated') {
                    event = `<span style="color: blue;">UPDATE</span>`;
                } else if (event == 'soft_deleted' || event == 'had_deleted') {
                    event = `<span style="color: red;">DELETE</span>`;
                } else if (event == 'restored') {
                    event = `<span style="color: yellow;">RESTORE</span>`;
                }
                let url = $(this).data('url');
                let ip = $(this).data('ip');
                let device = $(this).data('device');
                let platform = $(this).data('platform');
                let browser = $(this).data('browser');
                let oldValues = $(this).data('oldvalues');
                let newValues = $(this).data('newvalues');
                let date = $(this).data('date');

                //old values
                try {
                    oldValues = JSON.parse(decodeURIComponent(oldValues));
                } catch (error) {
                    oldValues = null;
                }
                let oldValuesHtml = "";
                if (oldValues && typeof oldValues === "object") {
                    oldValuesHtml = JSON.stringify(oldValues);
                } else {
                    oldValuesHtml = "<p>No previous data</p>";
                }

                //new values
                try {
                    newValues = JSON.parse(decodeURIComponent(newValues));
                } catch (error) {
                    newValues = null;
                }
                let newValuesHtml = "";

                if (newValues && typeof newValues === "object") {
                    newValuesHtml = JSON.stringify(newValues);
                } else {
                    newValuesHtml = "<p>No new data</p>";
                }

                let modalContent = `
                    <table>
                        <tr>
                            <td><strong>Nama User</strong></td>
                            <td>:</td>
                            <td>${name}</td>
                        </tr>
                        <tr>
                            <td><strong>Event</strong></td>
                            <td>:</td>
                            <td>${event}</td>
                        </tr>
                        <tr>
                            <td><strong>URL</strong></td>
                            <td>:</td>
                            <td>${url}</td>
                        </tr>
                        <tr>
                            <td><strong>IP Address</strong></td>
                            <td>:</td>
                            <td>${ip}</td>
                        </tr>
                        <tr>
                            <td><strong>OS</strong></td>
                            <td>:</td>
                            <td>${platform}</td>
                        </tr>
                        <tr>
                            <td><strong>Browser</strong></td>
                            <td>:</td>
                            <td>${browser}</td>
                        </tr>
                    </table>
                    <br>
                    <table style="width: 100%; border-collapse: collapse; border: 1px solid #ddd; table-layout: fixed;">
                        <tr style="background-color: #f4f4f4; text-align: left;">
                            <th style="width: 50%; padding: 10px; border: 1px solid #ddd;">Old Values</th>
                            <th style="width: 50%; padding: 10px; border: 1px solid #ddd;">New Values</th>
                        </tr>
                        <tr>
                            <td style="width: 50%; padding: 10px; border: 1px solid #ddd; min-height: 50px; word-wrap: break-word; overflow: hidden;">${oldValuesHtml}</td>
                            <td style="width: 50%; padding: 10px; border: 1px solid #ddd; min-height: 50px; word-wrap: break-word; overflow: hidden;">${newValuesHtml}</td>
                        </tr>
                    </table>
                `;

                $('#modal-add .modal-body').html(modalContent);
            });
        });
    </script>
@endsection
