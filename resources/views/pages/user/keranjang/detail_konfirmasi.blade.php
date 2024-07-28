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
            font-size: 14px;
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

        .deals-countdown .countdown-section .countdown-amount {
            margin-bottom: 0 !important;
            height: 25px !important;
        }
    </style>
@endsection

@section('content')
    {{-- Konten --}}
    <section class="mt-8">
        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">
                <div class="col-xl-12 col-12 mb-5">
                    <!-- card -->
                    <div class="card h-100 card-lg pb-5">
                        <div class="card h-100 card-lg">
                            <div class="card-body p-6">
                                <div class="card">
                                    @if ($order->pembayaran[0]->status_pembayaran == 1)
                                        <div class="card-body">
                                            <h4 class="card-title">Menunggu Pembayaran</h4>

                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row align-items-start justify-content-between">
                                                        <div class="col-lg-6">
                                                            <i class="fa-solid fa-bag-shopping me-2"></i>
                                                            <strong class="text-dark fs-5">
                                                                Belanja
                                                            </strong>
                                                            <span class="ms-2 text-secondary">
                                                                {{ $order->created_at->isoFormat('dddd, D MMMM Y') }}
                                                            </span>
                                                        </div>
                                                        <div class="col-lg-4 text-lg-end">
                                                            <span class="me-2 text-secondary">
                                                                Bayar Sebelum
                                                            </span>
                                                            <i class="text-warning fw-bold fa-solid fa-clock"></i>
                                                            <span class="text-primary fw-bold">
                                                                {{ $order->pembayaran[0]->created_at->addDays(1)->isoFormat('dddd, D MMMM Y H:mm') }}
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="row g-3 mt-3 justify-content-between align-items-center">
                                                        <div class="col-lg-7">
                                                            <div class="row g-3">
                                                                <div class="col-lg-2">
                                                                    @switch($bukti->transfer_ke)
                                                                        @case('BRI')
                                                                            <img style="width: 45px"
                                                                                src="{{ asset('images/bank/logo_bri.png') }}">
                                                                        @break

                                                                        @case('BCA')
                                                                            <img style="width: 45px"
                                                                                src="{{ asset('images/bank/logo_bca.png') }}">
                                                                        @break

                                                                        @case('BSI')
                                                                            <img style="width: 45px"
                                                                                src="{{ asset('images/bank/logo_bsi.svg') }}">
                                                                        @break

                                                                        @default
                                                                    @endswitch
                                                                </div>
                                                                <div class="col-lg-10">
                                                                    <strong>Metode Pembayaran</strong>
                                                                    <p class="mb-0">Transfer Manual</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 text-lg-end">
                                                            <strong>Total Pembayaran</strong>
                                                            <p class="mb-0">
                                                                {{ rupiah($order->harga_total + $order->biaya_pengiriman - $member_diskon - $diskon_alquran) }}
                                                            </p>
                                                        </div>
                                                    </div>

                                                    <div class="row justify-content-end mt-4">
                                                        <div class="col-lg-4">
                                                            <div class="row justify-content-end g-3">
                                                                <div class="col-lg-5">
                                                                    <a href="{{ route('user.order.detail_checkout', $order->id) }}"
                                                                        class="btn btn-outline-secondary w-100">Lihat
                                                                        Detail</a>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    @if ($order->status == 1)
                                                                        <button id="btn-cara-bayar" class="btn btn-primary"
                                                                            style="width: 87%">Cara Pembayaran</button>
                                                                        <span class="dropdown">
                                                                            <a href="#" class="text-reset"
                                                                                data-bs-toggle="dropdown"
                                                                                aria-expanded="false">
                                                                                <i
                                                                                    class="feather-icon icon-more-horizontal fs-5"></i>
                                                                            </a>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <button class="dropdown-item"
                                                                                        type="button" id="btn-bukti">
                                                                                        <i
                                                                                            class="bi bi-pencil-square me-3"></i>
                                                                                        Upload Bukti Pembayaran
                                                                                    </button>
                                                                                </li>
                                                                                <li>
                                                                                    <button class="dropdown-item btn-edit"
                                                                                        id="btn-ubah-rekening"
                                                                                        type="button">
                                                                                        <i
                                                                                            class="fa-solid fa-arrow-up-from-bracket me-3"></i>
                                                                                        Ubah Rekening Pengirim
                                                                                    </button>
                                                                                </li>
                                                                            </ul>
                                                                        </span>
                                                                    @elseif ($order->status == 6)
                                                                    @else
                                                                        <button type="button"
                                                                            class="btn btn-primary btn-download">Download
                                                                            Bukti
                                                                            Pembayaran</button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    @elseif($order->pembayaran[0]->status_pembayaran == 3)
                                        <div class="card-body">
                                            {{-- <h4 class="card-title">Pembayaran Kadaluarsa</h4> --}}
                                            <div class="alert alert-danger mb-0" role="alert">
                                                <strong>Pembayaran Kadaluarsa</strong><br>
                                                Pembayaran telah melebihi batas waktu yang telah ditentukan
                                            </div>

                                        </div>
                                    @endif
                                </div>

                                <div class="card mt-5">
                                    <div class="card-body">
                                        <h4 class="card-title">Detail Pesanan</h4>

                                        <div class="mt-8">
                                            <div class="row">

                                                @if ($dropship)
                                                    <div class="col-12">
                                                        <div class="alert alert-primary" role="alert">
                                                            Dikirim Melalui Dropship
                                                        </div>
                                                    </div>
                                                @endif

                                                <!-- address -->
                                                <div class="col-lg-4 col-md-4 col-12">
                                                    <div class="mb-6">
                                                        <h6>Detail Customer</h6>
                                                        <p class="mb-1 lh-lg">
                                                            {{ $order->user->name }}
                                                            <br />
                                                            {{ $order->user->email }}
                                                            <br />
                                                            {{ $order->user->no_telp }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <!-- address -->
                                                <div class="col-lg-4 col-md-4 col-12">
                                                    <div class="mb-6">
                                                        <h6>Alamat Pengiriman</h6>
                                                        <p class="mb-1 lh-lg">
                                                            {{ $order->user->alamat }}
                                                            <br>
                                                            {{ $order->user->district ? $order->user->district->name : '' }},
                                                            {{ $order->user->city ? $order->user->city->name : '' }}
                                                            <br>
                                                            {{ $order->user->province ? $order->user->province->name : '' }}
                                                            Kode Pos.
                                                            {{ $order->user->kode_pos ?? '' }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <!-- address -->
                                                <div class="col-lg-4 col-md-4 col-12">
                                                    <div class="mb-6">
                                                        <h6>Detail Order</h6>
                                                        <p class="mb-1 lh-lg">
                                                            Tanggal Order:
                                                            <span
                                                                class="text-dark">{{ \Carbon\Carbon::parse($order->created_at)->isoFormat('D MMMM Y') }}</span>
                                                            <br />
                                                            Total Order:
                                                            <span
                                                                class="text-dark">{{ rupiah($order->harga_total + $order->biaya_pengiriman - $member_diskon - $diskon_alquran) }}</span>
                                                            <br />
                                                            Status:
                                                        <h5>
                                                            <span id="btn-status" class="badge"></span>
                                                        </h5>
                                                        </p>
                                                    </div>
                                                </div>
                                                @if ($dropship)
                                                    <div class="col-lg-4 col-md-4 col-12">
                                                        <div class="mb-6">
                                                            <h6>Alamat Penerima</h6>
                                                            <p class="mb-1 lh-lg">
                                                                {{ $dropship->nama_penerima }}
                                                                <br>
                                                                {{ $dropship->no_telp_penerima }}
                                                                <br>
                                                                {{ $dropship->alamat_penerima }}
                                                                <br>
                                                                {{ $dropship->district->name }}
                                                                {{ $dropship->city->name }}
                                                                <br>
                                                                {{ $dropship->province->name }}
                                                                Kode Pos.
                                                                {{ $dropship->city->postal_code }}
                                                                <br />
                                                            </p>
                                                        </div>
                                                        <input type="hidden" id="subdistrict"
                                                            value="${response.data.desa}">
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-12">
                                                        <div class="mb-6">
                                                            <h6>Data Pengirim Dropshipper</h6>
                                                            <p class="mb-1 lh-lg">
                                                                {{ $dropship->nama_pengirim }}
                                                                <br />
                                                                {{ $dropship->email_pengirim }}
                                                                <br />
                                                                {{ $dropship->no_telp_pengirim }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="table-responsive">
                                            <!-- Table -->
                                            <table class="table mb-0 text-nowrap table-centered">
                                                <!-- Table Head -->
                                                <thead class="bg-light">
                                                    <tr>
                                                        <th>Produk</th>
                                                        <th>Harga</th>
                                                        <th>Jumlah Produk</th>
                                                        <th>Total</th>
                                                    </tr>
                                                </thead>
                                                <!-- tbody -->
                                                <tbody>
                                                    @foreach ($order->produk_dikirim as $i)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div>
                                                                        @if ($i->produk && $i->produk->gambar_produk->count() > 0)
                                                                            <img src="{{ asset('storage/produk/' . $i->produk->gambar_produk[0]->gambar) }}"
                                                                                alt=""
                                                                                class="icon-shape icon-lg" />
                                                                        @else
                                                                            <img src="{{ asset('images/avatar/no-image.png') }}"
                                                                                alt=""
                                                                                class="icon-shape icon-lg" />
                                                                        @endif
                                                                    </div>
                                                                    <div class="ms-lg-4 mt-2 mt-lg-0">
                                                                        <h5 class="mb-0 h6">
                                                                            {{ $i->produk ? $i->produk->nama_produk : '' }}
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <span
                                                                    class="text-body">{{ rupiah($i->harga_jual) }}</span>
                                                            </td>
                                                            <td>
                                                                {{ $i->jumlah_produk }}
                                                            </td>
                                                            <td>
                                                                {{ rupiah($i->harga_jual * $i->jumlah_produk) }}
                                                            </td>
                                                        </tr>
                                                    @endforeach

                                                    {{-- Total --}}
                                                    <tr>
                                                        <td class="border-bottom-0 pb-0"></td>
                                                        <td class="border-bottom-0 pb-0"></td>
                                                        <td colspan="1" class="fw-medium text-dark">
                                                            <!-- text -->
                                                            Sub Total :
                                                        </td>
                                                        <td class="fw-medium text-dark">
                                                            <!-- text -->
                                                            {{ rupiah($subTotal) }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="border-bottom-0 pb-0"></td>
                                                        <td class="border-bottom-0 pb-0"></td>
                                                        <td colspan="1" class="fw-medium text-dark">
                                                            <!-- text -->
                                                            Shipping Cost
                                                        </td>
                                                        <td class="fw-medium text-dark">
                                                            <!-- text -->
                                                            {{ rupiah($order->biaya_pengiriman) }}
                                                        </td>
                                                    </tr>

                                                    @if ($order->id_member)
                                                        <tr>
                                                            <td class="border-bottom-0 pb-0"></td>
                                                            <td class="border-bottom-0 pb-0"></td>
                                                            <td colspan="1" class="fw-medium text-success">
                                                                <!-- text -->
                                                                Member Diskon
                                                            </td>
                                                            <td class="fw-medium text-success">
                                                                <!-- text -->
                                                                <span id="member_diskon">
                                                                    {{ rupiah($member_diskon) }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endif

                                                    @if ($diskon_alquran)
                                                        <tr>
                                                            <td class="border-bottom-0 pb-0"></td>
                                                            <td class="border-bottom-0 pb-0"></td>
                                                            <td colspan="1" class="fw-medium text-success">
                                                                <!-- text -->
                                                                Diskon Alquran
                                                            </td>
                                                            <td class="fw-medium text-success">
                                                                <!-- text -->
                                                                <span id="member_diskon">
                                                                    {{ rupiah($diskon_alquran) }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @endif

                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="1" class="fw-semibold text-dark">
                                                            <!-- text -->
                                                            Grand Total
                                                        </td>
                                                        <td class="fw-semibold text-dark">
                                                            <!-- text -->
                                                            {{ rupiah($order->biaya_pengiriman + $subTotal - $member_diskon - $diskon_alquran) }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                @if ($order->status == 4 || $order->status == 5)
                                    <div class="card mt-5">
                                        <div class="card-body">
                                            <h4 class="card-title">Detail Pengiriman</h4>
                                            <div class="col-md-6 mb-4 mb-lg-0">
                                                <h6>Detail Pengiriman</h6>
                                                <!-- Section: Timeline -->
                                                <section class="p-5">
                                                    <ul class="timeline">
                                                        <div id="pengiriman"></div>
                                                    </ul>
                                                </section>
                                                <!-- Section: Timeline -->
                                                @if ($order->status < 5)
                                                    <span class="text-secondary d-block mb-2">Paket Telah diterima?</span>
                                                    <button class="btn btn-info btn-sm btn-diterima"><i
                                                            class="fa-solid fa-check me-2"></i>Paket Diterima</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Rating -->
    <div class="modal fade" id="modal-rating" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Berikan Rating
                    </h5>
                </div>
                <form id="form-rating">
                    <div class="modal-body">
                        @foreach ($order->produk_dikirim as $i)
                            <div class="row mb-2">
                                <div class="col-1">
                                    @if ($i->produk && $i->produk->gambar_produk->count() > 0)
                                        <img src="{{ asset('storage/produk/' . $i->produk->gambar_produk[0]->gambar) }}"
                                            alt="" class="icon-shape icon-lg" />
                                    @else
                                        <img src="{{ asset('images/avatar/no-image.png') }}" alt=""
                                            class="icon-shape icon-lg" />
                                    @endif
                                </div>
                                <div class="col-11">
                                    <h5>{{ $i->produk ? $i->produk->nama_produk : null }}</h5>
                                    <input type="hidden" name="id_produk[]"
                                        value="{{ $i->produk ? $i->produk->id : null }}">
                                    <h6 class="text-secondary fw-light fs-6">Bagaimana produk ini menurut anda?</h6>
                                    <input name="rating[]" class="rating rating-loading input-1" value="5"
                                        data-size="sm" data-show-clear="false" data-show-caption="true" data-min="0"
                                        data-max="5" data-step="1">
                                    <h6 class="text-secondary fw-light fs-6">Berikan ulasan untuk produk ini</h6>
                                    <textarea name="ulasan[]" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('user.order.konfirmasi') }}" type="button" class="btn btn-secondary">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary">Kirimkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Upload Bukti -->
    <div class="modal fade" id="modal-bukti" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Upload Bukti Transaksi
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @if (!$bukti)
                    <div class="container p-5">
                        <div class="alert alert-primary" role="alert">
                            <strong>Bukti Transaksi sudah diterima.</strong> <br>
                            Harap menunggu konfirmasi dari Admin Kami
                        </div>
                    </div>
                @else
                    <form id="form-bukti" method="post" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="card border-0 mb-3">
                                <div class="card-body p-0 p-3 bg-light rounded text-success">
                                    <i class="fa-regular fa-lightbulb me-2"></i>
                                    <span>Unggah bukti pembayaran dapat mempercepat verifikasi pembayaran</span>
                                </div>
                            </div>

                            <p>Pastikan bukti pembayaran menampilkan : </p>

                            <div class="row mb-4">
                                <div class="col-lg-6">
                                    <ul>
                                        <li>
                                            <strong class="d-block">Tanggal / Waktu Transfer</strong>
                                            <span class="fst-italic text-secondary">contoh: tgl . 24/04/2024 / jam
                                                09:20:36</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <ul>
                                        <li>
                                            <strong class="d-block">Status Berhasil</strong>
                                            <span class="fst-italic text-secondary">contoh: Transfer BERHASIL, Transaksi
                                                Sukses</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>


                            <div class="row g-3">
                                <div class="col-lg-12">
                                    <!-- input -->
                                    <input type="file" class="upload-berkas-dropify" name="gambar"
                                        data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg pdf"
                                        id="berkas" data-errors-position="outside" />

                                    <input type="hidden" name="id_order" value="{{ $order->id }}">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Cara Bayar -->
    <div class="modal fade" id="modal-cara-bayar" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Cara Pembayaran
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row align-items-center g-3">
                        <div class="col-lg-8">
                            <b>Transfer Manual</b>
                        </div>
                        <div class="col-lg-4 text-lg-end">
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
                                        <input type="text" class="d-none" id="norek" value="690301001436507" readonly>
                                        Eko Wicaksono
                                    @break

                                    @case('BCA')
                                        <div class="fw-bold">392 037 0747</div>
                                        <input type="text" class="d-none" id="norek" value="392 037 0747" readonly>
                                        Eko Wicaksono
                                    @break

                                    @case('BSI')
                                        <div class="fw-bold">6227979170</div>
                                        <input type="text" class="d-none" id="norek" value="6227979170" readonly>
                                        Eko Wicaksono
                                    @break

                                    @default
                                @endswitch
                            </div>
                        </div>
                        <div class="col-lg-6 p-2 text-lg-end">
                            <button id="copyrekening" class="btn btn-link text-decoration-none text-secondary p-0">
                                Salin
                                <i class="fa-regular fa-copy"></i>
                            </button>
                        </div>
                        <div class="col-lg-6 p-2">
                            <div>
                                <b>
                                    Total Pembayaran
                                </b>
                            </div>
                            <div class="fw-light mt-2">
                                <span
                                    class="fw-light">{{ rupiah($order->harga_total + $order->biaya_pengiriman - $member_diskon - $diskon_alquran) }}</span>
                            </div>
                        </div>
                        <div class="col-lg-6 p-2 text-lg-end">
                            <input id="tagihan_nominal" type="text" class="d-none"
                                value="{{ $order->harga_total + $order->biaya_pengiriman - $member_diskon - $diskon_alquran }}">
                            <button id="tagihan" class="btn btn-link text-decoration-none text-secondary p-0">
                                Salin
                                <i class="fa-regular fa-copy"></i>
                            </button>
                        </div>
                        <div class="alert" style="color: #055160; background-color: #eafbff; border-color: #9eeaf9"
                            role="alert">
                            <i class="fa-solid fa-circle-exclamation me-2"></i>
                            <strong>Penting! Transfer dengan jumlah yang tepat</strong>
                        </div>
                    </div>

                    <hr>
                    <span style="font-size: 12px">Pastikan pembayaran Anda sudah BERHASIL dan UNGGAH BUKTI untuk
                        mempercepat proses
                        verifikasi</span>
                    <hr style="height: 15px; border: none; background: #EAE6E6;">

                    <div class="row g-3">
                        <div class="col-lg-1">
                            <img style="min-height: 40px" class="img-fluid" src="{{ asset('images/payment/1.png') }}"
                                alt="">
                        </div>
                        <div class="col-lg-11">
                            <b class="text-primary">Pembayaran Terjamin</b><br>
                            <span>
                                Insan kamil menjamin keamanan dana yang kamu bayarkan di tiap transaksi.
                            </span>
                        </div>
                        <div class="col-lg-1">
                            <img style="min-height: 40px" class="img-fluid" src="{{ asset('images/payment/2.png') }}"
                                alt="">
                        </div>
                        <div class="col-lg-11">
                            <b class="text-primary">Jaga keamanan datamu</b><br>
                            <span>
                                Jangan menyebarkan bukti & data pembayaran ke pihak mana pun kecuali Penerbit Insan Kamil.
                            </span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

    <!-- Modal Ubah Rekening -->
    <div class="modal fade" id="modal-ubah-rekening" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Ubah Akun Bank
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form id="form-ubah-rekening">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Bank</label>
                            <select name="nama_bank" class="form-select">
                                <option value="bca" {{ $bukti->transfer_ke == 'BCA' ? 'selected' : '' }}>BCA</option>
                                <option value="bri" {{ $bukti->transfer_ke == 'BRI' ? 'selected' : '' }}>BRI</option>
                                <option value="bsi" {{ $bukti->transfer_ke == 'BSI' ? 'selected' : '' }}>BSI</option>
                            </select>
                            <input type="hidden" name="id" value="{{ $bukti->id }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Pengirim</label>
                            <input type="text" value="{{ $bukti->nama_rekening }}" name="nama_pengirim"
                                class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nomor Rekening</label>
                            <input type="text" value="{{ $bukti->no_rekening }}" name="no_rekening"
                                class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {

            // Button
            if ("{{ $order->status }}" == 1) {
                $('#btn-status').addClass('bg-warning')
                $('#btn-status').text('Menunggu Pembayaran')
            } else if ("{{ $order->status }}" == 2) {
                $('#btn-status').addClass('bg-primary')
                $('#btn-status').text('Sudah Dibayar')
            } else if ("{{ $order->status }}" == 3) {
                $('#btn-status').addClass('bg-primary')
                $('#btn-status').text('Pengemasan')
            } else if ("{{ $order->status }}" == 4) {
                $('#btn-status').addClass('bg-info')
                $('#btn-status').text('Proses Pengiriman')
            } else if ("{{ $order->status }}" == 6) {
                $('#btn-status').addClass('bg-danger')
                $('#btn-status').text('Gagal / Kadaluarsa')
            } else {
                $('#btn-status').text('Selesai')
                $('#btn-status').addClass('bg-success')
            }

            // Pesan
            $('#btn-bayar').click(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.order.detail_store') }}",
                    data: {
                        order_id: "{{ $order->id }}"
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');

                        snap.pay(response.data, {
                            onSuccess: function(result) {
                                // Success
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('user.order.pembayaran') }}",
                                    data: {
                                        id: response.order_id,
                                        status: 1
                                    },
                                    dataType: "JSON",
                                    beforeSend: function() {
                                        $.LoadingOverlay('show');
                                    },
                                    success: function(response) {
                                        $.LoadingOverlay('hide');
                                        location.href =
                                            "{{ route('user.order.konfirmasi') }}"
                                    }
                                });

                            },

                            onPending: function() {
                                // Pending
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('user.order.pembayaran') }}",
                                    data: {
                                        id: response.order_id,
                                        status: 2
                                    },
                                    dataType: "JSON",
                                    beforeSend: function() {
                                        $.LoadingOverlay('show');
                                    },
                                    success: function(response) {
                                        $.LoadingOverlay('hide');
                                        location.href =
                                            "{{ route('user.order.konfirmasi') }}"
                                    }
                                });
                            },

                            onError: function(result) {

                                // Error
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('user.order.pembayaran') }}",
                                    data: {
                                        id: response.order_id,
                                        status: 3
                                    },
                                    dataType: "JSON",
                                    beforeSend: function() {
                                        $.LoadingOverlay('show');
                                    },
                                    success: function(response) {
                                        $.LoadingOverlay('hide');
                                        location.reload()
                                    }
                                });
                            }

                        });

                        return false;
                    },
                    error: function(response) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Gagal!', 'Periksa kembali data anda.', 'error');
                    },
                });
            });

            // Ubah Rekening
            $('#form-ubah-rekening').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "PUT",
                    url: "{{ route('user.order.ubah_rekening') }}",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        $('#modal-ubah-rekening').modal('hide')
                        Swal.fire('Sukses!', 'Data berhasil diubah.', 'success');
                    },
                    error: function(response) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Gagal!', 'Periksa kembali data anda.', 'error');
                    },
                });

            });


            // Get Waybill
            $.ajax({
                type: "GET",
                url: "{{ route('user.order.waybill') }}",
                data: {
                    waybill: '{{ $order->no_resi }}',
                    courier: '{{ $order->courier }}'
                },
                dataType: "json",
                beforeSend: function() {
                    $('#pengiriman').append(`<div class="spinner-border text-success" role="status">
                            <span class="visually-hidden">Loading...</span>
                    </div>`);
                },
                success: function(response) {
                    $('#pengiriman').empty();
                    if (response.data != null) {
                        $.each(response.data, function(i, v) {
                            $('#pengiriman').append(
                                `<li class="timeline-item mb-5">
                                    <h6 class="fw-bold">${v.desc} ${v.location ?? '-' }</h6>
                                    <p style="font-size: 12px" class="text-muted mb-2 fw-bold">${v.date}</p>
                                </li>`
                            );
                        });
                    } else {
                        $('#pengiriman').append(`<li class="timeline-item mb-5">
                                                    <h6>Paket telah diserahkan ke kurir.</h6>
                                                </li>`);
                    }

                    if ('{{ $order->status == 5 }}') {
                        $('#pengiriman').append(`<li class="timeline-item mb-5">
                                                    <h6>Paket telah selesai dikirimkan.</h6>
                                                </li>`);
                    }
                },
                error: () => {
                    $('#pengiriman').empty();
                    $('#pengiriman').append(`<li class="timeline-item mb-5">
                                                <h6 class="fw-bold">Server Sibuk</h6>
                                            </li>`);
                }
            });

            // Paket diterima
            $('.btn-diterima').click(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: "Barang sudah diterima?",
                    text: "Pastikan barang yang anda pesan sudah diterima!",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#889397",
                    confirmButtonText: "Sudah diterima",
                    cancelButtonText: "Belum",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: "{{ route('user.order.diterima') }}",
                            data: {
                                order_id: "{{ $order->id }}"
                            },
                            dataType: "JSON",
                            beforeSend: function() {
                                $.LoadingOverlay('show');
                            },
                            success: function(response) {
                                $.LoadingOverlay('hide');
                                $('#modal-rating').modal('show')
                            }
                        });
                    }
                });

            });

            // with plugin options
            $(".input-id").rating();

            $('#form-rating').submit(function(e) {
                e.preventDefault();

                var user = "{{ $order->user->id }}"

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.order.rating') }}",
                    data: $(this).serialize() + `&user=${user}`,
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        Swal.fire({
                            icon: 'success',
                            title: "Sukses!",
                            text: "Data berhasil disimpan",
                        }).then((result) => {
                            location.href = "{{ route('user.order.konfirmasi') }}"
                        });
                    },
                    error: function(response) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Kesalahan!', 'Data gagal disimpan', 'error')
                    }
                });
            });

            // Download
            $('.btn-download').click(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "GET",
                    url: "{{ route('user.order.cetak') }}",
                    data: {
                        id: "{{ $order->id }}"
                    },
                    cache: false,
                    xhrFields: {
                        responseType: 'blob'
                    },
                    beforeSend: function() {
                        $.LoadingOverlay('show')
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide')
                        var blob = new Blob([response], {
                            type: 'application/pdf'
                        });
                        var url = URL.createObjectURL(blob);
                        window.open(url, '_blank');
                    },
                    error: function(xhr, status, error) {
                        $.LoadingOverlay('hide')
                    },
                });

            });

            // init Dropify
            if ($('.upload-berkas-dropify')) {
                $('.upload-berkas-dropify').dropify({
                    messages: {
                        'default': '<i class="fa-regular fa-image icon-file"></i> <br> Unggah file anda disini <br> <span>  Type: JPG | PNG | PDF (Max. 2MB) </span> <br> <button class="btn btn-yellow mt-3">Pilih File</button>',
                        'replace': 'Klik untuk mengganti file anda',
                        'remove': 'Hapus',
                        'error': 'Ooops, something wrong happended.'
                    },
                });
            }

            // Bukti Transfer
            $('#btn-bukti').click(function(e) {
                e.preventDefault();
                $('#modal-bukti').modal('show');
                $('#modal-bukti #total_pembayaran').text($.fn.dataTable.render.number('.', ',', 0, 'Rp ',
                        ',-')
                    .display(
                        `{{ rupiah($order->biaya_pengiriman + $subTotal - $member_diskon - $diskon_alquran) }}`
                    ))

            });

            // Submit Simpan
            $("#form-bukti").submit(function(e) {
                e.preventDefault();

                var formDataa = new FormData(document.getElementById("form-bukti"));

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.order.uploadBukti') }}",
                    data: formDataa,
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        if (response.meta.status == "success") {
                            Swal.fire({
                                icon: 'success',
                                title: "Sukses!",
                                text: response.meta.message,
                            }).then((result) => {
                                location.href = "{{ route('user.order.konfirmasi') }}"
                            });
                        }
                    },
                    error: function(response) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Gagal!', 'Periksa kembali data anda.', 'error');
                        console.log(response.responseJSON.message);
                    },
                });
            });

            //Flatpickr
            flatpickr("#tgl_transfer", {
                locale: "id",
                altInput: true,
                altFormat: "j F Y",
                dateFormat: "Y-m-d",
            });

            // Countdown
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

            $('#btn-cara-bayar').click(function(e) {
                e.preventDefault();
                $('#modal-cara-bayar').modal('show')
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

            // Modal Ubah Rekening
            $('#btn-ubah-rekening').click(function(e) {
                e.preventDefault();

                $('#modal-ubah-rekening').modal('show')

            });

        });
    </script>
@endsection
