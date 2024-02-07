@extends('layouts.landing.main')

@section('content')
    <section class="mt-8">
        <div class="container">
            <div class="hero-slider ">
                @forelse ($slide as $i)
                    <div class=" "
                        style="background: url({{ asset('storage/slideshow/' . $i->gambar) }}) no-repeat; background-size: cover; border-radius: .5rem; background-position: center;">
                        <div class="ps-lg-12 py-lg-16 col-xxl-5 col-lg-7 col-md-8 py-14 px-8 text-xs-center">


                            <h1 class="text-white display-5 fw-bold mt-4"> </h1>
                            <p class="lead text-white"></p>
                        </div>

                    </div>
                @empty
                    <div class=" "
                        style="background: url({{ asset('images/slider/hero-img-slider-1.jpg') }})no-repeat; background-size: cover; border-radius: .5rem; background-position: center;">
                        <div class="ps-lg-12 py-lg-16 col-xxl-5 col-lg-7 col-md-8 py-14 px-8 text-xs-center">


                            <h1 class="text-white display-5 fw-bold mt-4">SuperMarket For Fresh Grocery </h1>
                            <p class="lead text-white">Introduced a new model for online grocery shopping
                                and convenient home delivery at any time.</p>
                            <a href="#!" class="btn btn-dark mt-3">Shop Now <i
                                    class="feather-icon icon-arrow-right ms-1"></i></a>
                        </div>

                    </div>
                @endforelse

            </div>
        </div>
    </section>


    <div class=" mt-lg-12 mb-lg-14 mb-8">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row ">
                <!-- col -->
                <aside class="col-xl-3 col-lg-4 col-md-4 mb-6 mb-md-0">
                    <div id="sidebar">
                        <div class="sidebar__inner">
                            <div class="offcanvas offcanvas-start offcanvas-collapse " tabindex="-1" id="offcanvasCategory"
                                aria-labelledby="offcanvasCategoryLabel">

                                <div class="offcanvas-header d-lg-none">
                                    <h5 class="offcanvas-title" id="offcanvasCategoryLabel">Filter</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                        aria-label="Close"></button>
                                </div>
                                <div class="offcanvas-body p-lg-0 ">

                                    <div class="mb-4">
                                        <!-- title -->
                                        <h3 class="mb-4 h5">Kategori</h3>
                                        <!-- nav -->
                                        <div class="card">
                                            <ul class="nav nav-category" id="categoryCollapseMenu">
                                                @foreach ($kategori as $k)
                                                    <li class="nav-item border-bottom w-100 collapsed px-4 py-1">
                                                        <a href="{{ route('landing.kategori', $k->slug) }}"
                                                            class="nav-link">
                                                            <span class="d-flex align-items-center">
                                                                <span class="ms-2">{{ $k->nama_kategori }}</span>
                                                            </span><i class="feather-icon icon-chevron-right"></i></a>
                                                    </li>
                                                @endforeach
                                            </ul>

                                        </div>
                                    </div>

                                    <div class="card mb-6">
                                        <div class="card-body d-flex align-items-center border-top">
                                            <div class="">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="var(--fc-primary)" class="bi bi-reply" viewBox="0 0 16 16">
                                                    <path
                                                        d="M6.598 5.013a.144.144 0 0 1 .202.134V6.3a.5.5 0 0 0 .5.5c.667 0 2.013.005 3.3.822.984.624 1.99 1.76 2.595 3.876-1.02-.983-2.185-1.516-3.205-1.799a8.74 8.74 0 0 0-1.921-.306 7.404 7.404 0 0 0-.798.008h-.013l-.005.001h-.001L7.3 9.9l-.05-.498a.5.5 0 0 0-.45.498v1.153c0 .108-.11.176-.202.134L2.614 8.254a.503.503 0 0 0-.042-.028.147.147 0 0 1 0-.252.499.499 0 0 0 .042-.028l3.984-2.933zM7.8 10.386c.068 0 .143.003.223.006.434.02 1.034.086 1.7.271 1.326.368 2.896 1.202 3.94 3.08a.5.5 0 0 0 .933-.305c-.464-3.71-1.886-5.662-3.46-6.66-1.245-.79-2.527-.942-3.336-.971v-.66a1.144 1.144 0 0 0-1.767-.96l-3.994 2.94a1.147 1.147 0 0 0 0 1.946l3.994 2.94a1.144 1.144 0 0 0 1.767-.96v-.667z" />
                                                </svg>

                                            </div>
                                            <div class="ms-3">
                                                <p class="mb-0 small">Pelanggan dapat mengembalikan produk dan meminta
                                                    pengembalian dana
                                                    sesuai ketentuan.</p>
                                            </div>
                                        </div>
                                        <div class="card-body d-flex align-items-center border-top">
                                            <div class="">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="var(--fc-primary)" class="bi bi-bag-check" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd"
                                                        d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                                    <path
                                                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                                                </svg>
                                            </div>
                                            <div class="ms-3">
                                                <p class="mb-0 small">Pesan Sekarang jadi anda tidak melewatkan kesempatan.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="card-body d-flex align-items-center border-top">
                                            <div class="">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    fill="var(--fc-primary)" class="bi bi-clock-history"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z" />
                                                    <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z" />
                                                    <path
                                                        d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z" />
                                                </svg>
                                            </div>
                                            <div class="ms-3">
                                                <p class="mb-0 small">Pesanan anda akan diproses kurang lebih
                                                    15 menit setelah pemesanan.</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <div class="col-xl-9 col-lg-8 col-md-12 mb-6 mb-md-0">
                    {{-- Buku Baru --}}
                    <div class="mb-12 product-content">
                        <div class="mb-6">
                            <h3 class="mb-0">Buku Best Seller</h3>
                        </div>
                        <div class="product-slider-four-column">
                            @foreach ($produk_laris as $p)
                                <!-- item -->
                                <div class="item">
                                    <!-- card -->
                                    <div class="card card-product mb-4">
                                        <a href="{{ route('landing.detail', $p->id) }}">
                                            <div class="card-body text-center py-8">
                                                <!-- img -->
                                                @if ($p->gambar_produk)
                                                    <img src="{{ asset('storage/produk/' . $p->gambar_produk[0]->gambar) }}"
                                                        alt="{{ $p->nama_produk }}" class="mb-3"
                                                        style="max-height: 120px; max-width: 120px;">
                                                @else
                                                    <img src="{{ asset('images/avatar/no-image.png') }}"
                                                        alt="{{ $p->nama_produk }}" class="mb-3"
                                                        style="max-height: 120px; max-width: 120px;">
                                                @endif
                                                <!-- text -->

                                            </div>
                                        </a>
                                    </div>
                                    <div>
                                        @if ($p->harga->diskon > 0)
                                            <span
                                                class="badge bg-danger rounded-pill">{{ '-' . diskon($p->harga) . '%' }}</span>
                                        @endif
                                        <h2 class="mt-1 fs-6"> <a href="{{ route('landing.detail', $p->id) }}"
                                                class="text-inherit">{{ $p->nama_produk }}</a></h2>
                                        <div>
                                            <span
                                                class="text-dark fs-5 fw-bold">{{ rupiah($p->harga->harga_akhir) }}</span>
                                            @if ($p->harga->diskon > 0)
                                                <span
                                                    class="text-decoration-line-through text-muted">{{ rupiah($p->harga->harga_awal) }}</span>
                                            @endif
                                        </div>
                                        <div class="text-warning">
                                            <!-- rating -->
                                            <small>
                                                @if (round($p->averageRating()) > 0)
                                                    {{ tampilkanRating(round($p->averageRating(), 2)) }}
                                                @endif
                                            </small>
                                            @if (round($p->averageRating()) > 0)
                                                <span class="text-muted small">{{ round($p->averageRating(), 2) }}</span>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- <div class="mb-6">

                        <div class="mb-6">
                            <h3 class="mb-1">Promo Hari ini</h3>
                        </div>
                        <div class="card border border-danger p-6">
                            <div class="row">
                                <div class="col-lg-5 text-center">
                                    <a href="./pages/shop-single.html"><img
                                            src="{{ asset('images/products/deal-img.jpg') }}"
                                            alt="{{ $p->nama_produk }}" class="img-fluid"></a>

                                </div>
                                <div class="col-lg-7 text-center text-lg-start">

                                    <div class="mb-3">
                                        <small class="text-warning"> <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-fill"></i>
                                            <i class="bi bi-star-half"></i>
                                        </small>
                                        <span><small>4.5</small></span>
                                    </div>
                                    <h2 class="fs-4"><a href="./pages/shop-single.html"
                                            class="text-inherit text-decoration-none">Parle
                                            Platina Nutricrunch Digestive Cookies</a></h2>

                                    <div
                                        class="d-flex justify-content-center align-items-center justify-content-lg-between mt-3">
                                        <div><span class="text-dark fs-5 fw-bold">Rp. 15.000</span>
                                            <span class="text-decoration-line-through text-muted fs-5">Rp 20.000</span>
                                        </div>

                                    </div>
                                    <div class="mt-2"><a href="javascript:void(0)" class="btn btn-primary ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-plus">
                                                <line x1="12" y1="5" x2="12" y2="19">
                                                </line>
                                                <line x1="5" y1="12" x2="19" y2="12">
                                                </line>
                                            </svg> Masukkan Keranjang </a></div>
                                    <div class="mt-6 mb-6">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Terjual: <span class="text-dark fs-6 fw-bold">45</span></span>
                                            <span>Tersedia: <span class="text-dark fs-6 fw-bold">25</span></span>

                                        </div>

                                        <div class="progress bg-light-danger" role="progressbar"
                                            aria-label="Example 1px high" aria-valuenow="85" aria-valuemin="0"
                                            aria-valuemax="100" style="height: 5px">
                                            <div class="progress-bar bg-danger" style="width: 85%"></div>
                                        </div>


                                    </div>
                                    <p class="fw-bold text-dark mb-0">
                                        Buruan penawaran segera berakhir
                                    </p>
                                    <div class="d-flex justify-content-center justify-content-lg-start text-center mt-1">

                                        <div class="deals-countdown" data-countdown="2024/10/10 00:00:00"></div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div> --}}

                    <div class="row">
                        <div class="col-12">
                            <div class="row align-items-center mb-6">
                                <div class="col-xl-10 col-lg-9 col-8">
                                    <div class="mb-4 mb-lg-0">
                                        <h3 class="mb-1">Produk Baru</h3>
                                        <p class="mb-0">Produk baru dengan stok terupdate.</p>
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-3 col-4 text-end">
                                    <a href="#" class="btn btn-light">Selengkapnya</a>
                                </div>
                            </div>
                            <div class="row row-cols-xl-4 row-cols-lg-3 g-4">
                                @foreach ($produk_laris as $p)
                                    <!-- item -->
                                    <div class="col">
                                        <div class="mb-6">
                                            <!-- card -->
                                            <div class="card card-product mb-4">
                                                <a href="{{ route('landing.detail', $p->id) }}">
                                                    <div class="card-body text-center py-8">
                                                        <!-- img -->
                                                        @if ($p->gambar_produk)
                                                            <img src="{{ asset('storage/produk/' . $p->gambar_produk[0]->gambar) }}"
                                                                alt="{{ $p->nama_produk }}" class="mb-3"
                                                                style="max-height: 120px; max-width: 120px;">
                                                        @else
                                                            <img src="{{ asset('images/avatar/no-image.png') }}"
                                                                alt="{{ $p->nama_produk }}" class="mb-3"
                                                                style="max-height: 120px; max-width: 120px;">
                                                        @endif
                                                        <!-- text -->

                                                    </div>
                                                </a>
                                            </div>
                                            <div>
                                                @if ($p->harga->diskon > 0)
                                                    <span
                                                        class="badge bg-danger rounded-pill">{{ '-' . diskon($p->harga) . '%' }}</span>
                                                @endif
                                                <h2 class="mt-1 fs-6"> <a href="{{ route('landing.detail', $p->id) }}"
                                                        class="text-inherit">{{ $p->nama_produk }}</a></h2>
                                                <div>
                                                    <span
                                                        class="text-dark fs-5 fw-bold">{{ rupiah($p->harga->harga_akhir) }}</span>
                                                    @if ($p->harga->diskon > 0)
                                                        <span
                                                            class="text-decoration-line-through text-muted">{{ rupiah($p->harga->harga_awal) }}</span>
                                                    @endif
                                                </div>
                                                <div class="text-warning">
                                                    <!-- rating -->
                                                    <small>
                                                        @if (round($p->averageRating()) > 0)
                                                            {{ tampilkanRating(round($p->averageRating(), 2)) }}
                                                        @endif
                                                    </small>
                                                    @if (round($p->averageRating()) > 0)
                                                        <span
                                                            class="text-muted small">{{ round($p->averageRating(), 2) }}</span>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>


        </div>

        <section class="my-lg-14 my-8">
            <div class="container ">
                <div class="row align-items-center mb-8">
                    <div class="col-md-8 col-12">
                        <!-- heading -->
                        <div class="d-flex">
                            <div class="mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" class="bi bi-journal text-primary" viewBox="0 0 16 16">
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z">
                                    </path>
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z">
                                    </path>
                                </svg>
                            </div>
                            <div class="ms-3">
                                <h3 class=" mb-0">Blog</h3>
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>
                    <!-- button -->
                    <div class="col-md-4 text-end d-none d-md-block">
                        <a href="#" class="btn btn-primary">Lihat Selengkapnya
                        </a>
                    </div>
                </div>
                <div class="row">
                    <!-- col -->
                    <div class="col-12 col-md-6 col-lg-3 mb-8">
                        <div class="mb-4">
                            <a href="javascript:void(0)">
                                <!-- img -->
                                <div class="img-zoom">
                                    <img src="{{ asset('images/blog/blog-img-1.jpg') }}" alt=""
                                        class="img-fluid rounded w-100">
                                </div>
                            </a>
                        </div>
                        <!-- text -->
                        <div>
                            <h4 class="h5"><a href="javascript:void(0)" class="text-inherit">Spaghetti with Crispy
                                    Zucchini</a></h4>
                            <p>Praesent vestibulum magna lacinia augue mollisvel aliquet massa posuere. Duis et mauris
                                tortor.
                            </p>
                            <div class="d-flex align-items-center lh-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                    fill="currentColor" class="bi bi-clock text-dark" viewBox="0 0 16 16">
                                    <path
                                        d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z">
                                    </path>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"></path>
                                </svg>
                                <small class="ms-1"><span class="text-dark fw-bold">15</span> min</small>
                            </div>
                        </div>
                    </div>
                    <!-- col -->
                    <div class="col-12 col-md-6 col-lg-3 mb-8">
                        <div class="mb-4">
                            <a href="javascript:void(0)">
                                <div class="img-zoom">
                                    <!-- img -->
                                    <img src="{{ asset('images/blog/blog-img-2.jpg') }}" alt=""
                                        class="img-fluid rounded w-100">
                                </div>
                            </a>
                        </div>
                        <!-- text -->
                        <div>
                            <h4 class="h5"><a href="javascript:void(0)" class="text-inherit">Almond Butter Chocolate
                                    Chip Zucchini
                                    Bars</a>
                            </h4>
                            <p>Lorem ipsum dolor sit amet, consectetur sit amet tincidunt ellentesque aliquet
                                ligula in ultrices congue.
                            </p>
                            <div class="d-flex align-items-center lh-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                    fill="currentColor" class="bi bi-clock text-dark" viewBox="0 0 16 16">
                                    <path
                                        d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z">
                                    </path>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"></path>
                                </svg>
                                <small class="ms-1"><span class="text-dark fw-bold">18</span> min</small>
                            </div>
                        </div>
                    </div>
                    <!-- col -->
                    <div class="col-12 col-md-6 col-lg-3 mb-8">
                        <div class="mb-4">
                            <a href="javascript:void(0)">
                                <!-- img -->
                                <div class="img-zoom">
                                    <img src="{{ asset('images/blog/blog-img-3.jpg') }}" alt=""
                                        class="img-fluid rounded w-100">
                                </div>
                            </a>
                        </div>
                        <!-- text -->
                        <div>
                            <h4 class="h5"><a href="javascript:void(0)" class="text-inherit">Spicy Shrimp Tacos
                                    Garlic Cilantro Lime
                                    Slaw</a>
                            </h4>
                            <p>Praesent vestibulum magna lacinia augue mollisvel aliquet massa posuere. Duis et mauris
                                tortor.
                            </p>
                            <div class="d-flex align-items-center lh-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                    fill="currentColor" class="bi bi-clock text-dark" viewBox="0 0 16 16">
                                    <path
                                        d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z">
                                    </path>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"></path>
                                </svg>
                                <small class="ms-1"><span class="text-dark fw-bold">20</span> min</small>
                            </div>
                        </div>
                    </div>
                    <!-- col -->
                    <div class="col-12 col-md-6 col-lg-3 mb-8">
                        <div class="mb-4">
                            <a href="javascript:void(0)">
                                <!-- img -->
                                <div class="img-zoom">
                                    <img src="{{ asset('images/blog/blog-img-4.jpg') }}" alt=""
                                        class="img-fluid rounded w-100">
                                </div>
                            </a>
                        </div>
                        <div>
                            <h4 class="h5"><a href="javascript:void(0)" class="text-inherit">Simple Homemade Tomato
                                    Soup</a></h4>
                            <p>Aliquam tempus velit augue, sodales tincidunt augue ipsum primis in faucibus orci luctus
                                et ultrices posuere cubilia
                            </p>
                            <div class="d-flex align-items-center lh-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                    fill="currentColor" class="bi bi-clock text-dark" viewBox="0 0 16 16">
                                    <path
                                        d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z">
                                    </path>
                                    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z"></path>
                                </svg>
                                <small class="ms-1"><span class="text-dark fw-bold">9</span> min</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
