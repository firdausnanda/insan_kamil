@extends('layouts.dashboard.main')

@section('content')
    <main class="main-content-wrapper">
        <div class="container">
            <div class="row mb-8">
                <div class="col-md-12">
                    <!-- page header -->
                    <div class="d-md-flex justify-content-between align-items-center">
                        <div>
                            <h2>Ulasan</h2>
                            <!-- breacrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Ulasan</li>
                                </ol>
                            </nav>
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
                                <table class="table table-striped" id="ulasan">
                                    <thead>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Rating</th>
                                        <th scope="col">Ulasan</th>
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

    <!-- Modal Body -->
    <div class="modal fade" id="modal-edit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Ubah Data Ulasan
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-edit">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Rating</label>
                                <input name="rating" id="rating" class="rating rating-loading input-1" data-size="sm"
                                    data-show-clear="false" data-show-caption="true" data-min="0" data-max="5"
                                    data-step="1">
                            </div>
                            <div class="col-lg-12">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Ulasan</label>
                                <textarea name="comment" class="form-control" id="comment" cols="5" rows="5"></textarea>
                                <input type="hidden" class="form-control" name="id" id="id">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batalkan
                        </button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
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
            var table = $('#ulasan').DataTable({
                ajax: {
                    url: "{{ route('admin.ulasan.index') }}",
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
                        data: 'produk.nama_produk',
                        render: function(data, type, row, meta) {
                            return `${row.produk.nama_produk}`
                        }
                    },
                    {
                        targets: 2,
                        className: 'align-middle',
                        data: 'produk.nama_produk',
                        render: function(data, type, row, meta) {
                            var star = ''

                            for (var i = 1; i <= row.rating; i++) {
                                star += '<i class="bi bi-star-fill text-primary"></i>'
                            }

                            var ht = 5 - row.rating

                            if (ht < 5) {
                                for (let i = 0; i < ht; i++) {
                                    star += '<i class="bi bi-star-fill"></i>'
                                }
                            }

                            return `${star} <span style='font-size: 13px'>${row.rating}</span> <br> <span class='text-secondary' style='font-size: 12px;'>${row.user.name}<span>`
                        }
                    },
                    {
                        targets: 3,
                        className: 'align-middle',
                        data: 'comment',
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
                                                <button class="dropdown-item btn-hapus" type="button">
                                                    <i class="bi bi-trash me-3"></i>
                                                    Hapus
                                                </button>
                                            </li>
                                        </ul>
                                    </div>`;
                        }
                    },
                ]
            });

            // init
            $(".input-id").rating();

            // Modal Edit
            $('#ulasan tbody').on('click', '.btn-edit', function(event) {
                event.preventDefault();

                var data = table.row($(this).parents('tr')).data();

                var id = data.id;
                var ulasan = data.comment;
                var ratings = data.rating;

                $('#id').val(id);
                $('#comment').val(ulasan);
                $('#rating').rating("update", ratings);

                $('#modal-edit').modal('show')
            });

            // Submit Edit
            $("#form-edit").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "PUT",
                    url: "{{ route('admin.ulasan.update') }}",
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

            // Hapus
            $('#ulasan tbody').on('click', '.btn-hapus', function(event) {
                event.preventDefault()

                var data = table.row($(this).parents('tr')).data();

                Swal.fire({
                    title: "Data akan dihapus?",
                    text: "Data yang sudah dihapus tidak bisa dikembalikan lagi!",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#889397",
                    confirmButtonText: "Lanjutkan",
                    cancelButtonText: "Batalkan",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('admin.ulasan.destroy') }}",
                            data: {
                                id: data.id
                            },
                            dataType: "JSON",
                            beforeSend: function() {
                                $.LoadingOverlay('show');
                            },
                            success: function(response) {
                                $.LoadingOverlay('hide');
                                if (response.meta.status == "success") {
                                    table.ajax.reload();
                                    Swal.fire('Sukses!', response.meta.message,
                                        'success');
                                }
                            },
                            error: function(response) {
                                $.LoadingOverlay('hide');
                                Swal.fire('Gagal!', 'Periksa kembali data anda.',
                                    'error');
                                console.log(response.responseJSON.message);
                            },
                        });
                    }
                });
            });

        });
    </script>
@endsection
