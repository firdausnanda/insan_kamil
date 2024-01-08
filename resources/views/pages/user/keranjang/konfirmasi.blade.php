@extends('layouts.landing.main')

@section('content')
    {{-- Konten --}}
    <section class="mt-8">
        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">
                <div class="col-xl-12 col-12 mb-5">
                    <!-- card -->
                    <div class="card h-100 card-lg pb-5">
                        <div class="card-body p-6">
                            <div class="d-md-flex justify-content-between">
                                <div class="d-flex align-items-center mb-2 mb-md-0">
                                    <h2 class="mb-0">Data Pesanan</h2>
                                </div>
                            </div>
                            <div class="mt-8">

                                {{-- Menu Navigation --}}
                                <div class="gap-2" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check btn-status" name="status" id="btnradio1"
                                        value="semua" autocomplete="off" checked="">
                                    <label class="btn btn-outline-primary" for="btnradio1">Semua</label>

                                    <input type="radio" class="btn-check btn-status" name="status" id="btnradio2"
                                        value="menunggu pembayaran" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btnradio2">Menunggu Pembayaran</label>

                                    <input type="radio" class="btn-check btn-status" name="status" id="btnradio3"
                                        value="pengemasan" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btnradio3">Pengemasan</label>

                                    <input type="radio" class="btn-check btn-status" name="status" id="btnradio4"
                                        value="dikirim" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btnradio4">Dikirim</label>

                                </div>

                                <div class="table-responsive mt-5">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">Tanggal Transaksi</th>
                                                <th scope="col">Total Transaksi</th>
                                                <th scope="col">Status Transaksi</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="">
                                                <td scope="row">R1C1</td>
                                                <td>R1C2</td>
                                                <td>R1C3</td>
                                                <td>R1C3</td>
                                                <td>R1C3</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
