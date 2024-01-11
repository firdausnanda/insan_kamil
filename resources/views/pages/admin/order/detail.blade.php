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
                                </div>
                                <!-- select option -->
                                <div class="d-md-flex gap-2">
                                    <div class="mb-2 mb-md-0">
                                        <select class="form-select" id="status">
                                            <option value="2">Belum Diproses</option>
                                            <option value="3">Diproses</option>
                                            <option value="4">Pengiriman</option>
                                            <option value="5">Selesai</option>
                                        </select>
                                    </div>
                                    <div class="mb-2 mb-md-0">
                                        <input type="text" id="no_resi" value="{{ $order->no_resi }}" class="form-control d-none">
                                    </div>
                                    <!-- button -->
                                    <div class="ms-md-3">
                                        <button id="btn-simpan" class="btn btn-primary">Simpan</button>
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
                                                {{ $order->user->name }}
                                                <br />
                                                {{ $order->user->email }}
                                                <br />
                                                {{ $order->user->no_telp }}
                                            </p>
                                            <a href="#">View Profile</a>
                                        </div>
                                    </div>
                                    <!-- address -->
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-6">
                                            <h6>Alamat Pengiriman</h6>
                                            <p class="mb-1 lh-lg">
                                                {{ $order->user->alamat }}
                                                <br>
                                                {{ $order->user->district ? $order->user->district->name : '' }},
                                                {{ $order->user->city ? $order->user->city->name : '' }}
                                                <br>
                                                {{ $order->user->province ? $order->user->province->name : '' }}
                                                Kode Pos.
                                                {{ $order->user->city ? $order->user->city->postal_code : '' }}
                                            </p>
                                        </div>
                                    </div>
                                    <!-- address -->
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-6">
                                            <h6>Detail Order</h6>
                                            <p class="mb-1 lh-lg">
                                                Tanggal Order:
                                                <span
                                                    class="text-dark">{{ \Carbon\Carbon::parse($order->created_at)->isoFormat('D MMMM Y') }}</span>
                                                <br />
                                                Total Order:
                                                <span
                                                    class="text-dark">{{ rupiah($order->harga_total + $order->biaya_pengiriman) }}</span>
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
                                                <th>Produk</th>
                                                <th>Harga</th>
                                                <th>Jumlah Produk</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <!-- tbody -->
                                        <tbody>
                                            @foreach ($order->produk_dikirim as $i)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                @if ($i->produk->gambar_produk)
                                                                    <img src="{{ asset('storage/produk/' . $i->produk->gambar_produk[0]->gambar) }}"
                                                                        alt="" class="icon-shape icon-lg" />
                                                                @else
                                                                    <img src="{{ asset('images/products/product-img-1.jpg') }}"
                                                                        alt="" class="icon-shape icon-lg" />
                                                                @endif
                                                            </div>
                                                            <div class="ms-lg-4 mt-2 mt-lg-0">
                                                                <h5 class="mb-0 h6">{{ $i->produk->nama_produk }}</h5>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="text-body">{{ rupiah($i->harga_jual) }}</span>
                                                    </td>
                                                    <td>
                                                        {{ $i->jumlah_produk }}
                                                    </td>
                                                    <td>
                                                        {{ rupiah($i->harga_jual * $i->jumlah_produk) }}
                                                    </td>
                                                </tr>
                                            @endforeach

                                            {{-- Total --}}
                                            <tr>
                                                <td class="border-bottom-0 pb-0"></td>
                                                <td class="border-bottom-0 pb-0"></td>
                                                <td colspan="1" class="fw-medium text-dark">
                                                    <!-- text -->
                                                    Sub Total :
                                                </td>
                                                <td class="fw-medium text-dark">
                                                    <!-- text -->
                                                    {{ rupiah($subTotal) }}
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
                                                    {{ rupiah($order->biaya_pengiriman) }}
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
                                                    {{ rupiah($order->biaya_pengiriman + $subTotal) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-6">
                            <div class="row">
                                @if ($order->status >= 4)
                                    <div class="col-md-6 mb-4 mb-lg-0">
                                        <h6>Detail Pengiriman</h6>
                                        <ul>
                                            <li>Diterima Kurir</li>
                                        </ul>
                                    </div>
                                @endif
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

            // Filter
            $("#status").change(function (e) { 
                e.preventDefault();

                if ($('#status').val() == 4) {
                    $('#no_resi').addClass('d-block').removeClass('d-none')
                }else{
                    $('#no_resi').addClass('d-none').removeClass('d-block')
                }
            });

            // Simpan
            $('#btn-simpan').click(function (e) { 
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.order.store') }}",
                    data: {
                        no_resi: $('#no_resi').val(),
                        id_order: '{{ $order->id }}'
                    },
                    dataType: "json",
                    beforeSend: function(){
                        $.LoadingOverlay('show');
                    },
                    success: function (response) {
                        $.LoadingOverlay('hide');
                        location.reload()
                    }
                });
            });
        });
    </script>
@endsection
