@extends('layouts.dashboard.main')

@section('content')
    <main class="main-content-wrapper">
        <section class="container">
            <!-- row -->
            <div class="row mb-8">
                <div class="col-md-12">
                    <!-- card -->
                    <div class="card bg-light border-0 rounded-4"
                        style="background-image: url({{ asset('images/slider/slider-image') }}-1.jpg); background-repeat: no-repeat; background-size: cover; background-position: right;">
                        <div class="card-body p-lg-12">
                            <h2>Selamat Datang Kembali!
                            </h2>
                            <p>{{ strip_tags($quote) }}.</p>
                            <a href="{{ route('admin.produk.index') }}" class="btn btn-primary">
                                Create Product
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- table -->

            <div class="row">
                <div class="col-lg-4 col-12 mb-6">
                    <!-- card -->
                    <div class="card h-100 card-lg">
                        <!-- card body -->
                        <div class="card-body p-6">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-6">
                                <div>
                                    <h4 class="mb-0 fs-5">Transaksi</h4>
                                </div>
                                <div class="icon-shape icon-md bg-light-danger text-dark-danger rounded-circle">
                                    <i class="bi bi-currency-dollar fs-5"></i>
                                </div>
                            </div>
                            <!-- project number -->
                            <div class="lh-1">
                                <h1 class=" mb-2 fw-bold fs-2">Rp. 10.000.000</h1>
                                <span>Total Transaksi Bulan ini</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 mb-6">
                    <!-- card -->
                    <div class="card h-100 card-lg">
                        <!-- card body -->
                        <div class="card-body p-6">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-6">
                                <div>
                                    <h4 class="mb-0 fs-5">Order</h4>
                                </div>
                                <div class="icon-shape icon-md bg-light-warning text-dark-warning rounded-circle">
                                    <i class="bi bi-cart fs-5"></i>
                                </div>
                            </div>
                            <!-- project number -->
                            <div class="lh-1">
                                <h1 class=" mb-2 fw-bold fs-2">100</h1>
                                <span><span class="text-dark me-1">35+</span>Bulan ini</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 mb-6">
                    <!-- card -->
                    <div class="card h-100 card-lg">
                        <!-- card body -->
                        <div class="card-body p-6">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-6">
                                <div>
                                    <h4 class="mb-0 fs-5">Customer</h4>
                                </div>
                                <div class="icon-shape icon-md bg-light-info text-dark-info rounded-circle">
                                    <i class="bi bi-people fs-5"></i>
                                </div>
                            </div>
                            <!-- project number -->
                            <div class="lh-1">
                                <h1 class=" mb-2 fw-bold fs-2">250</h1>
                                <span><span class="text-dark me-1">30+</span>Customer baru bulan ini</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- row -->
            <div class="row ">
                <div class="col-xl-8 col-lg-6 col-md-12 col-12 mb-6">
                    <!-- card -->
                    <div class="card h-100 card-lg">
                        <div class="card-body p-6">
                            <!-- heading -->
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="mb-1 fs-5">Pendapatan </h3>
                                    <small>(+63%) than last year)</small>
                                </div>
                                <div>
                                    <!-- select option -->
                                    <select class="form-select ">
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023" selected>2023</option>
                                    </select>
                                </div>

                            </div>
                            <!-- chart -->
                            <div id="revenueChart" class="mt-6"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-12 mb-6">
                    <!-- card -->
                    <div class="card h-100 card-lg">
                        <!-- card body -->
                        <div class="card-body p-6">
                            <!-- heading -->
                            <h3 class="mb-0 fs-5">Total Penjualan </h3>
                            <div id="totalSale" class="mt-6 d-flex justify-content-center"></div>
                            <div class="mt-4">
                                <!-- list -->
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="8"
                                            fill="currentColor" class="bi bi-circle-fill text-primary" viewBox="0 0 16 16">
                                            <circle cx="8" cy="8" r="8" />
                                        </svg> <span class="ms-1"><span class="text-dark">Produk
                                                6000</span> (2%)</span></li>
                                    <li class="mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="8"
                                            fill="currentColor" class="bi bi-circle-fill text-warning" viewBox="0 0 16 16">
                                            <circle cx="8" cy="8" r="8" />
                                        </svg> <span class="ms-1"><span class="text-dark">Order 1000</span>
                                            (11%)</span></li>
                                    <li class="mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="8"
                                            fill="currentColor" class="bi bi-circle-fill text-danger" viewBox="0 0 16 16">
                                            <circle cx="8" cy="8" r="8" />
                                        </svg> <span class="ms-1"><span class="text-dark">Terjual
                                                600</span>
                                            (1%)</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- row -->
            <div class="row ">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-6">
                    <div class="card h-100 card-lg">
                        <!-- heading -->
                        <div class="p-6">
                            <h3 class="mb-0 fs-5">Transaksi Terbaru</h3>
                        </div>
                        <div class="card-body p-0">
                            <!-- table -->
                            <div class="table-responsive">
                                <table class="table table-centered table-borderless text-nowrap table-hover">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col">ID Transaksi</th>
                                            <th scope="col">Nama Produk</th>
                                            <th scope="col">Tanggal Order</th>
                                            <th scope="col">Total Transaksi</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Detail</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td>#FC0005</td>
                                            <td>Haldiram's Sev Bhujia</td>
                                            <td>28 Maret 2023</td>
                                            <td>Rp. 100.000</td>
                                            <td>
                                                <span class="badge bg-light-primary text-dark-primary">Selesai</span>
                                            </td>
                                            <td><button class="btn btn-sm btn-info">Detail</button></td>
                                        </tr>
                                        <tr>

                                            <td>#FC0004</td>
                                            <td>NutriChoice Digestive</td>
                                            <td>24 Maret 2023</td>
                                            <td>Rp. 50.000</td>
                                            <td>
                                                <span class="badge bg-light-warning text-dark-warning">Pengiriman</span>
                                            </td>
                                            <td><button class="btn btn-sm btn-info">Detail</button></td>
                                        </tr>
                                        <tr>

                                            <td>#FC0003</td>
                                            <td>Onion Flavour Potato</td>
                                            <td>8 Februari 2023</td>
                                            <td>Rp. 100.000</td>
                                            <td>
                                                <span class="badge bg-light-danger text-dark-danger">Belum Diproses</span>
                                            </td>
                                            <td><button class="btn btn-sm btn-info">Detail</button></td>
                                        </tr>
                                        <tr>

                                            <td>#FC0002</td>
                                            <td>Blueberry Greek Yogurt</td>
                                            <td>20 Januari 2023</td>
                                            <td>Rp. 50.000</td>
                                            <td>
                                                <span class="badge bg-light-warning text-dark-warning">Pengiriman</span>
                                            </td>
                                            <td><button class="btn btn-sm btn-info">Detail</button></td>
                                        </tr>
                                        <tr>

                                            <td>#FC0001</td>
                                            <td>Slurrp Millet Chocolate</td>
                                            <td>14 Januari 2023</td>
                                            <td>Rp. 150.000</td>
                                            <td>
                                                <span class="badge bg-light-danger text-dark-danger">Belum Diproses</span>
                                            </td>
                                            <td><button class="btn btn-sm btn-info">Detail</button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
