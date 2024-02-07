@extends('layouts.dashboard.main')

@section('content')
    <main class="main-content-wrapper">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row mb-8">
                <div class="col-md-12">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4">
                        <div>
                            <!-- page header -->
                            <h2>Detail Order</h2>
                            <!-- breacrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" class="text-inherit">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.order.index') }}" class="text-inherit">Order</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Detail Order</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- button -->
                        <div>
                            <a href="{{ route('admin.order.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row">
                <div class="col-xl-12 col-12 mb-5">
                    <!-- card -->
                    <div class="card h-100 card-lg">
                        <div class="card-body p-6">
                            <div class="d-md-flex justify-content-between">
                                <div class="d-flex align-items-center mb-2 mb-md-0">
                                    <h2 class="mb-0">Detail Transaksi</h2>
                                </div>
                                <!-- select option -->
                                <div class="d-md-flex gap-2">
                                    <div class="mb-2 mb-md-0">
                                        <select class="form-select" id="status">
                                            <option value="2" {{ $order->status == 2 ? 'Selected' : '' }}>Belum
                                                Diproses</option>
                                            <option value="3" {{ $order->status == 3 ? 'Selected' : '' }}>Diproses
                                            </option>
                                            <option value="4" {{ $order->status == 4 ? 'Selected' : '' }}>Pengiriman
                                            </option>
                                            <option value="5" {{ $order->status == 5 ? 'Selected' : '' }}>Selesai
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-2 mb-md-0">
                                        <input type="text" id="no_resi" value="{{ $order->no_resi }}"
                                            class="form-control d-none">
                                    </div>
                                    <!-- button -->
                                    <div class="ms-md-3">
                                        <button id="btn-simpan" class="btn btn-primary">Simpan</button>
                                        <a href="#" class="btn btn-secondary">Download Bukti Transaksi</a>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-8">
                                <div class="row">
                                    {{-- address --}}
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <div class="mb-6">
                                            <div class="alert alert-warning" role="alert">
                                                <strong>Courier:</strong>
                                                {{ $courier_search }}<br>

                                                <strong>Nomor Resi:</strong>
                                                {{ $order->no_resi ?? '-' }}

                                            </div>
                                        </div>
                                    </div>

                                    <!-- address -->
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-6">
                                            <h6>Customer Details</h6>
                                            <p class="mb-1 lh-lg">
                                                {{ $order->user->name }}
                                                <br />
                                                {{ $order->user->email }}
                                                <br />
                                                {{ $order->user->no_telp }}
                                            </p>
                                            <button class="btn btn-link p-0 text-decoration-none btn-profil">View
                                                Profile</button>
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
                                                {{ $order->user->city ? $order->user->city->postal_code : '' }}
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
                                                    class="text-dark">{{ rupiah($order->harga_total + $order->biaya_pengiriman) }}</span>
                                            </p>
                                        </div>
                                    </div>
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

                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td colspan="1" class="fw-semibold text-dark">
                                                    <!-- text -->
                                                    Grand Total
                                                </td>
                                                <td class="fw-semibold text-dark">
                                                    <!-- text -->
                                                    {{ rupiah($order->biaya_pengiriman + $subTotal) }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-6">
                            <div class="row">
                                @if ($order->status >= 4)
                                    <div class="col-md-6 mb-4 mb-lg-0">
                                        <h6>Detail Pengiriman</h6>

                                        <ul>
                                            <div id="pengiriman"></div>
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Modal Show --}}
    <div class="modal fade" id="modal-show" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Data Pengguna</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-edit">
                    <div class="modal-body">
                        <div class="row">
                            <!-- input -->
                            <div class="col-md-12 mb-3">
                                <!-- input -->
                                <label class="form-label" for="nama">
                                    Nama Lengkap
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="nama" name="nama" class="form-control-plaintext"
                                    placeholder="Nama Lengkap" value="{{ $order->user->name }}" />
                                <input type="hidden" name="id_user" value="{{ $order->user->id }}" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="no_telepon">
                                    Nomor Telepon
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="hidden" name="email" value="{{ $order->user->email }}">
                                <input type="text" id="no_telepon" name="no_telepon" class="form-control-plaintext"
                                    placeholder="Nomor Telepon" value="{{ $order->user->no_telp }}" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <!-- input -->
                                <label class="form-label" for="alamat">Alamat</label>
                                <textarea rows="3" id="alamat" name="alamat" class="form-control-plaintext" placeholder="Nama Lengkap">{{ $order->user->alamat }}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <!-- input -->
                                <label class="form-label" for="provinsi">Provinsi</label>
                                <input type="text" id="no_telepon" name="no_telepon" class="form-control-plaintext"
                                    placeholder="Nomor Telepon"
                                    value="{{ $order->user->province ? $order->user->province->name : '' }}" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <!-- input -->
                                <label class="form-label" for="kota">Kota</label>
                                <input type="text" id="no_telepon" name="no_telepon" class="form-control-plaintext"
                                    placeholder="Nomor Telepon"
                                    value="{{ $order->user->city ? $order->user->city->name : '' }}" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <!-- input -->
                                <label class="form-label" for="desa">Kelurahan/Desa</label>
                                <input type="text" id="no_telepon" name="no_telepon" class="form-control-plaintext"
                                    placeholder="Nomor Telepon"
                                    value="{{ $order->user->district ? $order->user->district->name : '' }}" />

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            // Filter
            $("#status").change(function(e) {
                e.preventDefault();

                if ($('#status').val() == 4) {
                    $('#no_resi').addClass('d-block').removeClass('d-none')
                } else {
                    $('#no_resi').addClass('d-none').removeClass('d-block')
                }
            });

            // Filter
            if ($('#status').val() == 4) {
                $('#no_resi').addClass('d-block').removeClass('d-none')
            } else {
                $('#no_resi').addClass('d-none').removeClass('d-block')
            }

            // Simpan
            $('#btn-simpan').click(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.order.store') }}",
                    data: {
                        no_resi: $('#no_resi').val(),
                        id_order: '{{ $order->id }}',
                        status: $('#status').val()
                    },
                    dataType: "json",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        if (response.meta.status == "success") {
                            Swal.fire({
                                icon: 'success',
                                title: "Sukses!",
                                text: "Data berhasil disimpan",
                            }).then((result) => {
                                location.href = "{{ route('admin.order.index') }}";
                            });
                        }
                    }
                });
            });

            // Button Profile
            $('.btn-profil').click(function(e) {
                e.preventDefault();

                $('#modal-show').modal('show')
            });

            // Get Waybill
            $.ajax({
                type: "GET",
                url: "{{ route('admin.order.waybill') }}",
                data: {
                    waybill: $('#no_resi').val(),
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
                                `<li>${v.manifest_date} ${v.manifest_time} - ${v.manifest_description} ${v.city_name}</li>`
                                );
                        });
                    } else {
                        $('#pengiriman').append(`<li>Paket telah diserahkan ke kurir.</li>`);
                    }
                }
            });

        });
    </script>
@endsection
