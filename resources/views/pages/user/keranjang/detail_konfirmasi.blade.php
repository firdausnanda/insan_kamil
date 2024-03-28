@extends('layouts.landing.main')

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
                                <div class="d-md-flex justify-content-between">
                                    <div class="d-flex align-items-center mb-2 mb-md-0">
                                        <h2>Detail Pesanan</h2>
                                    </div>
                                    <!-- select option -->
                                    <div class="d-md-flex">

                                        <!-- button -->
                                        <div class="ms-md-3">
                                            @if ($order->status == 1)
                                                {{-- <button id="btn-bayar" class="btn btn-primary">Lakukan Pembayaran</button> --}}
                                                <button id="btn-bukti" class="btn btn-info">Unggah Bukti Pembayaran</button>
                                            @elseif ($order->status == 6)
                                            @else
                                                <button type="button" class="btn btn-info btn-download">Download Bukti
                                                    Pembayaran</button>
                                            @endif
                                            <a href="{{ route('user.order.konfirmasi') }}"
                                                class="btn btn-secondary">Kembali</a>
                                        </div>
                                    </div>
                                </div>
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
                                                <input type="hidden" id="subdistrict" value="${response.data.desa}">
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
                            </div>
                            <div class="row">
                                <div class="col-12">
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
                                                                    @if ($i->produk->gambar_produk->count() > 0)
                                                                        <img src="{{ asset('storage/produk/' . $i->produk->gambar_produk[0]->gambar) }}"
                                                                            alt="" class="icon-shape icon-lg" />
                                                                    @else
                                                                        <img src="{{ asset('images/avatar/no-image.png') }}"
                                                                            alt="" class="icon-shape icon-lg" />
                                                                    @endif
                                                                </div>
                                                                <div class="ms-lg-4 mt-2 mt-lg-0">
                                                                    <h5 class="mb-0 h6">{{ $i->produk->nama_produk }}</h5>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="text-body">{{ rupiah($i->harga_jual) }}</span>
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
                                {{-- <div class="col-lg-6 p-5">
                                    <div class="container border rounded p-4 text-center position-relative"
                                        style="background-color: #f7c331; bottom: 120px; left: 45px">
                                        <div class="container border border-white border-5 p-4 rounded">
                                            <img src="{{ asset('images/warning.png') }}" style="width: 80px">
                                            <h4 class="text-danger">Perhatian</h4>
                                            <p class="text-dark fs-5">Ditujukan kepada seluruh customer kami untuk
                                                mempermudah
                                                administrasi, setiap transaksi pembelian kurang dari Rp 500.00 silahkan
                                                menggunakan pembayaran via <strong>Qris</strong>. Untuk transaksi lebih dari
                                                Rp 500.000
                                                dianjurkan pembayaran transfer via bank. Terima kasih atas perhatian
                                                dan kerja samanya.</p>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="card-body p-6">
                                <div class="row">
                                    @if ($order->status == 4 || $order->status == 5)
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
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Body -->
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
                                    @if ($i->produk->gambar_produk->count() > 0)
                                        <img src="{{ asset('storage/produk/' . $i->produk->gambar_produk[0]->gambar) }}"
                                            alt="" class="icon-shape icon-lg" />
                                    @else
                                        <img src="{{ asset('images/avatar/no-image.png') }}" alt=""
                                            class="icon-shape icon-lg" />
                                    @endif
                                </div>
                                <div class="col-11">
                                    <h5>{{ $i->produk->nama_produk }}</h5>
                                    <input type="hidden" name="id_produk[]" value="{{ $i->produk->id }}">
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

    <!-- Modal Body -->
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
                @if ($bukti)
                    <div class="container p-5">
                        <div class="alert alert-primary" role="alert">
                            <strong>Bukti Transaksi sudah diterima.</strong> <br>
                            Harap menunggu konfirmasi dari Admin Kami
                        </div>
                    </div>
                @else
                    <form id="form-bukti" method="post" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="alert alert-primary" role="alert">
                                <strong>Perhatian</strong><br>
                                Silakan kirimkan pembayaran ke salah satu rekening berikut.
                                <ol>
                                    <li>
                                        <strong>BRI 6903 01 001436 50 7</strong> <br>
                                        An. Eko Wicaksono
                                    </li>
                                    <li>
                                        <strong>BCA 3920370747 </strong><br>
                                        An. Eko Wicaksono
                                    </li>
                                    <li>
                                        <strong>BSI 6227979170 </strong><br>
                                        An. Eko wicaksono
                                    </li>
                                    <li>
                                        <strong>BSM 7002044824</strong> <br>
                                        An. RIYANTO
                                    </li>
                                </ol>
                            </div>


                            <div class="row g-3">
                                <div class="col-lg-12">
                                    <label for="" class="form-label">Nama Rekening</label>
                                    <input type="text" class="form-control" name="nama_rekening">
                                </div>
                                <div class="col-lg-12">
                                    <label for="" class="form-label">Tranfer ke</label>
                                    <select class="form-select" name="transfer_ke">
                                        <option value="BRI">BRI (No Rek : 6903 01 001436 50 7 A.n Eko Wicaksono)
                                        </option>
                                        <option value="BCA">BCA (No Rek : 3920370747 A.n Eko Wicaksono)</option>
                                        <option value="BSI">BSI (No Rek : 6227979170 A.n Eko Wicaksono)</option>
                                        <option value="BSM">BSM (No Rek : 7002044824 A.n Riyanto)</option>
                                    </select>
                                </div>
                                <div class="col-lg-12">
                                    <label for="" class="form-label">Tanggal Transfer</label>
                                    <input type="text" class="form-control" name="tgl_transfer" id="tgl_transfer">
                                </div>
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
            });

            // Submit Simpan
            $("#form-bukti").submit(function(e) {
                e.preventDefault();

                var formDataa = new FormData(document.getElementById("form-bukti"));

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.order.addBukti') }}",
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

        });
    </script>
@endsection
