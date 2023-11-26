@extends('layouts.landing.main')

@section('content')
    {{-- Breadcrumbs --}}
    <div class="mt-4">
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-12">
                    <!-- breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('landing.home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">{{ $produk->kategori->nama_kategori }}</a></li>

                            <li class="breadcrumb-item active" aria-current="page">{{ $produk->nama_produk }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{-- Konten --}}
    <section class="mt-8">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="slider slider-for">
                        @foreach ($produk->gambar_produk as $g)
                            <div>
                                <div class="zoom" onmousemove="zoom(event)"
                                    style="background-image: url({{ asset('storage/produk/' . $g->gambar) }})">
                                    <!-- img -->
                                    <!-- img -->
                                    <img src="{{ asset('storage/produk/' . $g->gambar) }}" alt="" />
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="slider slider-nav mt-4">
                        @forelse ($produk->gambar_produk as $g)
                            <div>
                                <img src="{{ asset('storage/produk/' . $g->gambar) }}" alt=""
                                    class="w-100 rounded" />
                            </div>
                        @empty
                            <div>
                                <img src="{{ asset('images/avatar/no-image.png') }}" alt="" class="w-100 rounded" />
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="ps-lg-10 mt-6 mt-md-0">
                        <!-- content -->
                        <a href="#!" class="mb-4 d-block">{{ $produk->kategori->nama_kategori }}</a>
                        <!-- heading -->
                        <h1 class="mb-1">{{ $produk->nama_produk }}</h1>
                        <div class="mb-4">
                            <!-- rating -->
                            <!-- rating -->
                            <small class="text-warning">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </small>
                            <a href="#" class="ms-2">(30 reviews)</a>
                        </div>
                        <div class="fs-4">
                            <!-- price -->
                            <span class="fw-bold text-dark">{{ rupiah($produk->harga->harga_akhir) }}</span>
                            @if ($produk->harga->diskon > 0)
                                <span
                                    class="text-decoration-line-through text-muted">{{ rupiah($produk->harga->harga_awal) }}</span>
                            @endif
                        </div>
                        <!-- hr -->
                        <hr class="my-6" />
                        <div>
                            <!-- input -->
                            <div class="input-group input-spinner">
                                <input type="button" value="-" class="button-minus btn btn-sm"
                                    data-field="quantity" />
                                <input type="number" step="1" max="10" value="1" name="quantity"
                                    class="quantity-field form-control-sm form-input" />
                                <input type="button" value="+" class="button-plus btn btn-sm" data-field="quantity" />
                            </div>
                        </div>
                        <div class="mt-3 row justify-content-start g-2 align-items-center">
                            <div class="col-xxl-4 col-lg-4 col-md-6 col-5 d-grid">
                                <!-- button -->
                                <!-- btn -->
                                <button type="button" class="btn btn-outline-primary" style="font-size: 12px">
                                    <i class="feather-icon icon-shopping-bag me-2"></i>
                                    Masukkan Keranjang
                                </button>
                            </div>
                            <div class="col-md-4 col-4">
                                <!-- btn -->
                                <a class="btn btn-primary" style="font-size: 12px">Beli Sekarang</a>
                            </div>
                        </div>
                        <!-- hr -->
                        <hr class="my-6" />
                        <div>
                            <!-- table -->
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td>Kategori:</td>
                                        <td>{{ $produk->kategori->nama_kategori }}</td>
                                    </tr>
                                    <tr>
                                        <td>Bahasa:</td>
                                        <td>{{ $produk->bahasa }}</td>
                                    </tr>
                                    <tr>
                                        <td>Ukuran:</td>
                                        <td>{{ $produk->ukuran_produk }} <span class="text-muted">cm</span></td>
                                    </tr>
                                    <tr>
                                        <td>Berat:</td>
                                        <td>{{ $produk->berat_produk }} <span class="text-muted">gr</span></td>
                                    </tr>
                                    <tr>
                                        <td>Halaman:</td>
                                        <td>
                                            <small>
                                                {{ $produk->halaman_produk }}
                                                <span class="text-muted">Halaman</span>
                                            </small>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-8">
                            <!-- dropdown -->
                            <div class="dropdown">
                                <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">Share</a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi bi-facebook me-2"></i>
                                            Facebook
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi bi-twitter me-2"></i>
                                            Twitter
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi bi-instagram me-2"></i>
                                            Instagram
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Produk Information --}}
    <section class="mt-lg-14 mt-8">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills nav-lb-tab" id="myTab" role="tablist">
                        <!-- nav item -->
                        <li class="nav-item" role="presentation">
                            <!-- btn -->
                            <button class="nav-link active" id="product-tab" data-bs-toggle="tab"
                                data-bs-target="#product-tab-pane" type="button" role="tab"
                                aria-controls="product-tab-pane" aria-selected="true">
                                Deskripsi Buku
                            </button>
                        </li>
                    </ul>
                    <!-- tab content -->
                    <div class="tab-content" id="myTabContent">
                        <!-- tab pane -->
                        <div class="tab-pane fade show active" id="product-tab-pane" role="tabpanel"
                            aria-labelledby="product-tab" tabindex="0">
                            <div class="my-8">
                                <div class="mb-5">
                                    <!-- text -->
                                    {!! $produk->keterangan !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Items -->
    <section class="my-lg-14 my-14">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <!-- heading -->
                    <h3>Produk Terkait</h3>
                </div>
            </div>
            <!-- row -->
            <div class="row g-4 row-cols-lg-5 row-cols-2 row-cols-md-2 mt-2">
                <!-- col -->
                @foreach ($produk_related as $p)
                    <div class="col">
                        <div class="card card-product">
                            <div class="card-body">
                                <!-- badge -->

                                <div class="text-center position-relative">
                                    <a href="{{ route('landing.detail', $p->id) }}">
                                        @if ($p->gambar_produk)
                                            <img src="{{ asset('storage/produk/' . $p->gambar_produk[0]->gambar) }}"
                                                alt="{{ $p->nama_produk }}" style="max-height: 210px; max-width: 210px;"
                                                class="mb-3 img-fluid" />
                                        @else
                                            <img src="{{ asset('images/avatar/no-image.png') }}"
                                                alt="{{ $p->nama_produk }}" style="max-height: 210px; max-width: 210px;"
                                                class="mb-3 img-fluid" />
                                        @endif
                                    </a>

                                </div>
                                <!-- heading -->
                                <div class="text-small mb-1">
                                    <a href="{{ route('landing.detail', $p->id) }}"
                                        class="text-decoration-none text-muted"><small>{{ $p->kategori->nama_kategori }}</small></a>
                                </div>
                                <h2 class="fs-6"><a href="{{ route('landing.detail', $p->id) }}"
                                        class="text-inherit text-decoration-none">{{ $p->nama_produk }}</a></h2>
                                <div>
                                    <!-- rating -->
                                    <small class="text-warning">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-half"></i>
                                    </small>
                                    <span class="text-muted small">4.5(149)</span>
                                </div>
                                <!-- price -->
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div>
                                        <span class="text-dark">{{ rupiah($p->harga->harga_akhir) }}</span>
                                        @if ($p->harga->diskon > 0)
                                            <span
                                                class="text-decoration-line-through text-muted">{{ rupiah($p->harga->harga_awal) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
