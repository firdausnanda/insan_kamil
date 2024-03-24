@extends('layouts.dashboard.main')

@section('content')
    <main class="main-content-wrapper">
        <div class="container">
            <div class="row mb-8">
                <div class="col-md-12">
                    <!-- page header -->
                    <div class="d-md-flex justify-content-between align-items-center">
                        <div>
                            <h2>Diskon Event</h2>
                            <!-- breacrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"
                                            class="text-inherit">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Diskon Event</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- button -->
                        <div>
                            <a class="btn btn-primary btn-tambah">Tambah Diskon</a>
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
                                <table class="table table-striped" id="diskon">
                                    <thead>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama Diskon</th>
                                        <th scope="col">Diskon</th>
                                        <th scope="col">Produk</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Diskon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-tambah">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Nama Diskon</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="nama" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Keterangan</label>
                            <div class="col-sm-8">
                                <textarea name="keterangan" class="form-control" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">Diskon</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="diskon" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Mulai Diskon</label>
                            <input type="date" class="form-control" value="{{ now() }}"
                                name="tanggal_mulai_diskon" id="tanggal_mulai_diskon" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Selesai Diskon</label>
                            <input type="date" class="form-control" name="tanggal_selesai_diskon"
                                id="tanggal_selesai_diskon" />
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Diskon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-edit">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="row mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Nama</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="nama" id="nama" required>
                                    <input type="hidden" class="form-control" name="id" id="id">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Keterangan</label>
                                <div class="col-sm-8">
                                    <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Diskon</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="diskon" id="nilai_diskon"
                                        required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Mulai Diskon</label>
                                <input type="date" class="form-control"
                                    name="tanggal_mulai_diskon" id="tanggal_mulai_diskon_edit" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tanggal Selesai Diskon</label>
                                <input type="date" class="form-control" name="tanggal_selesai_diskon"
                                    id="tanggal_selesai_diskon_edit" />
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

    {{-- Modal Produk --}}
    <div class="modal fade" id="modal-produk" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Data Produk
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped w-100" id="produk">
                            <thead>
                                <th scope="col">No.</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Aksi</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Tambah Produk --}}
    <div class="modal fade" id="modal-tambah-produk" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Data Produk
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-striped w-100" id="tambah-produk">
                            <thead>
                                <th class="text-center" scope="col">#</th>
                                <th scope="col">Nama Produk</th>
                                <th scope="col">Stok</th>
                                <th scope="col">Harga</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            // Init Datatable
            var table = $('#diskon').DataTable({
                ajax: {
                    url: "{{ route('admin.produk.diskon.index') }}",
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
                            if (row.status == 2) return `
                                ${data} <span class="badge bg-warning">Flash Sale!</span> 
                                <br> 
                                <span class="fst-italic" style="font-size: 12px;"> 
                                    ${moment(row.mulai_diskon).format('DD-MM-YYYY HH:mm')} s/d 
                                    ${moment(row.selesai_diskon).format('DD-MM-YYYY HH:mm')} 
                                </span>`

                            return `${data} <br> 
                                <span class="fst-italic" style="font-size: 12px;"> 
                                    ${moment(row.mulai_diskon).format('DD-MM-YYYY HH:mm')} s/d 
                                    ${moment(row.selesai_diskon).format('DD-MM-YYYY HH:mm')} 
                                </span>`
                        }

                    },
                    {
                        targets: 2,
                        className: 'align-middle',
                        data: 'diskon',
                        render: function(data, type, row, meta) {
                            return `${data} %`
                        }
                    },
                    {
                        targets: 3,
                        className: 'align-middle',
                        data: 'produk_count',
                        render: function(data, type, row, meta) {
                            return `<button class="btn btn-outline-info btn-sm btn-produk">${data} Produk</button>
                            <button class="btn btn-link btn-sm btn-tambah-produk text-decoration-none"><i class="fa-solid fa-circle-plus"></i> Tambah</button>`
                        }
                    },
                    {
                        targets: 4,
                        className: 'align-middle',
                        data: 'status',
                        render: function(data, type, row, meta) {
                            if ($.now() >= Date.parse(row.mulai_diskon) && $.now() <= Date.parse(row
                                    .selesai_diskon)) {
                                return `<span class="badge bg-success">Aktif</span>`;
                            } else if (Date.parse(row.mulai_diskon) >= $.now()) {
                                return `<span class="badge bg-info">Pending</span>`;
                            } else {
                                return `<span class="badge bg-danger">Tidak Aktif</span>`;
                            }
                        }
                    },
                    {
                        targets: 5,
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

            //Flatpickr
            flatpickr("#tanggal_selesai_diskon", {
                locale: "id",
                altInput: true,
                altFormat: "j F Y, H:i",
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });

            //Flatpickr
            flatpickr("#tanggal_mulai_diskon", {
                locale: "id",
                altInput: true,
                altFormat: "j F Y, H:i",
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });

            //Flatpickr
            let tanggal_selesai_diskon_edit = flatpickr("#tanggal_selesai_diskon_edit", {
                locale: "id",
                altInput: true,
                altFormat: "j F Y, H:i",
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });

            //Flatpickr
            let tanggal_mulai_diskon_edit = flatpickr("#tanggal_mulai_diskon_edit", {
                locale: "id",
                altInput: true,
                altFormat: "j F Y, H:i",
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });

            // Modal Tambah Show
            $(".btn-tambah").click(function(e) {
                e.preventDefault();
                $("#modal-tambah").modal('show')
            });

            // Submit Form Tambah
            $("#form-tambah").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.produk.diskon.store') }}",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        if (response.meta.status == "success") {
                            $(':input').val('');
                            $('#modal-tambah').modal('hide');
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

            // Modal Edit
            $('#diskon tbody').on('click', '.btn-edit', function(event) {
                event.preventDefault();
                var data = table.row($(this).parents('tr')).data();
                var id = data.id;
                var nama = data.nama;
                var keterangan = data.keterangan;
                var diskon = data.diskon;
                var tgl_selesai = data.selesai_diskon;
                var tgl_mulai = data.mulai_diskon;

                $('#id').val(id);
                $('#nama').val(nama);
                $('#keterangan').val(keterangan);
                $('#nilai_diskon').val(diskon);
                tanggal_mulai_diskon_edit.setDate(tgl_mulai, true);
                tanggal_selesai_diskon_edit.setDate(tgl_selesai, true);
                $('#modal-edit').modal('show');
            });

            // Submit Edit
            $("#form-edit").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "PUT",
                    url: "{{ route('admin.produk.diskon.update') }}",
                    data: $(this).serialize(),
                    dataType: "JSON",
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

            // Modal Produk
            $('#diskon tbody').on('click', '.btn-produk', function(event) {
                event.preventDefault();
                var data = table.row($(this).parents('tr')).data();

                // Init Datatable
                var table2 = $('#produk').DataTable({
                    ajax: {
                        url: "{{ route('admin.produk.diskon.index') }}",
                        data: {
                            diskon_id: data.id
                        },
                        type: "GET"
                    },
                    lengthChange: false,
                    ordering: false,
                    processing: true,
                    destroy: true,
                    columnDefs: [{
                            targets: 0,
                            width: '3%',
                            className: 'align-middle text-center',
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            targets: 1,
                            className: 'align-middle',
                            data: 'nama_produk',
                            render: function(data, type, row, meta) {
                                return `${data} <br> <span class="fw-light" style="font-size: 12px">${row.kategori.nama_kategori}</span>`
                            }
                        },
                        {
                            targets: 2,
                            className: 'align-middle',
                            data: 'stok.sisa_produk',
                            render: function(data, type, row, meta) {
                                return `${data}`
                            }
                        },
                        {
                            targets: 3,
                            className: 'align-middle',
                            data: 'harga.harga_akhir',
                            render: function(data, type, row, meta) {
                                return $.fn.dataTable.render.number('.', ',', 0, 'Rp ',
                                        ',-')
                                    .display(
                                        `${data}`
                                    );
                            }
                        },
                        {
                            targets: 4,
                            className: 'align-middle text-center',
                            render: function(data, type, row, meta) {
                                return `<button class="btn btn-sm btn-danger btn-hapus"><i class="fa-regular fa-trash-can"></i></button>`;
                            }
                        },
                    ]
                });

                // Init Datatable
                $('#produk tbody').on('click', '.btn-hapus', function(event) {
                    event.preventDefault();
                    var data2 = table2.row($(this).parents('tr')).data();

                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('admin.produk.diskon.produk_destroy') }}",
                        data: {
                            id_diskon: data.id,
                            id_produk: data2.id
                        },
                        dataType: 'json',
                        beforeSend: function() {
                            $.LoadingOverlay('show');
                        },
                        success: function(response) {
                            $.LoadingOverlay('hide');
                            if (response.meta.status == "success") {
                                table.ajax.reload();
                                table2.ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sukses!',
                                    text: response.meta.message,
                                    timer: 5000,
                                });
                            }
                        },
                        error: function(response) {
                            $.LoadingOverlay('hide');
                            Swal.fire('Oops!', "Gagal menyimpan data.",
                                'error');
                        },
                    });
                })

                $('#modal-produk').modal('show')
            })

            // Modal Tambah Produk
            $('#diskon tbody').on('click', '.btn-tambah-produk', function(event) {
                event.preventDefault();
                var data = table.row($(this).parents('tr')).data();
                var diskon_id = data.id;

                // Init Datatable
                var table3 = $('#tambah-produk').DataTable({
                    ajax: {
                        url: "{{ route('admin.produk.diskon.getProduk') }}",
                        data: {
                            diskon: data.id
                        },
                        type: "GET"
                    },
                    lengthChange: false,
                    ordering: false,
                    processing: true,
                    destroy: true,
                    buttons: [{
                        text: 'Simpan Data',
                        name: 'simpan',
                        className: 'btn btn-primary btn-sm btn-simpan',
                        action: function(e, dt, node, config) {
                            getSelect()
                        }
                    }],
                    columnDefs: [{
                            width: '3%',
                            targets: 0,
                            className: 'select-checkbox align-middle',
                            data: 'id',
                            render: function(data, type, row, meta) {
                                return '<input type="text" name="' + data + '" value="' +
                                    data +
                                    '" hidden>';
                            }
                        },
                        {
                            targets: 1,
                            className: 'align-middle',
                            data: 'nama_produk',
                            render: function(data, type, row, meta) {
                                return `${data} <br> <span class="fw-light" style="font-size: 12px">${row.kategori.nama_kategori}</span>`
                            }
                        },
                        {
                            targets: 2,
                            className: 'align-middle',
                            data: 'stok.sisa_produk',
                            render: function(data, type, row, meta) {
                                return `${data}`
                            }
                        },
                        {
                            targets: 3,
                            className: 'align-middle text-center',
                            data: 'harga.harga_akhir',
                            render: function(data, type, row, meta) {
                                return $.fn.dataTable.render.number('.', ',', 0, 'Rp ',
                                        ',-')
                                    .display(
                                        `${data}`
                                    );
                            }
                        },
                    ],
                    select: {
                        style: 'multi',
                        selector: 'td:first-child',
                        blurable: false,
                    },
                    initComplete: function() {
                        $('#tambah-produk').DataTable().buttons().container().appendTo(
                            '#tambah-produk_wrapper .col-md-6:eq(0)');
                        $('.btn-simpan').removeClass("btn-secondary");
                    },
                });

                // Get Selected Row
                function getSelect() {
                    var data = table3.rows({
                        selected: true
                    }).data();

                    var dataProduk = [];
                    for (var i = 0; i < data.length; i++) {
                        dataProduk.push(data[i].id);
                    }

                    if (data.length > 0) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.produk.diskon.produk_store') }}",
                            data: {
                                diskon: diskon_id,
                                data_produk: dataProduk
                            },
                            dataType: 'json',
                            beforeSend: function() {
                                $.LoadingOverlay('show');
                            },
                            success: function(response) {
                                $.LoadingOverlay('hide');
                                if (response.meta.status == "success") {
                                    table.ajax.reload();
                                    table3.ajax.reload();
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Sukses!',
                                        text: response.meta.message,
                                        timer: 5000,
                                    });
                                }
                            },
                            error: function(response) {
                                $.LoadingOverlay('hide');
                                Swal.fire('Oops!', "Gagal menyimpan data.",
                                    'error');
                            },
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Pilih minimal 1 data!',
                        });
                    }
                };

                $('#modal-tambah-produk').modal('show')
            })
        });
    </script>
@endsection
