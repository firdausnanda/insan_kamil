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
                            <li class="breadcrumb-item"><a href="#!">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $slug->nama_kategori }}</li>
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

                            <div class="mb-8">
                                <!-- price -->
                                <h5 class="mb-3">Harga</h5>
                                <div>
                                    <!-- range -->
                                    <div id="priceRange" class="mb-3"></div>
                                    <small class="text-muted">Price:</small>
                                    <span id="priceRange-value" class="small"></span>
                                </div>
                            </div>
                            <!-- rating -->
                            <div class="mb-8">
                                <h5 class="mb-3">Rating</h5>
                                <div>
                                    <!-- form check -->
                                    <div class="form-check mb-2">
                                        <!-- input -->
                                        <input class="form-check-input" type="checkbox" value="" id="ratingFive" />
                                        <label class="form-check-label" for="ratingFive">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        </label>
                                    </div>
                                    <!-- form check -->
                                    <div class="form-check mb-2">
                                        <!-- input -->
                                        <input class="form-check-input" type="checkbox" value="" id="ratingFour"
                                            checked />
                                        <label class="form-check-label" for="ratingFour">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star text-warning"></i>
                                        </label>
                                    </div>
                                    <!-- form check -->
                                    <div class="form-check mb-2">
                                        <!-- input -->
                                        <input class="form-check-input" type="checkbox" value="" id="ratingThree" />
                                        <label class="form-check-label" for="ratingThree">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star text-warning"></i>
                                            <i class="bi bi-star text-warning"></i>
                                        </label>
                                    </div>
                                    <!-- form check -->
                                    <div class="form-check mb-2">
                                        <!-- input -->
                                        <input class="form-check-input" type="checkbox" value="" id="ratingTwo" />
                                        <label class="form-check-label" for="ratingTwo">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star text-warning"></i>
                                            <i class="bi bi-star text-warning"></i>
                                            <i class="bi bi-star text-warning"></i>
                                        </label>
                                    </div>
                                    <!-- form check -->
                                    <div class="form-check mb-2">
                                        <!-- input -->
                                        <input class="form-check-input" type="checkbox" value="" id="ratingOne" />
                                        <label class="form-check-label" for="ratingOne">
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <i class="bi bi-star text-warning"></i>
                                            <i class="bi bi-star text-warning"></i>
                                            <i class="bi bi-star text-warning"></i>
                                            <i class="bi bi-star text-warning"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
                <section class="col-lg-9 col-md-12">
                    <!-- card -->
                    <div class="card mb-4 bg-light border-0">
                        <!-- card body -->
                        <div class="card-body p-9">
                            <h2 class="mb-0 fs-1">{{ $slug->nama_kategori }}</h2>
                        </div>
                    </div>
                    <!-- list icon -->
                    <div class="d-lg-flex justify-content-between align-items-center">
                        <div class="mb-3 mb-lg-0">
                            <p class="mb-0">
                                <span class="text-dark">{{ $produk->count() }}</span>
                                Products found
                            </p>
                        </div>

                        <!-- icon -->
                        <div class="d-md-flex justify-content-between align-items-center">

                            <div class="d-flex mt-2 mt-lg-0">
                                <div>
                                    <!-- select option -->
                                    <select class="form-select">
                                        <option selected>Sort by: Featured</option>
                                        <option value="Low to High">Price: Low to High</option>
                                        <option value="High to Low">Price: High to Low</option>
                                        <option value="Release Date">Release Date</option>
                                        <option value="Avg. Rating">Avg. Rating</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- row -->
                    <div class="row g-4 row-cols-xl-4 row-cols-lg-3 row-cols-2 row-cols-md-2 mt-2">
                        @foreach ($produk as $p)
                            <!-- col -->
                            <div class="col">
                                <!-- card -->
                                <div class="card card-product">
                                    <div class="card-body">
                                        <!-- badge -->
                                        <a href="{{ route('landing.detail', $p->id) }}">
                                            <div class="text-center position-relative">
                                                <!-- img -->
                                                @if ($p->gambar_produk)
                                                    <img src="{{ asset('storage/produk/' . $p->gambar_produk[0]->gambar) }}"
                                                        alt="{{ $p->nama_produk }}" class="mb-3 img-fluid"
                                                        style="max-height: 193px; max-width: 193px;">
                                                @else
                                                    <img src="{{ asset('images/avatar/no-image.png') }}"
                                                        alt="{{ $p->nama_produk }}" class="mb-3 img-fluid"
                                                        style="max-height: 193px; max-width: 193px;">
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
                    <div class="row mt-8">
                        <div class="col">
                            @if ($produk->count() > 0)
                                <!-- nav -->
                                <nav>
                                    <ul class="pagination">
                                        <li class="page-item disabled">
                                            <a class="page-link mx-1" href="#" aria-label="Previous">
                                                <i class="feather-icon icon-chevron-left"></i>
                                            </a>
                                        </li>
                                        <li class="page-item"><a class="page-link mx-1 active" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link mx-1" href="#">2</a></li>

                                        <li class="page-item"><a class="page-link mx-1" href="#">...</a></li>
                                        <li class="page-item"><a class="page-link mx-1" href="#">12</a></li>
                                        <li class="page-item">
                                            <a class="page-link mx-1" href="#" aria-label="Next">
                                                <i class="feather-icon icon-chevron-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            @endif
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
