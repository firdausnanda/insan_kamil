@extends('layouts.dashboard.main')

@section('content')
    <main class="main-content-wrapper">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row mb-8">
                <div class="col-md-12">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                        <div>
                            <!-- page header -->
                            <h2>Detail Order</h2>
                            <!-- breacrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#" class="text-inherit">Order</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Detail Order</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- button -->
                        <div>
                            <a href="#" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-xl-12 col-12 mb-5">
                    <!-- card -->
                    <div class="card h-100 card-lg">
                        <div class="card-body p-6">
                            <div class="d-md-flex justify-content-between">
                                <div class="d-flex align-items-center mb-2 mb-md-0">
                                    <h2 class="mb-0">Detail Transaksi</h2>
                                    <span class="badge bg-light-warning text-dark-warning ms-2">Pending</span>
                                </div>
                                <!-- select option -->
                                <div class="d-md-flex">
                                    <div class="mb-2 mb-md-0">
                                        <select class="form-select">
                                            <option value="selesai">Belum Diproses</option>
                                            <option value="selesai">Diproses</option>
                                            <option value="selesai">Pengiriman</option>
                                            <option value="selesai">Selesai</option>
                                        </select>
                                    </div>
                                    <!-- button -->
                                    <div class="ms-md-3">
                                        <a href="#" class="btn btn-primary">Simpan</a>
                                        <a href="#" class="btn btn-secondary">Download Bukti Transaksi</a>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-8">
                                <div class="row">
                                    <!-- address -->
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-6">
                                            <h6>Customer Details</h6>
                                            <p class="mb-1 lh-lg">
                                                John Alex
                                                <br />
                                                anderalex@example.com
                                                <br />
                                                +998 99 22123456
                                            </p>
                                            <a href="#">View Profile</a>
                                        </div>
                                    </div>
                                    <!-- address -->
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-6">
                                            <h6>Alamat Pengiriman</h6>
                                            <p class="mb-1 lh-lg">
                                                Jl. Merdeka No. 28
                                                <br>
                                                Surabaya, Jawa Timur, 
                                                Kode Pos. 235153
                                                <br />
                                                No. Kontak. +62 1234 12345
                                            </p>
                                        </div>
                                    </div>
                                    <!-- address -->
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-6">
                                            <h6>Detail Order</h6>
                                            <p class="mb-1 lh-lg">
                                                ID Transaksi:
                                                <span class="text-dark">FC001</span>
                                                <br />
                                                Tanggal Order:
                                                <span class="text-dark">22 Oktober 2023</span>
                                                <br />
                                                Total Order:
                                                <span class="text-dark">Rp. 250.000</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <!-- Table -->
                                    <table class="table mb-0 text-nowrap table-centered">
                                        <!-- Table Head -->
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Products</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <!-- tbody -->
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-inherit">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <img src="{{ asset('images/products/product-img-1.jpg') }}"
                                                                    alt="" class="icon-shape icon-lg" />
                                                            </div>
                                                            <div class="ms-lg-4 mt-2 mt-lg-0">
                                                                <h5 class="mb-0 h6">Haldiram's Sev Bhujia</h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td><span class="text-body">Rp. 8.000</span></td>
                                                <td>10</td>
                                                <td>Rp. 80.000</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-inherit">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <img src="{{ asset('images/products/product-img-2.jpg') }}"
                                                                    alt="" class="icon-shape icon-lg" />
                                                            </div>
                                                            <div class="ms-lg-4 mt-2 mt-lg-0">
                                                                <h5 class="mb-0 h6">NutriChoice Digestive</h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td><span class="text-body">Rp. 8.000</span></td>
                                                <td>10</td>
                                                <td>Rp. 80.000</td>
                                            </tr>
                                                <td>
                                                    <a href="#" class="text-inherit">
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                <img src="{{ asset('images/products/product-img-4.jpg') }}"
                                                                    alt="" class="icon-shape icon-lg" />
                                                            </div>
                                                            <div class="ms-lg-4 mt-2 mt-lg-0">
                                                                <h5 class="mb-0 h6">Onion Flavour Potato</h5>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td><span class="text-body">Rp. 8.000</span></td>
                                                <td>10</td>
                                                <td>Rp. 80.000</td>
                                            </tr>
                                            <tr>
                                                <td class="border-bottom-0 pb-0"></td>
                                                <td class="border-bottom-0 pb-0"></td>
                                                <td colspan="1" class="fw-medium text-dark">
                                                    <!-- text -->
                                                    Sub Total :
                                                </td>
                                                <td class="fw-medium text-dark">
                                                    <!-- text -->
                                                    Rp. 24.000
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-bottom-0 pb-0"></td>
                                                <td class="border-bottom-0 pb-0"></td>
                                                <td colspan="1" class="fw-medium text-dark">
                                                    <!-- text -->
                                                    Shipping Cost
                                                </td>
                                                <td class="fw-medium text-dark">
                                                    <!-- text -->
                                                    Rp. 10.000
                                                </td>
                                            </tr>

                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td colspan="1" class="fw-semibold text-dark">
                                                    <!-- text -->
                                                    Grand Total
                                                </td>
                                                <td class="fw-semibold text-dark">
                                                    <!-- text -->
                                                    Rp. 250.000
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-6">
                            <div class="row">
                                <div class="col-md-6 mb-4 mb-lg-0">
                                    <h6>Detail Pengiriman</h6>
                                    <ul>
                                        <li>Diterima Kurir</li>
                                    </ul>
                                </div>
                                <div class="col-md-6 mb-4 mb-lg-0">
                                    <h6>Pembayaran</h6>
                                    <span>Bank BNI</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
