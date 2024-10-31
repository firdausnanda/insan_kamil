@extends('layouts.landing.main')

@section('content')
    <section class="my-lg-14 my-8">
        <!-- container -->
        <div class="container">
            <div class="row g-4">
                <!-- col -->
                <div class="offset-lg-2 col-lg-8 col-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Point</h5>

                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="d-flex justify-content-center align-items-center">
                                        <img src="{{ asset('images/point/1.png') }}" alt="point" class="img-fluid"
                                            style="width: 25px; height: 25px;">
                                        <h5 class="ms-2 card-title fw-bold mb-0">{{ $user->total_points }} Loyalty Points</h5>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-center">
                                    <div class="card px-5">
                                        <div class="card-body text-center">
                                            <h4 class="fw-bold card-title mb-0">Latest Update :
                                                {{ Carbon\Carbon::now()->translatedFormat('d F Y') }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="container w-75">
                                        <p class="text-center">Ayo, kumpulkan Poin dari setiap pembelian produk Penerbit
                                            Insan Kamil
                                            dan tukarkan dengan hadiah menarik!</p>

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="container w-75">
                                        <div class="row g-2 text-center">
                                            <div class="col-6">
                                                <a href="#activity_point_history"
                                                    class="btn btn-sm btn-outline-secondary px-5">Point History</a>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ route('user.point.redeem.index') }}"
                                                    class="btn btn-sm btn-outline-secondary px-5">Redeem Point</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="container w-75">
                                        <div class="card border-dashed">
                                            <div class="card-body text-center">
                                                <h5 class="card-title">Setiap Pembelanjaan Rp.50.000 (Nilai Transaksi Netto)
                                                </h5>
                                                <span class="btn btn-sm bg-primary text-white px-5">1 Point</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>

                <section id="activity_point_history">
                    <div class="offset-lg-2 col-lg-8 col-12">
                        <div class="card px-3">
                            <div class="card-body">

                                <div class="card text-start border-dashed">
                                    <div class="card-body p-0 p-2">
                                        <h5 class="card-title mb-0">Activity Point History</h5>
                                    </div>
                                </div>


                                {{-- Header --}}
                                <div class="row mt-4 align-items-center">
                                    <div class="col-lg-1">
                                        @if (Auth::user()->avatar == null)
                                            @if (Auth::user()->id_member && Auth::user()->member)
                                                <img src="{{ asset('images/avatar/user.png') }}" alt=""
                                                    class="avatar avatar-md rounded-circle">
                                            @else
                                                <img src="{{ asset('images/avatar/user.png') }}" alt=""
                                                    class="avatar avatar-md rounded-circle">
                                            @endif
                                        @else
                                            @if (Auth::user()->id_member && Auth::user()->member)
                                                <img src="{{ Auth::user()->avatar }}" alt=""
                                                    class="avatar avatar-md rounded-circle">
                                            @else
                                                <img src="{{ Auth::user()->avatar }}" alt=""
                                                    class="avatar avatar-md rounded-circle">
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col-lg-5">
                                        <p class="fw-bold mb-0">{{ Auth::user()->name }}</p>
                                        @if (Auth::user()->id_member && Auth::user()->member)
                                            <span class="badge mb-2 bg-{{ Str::lower(Auth::user()->member->nama) }}">Member
                                                {{ Auth::user()->member->nama }}</span>
                                        @else
                                            <span class="badge bg-secondary mb-2">Non-Member</span>
                                        @endif
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-6 p-0 p-2">
                                                <div class="card" style="min-height: 92.8px;">
                                                    <div class="card-body">
                                                        <div class="row g-2">
                                                            <div class="col-1">
                                                                <img src="{{ asset('images/point/1.png') }}" alt="point"
                                                                    style="width: 20px; height: 20px;">
                                                            </div>
                                                            <div class="col">
                                                                <span
                                                                    class="card-title mb-0 fw-bold ms-5">{{ $user->total_points }}</span><br>
                                                                <span class="card-title mb-0 ms-5"
                                                                    style="font-size: 12px;">Loyalty Point</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 p-0 p-2">
                                                <div class="card" style="min-height: 92.8px;">
                                                    <div class="card-body">
                                                        <p class="card-title fw-bold mb-0">{{ rupiah($total_order) }}</p>
                                                        <p class="mb-0" style="font-size: 12px;">Setiap Pembelanjaan</p>
                                                        <p class="mb-0" style="font-size: 12px;">(1 Point Kelipatan 50 Ribu)</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                            <div class="card-footer mt-3"></div>

                            <div class="card-body">

                                <h5 class="card-title">Point History Kamu</h5>

                                @forelse ($groupedOrders->take(5) as $month => $orders)
                                    <p class="card-title">{{ $month }}</p>
                                    @foreach ($orders as $order)
                                        <div class="card border-dashed mb-2">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-1">
                                                        <img src="{{ asset('images/point/2.png') }}" alt="">
                                                    </div>
                                                    <div class="col-lg-8">
                                                        <p class="mb-0">Order <span class="bg-light" style="padding: 5px">
                                                                {{ rupiah($order->pembayaran_sum_harga_jual) }}</span></p>
                                                        <p class="mb-0">
                                                            {{ Str::limit($order->produk_dikirim->pluck('produk.nama_produk')->implode(', '), 100) }}
                                                        </p>
                                                        <p class="mb-0">
                                                            {{ \Carbon\Carbon::parse($order->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                                                        </p>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <img src="{{ asset('images/point/1.png') }}" alt="">
                                                        <span class="mb-0 fw-bold">+
                                                            {{ $order->total_point }} Points</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @empty
                                <p>- Data Tidak ada -</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </section>

            </div>

    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {


        });
    </script>
@endsection
