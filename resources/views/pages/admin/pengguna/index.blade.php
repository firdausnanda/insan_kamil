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
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Nomor Telepon</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="no_telp" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Alamat</label>
                            <div class="col-sm-8">
                                <textarea name="alamat" class="form-control" cols="30" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Provinsi</label>
                            <div class="col-sm-8">
                                <select name="provinsi" id="provinsi">
                                    <option value="">-- Pilih Provinsi --</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Kabupaten</label>
                            <div class="col-sm-8">
                                <select name="kota" id="kota">
                                    <option value="">-- Pilih Kabupaten/Kota --</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="password" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Role</label>
                            <div class="col-sm-8">
                                <select name="role" class="form-select">
                                    <option value="">-- Pilih Role --</option>
                                    @foreach ($role as $r)
                                        <option value="{{ $r->name }}">{{ Str::title($r->name) }}</option>
                                    @endforeach
                                </select>
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

    {{-- Modal Edit --}}
    <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-edit">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Nama Pengguna</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama" id="nama_e" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Nomor Telepon</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="no_telp" id="no_telp_e" required>
                                <input type="hidden" name="id_e" id="id_e">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="email" id="email_e" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Alamat</label>
                            <div class="col-sm-8">
                                <textarea name="alamat" id="alamat_e" class="form-control" cols="30" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Provinsi</label>
                            <div class="col-sm-8">
                                <select name="provinsi" id="provinsi_e">
                                    <option value="">-- Pilih Provinsi --</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Kabupaten</label>
                            <div class="col-sm-8">
                                <select name="kota" id="kota_e">
                                    <option value="">-- Pilih Kabupaten/Kota --</option>
                                    @foreach ($kota as $i)
                                        <option value="{{ $i->id }}">{{ $i->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Role</label>
                            <div class="col-sm-8">
                                <select name="role" class="form-select" id="role_e">
                                    <option value="">-- Pilih Role --</option>
                                    @foreach ($role as $r)
                                        <option value="{{ $r->name }}">{{ Str::title($r->name) }}</option>
                                    @endforeach
                                </select>
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

    {{-- Modal Edit Password --}}
    <div class="modal fade" id="modal-password" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Password Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="password">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="password_baru">
                                    Password Baru
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" id="password_baru" name="password_baru" class="form-control"
                                    placeholder="*******" required />
                                <input type="hidden" name="password_e" id="password_e">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="password_ulangi">
                                    Ulangi Password Baru
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" id="password_ulangi" name="password_ulangi" class="form-control"
                                    placeholder="*******" required />
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
                            var button
                            if (row.google_id == null) {
                                button = `<div class="dropdown">
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
                                            <li>
                                                <button class="dropdown-item btn-password" type="button">
                                                    <i class="bi bi-lock me-3"></i>
                                                    Ubah Password
                                                </button>
                                            </li>
                                        </ul>
                                    </div>`
                            } else {
                                button = `<div class="dropdown">
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
                                    </div>`
                            }
                            return button;
                        }
                    },
                ]
            });

            // Init Select 2
            $('#provinsi').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Provinsi --',
                dropdownParent: $("#modal-tambah")
            });

            // Init Select 2
            $('#provinsi_e').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Provinsi --',
                dropdownParent: $("#modal-edit")
            });

            // Select Provinsi
            $.ajax({
                url: "{{ route('admin.pengguna.provinsi') }}",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(response) {
                    $.each(response.data, function(index, value) {
                        $("#provinsi").append(
                            `<option value="${value['id']}">${value['name']}</option>`);

                        $("#provinsi_e").append(
                            `<option value="${value['id']}">${value['name']}</option>`);
                    });
                },
            });

            // Init Select 2
            $('#kota').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Kota/Kabupaten --',
                dropdownParent: $("#modal-tambah")
            });

            // Init Select 2
            $('#kota_e').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Kota/Kabupaten --',
                dropdownParent: $("#modal-edit")
            });

            // Select Kota
            $('#provinsi').on('select2:select', function(e) {
                var id = e.params.data.id;

                var link = "{{ route('admin.pengguna.kota', ':id') }}";
                link = link.replace(':id', id);

                $.ajax({
                    url: link,
                    data: $(this).serialize(),
                    dataType: "JSON",
                    delay: 250,
                    beforeSend: function() {
                        $('#kota').attr('disabled', 'disabled');
                        $('#kota').empty().append(
                            '<option value="" selected disabled>-- Pilih Kota/Kabupaten --</option>'
                        );
                    },
                    success: function(data) {
                        $.each(data.data, function(index, value) {
                            $("#kota").append("<option value='" + value['id'] + "'>" +
                                value['name'] + "</option>");
                        });
                        $('#kota').removeAttr('disabled');
                    },
                    error: function() {
                        $('#kota').removeAttr('disabled');
                    }
                });
            })

            // Select Kota
            $('#provinsi_e').on('select2:select', function(e) {
                var id = e.params.data.id;

                var link = "{{ route('admin.pengguna.kota', ':id') }}";
                link = link.replace(':id', id);

                $.ajax({
                    url: link,
                    data: $(this).serialize(),
                    dataType: "JSON",
                    delay: 250,
                    beforeSend: function() {
                        $('#kota_e').attr('disabled', 'disabled');
                        $('#kota_e').empty().append(
                            '<option value="" selected disabled>-- Pilih Kota/Kabupaten --</option>'
                        );
                    },
                    success: function(data) {
                        $.each(data.data, function(index, value) {
                            $("#kota_e").append("<option value='" + value['id'] + "'>" +
                                value['name'] + "</option>");
                        });
                        $('#kota_e').removeAttr('disabled');
                    },
                    error: function() {
                        $('#kota_e').removeAttr('disabled');
                    }
                });
            })

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

            // Form Submit
            $("#form-tambah").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.pengguna.store') }}",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        if (response.meta.status == "success") {
                            table.ajax.reload()
                            $(':input').val('');
                            $('#modal-tambah').modal('hide');
                            Swal.fire('Sukses!', 'Data berhasil disimpan', 'success');
                        }
                    },
                    error: function(response) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Gagal!', 'Periksa kembali data anda.', 'error');
                    },
                });
            });

            // Modal Edit
            $('#pengguna tbody').on('click', '.btn-edit', function(event) {
                event.preventDefault();
                var data = table.row($(this).parents('tr')).data();

                $('#id_e').val(data.id);
                $('#nama_e').val(data.name);
                $('#email_e').val(data.email);
                $('#no_telp_e').val(data.no_telp);
                $('#alamat_e').val(data.alamat);
                $('#role_e').val(data.roles[0].name).change();

                if (data.provinsi != null) {
                    $('#provinsi_e').val(data.provinsi).change();
                }

                if (data.kota != null) {
                    $('#kota_e').val(data.kota).change();
                }

                $('#modal-edit').modal('show');
            });

            // Modal Password Show
            $('#pengguna tbody').on('click', '.btn-password', function(event) {
                event.preventDefault();
                var data = table.row($(this).parents('tr')).data();
                $('#password_e').val(data.id)
                $('#modal-password').modal('show');
            });

            // Form Submit Edit
            $("#form-edit").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "PUT",
                    url: "{{ route('admin.pengguna.update') }}",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        if (response.meta.status == "success") {
                            table.ajax.reload()
                            $(this).closest('form').find(':input').val('');
                            $('#modal-edit').modal('hide');
                            Swal.fire('Sukses!', 'Data berhasil diubah', 'success');
                        }
                    },
                    error: function(response) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Gagal!', 'Periksa kembali data anda.', 'error');
                    },
                });
            });

            // Form Submit Password
            $("#password").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.pengguna.password') }}",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        if (response.meta.status == "success") {
                            table.ajax.reload()
                            $(':input').val('');
                            $('#modal-password').modal('hide');
                        }
                    },
                    error: function(response) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Gagal!', 'Periksa kembali data anda.', 'error');
                    },
                });
            });
        });
    </script>
@endsection
