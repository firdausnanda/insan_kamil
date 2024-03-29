<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Codescandy" name="author">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Insan Kamil - Book Store </title>
    <link href="{{ asset('vendor/tiny-slider/dist/tiny-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/slick-carousel/slick/slick.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/slick-carousel/slick/slick-theme.css') }}" rel="stylesheet">
    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">


    <!-- Libs CSS -->
    <link href="{{ asset('vendor/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/feather-webfont/dist/feather-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/simplebar/dist/simplebar.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/solid.css') }}">
    <link href="{{ asset('vendor/datatables/datatables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap-5-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/dropify/dropify.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/flatpickr/dist/flatpickr.min.css') }}">
    <link href="{{ asset('vendor/nouislider/dist/nouislider.min.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/css/star-rating.min.css" media="all"
        rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.css"
        media="all" rel="stylesheet" type="text/css" />


    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('css/theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Google tag (gtag.js) -->

    <!-- End Tag -->
</head>

<body>

    <!-- Impersonate -->
    @if (session('impersonated_by'))
        <nav class="main-header navbar navbar-dark bg-danger fixed-top p-3 py-2" style="z-index: 1035">
            <a class="navbar-brand">Anda Login Sebagai : <b>{{ Auth::user()->name }}</b></a>
            <a href="{{ route('leave-impersonate') }}" class="btn btn-warning my-2 my-sm-0">Logout</a>
        </nav>
    @endif

    @include('layouts.landing.header')


    <!-- Modal Login -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-4">
                <div class="modal-header border-0">
                    <h5 class="modal-title fs-3 fw-bold" id="userModalLabel">Sign Up</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="fullName" placeholder="Enter Your Name"
                                required="">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter Email address"
                                required="">
                        </div>

                        <div class="mb-5">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter Password"
                                required="">
                            <small class="form-text">By Signup, you agree to our <a href="#!">Terms of Service</a>
                                & <a href="#!">Privacy Policy</a></small>
                        </div>

                        <button type="submit" class="btn btn-primary">Sign Up</button>
                    </form>
                </div>
                <div class="modal-footer border-0 justify-content-center">

                    Already have an account? <a href="#">Sign in</a>
                </div>
            </div>
        </div>
    </div>

    <main>
        @yield('content')
    </main>


    <!-- Modal Pop Awal -->
    @if (Route::is('landing.home'))
        @if ($popup && $popup->status == 1)

            <!-- Modal Body -->
            <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static"
                data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTitleId">
                                Modal title
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">Body</div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal-subscribe" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">

                        <div class="modal-body p-0">
                            <div class="d-flex align-items-center">
                                <div class="d-none d-lg-block">
                                    @if ($popup->gambar)
                                        <img src="{{ asset('storage/popup/' . $popup->gambar) }}"
                                            style="min-height: 419px; min-width: 364px" alt=""
                                            class="img-fluid rounded-start">
                                    @else
                                        <img src="{{ asset('images/banner/modal_img.jpg') }}" alt=""
                                            class="img-fluid rounded-start">
                                    @endif
                                </div>
                                <div class="px-8 py-8 py-lg-0">
                                    <div class="position-absolute end-0 top-0 m-6">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <h2 class="display-6 fw-bold">{{ $popup->judul }} <br><span
                                            class="text-primary">{{ $popup->diskon }}%</span>
                                    </h2>
                                    <p class="lead mb-5">{{ $popup->keterangan }}</p>

                                    <div class="d-grid">
                                        <a href="{{ route('landing.detail_popup') }}" class="btn btn-primary">Start
                                            Show
                                            Now</a>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endif
    @endif

    <!-- Footer -->
    @include('layouts.landing.footer')

    <!-- Javascript-->
    <!-- Libs JS -->
    <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/simplebar/dist/simplebar.min.js') }}"></script>

    <!-- Theme JS -->
    <script src="{{ asset('js/vendors/password.js') }}"></script>
    <script src="{{ asset('js/vendors/validation.js') }}"></script>
    <script src="{{ asset('vendor/slick-carousel/slick/slick.min.js') }}"></script>
    <script src="{{ asset('js/vendors/slick-slider.js') }}"></script>
    <script src="{{ asset('vendor/tiny-slider/dist/min/tiny-slider.js') }}"></script>
    <script src="{{ asset('js/vendors/tns-slider.js') }}"></script>
    <script src="{{ asset('js/vendors/zoom.js') }}"></script>
    <script src="{{ asset('js/vendors/increment-value.js') }}"></script>
    <script src="{{ asset('vendor/jquery-countdown/dist/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('vendor/sticky-sidebar/dist/sticky-sidebar.min.js') }}"></script>
    <script src="{{ asset('js/vendors/sticky.js') }}"></script>
    {{-- <script src="{{ asset('js/vendors/modal.js') }}"></script> --}}
    <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendor/loading-overlay/loadingoverlay.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/nouislider/dist/nouislider.min.js') }}"></script>
    <script src="{{ asset('vendor/wnumb/wNumb.min.js') }}"></script>
    <script src="{{ asset('vendor/momentjs/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/typehead.js/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery.mask.min.js') }}"></script>
    <script src="{{ asset('vendor/dropify/dropify.js') }}"></script>
    <script src="{{ asset('vendor/flatpickr/dist/flatpickr.min.js') }}"></script>
    <script src="{{ asset('vendor/flatpickr/dist/id.js') }}"></script>
    <script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}">
    </script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/star-rating.min.js"
        type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/js/locales/LANG.js"></script>
    <script src="{{ asset('js/theme.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            var products = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nama_produk'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                remote: {
                    url: '{{ route('search') }}?query=%QUERY',
                    wildcard: '%QUERY'
                }
            });

            $('#search').typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            }, {
                name: 'products',
                display: 'nama_produk',
                source: products,
                templates: {
                    suggestion: function(data) {

                        var link = "{{ route('landing.detail', ':slug') }}"
                        link = link.replace(':slug', data.id)

                        return `<a href="${link}" class="mt-2 d-block text-black"> ${data.nama_produk} </a>`;
                    }
                }
            });

            var popupShown = localStorage.getItem('popupShown');

            if (!popupShown || JSON.parse(popupShown).expiry < Date.now()) {
                // Jika belum pernah ditampilkan atau sudah kedaluwarsa, tampilkan pop-up
                $('#modal-subscribe').modal('show');
                // Set waktu kedaluwarsa 1 hari dari sekarang
                var expiry = Date.now() + 24 * 60 * 60 * 1000; // 1 hari dalam milidetik
                localStorage.setItem('popupShown', JSON.stringify({
                    shown: true,
                    expiry: expiry
                }));
            } else {
                $('#modal-subscribe').modal('hide');
            }
        });
    </script>

    @yield('script')

</body>

</html>
