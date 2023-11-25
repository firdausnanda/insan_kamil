<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Codescandy" name="author">
    <title>Insan Kamil - Dashboard </title>
    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Libs CSS -->
    <link href="{{ asset('vendor/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/feather-webfont/dist/feather-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/simplebar/dist/simplebar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/dropzone/dist/min/dropzone.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/brands.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/solid.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap-5-theme.min.css') }}">


    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('css/theme.min.css') }}">
    <!-- Google tag (gtag.js) -->



    <!-- End Tag -->

</head>

<body>
    <!-- main -->
    <div>
        @include('layouts.dashboard.header')

        <div class="main-wrapper">
            <!-- navbar vertical -->
            @include('layouts.dashboard.menu')

            <!-- main wrapper -->
            @yield('content')
        </div>
    </div>

    <!-- Libs JS -->
    <script src="{{ asset('vendor/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/simplebar/dist/simplebar.min.js') }}"></script>

    <!-- Theme JS -->
    <script src="{{ asset('js/theme.min.js') }}"></script>
    <script src="{{ asset('vendor/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('js/vendors/chart.js') }}"></script>
    <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery.mask.min.js') }}"></script>

    {{-- Vendor --}}
    <script src="{{ asset('vendor/quill/dist/quill.min.js') }}"></script>
    <script src="{{ asset('js/vendors/editor.js') }}"></script>
    <script src="{{ asset('vendor/loading-overlay/loadingoverlay.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>


    {{-- <script src="https://cdn.datatables.net/v/bs5/dt-1.13.7/datatables.min.js"></script> --}}

    @yield('script')

</body>

</html>
