@extends('layouts.dashboard.main')

@section('content')
    <main class="main-content-wrapper">
        <div class="container">
            <div class="row mb-8">
                <div class="col-md-12">
                    <!-- page header -->
                    <div class="d-md-flex justify-content-between align-items-center">
                        <div>
                            <h2>Pengguna</h2>
                            <!-- breacrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- button -->
                        <div>
                            <button type="button" class="btn btn-primary btn-tambah">Tambah Pengguna</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row ">
                <div class="col-xl-12 col-12 mb-5">
                    <!-- card -->
                    <div class="card h-100 card-lg">

                        <!-- card body -->
                        <div class="card-body p-0">

                            <div class="row pt-5 ps-5">
                                <div class="col-lg-4">
                                    <label for="role">Role</label>
                                    <select name="role" id="role" class="form-select">
                                        <option value="user">User</option>
                                        <option value="admin">Admin</option>
                                        <option value="superadmin">Superadmin</option>
                                    </select>
                                </div>
                            </div>

                            <div class="table-responsive p-5">
                                <table class="table table-striped" id="pengguna">
                                    <thead>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama Pengguna</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">No. Telp</th>
                                        <th scope="col">Registrasi</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Modal Tambah --}}
    <div class="modal fade" id="modal-tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-tambah">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Nama Pengguna</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            // Init Datatable
            var table = $('#pengguna').DataTable({
                ajax: {
                    url: "{{ route('admin.pengguna.index') }}",
                    type: "GET",
                    data: function(d) {
                        d.role = $('#role').val()
                    }
                },
                lengthChange: false,
                ordering: false,
                processing: true,
                columnDefs: [{
                        targets: 0,
                        width: '10%',
                        className: 'align-middle text-center',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        targets: 1,
                        className: 'align-middle',
                        data: 'avatar',
                        render: function(data, type, row, meta) {
                            if (data == '' || data == null) {
                                return `<img src="{{ asset('images/avatar/user.png') }}" alt="" class="avatar avatar-xs rounded-circle me-2" /> ${row.name}`
                            } else {
                                return `<img src="${data}" alt="" class="avatar avatar-xs rounded-circle me-2" /> ${row.name}`
                            }
                        }
                    },
                    {
                        targets: 2,
                        className: 'align-middle',
                        data: 'email',
                        render: function(data, type, row, meta) {
                            if (data) {
                                return data
                            }
                            return '-'
                        }
                    },
                    {
                        targets: 3,
                        className: 'align-middle',
                        data: 'no_telp',
                        render: function(data, type, row, meta) {
                            if (data) {
                                return data
                            }
                            return '-'
                        }
                    },
                    {
                        targets: 4,
                        className: 'align-middle',
                        data: 'created_at',
                        render: function(data, type, row, meta) {
                            if (data)
                            return `${moment(row.created_at).format('DD-MM-YYYY', 'de')} <br> <i>${moment(row.created_at).format('hh:mm:ss', 'de')}`
                            return `-`
                        }
                    },
                    {
                        targets: 5,
                        className: 'align-middle',
                        data: 'status',
                        render: function(data, type, row, meta) {
                            if (data == 1) {
                                return `<span class="badge bg-light-primary text-dark-primary">Aktif</span>`
                            }
                            return '<span class="badge bg-light-danger text-dark-danger">Tidak Aktif</span>'
                        }
                    },
                    {
                        targets: 6,
                        className: 'align-middle text-center',
                        render: function(data, type, row, meta) {
                            return `<div class="dropdown">
                                        <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="feather-icon icon-more-vertical fs-5"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <button class="dropdown-item btn-edit" type="button">
                                                    <i class="bi bi-pencil-square me-3"></i>
                                                    Edit
                                                </button>
                                            </li>
                                        </ul>
                                    </div>`;
                        }
                    },
                ]
            });

            // Filter
            $('#role').change(function(e) {
                e.preventDefault();
                table.ajax.reload()
            });

            // Modal Tambah Show
            $(".btn-tambah").click(function(e) {
                e.preventDefault();
                $("#modal-tambah").modal('show')
            });
        });
    </script>
@endsection
