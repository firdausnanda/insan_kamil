@extends('layouts.landing.main')

@section('content')
    <!-- section-->
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
                            <li class="breadcrumb-item active" aria-current="page">Produk Baru</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- section -->
    <div class="mt-8 mb-lg-14 mb-8">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row gx-10">
                <!-- col -->
                <aside class="col-lg-3 col-md-4 mb-6 mb-md-0">
                    <div class="offcanvas offcanvas-start offcanvas-collapse w-md-50" tabindex="-1" id="offcanvasCategory"
                        aria-labelledby="offcanvasCategoryLabel">
                        <div class="offcanvas-header d-lg-none">
                            <h5 class="offcanvas-title" id="offcanvasCategoryLabel">Filter</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body ps-lg-2 pt-lg-0">
                            <div class="mb-8">
                                <!-- title -->
                                <h5 class="mb-3">Kategori</h5>
                                <!-- nav -->
                                <ul class="nav nav-category" id="categoryCollapseMenu">
                                    @foreach ($kategori_all as $k)
                                        <li class="nav-item border-bottom w-100">
                                            <a href="{{ route('landing.kategori', $k->slug) }}" class="nav-link">
                                                {{ $k->nama_kategori }}
                                                <i class="feather-icon icon-chevron-right"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </aside>
                <section class="col-lg-9 col-md-12">
                    <!-- card -->
                    <div class="card mb-4 bg-light border-0">
                        <!-- card body -->
                        <div class="card-body p-9">
                            <h2 class="mb-0 fs-1">Produk Baru</h2>
                        </div>
                    </div>

                    <!-- row -->
                    <div class="row g-4 row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-2 mt-2">
                        @foreach ($produk as $p)
                            <!-- col -->
                            <div class="col">
                                <!-- card -->
                                <div class="card card-product">
                                    <div class="card-body" style="min-height: 405px">
                                        <!-- badge -->
                                        <a href="{{ route('landing.detail', $p->id) }}">
                                            <div class="text-center position-relative">
                                                <!-- img -->
                                                @if (count($p->gambar_produk) > 0)
                                                    <img src="{{ asset('storage/produk/' . $p->gambar_produk[0]->gambar) }}"
                                                        alt="{{ $p->nama_produk }}" class="mb-3 img-fluid"
                                                        style="max-height: 193px; width: auto;">
                                                @else
                                                    <img src="{{ asset('images/avatar/no-image.png') }}"
                                                        alt="{{ $p->nama_produk }}" class="mb-3 img-fluid"
                                                        style="max-height: 193px; width: auto;">
                                                @endif
                                            </div>
                                        </a>
                                        <!-- heading -->
                                        <div class="text-small mb-1">
                                            <a href="#!"
                                                class="text-decoration-none text-muted"><small>{{ $p->kategori->nama_kategori }}</small></a>
                                        </div>
                                        <h2 class="fs-6"><a href="{{ route('landing.detail', $p->id) }}"
                                                class="text-inherit text-decoration-none">{{ $p->nama_produk }}</a></h2>
                                        @if ($p->harga->mulai_diskon <= now() && $p->harga->diskon > 0)
                                            <span
                                                class="badge bg-danger rounded-pill mb-1">{{ '-' . diskon($p->harga) . '%' }}</span>
                                        @endif
                                        <span>
                                            <!-- rating -->
                                            <small class="text-warning">
                                                @if (round($p->averageRating()) > 0)
                                                    {{ tampilkanRating(round($p->averageRating(), 2)) }}
                                                @endif
                                            </small>
                                            <span class="text-muted small">
                                                @if (round($p->averageRating()) > 0)
                                                    {{ round($p->averageRating(), 2) }}({{ $p->ratings()->count() }})
                                                @endif
                                            </span>
                                        </span>
                                        @if (round($p->averageRating()) > 0 and $p->produk_dikirim->whereNotNull('order_dibayar')->count() > 0)
                                            <span class="text-secondary">
                                                |
                                            </span>
                                        @endif
                                        @if ($p->produk_dikirim->whereNotNull('order_dibayar')->count() > 0)
                                            <small class="text-secondary">
                                                Terjual
                                                {{ $p->produk_dikirim->whereNotNull('order_dibayar')->count() }}
                                            </small>
                                        @endif
                                        <!-- price -->
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <div>
                                                <span class="text-dark">{{ rupiah($p->harga->harga_akhir) }}</span>
                                                @if ($p->harga->mulai_diskon <= now() && $p->harga->diskon > 0)
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

                    <div class="row mt-8">
                        <div class="col">
                            @if ($produk->count() > 0)
                                {{-- Pagination --}}
                                @if ($produk instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item"><a class="page-link mx-1"
                                                    href="{{ $produk->previousPageUrl() }}">Prev</a>
                                            </li>
                                            @for ($i = 1; $i <= $produk->lastPage(); $i++)
                                                <li class="page-item {{ $produk->currentPage() == $i ? 'active' : '' }}">
                                                    <a class="page-link mx-1"
                                                        href="{{ $produk->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            <li class="page-item"><a class="page-link mx-1"
                                                    href="{{ $produk->nextPageUrl() }}">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                @endif
                            @endif
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
