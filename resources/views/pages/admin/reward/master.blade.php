@extends('layouts.dashboard.main')

@section('content')
    <main class="main-content-wrapper">
        <div class="container">
            <div class="row mb-8">
                <div class="col-md-12">
                    <!-- page header -->
                    <div class="d-md-flex justify-content-between align-items-center">
                        <div>
                            <h2>Reward</h2>
                            <!-- breacrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"
                                            class="text-inherit">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Reward</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- button -->
                        <div>
                            <a class="btn btn-primary btn-tambah">Tambah Reward</a>
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

                            <div class="table-responsive p-5">
                                <table class="table table-striped" id="reward">
                                    <thead>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Kuota</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Reward</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-tambah" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Nama</label>
                                <!-- input -->
                                <input type="text" class="form-control" name="nama" />
                            </div>
                            <div class="col-lg-12">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Point yang dibutuhkan</label>
                                <!-- input -->
                                <input type="number" class="form-control" name="point" />
                            </div>
                            <div class="col-lg-12">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Deskripsi</label>
                                <!-- input -->
                                <input type="text" class="form-control" name="deskripsi" />
                            </div>
                            <div class="col-lg-12">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Kuota</label>
                                <!-- input -->
                                <input type="number" class="form-control" name="kuota" />
                            </div>

                            <div class="col-lg-12">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Gambar</label>
                                <!-- input -->
                                <input type="file" class="upload-berkas-dropify" name="gambar" data-max-file-size="2M"
                                    data-allowed-file-extensions="jpg png jpeg" id="berkas"
                                    data-errors-position="outside" />

                            </div>
                            <div class="col-lg-12">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Status</label>
                                <!-- input -->
                                <select name="status" class="form-select">
                                    <option value="1">Aktif</option>
                                    <option value="2">Non Aktif</option>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Reward</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-edit" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <input type="hidden" name="id_reward" id="id_reward">
                            <div class="col-lg-12">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Nama</label>
                                <!-- input -->
                                <input type="text" class="form-control" name="nama" id="nama" />
                            </div>
                            <div class="col-lg-12">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Point yang dibutuhkan</label>
                                <!-- input -->
                                <input type="number" class="form-control" name="point" id="point" />
                            </div>
                            <div class="col-lg-12">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Deskripsi</label>
                                <!-- input -->
                                <input type="text" class="form-control" name="deskripsi" id="deskripsi" />
                            </div>
                            <div class="col-lg-12">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Kuota</label>
                                <!-- input -->
                                <input type="number" class="form-control" name="kuota" id="kuota" />
                            </div>
                            <div class="col-lg-12">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Gambar</label>
                                <!-- input -->
                                <input type="file" class="upload-berkas-dropify" name="gambar"
                                    data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg pdf"
                                    id="berkas" data-errors-position="outside" />

                            </div>
                            <div class="col-lg-12">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Status</label>
                                <!-- input -->
                                <select name="status" class="form-select" id="status">
                                    <option value="1">Aktif</option>
                                    <option value="2">Non Aktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Ubah</button>
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
            var table = $('#reward').DataTable({
                ajax: {
                    url: "{{ route('admin.reward.master') }}",
                    type: "GET"
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
                        data: 'nama',
                        render: function(data, type, row, meta) {
                            let gambar = ''
                            if (row.gambar != '' || row.gambar != null) {
                                gambar =
                                    `<img src="{{ asset('storage/reward/${row.gambar}') }}" alt="" class="icon-shape icon-lg" />`;
                            } else {
                                gambar =
                                    `<img src="{{ asset('images/avatar/no-image.png') }}" alt="" class="icon-shape icon-lg" />`;
                            }
                            return `
                            <div class="row">
                              <div class="col-lg-2">${gambar}</div>
                              <div class="col-lg-10">
                                <b>${data}</b><br>
                                ${row.deskripsi}<br>
                                <span class="text-primary" style="font-size: 12px;">dibutuhkan <i>${row.point_total.toLocaleString('id-ID')}</i> point</span>
                              </div>
                            </div>`
                        }
                    },
                    {
                        targets: 2,
                        className: 'align-middle',
                        data: 'kuota',
                    },
                    {
                        targets: 3,
                        className: 'align-middle',
                        data: 'is_active',
                        render: function(data, type, row, meta) {
                            if (data == 1) return `<span class="badge bg-primary">Aktif</span>`
                            return `<span class="badge bg-danger">Tidak Aktif</span>`
                        }
                    },
                    {
                        targets: 4,
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
                                            <li>
                                                <button class="dropdown-item btn-aktif" type="button">
                                                  <i class="bi bi-lock me-3"></i>
                                                    Aktif/Non-Aktif
                                                </button>
                                            </li>
                                        </ul>
                                    </div>`;
                        }
                    },
                ]
            });

            // Modal Tambah Show
            $(".btn-tambah").click(function(e) {
                e.preventDefault();
                $("#modal-tambah").modal('show')
            });

            // Submit Form Tambah
            $("#form-tambah").submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    url: "{{ route('admin.reward.store') }}",
                    type: "POST",
                    data: formData,
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        if (response.meta.status == "success") {
                            Swal.fire({
                                icon: 'success',
                                title: "Sukses!",
                                text: response.meta.message,
                            }).then((result) => {
                                location.reload();
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay('hide');
                    },
                });
            });

            // init Dropify
            if ($('.upload-berkas-dropify')) {
                $('.upload-berkas-dropify').dropify({
                    messages: {
                        'default': '<i class="fa-regular fa-image icon-file"></i> <br> Unggah gambar anda disini <br> <span>  Type: JPG | JPEG | PNG (Max. 2MB) </span> <br> <button class="btn btn-yellow mt-3">Pilih File</button>',
                        'replace': 'Klik untuk mengganti gambar anda',
                        'remove': 'Hapus',
                        'error': 'Ooops, something wrong happended.'
                    },
                });
            }

            // Modal Edit
            $('#reward tbody').on('click', '.btn-edit', function(event) {
                event.preventDefault();
                var data = table.row($(this).parents('tr')).data();
                var id = data.id;
                var nama = data.nama;
                var point = data.point_total;
                var deskripsi = data.deskripsi;
                var kuota = data.kuota;
                var status = data.is_active;

                $('#id_reward').val(id);
                $('#nama').val(nama);
                $('#point').val(point);
                $('#deskripsi').val(deskripsi);
                $('#kuota').val(kuota);
                $('#status').val(status).change();
                $('#modal-edit').modal('show');
            });

            // Submit Edit
            $("#form-edit").submit(function(e) {
                e.preventDefault();

                var formDataa = new FormData(document.getElementById("form-edit"));

                $.ajax({
                    type: "POSt",
                    url: "{{ route('admin.reward.update') }}",
                    data: formDataa,
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        if (response.meta.status == "success") {
                            $('#modal-edit').modal('hide');
                            table.ajax.reload();
                            Swal.fire('Sukses!', response.meta.message, 'success');
                        }
                    },
                    error: function(response) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Gagal!', 'Periksa kembali data anda.', 'error');
                        console.log(response.responseJSON.message);
                    },
                });
            });

            // Modal Aktif
            $('#reward tbody').on('click', '.btn-aktif', function(event) {
                event.preventDefault();
                var data = table.row($(this).parents('tr')).data();

                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.reward.aktif') }}",
                    data: {
                        id: data.id,
                        status: data.is_active
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        table.ajax.reload();
                        Swal.fire('Sukses!', 'Data berhasil diubah!', 'success');
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
