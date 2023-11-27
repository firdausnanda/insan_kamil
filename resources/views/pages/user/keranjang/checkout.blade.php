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
                    <div class="card h-100 card-lg">
                        <div class="card-body p-6">
                            <div class="d-md-flex justify-content-between">
                                <div class="d-flex align-items-center mb-2 mb-md-0">
                                    <h2 class="mb-0">Detail Transaksi</h2>
                                    <span class="badge bg-light-warning text-dark-warning ms-2">Pending</span>
                                </div>
                            </div>
                            <div class="mt-8">
                                <div class="row">
                                    <!-- address -->
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-6">
                                            <h6>Customer Details</h6>
                                            <p class="mb-1 lh-lg">
                                                {{ $data[0]->user->name }}
                                                <br />
                                                {{ $data[0]->user->email }}
                                                <br />
                                                {{ $data[0]->user->no_telp }}
                                            </p>
                                            <a class="btn btn-secondary mt-2 btn-sm" href="#">Ubah Data</a>
                                        </div>
                                    </div>
                                    <!-- address -->
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-6">
                                            <h6>Alamat Pengiriman</h6>
                                            <p class="mb-1 lh-lg">
                                                {{ $data[0]->user->alamat }}
                                                <br>
                                                {{ $data[0]->user->city->name }}, {{ $data[0]->user->province->name }}
                                                <br>
                                                Kode Pos. {{ $data[0]->user->city->postal_code }}
                                                <br />
                                            </p>
                                        </div>
                                    </div>
                                    <!-- address -->
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-2">
                                            <h6>Detail Pengiriman</h6>
                                            <p class="mb-1 lh-lg">
                                                Jasa Pengiriman:
                                                <select class="form-select" name="jasa_pengiriman" id="jasa_pengiriman">
                                                    <option value="">Pilih Jasa Pengiriman</option>
                                                    <option value="jne">JNE Express</option>
                                                    <option value="pos">Pos Indonesia</option>
                                                    <option value="tiki">TIKI</option>
                                                </select>
                                            </p>
                                        </div>
                                        <select class="form-select" name="pilih_paket" id="pilih_paket" disabled>
                                            <option value="">Pilih Paket Pengiriman</option>
                                        </select>
                                        <a class="btn btn-primary mt-2" href="#">Lakukan Pemesanan</a>
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
                                            @foreach ($data as $d)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                @if ($d->produk->gambar_produk)
                                                                    <img src="{{ asset('storage/produk/' . $d->produk->gambar_produk[0]->gambar) }}"
                                                                        alt="" class="icon-shape icon-lg" />
                                                                @else
                                                                    <img src="{{ asset('images/products/product-img-1.jpg') }}"
                                                                        alt="" class="icon-shape icon-lg" />
                                                                @endif
                                                            </div>
                                                            <div class="ms-lg-4 mt-2 mt-lg-0">
                                                                <h5 class="mb-0 h6">{{ $d->produk->nama_produk }}</h5>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><span class="text-body">{{ rupiah($d->harga_jual) }}</span></td>
                                                    <td>{{ $d->jumlah_produk }}</td>
                                                    <td>{{ rupiah($d->harga_jual * $d->jumlah_produk) }}</td>
                                                </tr>
                                            @endforeach

                                            <tr>
                                                <td class="border-bottom-0 pb-0"></td>
                                                <td class="border-bottom-0 pb-0"></td>
                                                <td colspan="1" class="fw-medium text-dark">
                                                    <!-- text -->
                                                    Sub Total :
                                                </td>
                                                <td class="fw-medium text-dark">
                                                    <!-- text -->
                                                    <span id="sub_total">
                                                        {{ rupiah($subTotal) }}
                                                    </span>
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
                                                    <span id="shipping_cost">
                                                        0
                                                    </span>
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
                                                    <span id="grand_total">
                                                        {{ rupiah($subTotal) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-6">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            // Get Paket Pengiriman
            $('#jasa_pengiriman').change(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "GET",
                    url: "{{ route('user.order.ongkir') }}",
                    data: {
                        city_destination:"{{ $data[0]->user->kota }}",
                        courier:$('#jasa_pengiriman').val(),
                        weight:"{{ $beratProduk }}"
                    },
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response);
                    }
                });
            });

        });
    </script>
@endsection
