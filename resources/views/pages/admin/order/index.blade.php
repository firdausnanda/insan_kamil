@extends('layouts.dashboard.main')

@section('content')
    <main class="main-content-wrapper">
        <div class="container">
            <div class="row mb-8">
                <div class="col-md-12">
                    <!-- page header -->
                    <div class="d-md-flex justify-content-between align-items-center">
                        <div>
                            <h2>Order</h2>
                            <!-- breacrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"
                                            class="text-inherit">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Order</li>
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

                        <div class="alert alert-primary" role="alert">
                            <strong class="ms-2">Note</strong>
                            <ol>
                                <li>
                                    Belum Diproses : Data pembeli yang sudah melakukan order dan melakukan pembayaran
                                </li>
                                <li>
                                    Diproses : Data order yang sedang dilakukan pengepakan produk
                                </li>
                                <li>
                                    Pengiriman : Data order yang sudah dikirim dan memiliki resi
                                </li>
                                <li>
                                    Selesai : Order sudah selesai dan diterima oleh pengguna
                                </li>
                            </ol>
                        </div>


                        <!-- card body -->
                        <div class="card-body p-0">

                            <div class="row pt-5 ps-5">
                                <div class="col-lg-4">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-select" id="status">
                                        <option value="6">Transaksi Diperiksa</option>
                                        <option value="2">Belum Diproses</option>
                                        <option value="3">Diproses</option>
                                        <option value="4">Pengiriman</option>
                                        <option value="5">Selesai</option>
                                    </select>
                                </div>
                            </div>

                            <div class="table-responsive p-5">
                                <table class="table table-striped w-100" id="produks">
                                    <thead>
                                        <th scope="col">No.</th>
                                        <th scope="col">ID Transaksi</th>
                                        <th scope="col">Tanggal Order</th>
                                        <th scope="col">Total Transaksi</th>
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

    <!-- Modal Bukti Transaksi -->
    <div class="modal fade" id="modal-bukti" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Upload Bukti Transaksi
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <label for="" class="form-label">Nama Rekening</label>
                            <input type="text" class="form-control" name="nama_rekening" readonly id="nama_rekening">
                        </div>
                        <div class="col-lg-12">
                            <label for="" class="form-label">Tranfer ke</label>
                            <input type="text" class="form-control" name="transfer_ke" readonly id="transfer_ke">
                        </div>
                        <div class="col-lg-12">
                            <label for="" class="form-label d-block">Lihat Bukti</label>
                            <input type="hidden" id="lihat-bukti">
                            <input type="hidden" id="id_order">
                            <button class="btn btn-primary btn-lihat-bukti"><i class="fa-solid fa-eye"></i></button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary btn-konfirmasi">Konfirmasi</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            // init datatable
            var table = $('#produks').DataTable({
                ajax: {
                    url: "{{ route('admin.order.index') }}",
                    type: "GET",
                    data: function(d) {
                        d.status = $('#status').val()
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
                        data: 'id',
                        render: function(data, type, row, meta) {

                            var link = "{{ route('admin.order.detail', ':id') }}";
                            link = link.replace(':id', data);

                            if (row.status == 1) {
                                return `<button class="btn btn-link p-0 text-decoration-none text-info btn-bukti text-start">${row.user.name}</button> <br> <span style="font-size: 12px">${data}</span>`
                            } else {
                                return `<a class="btn btn-link p-0 text-decoration-none text-info text-start" href="${link}">${row.user.name}</a> <br> <span style="font-size: 12px">${data}</span>`
                            }
                        }
                    },
                    {
                        targets: 2,
                        className: 'align-middle text-center',
                        data: 'created_at',
                        render: function(data, type, row, meta) {
                            if (data)
                                return `${moment(data).format('DD-MM-YYYY', 'de')} <br> <i>${moment(data).format('hh:mm:ss', 'de')}`
                            return `-`
                        }
                    },
                    {
                        targets: 3,
                        className: 'align-middle text-center',
                        data: 'harga_total',
                        render: function(data, type, row, meta) {
                            if (row.pembayaran_sum_harga_jual) {
                                return $.fn.dataTable.render.number('.', ',', 0, 'Rp ', ',-')
                                    .display(row.pembayaran_sum_harga_jual)
                            } else {
                                return 0
                            }
                        }
                    },
                    {
                        targets: 4,
                        className: 'align-middle text-center',
                        data: 'status',
                        render: function(data, type, row, meta) {
                            if (data == 2) {
                                return `<span class="badge bg-light-danger text-dark-danger">Belum Diproses</span>`
                            } else if (data == 3) {
                                return `<span class="badge bg-light-warning text-dark-warning">Diproses</span>`
                            } else if (data == 4) {
                                return `<span class="badge bg-light-info text-dark-info">Dikirim</span>`
                            } else if (data == 1) {
                                return `<span class="badge bg-secondary text-white">Konfirmasi Pembayaran</span>`
                            } else {
                                return `<span class="badge bg-light-primary text-dark-primary">Selesai</span>`
                            }
                        }
                    },
                    {
                        targets: 5,
                        className: 'align-middle text-center',
                        data: 'id',
                        render: function(data, type, row, meta) {

                            var link = "{{ route('admin.order.detail', ':id') }}";
                            link = link.replace(':id', data);

                            let menu = `<li>
                                            <a class="dropdown-item" href="${link}">
                                                <i class="bi bi-pencil-square me-3"></i>
                                                    Edit
                                            </a>
                                        </li>`

                            if (row.status == 1) {
                                menu = `<li>
                                            <button class="dropdown-item btn-bukti">
                                                <i class="bi bi-check-square me-3"></i>
                                                    Konfirmasi
                                            </button>
                                        </li>`
                            }

                            return (`<div class="dropdown">
                                        <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="feather-icon icon-more-vertical fs-5"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            ${menu}
                                        </ul>
                                    </div>`);
                        }
                    },
                ]
            });

            // filter
            $('#status').change(function(e) {
                e.preventDefault();
                table.ajax.reload()
            });

            // Detail
            $('#produks tbody').on('click', '.btn-bukti', function(event) {
                event.preventDefault()

                var data = table.row($(this).parents('tr')).data();

                $('#id_order').val(data.id)
                $('#nama_rekening').val(data.bukti_transaksi[0].nama_rekening)
                $('#transfer_ke').val(data.bukti_transaksi[0].transfer_ke)
                $('#tgl_transfer').val(data.bukti_transaksi[0].tgl_transfer)
                $('#lihat-bukti').val(data.bukti_transaksi[0].gambar)
                $('#modal-bukti').modal('show')

            })

            // Klik Lihat
            $('.btn-lihat-bukti').click(function(e) {
                e.preventDefault();

                let a = $('#lihat-bukti').val()

                if (a == null || a == '') {
                    Swal.fire('Gagal!', 'Data bukti gambar tidak tersedia', 'error')
                }else{
                    let b = `{{ asset('storage/bukti-transaksi/${a}') }}`
                    window.open(b, '_blank');
                }

            });

            // Konfirmasi Pembayaran
            $('.btn-konfirmasi').click(function (e) { 
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.produk.konfirmasi') }}",
                    data: {
                        id_order: $('#id_order').val()
                    },
                    dataType: "JSON",
                    beforeSend: function(){
                        $.LoadingOverlay('show')                        
                    },
                    success: function (response) {
                        $.LoadingOverlay('hide')
                        table.ajax.reload();
                        $('#modal-bukti').modal('hide')
                        Swal.fire('Sukses!', response.meta.message, 'success');
                    }
                });

            });
        });
    </script>
@endsection
