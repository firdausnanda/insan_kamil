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
    <link href="{{ asset('vendor/nouislider/dist/nouislider.min.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/css/star-rating.min.css" media="all"
        rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-star-rating@4.1.2/themes/krajee-svg/theme.css"
        media="all" rel="stylesheet" type="text/css" />


    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('css/theme.min.css') }}">
    <!-- Google tag (gtag.js) -->

    <!-- End Tag -->
</head>

<body>

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
                                        <a href="{{ route('landing.detail_popup') }}" class="btn btn-primary">Start Show
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
    <script src="{{ asset('js/vendors/countdown.js') }}"></script>
    <script src="{{ asset('vendor/sticky-sidebar/dist/sticky-sidebar.min.js') }}"></script>
    <script src="{{ asset('js/vendors/sticky.js') }}"></script>
    <script src="{{ asset('js/vendors/modal.js') }}"></script>
    <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendor/loading-overlay/loadingoverlay.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/nouislider/dist/nouislider.min.js') }}"></script>
    <script src="{{ asset('vendor/wnumb/wNumb.min.js') }}"></script>
    <script src="{{ asset('vendor/momentjs/moment.min.js') }}"></script>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
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

    @yield('script')

</body>

</html>
