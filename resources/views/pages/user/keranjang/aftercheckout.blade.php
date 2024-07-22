@extends('layouts.landing.main')

@section('css')
    <style>
        .deals-countdown .countdown-section {
            color: #0aad0a;
            border: 0 !important;
        }

        .countdown-section span {
            color: #0aad0a !important;
            min-width: 40px;
            text-align: center;
            font-size: 24px;
            font-weight: bold !important;
            width: 100% !important;
        }

        .copy-notification {
            color: #ffffff;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 20px;
            border-radius: 30px;
            position: fixed;
            top: 50%;
            left: 50%;
            width: 150px;
            margin-top: -30px;
            margin-left: -85px;
            display: none;
            text-align: center;
        }
    </style>
@endsection

@section('content')
    {{-- Konten --}}
    <section class="mt-8">
        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row justify-content-center">
                <div class="col-xl-8 col-8 mb-5">
                    <!-- card -->
                    <div class="card h-100 card-lg pb-5">
                        <div class="card h-100 card-lg">
                            <div class="card-body p-6">
                                <div class="card">
                                    @if ($order->pembayaran[0]->status_pembayaran == 1)
                                        <div class="card-body">
                                            <h4 class="card-title text-center text-dark">Selesaikan pembayaran dalam</h4>

                                            <div class="text-center">
                                                <div class="deals-countdown"
                                                    data-countdown="{{ $order->pembayaran[0]->created_at->addDays(1) }}">
                                                </div>
                                            </div>

                                            <p class="text-center">Batas Akhir Pembayaran</p>

                                            <div
                                                class="d-flex justify-content-center justify-content-lg-start text-center mt-1">

                                            </div>

                                            <h5 class="text-dark text-center fw-bold">
                                                {{ $order->pembayaran[0]->created_at->addDays(1)->isoFormat('dddd, D MMMM Y H:mm') }}
                                            </h5>

                                            <div class="row m-5 align-items-center">
                                                <div class="col-lg-6 p-2 border-bottom">
                                                    <b>
                                                        Transfer Bank
                                                    </b>
                                                </div>
                                                <div class="col-lg-6 p-2 border-bottom text-end">
                                                    @switch($bukti->transfer_ke)
                                                        @case('BRI')
                                                            <img style="width: 45px" src="{{ asset('images/bank/logo_bri.png') }}">
                                                        @break

                                                        @case('BCA')
                                                            <img style="width: 45px" src="{{ asset('images/bank/logo_bca.png') }}">
                                                        @break

                                                        @case('BSI')
                                                            <img style="width: 45px" src="{{ asset('images/bank/logo_bsi.svg') }}">
                                                        @break

                                                        @default
                                                    @endswitch
                                                </div>
                                                <div class="col-lg-6 p-2">
                                                    <div>
                                                        <b>
                                                            Nomor Rekening Tujuan
                                                        </b>
                                                    </div>
                                                    <div class="fw-light mt-2">
                                                        @switch($bukti->transfer_ke)
                                                            @case('BRI')
                                                                <div class="fw-bold">6903 01 001436 50 7</div>
                                                                <input type="text" class="d-none" id="norek"
                                                                    value="690301001436507" readonly>
                                                                Eko Wicaksono
                                                            @break

                                                            @case('BCA')
                                                                <div class="fw-bold">392 037 0747</div>
                                                                <input type="text" class="d-none" id="norek"
                                                                    value="392 037 0747" readonly>
                                                                Eko Wicaksono
                                                            @break

                                                            @case('BSI')
                                                                <div class="fw-bold">6227979170</div>
                                                                <input type="text" class="d-none" id="norek"
                                                                    value="6227979170" readonly>
                                                                Eko Wicaksono
                                                            @break

                                                            @default
                                                        @endswitch
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 p-2 text-end">
                                                    <button id="copyrekening"
                                                        class="btn btn-link text-decoration-none text-secondary p-0">
                                                        Salin
                                                        <i class="fa-regular fa-copy"></i>
                                                    </button>
                                                </div>
                                                <div class="col-lg-6 p-2">
                                                    <div>
                                                        <b>
                                                            Total Tagihan
                                                        </b>
                                                    </div>
                                                    <div class="fw-light mt-2">
                                                        <span
                                                            class="fw-light">{{ rupiah($order->harga_total + $order->biaya_pengiriman - $member_diskon - $diskon_alquran) }}</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 p-2 text-end">
                                                    <input id="tagihan_nominal" type="text" class="d-none"
                                                        value="{{ $order->harga_total + $order->biaya_pengiriman - $member_diskon - $diskon_alquran }}">
                                                    <button id="tagihan"
                                                        class="btn btn-link text-decoration-none text-secondary p-0">
                                                        Salin
                                                        <i class="fa-regular fa-copy"></i>
                                                    </button>
                                                </div>
                                                <div class="alert"
                                                    style="color: #055160; background-color: #eafbff; border-color: #9eeaf9"
                                                    role="alert">
                                                    <strong>Penting!</strong>
                                                    <ol>
                                                        <li>Transfer tepat hingga <b>3 digit terakhir</b></li>
                                                        <li>Tidak disarankan transfer melalui LLG/Kliring/SKBNI</li>
                                                    </ol>
                                                </div>
                                                <div class="col-lg-6">
                                                    <a href="{{ route('user.order.detail_konfirmasi', $order->id) }}"
                                                        class="btn btn-outline-secondary w-100">Cek Status
                                                        Pembayaran</a>
                                                </div>
                                                <div class="col-lg-6">
                                                    <a href="{{ route('landing.home') }}"
                                                        class="btn btn-primary w-100">Belanja
                                                        Lagi</a>
                                                </div>

                                            </div>


                                        </div>
                                    @elseif ($order->pembayaran[0]->status_pembayaran == 2)
                                        <div class="alert alert-primary mb-0" role="alert">
                                            <strong>Pembayaran Sukses</strong><br>
                                            Pembayaran telah diterima <br>
                                            <a href="{{ route('user.order.detail_konfirmasi', $order->id) }}"
                                                class="btn btn-primary">Detail Pembayaran</a>
                                        </div>
                                    @else
                                        <div class="alert alert-danger mb-0" role="alert">
                                            <strong>Pembayaran Kadaluarsa</strong><br>
                                            Pembayaran telah melebihi batas waktu yang telah ditentukan <br>
                                            <a href="{{ route('user.order.detail_konfirmasi', $order->id) }}"
                                                class="btn btn-sm btn-danger mt-2">Detail Pembayaran</a>
                                        </div>
                                    @endif
                                </div>
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

            $("[data-countdown]").each(function() {
                var n = $(this),
                    s = $(this).data("countdown");
                n.countdown(s, function(n) {
                    $(this).html(n.strftime(
                        `<span class="countdown-section">
                            <span class="countdown-amount hover-up">%H : %M : %S</span>
                        </span>`
                    ))
                }).on('finish.countdown', function() {
                    setTimeout(
                        function() {
                            location.reload()
                        }, 1000);
                });
            });

            $('#copyrekening').click(function(e) {
                e.preventDefault();

                CopyToClipboard($('#norek').val(), true, "Copied");

            });

            $('#tagihan').click(function(e) {
                e.preventDefault();

                CopyToClipboard($('#tagihan_nominal').val(), true, "Copied");

            });

            function CopyToClipboard(value, showNotification, notificationText) {
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(value).select();
                document.execCommand("copy");
                $temp.remove();

                if (typeof showNotification === 'undefined') {
                    showNotification = true;
                }
                if (typeof notificationText === 'undefined') {
                    notificationText = "Copied to clipboard";
                }

                var notificationTag = $("div.copy-notification");
                if (showNotification && notificationTag.length == 0) {
                    notificationTag = $("<div/>", {
                        "class": "copy-notification",
                        text: notificationText
                    });
                    $("body").append(notificationTag);

                    notificationTag.fadeIn("slow", function() {
                        setTimeout(function() {
                            notificationTag.fadeOut("slow", function() {
                                notificationTag.remove();
                            });
                        }, 1000);
                    });
                }
            }

        });
    </script>
@endsection
