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

                            <div class="mb-8">
                                <button class="btn btn-primary"><i class="fa-solid fa-filter me-2"></i> Filter</button>
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
                                    <select class="form-select" id="sort">
                                        <option value="1">Sort by: Terbaru</option>
                                        <option value="2">Price: Harga Terendah</option>
                                        <option value="3">Price: Harga Tertinggi</option>
                                        <option value="4">Rating</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="produk"></div>

                </section>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Produk
            function produk() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('landing.kategori', $slug->slug) }}",
                    data: {
                        sort: $('#sort').val()
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                        $("#produk").empty();
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');

                        // Append to Berita
                        $("#produk").append(response.data);
                    }
                });
            }

            produk()

            // Filter
            $('#sort').change(function (e) { 
                e.preventDefault();
               
                produk()
            });

            // Pagination
            $('#produk').on('click', '.pagination a', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('href'),
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                        $("#produk").empty();
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        window.scrollTo(0, 0)
                        $('#produk').append(response.data);
                    }
                });
            });

        });
    </script>
@endsection
