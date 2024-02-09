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
                            <li class="breadcrumb-item active" aria-current="page">Promo</li>
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
                            <h2 class="mb-0 fs-1">Promo</h2>
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
                    url: "{{ route('landing.detail_popup') }}",
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
