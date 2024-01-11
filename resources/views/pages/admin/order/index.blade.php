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
                                    <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
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
                                        <th scope="col">Nama User</th>
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
                    },
                    {
                        targets: 2,
                        className: 'align-middle text-center',
                        data: 'user.name',
                    },
                    {
                        targets: 3,
                        className: 'align-middle text-center',
                        data: 'created_at',
                        render: function(data, type, row, meta) {
                            if (data) return `${moment(data).format('DD-MM-YYYY', 'de')} <br> <i>${moment(data).format('hh:mm:ss', 'de')}`
                            return `-`
                        }
                    },
                    {
                        targets: 4,
                        className: 'align-middle text-center',
                        data: 'harga_total',
                        render: function(data, type, row, meta) {
                            return $.fn.dataTable.render.number('.', ',', 0, 'Rp ', ',-').display(
                                data)
                        }
                    },
                    {
                        targets: 5,
                        className: 'align-middle text-center',
                        data: 'status',
                        render: function(data, type, row, meta) {
                            if (data == 2) {
                                return `<span class="badge bg-light-danger text-dark-danger">Belum Diproses</span>`
                            } else if (data == 3) {
                                return `<span class="badge bg-light-warning text-dark-warning">Diproses</span>`
                            } else if (data == 4) {
                                return `<span class="badge bg-light-info text-dark-info">Dikirim</span>`
                            } else {
                                return `<span class="badge bg-light-primary text-dark-primary">Selesai</span>`
                            }
                        }
                    },
                    {
                        targets: 6,
                        className: 'align-middle text-center',
                        data: 'id',
                        render: function(data, type, row, meta) {

                            var link = "{{ route('admin.order.detail', ':id') }}";
                            link = link.replace(':id', data);

                            return `<div class="dropdown">
                                        <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="feather-icon icon-more-vertical fs-5"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="${link}">
                                                    <i class="bi bi-pencil-square me-3"></i>
                                                    Edit
                                                </a>
                                            </li>
                                        </ul>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <i class="bi bi-pencil-square me-3"></i>
                                                    Non Aktifkan
                                                </a>
                                            </li>
                                        </ul>
                                    </div>`;
                        }
                    },
                ]
            });

            // filter
            $('#status').change(function(e) {
                e.preventDefault();
                table.ajax.reload()
            });
        });
    </script>
@endsection
