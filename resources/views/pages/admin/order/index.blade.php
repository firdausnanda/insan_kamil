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
                                    <li class="breadcrumb-item active" aria-current="page">Kategori</li>
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

                            <div class="row pt-5 ps-5">
                                <div class="col-lg-4">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-select">
                                        <option value="selesai">Belum Diproses</option>
                                        <option value="selesai">Diproses</option>
                                        <option value="selesai">Pengiriman</option>
                                        <option value="selesai">Selesai</option>
                                    </select>
                                </div>
                            </div>

                            <div class="table-responsive p-5">
                                <table class="table table-striped" id="produks">
                                    <thead>
                                        <th scope="col">No.</th>
                                        <th scope="col">ID Transaksi</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Tanggal Order</th>
                                        <th scope="col">Total Transaksi</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
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
                                            <td>2</td>
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
                                            <td>3</td>
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
                                            <td>4</td>
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
                                            <td>5</td>
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
        </div>
    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var table = $('#produks').DataTable();
        });
    </script>
@endsection

