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
                            <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- section -->
    <section class="mb-lg-14 mb-8 mt-8">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <!-- card -->
                    <div class="card py-1 border-0 mb-8">
                        <div>
                            <h1 class="fw-bold">Keranjang Belanja</h1>
                            <p class="mb-0">Total Produk : {{ $cek_keranjang->sum('jumlah_produk') }} Produk</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-lg-8 col-md-7">
                    <div class="py-3">

                        <ul class="list-group list-group-flush" id="keranjang">
                            @foreach ($cek_keranjang as $c)
                                <!-- list group -->
                                <li class="list-group-item py-3 ps-0 border-top">
                                    <!-- row -->
                                    <div class="row align-items-center">
                                        <div class="col-6 col-md-6 col-lg-7">
                                            <div class="d-flex">
                                                @if ($c->produk->gambar_produk)
                                                    <img src="{{ asset('images/avatar/no-image.png') }}" alt=""
                                                        class="icon-shape icon-xxl" />
                                                @else
                                                    <img src="{{ asset('storage/produk/${row.produk.gambar_produk[0].gambar}') }}"
                                                        alt="" class="icon-shape icon-xxl" />
                                                @endif
                                                <div class="ms-3">
                                                    <!-- title -->
                                                    <a href="{{ route('landing.detail', $c->produk->id) }}"
                                                        class="text-inherit">
                                                        <h6 class="mb-0">{{ $c->produk->nama_produk }}</h6>
                                                    </a>
                                                    <span><small class="text-muted">{{ $c->produk->berat_produk }} /
                                                            gr</small></span>
                                                    <!-- text -->
                                                    <div class="mt-2 small lh-1">
                                                        <button data-id="{{ $c->id }}"
                                                            class="btn btn-link btn-sm p-0 text-decoration-none text-inherit btn-hapus">
                                                            <span class="me-1 align-text-bottom">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                                    height="14" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-trash-2 text-success">
                                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                                    <path
                                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                    </path>
                                                                    <line x1="10" y1="11" x2="10"
                                                                        y2="17"></line>
                                                                    <line x1="14" y1="11" x2="14"
                                                                        y2="17"></line>
                                                                </svg>
                                                            </span>
                                                            <span class="text-muted">Remove</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- input group -->
                                        <div class="col-4 col-md-3 col-lg-3">
                                            <!-- input -->
                                            <!-- input -->
                                            <div class="input-group input-spinner">
                                                <input type="button" data-jumlah="{{ $c->jumlah_produk }}"
                                                    data-id="{{ $c->id }}" value="-"
                                                    class="button-minus btn btn-sm" data-field="quantity" />
                                                <input type="number" step="1" max="10"
                                                    value="{{ $c->jumlah_produk }}" name="quantity"
                                                    style="min-height: 2.25rem!important"
                                                    class="nilai quantity-field form-control-sm form-input" />
                                                <input type="button" data-jumlah="{{ $c->jumlah_produk }}"
                                                    data-id="{{ $c->id }}" value="+"
                                                    class="button-plus btn btn-sm" data-field="quantity" />
                                            </div>
                                        </div>
                                        <!-- price -->
                                        <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                                            <span class="fw-bold">{{ rupiah($c->produk->harga->harga_akhir) }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <!-- btn -->
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('landing.home') }}" class="btn btn-primary">Continue Shopping</a>
                        </div>
                    </div>
                </div>

                <!-- sidebar -->
                <div class="col-12 col-lg-4 col-md-5">
                    <!-- card -->
                    <div class="mb-5 card mt-6">
                        <div class="card-body p-6">
                            <!-- heading -->
                            <h2 class="h5 mb-4">Summary</h2>
                            <div class="card mb-2">
                                <!-- list group -->
                                <ul class="list-group list-group-flush">
                                    <!-- list group item -->
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="me-auto">
                                            <div>Item Subtotal</div>
                                        </div>
                                        <span id="subtotal">0</span>
                                    </li>

                                    <!-- list group item -->
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="me-auto">
                                            <div>Diskon Member</div>
                                        </div>
                                        <span id="diskon">0</span>
                                    </li>
                                    <!-- list group item -->
                                    <li class="list-group-item d-flex justify-content-between align-items-start">
                                        <div class="me-auto">
                                            <div class="fw-bold">Subtotal</div>
                                        </div>
                                        <span id="total" class="fw-bold">0</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="d-grid mb-1 mt-4">
                                <!-- btn -->
                                <button
                                    class="btn-checkout btn btn-primary btn-lg d-flex justify-content-between align-items-center"
                                    type="submit">
                                    Checkout
                                    <span class="fw-bold" id="button-total">0</span>
                                </button>
                            </div>
                            <!-- text -->
                            <p>
                                <small>
                                    By placing your order, you agree to be bound by the Freshcart
                                    <a href="#!">Terms of Service</a>
                                    and
                                    <a href="#!">Privacy Policy.</a>
                                </small>
                            </p>

                            <!-- heading -->
                            <div class="mt-8">
                                <h2 class="h5 mb-3">Add Promo or Gift Card</h2>
                                <form>
                                    <div class="mb-2">
                                        <!-- input -->
                                        <label for="giftcard" class="form-label sr-only">Email address</label>
                                        <input type="text" class="form-control" id="giftcard"
                                            placeholder="Promo or Gift Card" />
                                    </div>
                                    <!-- btn -->
                                    <div class="d-grid"><button type="submit"
                                            class="btn btn-outline-dark mb-1">Redeem</button></div>
                                    <p class="text-muted mb-0"><small>Terms & Conditions apply</small></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            // get Subtotal
            function subtotal() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('user.keranjang.subtotal') }}",
                    dataType: "JSON",
                    success: function(response) {
                        let subtotal = new Intl.NumberFormat("id-ID", {
                            style: "currency",
                            currency: "IDR",
                            minimumFractionDigits: 0
                        }).format(response.data[0])

                        $('#subtotal').text(subtotal)

                        let diskon = new Intl.NumberFormat("id-ID", {
                            style: "currency",
                            currency: "IDR",
                            minimumFractionDigits: 0
                        }).format(response.data[1])

                        $('#diskon').text(diskon)

                        let total = new Intl.NumberFormat("id-ID", {
                            style: "currency",
                            currency: "IDR",
                            minimumFractionDigits: 0
                        }).format(response.data[0] - response.data[1])

                        $('#total').text(total)
                        $('#button-total').text(total)
                    }
                });

            }

            subtotal()

            // Edit Kurangi Jumlah
            $('#keranjang li').on('click', '.button-minus', function(event) {
                event.preventDefault();

                $.ajax({
                    type: "GET",
                    url: "{{ route('user.order.jumlah') }}",
                    data: {
                        id_keranjang: $(this).data('id'),
                        jumlah: $(this).siblings().val()
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        subtotal()
                    },
                    error: function(response) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Gagal!', 'Periksa kembali data anda.', 'error');
                    },
                });

            });

            // Edit Tambah Jumlah
            $('#keranjang li').on('click', '.button-plus', function(event) {
                event.preventDefault();

                $.ajax({
                    type: "GET",
                    url: "{{ route('user.order.jumlah') }}",
                    data: {
                        id_keranjang: $(this).data('id'),
                        jumlah: $(this).prev().val()
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        subtotal()
                    },
                    error: function(response) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Gagal!', 'Periksa kembali data anda.', 'error');
                    },
                });

            });

            // Edit Jumlah
            $('#keranjang li').on('change', '.nilai', function(event) {
                event.preventDefault();

                $.ajax({
                    type: "GET",
                    url: "{{ route('user.order.jumlah') }}",
                    data: {
                        id_keranjang: $(this).siblings().data('id'),
                        jumlah: $(this).val()
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        subtotal()
                    },
                    error: function(response) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Gagal!', 'Periksa kembali data anda.', 'error');
                    },
                });

            });

            // Checkout Action
            $('.btn-checkout').click(function(e) {
                e.preventDefault();

                // Store Temp Order
                $.ajax({
                    type: "POST",
                    url: "{{ route('user.order.temp') }}",
                    data: {
                        id_user: "{{ Auth::user()->id }}"
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        if (response.meta.status == "success") {
                            location.href = "{{ route('user.order.index') }}"
                        }
                    },
                    error: function(response) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Gagal!', response.responseJSON.data,
                            'error');
                    },
                })
            });

            // Hapus Keranjang
            $('#keranjang li').on('click', '.btn-hapus', function(event) {
                event.preventDefault();

                Swal.fire({
                    title: "Hapus barang dari keranjang?",
                    text: "Pastikan data yang akan dihapus sudah sesuai",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#889397",
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Batalkan",
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('user.keranjang.destroy') }}",
                            data: {
                                id_keranjang: $(this).data('id'),
                            },
                            dataType: "json",
                            beforeSend: function() {
                                $.LoadingOverlay('show');
                            },
                            success: function(response) {
                                $.LoadingOverlay('hide');
                                location.reload()
                            },
                            error: function(response) {
                                $.LoadingOverlay('hide');
                                Swal.fire('Gagal!', 'Periksa kembali data anda.',
                                    'error');
                            },
                        });
                    }
                });
            });

        });
    </script>
@endsection
