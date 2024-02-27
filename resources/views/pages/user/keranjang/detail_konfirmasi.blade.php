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
                                                <button id="btn-bayar" class="btn btn-primary">Lakukan Pembayaran</button>
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
                                                    {{ $order->user->city->name }}, {{ $order->user->province->name }},
                                                    <br />
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
                                                    @if ($order->user->id_member)
                                                        <span
                                                            class="text-dark">{{ rupiah($order->harga_total + $order->biaya_pengiriman - $member_diskon) }}</span>
                                                    @else
                                                        <span
                                                            class="text-dark">{{ rupiah($order->harga_total + $order->biaya_pengiriman) }}</span>
                                                    @endif
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
                                                                    @if ($i->produk->gambar_produk)
                                                                        <img src="{{ asset('storage/produk/' . $i->produk->gambar_produk[0]->gambar) }}"
                                                                            alt="" class="icon-shape icon-lg" />
                                                                    @else
                                                                        <img src="{{ asset('images/products/product-img-1.jpg') }}"
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

                                                @if ($order->user->id_member)
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

                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td colspan="1" class="fw-semibold text-dark">
                                                        <!-- text -->
                                                        Grand Total
                                                    </td>
                                                    <td class="fw-semibold text-dark">
                                                        <!-- text -->
                                                        @if ($order->user->id_member)
                                                            {{ rupiah($order->biaya_pengiriman + $subTotal - $member_diskon) }}
                                                        @else
                                                            {{ rupiah($order->biaya_pengiriman + $subTotal) }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body p-6">
                                <div class="row">
                                    @if ($order->status == 4 || $order->status == 5)
                                        <div class="col-md-6 mb-4 mb-lg-0">
                                            <h6>Detail Pengiriman</h6>
                                            <ul>
                                                <div id="pengiriman"></div>
                                            </ul>
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
                                    @if ($i->produk->gambar_produk)
                                        <img src="{{ asset('storage/produk/' . $i->produk->gambar_produk[0]->gambar) }}"
                                            alt="" class="icon-shape icon-lg" />
                                    @else
                                        <img src="{{ asset('images/products/product-img-1.jpg') }}" alt=""
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
                        $('#pengiriman').append(`<li>Paket telah diserahkan ke kurir.</li>`);
                        $.each(response.data, function(i, v) {
                            $('#pengiriman').append(
                                `<li>${v.manifest_date} ${v.manifest_time} - ${v.manifest_description} ${v.city_name}</li>`
                            );
                        });
                    } else {
                        $('#pengiriman').append(`<li>Paket telah diserahkan ke kurir.</li>`);
                    }

                    if ('{{ $order->status == 5 }}') {
                        $('#pengiriman').append(`<li>Paket telah selesai dikirimkan.</li>`);
                    }
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

                        Swal.fire('Periksa kembali data anda!', 'Data Tidak Ditemukan',
                            'error');
                    },
                });

            });

        });
    </script>
@endsection
