@extends('layouts.landing.main')

@section('content')
    {{-- Konten --}}
    <section class="mb-lg-14 mb-8 mt-8">
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- col -->
                <div class="col-12">
                    <div>
                        <div class="mb-8">
                            <!-- text -->
                            <h1 class="fw-bold mb-0">Checkout</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-7 col-md-12">
                        <!-- accordion -->
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <!-- accordion item -->
                            <div class="accordion-item py-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- heading one -->
                                    <a class="fs-5 text-inherit collapsed h4">
                                        <i class="feather-icon icon-map-pin me-2 text-muted"></i>
                                        Add delivery address
                                    </a>
                                </div>
                                <div id="flush-collapseOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="mt-5">

                                        <div class="row">
                                            <div class="col-lg-6 col-12 mb-4">
                                                <!-- form -->
                                                <label class="d-block">
                                                    <div class="card card-body card-input p-6 mb-4">

                                                        <span class="fw-bold mb-2">
                                                            <i class="fa-solid fa-house me-2"></i>
                                                            Kirim ke mana?
                                                        </span>

                                                        <span class="mb-2">{{ $data[0]->user->name ?? '' }} -
                                                            {{ $data[0]->user->no_telp ?? '' }} <span
                                                                class="badge bg-secondary">Utama</span></span>

                                                        <div class="form-check mb-4">
                                                            <input
                                                                value="{{ $data[0]->user->district ? $data[0]->user->district->id : '' }}"
                                                                class="form-check-input card-input-element" type="radio"
                                                                name="alamat" id="homeRadio" checked />
                                                            <span class="form-check-label text-dark"
                                                                for="homeRadio">Home</span>
                                                        </div>

                                                        <!-- address -->
                                                        <address>
                                                            <strong>{{ $data[0]->user->name }}</strong>
                                                            <br />

                                                            {{ $data[0]->user->alamat }}
                                                            <br />

                                                            {{ $data[0]->user->district ? $data[0]->user->district->name : '' }},
                                                            {{ $data[0]->user->city ? $data[0]->user->city->name : '' }}
                                                            <br>
                                                            {{ $data[0]->user->province ? $data[0]->user->province->name : '' }}
                                                            Kode Pos.
                                                            {{ $data[0]->user->kode_pos ?? '' }}
                                                        </address>

                                                        <div class="col">
                                                            <button
                                                                class="btn btn-link p-0 text-decoration-none btn-edit-alamat">Edit
                                                                Alamat</button>
                                                        </div>
                                                    </div>
                                                </label>

                                                {{-- Dropship --}}
                                                <input style="cursor: pointer;" class="form-check-input me-2 mb-3"
                                                    id="dropship" type="checkbox"><label style="cursor: pointer;"
                                                    for="dropship">Kirim
                                                    sebagai dropshipper ? </label>
                                                <div id="card_dropship"></div>
                                            </div>
                                            <div class="col-lg-6 col-12 mb-4">
                                                <!-- input -->
                                                <div class="card">
                                                    <div class="card-body">

                                                        <div class="row g-3 py-1">

                                                            <div class="col d-flex justify-content-end">
                                                                <button
                                                                    class="btn btn-outline-primary btn-sm btn-tambah-alamat">Add
                                                                    a new
                                                                    address</button>
                                                            </div>

                                                            @forelse ($alamat as $a)
                                                                <label class="d-block">
                                                                    <div class="card card-body card-input border">
                                                                        {{-- List Alamat --}}
                                                                        <div class="form-check mb-4">
                                                                            <input
                                                                                class="form-check-input card-input-element"
                                                                                type="radio" name="alamat"
                                                                                id="officeRadio1"
                                                                                value="{{ $a->district ? $a->district->id : '' }}" />
                                                                            <span class="form-check-label fw-bold"
                                                                                for="officeRadio1">{{ $a->nama_penerima }}</span>
                                                                        </div>
                                                                        <address>

                                                                            {{ $a->alamat_penerima }}
                                                                            <br />

                                                                            {{ $a->district ? $a->district->name : '' }},
                                                                            {{ $a->city ? $a->city->name : '' }}
                                                                            <br>
                                                                            {{ $a->province ? $a->province->name : '' }}
                                                                            Kode Pos.
                                                                            {{ $a->city ? $a->city->postal_code : '' }}
                                                                        </address>
                                                                    </div>
                                                                </label>
                                                            @empty
                                                                <p class="text-secondary text-center fst-italic">Belum ada
                                                                    alamat tersimpan</p>
                                                            @endforelse

                                                        </div>

                                                    </div>

                                                    <div class="card-footer" style="font-size: 12px;">
                                                        <div class="row">
                                                            <div class="col-lg-8">
                                                                {{ $alamat->currentPage() }} dari
                                                                {{ $alamat->lastPage() }} <br>
                                                                Alamat tersimpan
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <ul class="pagination">
                                                                    <li class="page-item">
                                                                        <a class="page-link"
                                                                            href="{{ $alamat->previousPageUrl() }}"
                                                                            aria-label="Previous">
                                                                            <span aria-hidden="true">&laquo;</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="page-item">
                                                                        <a class="page-link"
                                                                            href="{{ $alamat->nextPageUrl() }}"
                                                                            aria-label="Next">
                                                                            <span aria-hidden="true">&raquo;</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col d-flex justify-content-end">
                                                <a href="#" class="btn btn-primary" data-bs-toggle="collapse"
                                                    data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                                    aria-controls="flush-collapseTwo">Selanjutnya</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- accordion item -->
                            <div class="accordion-item py-4">
                                <a class="text-inherit collapsed h5">
                                    <i class="fa-solid fa-box me-2 text-muted"></i>
                                    Detail Pengiriman
                                </a>
                                <!-- collapse -->
                                <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample">

                                    <select class="form-select my-3" id="jasa_pengiriman">
                                        <option value="">Pilih Jasa Pengiriman</option>
                                        @foreach ($courier as $c)
                                            <option value="{{ $c['kode'] }}">{{ $c['nama'] }}</option>
                                        @endforeach
                                    </select>

                                    <div id="loading"></div>

                                    <div class="row g-3" id="daftar_paket"></div>

                                    <div class="row mt-3">
                                        <div class="col d-flex justify-content-end">
                                            <a href="#" class="btn btn-outline-secondary me-2"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                aria-expanded="false" aria-controls="flush-collapseOne">Sebelumnya</a>
                                            <button class="btn btn-primary disabled" data-bs-toggle="collapse"
                                                data-bs-target="#flush-collapseThree" aria-expanded="false"
                                                aria-controls="flush-collapseThree">Selanjutnya</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- accordion item -->
                            <div class="accordion-item py-4">
                                <a class="text-inherit h5">
                                    <i class="feather-icon icon-shopping-bag me-2 text-muted"></i>
                                    Informasi Pengiriman
                                    <!-- collapse -->
                                </a>
                                <div id="flush-collapseThree" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="mt-5">
                                        <span>Instruksi pengiriman (Opsional)</span>
                                        <textarea class="form-control" id="catatan" rows="3" placeholder="Tulis intruksi pengiriman "></textarea>
                                        <p class="form-text">Tambahkan instruksi tentang bagaimana Anda ingin pesanan Anda
                                            dikirimkan</p>

                                        <div class="row mt-3">
                                            <div class="col d-flex justify-content-end">
                                                <a href="#" class="btn btn-outline-secondary me-2"
                                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                                    aria-expanded="false" aria-controls="flush-collapseTwo">Sebelumnya</a>
                                                <a href="#" class="btn btn-primary" data-bs-toggle="collapse"
                                                    data-bs-target="#flush-collapseFour" aria-expanded="false"
                                                    aria-controls="flush-collapseFour">Selanjutnya</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- accordion item -->
                            <div class="accordion-item py-4">
                                <a class="text-inherit h5">
                                    <i class="feather-icon icon-credit-card me-2 text-muted"></i>
                                    Pembayaran
                                    <!-- collapse -->
                                </a>
                                <div id="flush-collapseFour" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionFlushExample">

                                    <div class="alert alert-primary mt-5" role="alert">
                                        Klik Bayar Pesanan untuk melanjutkan pembelian
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col d-flex justify-content-end">
                                            <a href="#" class="btn btn-outline-secondary me-2"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseThree"
                                                aria-expanded="false" aria-controls="flush-collapseThree">Sebelumnya</a>
                                            <button class="btn btn-primary float-end" id="pesan">Bayar
                                                Pesanan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-12 col-lg-5">
                        <div class="mt-4 mt-lg-0">
                            <div class="card shadow-sm">
                                <h5 class="px-6 py-4 bg-transparent mb-0">Order Details</h5>
                                <ul class="list-group list-group-flush">
                                    @foreach ($data as $d)
                                        <!-- list group item -->
                                        <li class="list-group-item px-4 py-3">
                                            <div class="row align-items-center">
                                                <div class="col-2 col-md-2">
                                                    @if ($d->produk->gambar_produk->count() > 0)
                                                        <img src="{{ asset('storage/produk/' . $d->produk->gambar_produk[0]->gambar) }}"
                                                            alt="" class="img-fluid" />
                                                    @else
                                                        <img src="{{ asset('images/avatar/no-image.png') }}"
                                                            alt="" class="img-fluid" />
                                                    @endif
                                                </div>
                                                <div class="col-5 col-md-5">
                                                    <h6 class="mb-0">{{ $d->produk->nama_produk }}</h6>
                                                    <span><small class="text-muted">{{ $d->berat_produk }} /
                                                            gr</small></span>
                                                </div>
                                                <div class="col-2 col-md-2 text-center text-muted">
                                                    <span>{{ $d->jumlah_produk }}</span>
                                                </div>
                                                <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                                                    <span
                                                        class="fw-bold">{{ rupiah($d->harga_jual * $d->jumlah_produk) }}</span>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                    <li class="list-group-item px-4 py-3">
                                        <div class="row align-items-center">

                                            {{-- Subtotal --}}
                                            <div class="col-9 col-md-9 py-2">
                                                <span class="text-secondary">Subtotal Produk</span>
                                            </div>
                                            <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                                                <span class="fw-bold">{{ rupiah($subTotal) }}</span>
                                            </div>

                                            @if ($member_diskon)
                                                <div class="col-9 col-md-9 py-2">
                                                    <span class="text-secondary">Member Diskon</span>
                                                </div>
                                                <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                                                    <span class="fw-bold">{{ rupiah($member_diskon) }}</span>
                                                </div>
                                            @endif

                                            @if ($diskon_alquran)
                                                <div class="col-9 col-md-9 py-2">
                                                    <span class="text-secondary">Diskon Alquran</span>
                                                </div>
                                                <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                                                    <span class="fw-bold">{{ rupiah($diskon_alquran) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </li>

                                    <li class="list-group-item px-4 py-3">
                                        <div class="row align-items-center">

                                            {{-- Subtotal --}}
                                            <div class="col-9 col-md-9 py-2">
                                                <span class="text-secondary">Grand Total</span>
                                            </div>
                                            <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                                                <span
                                                    class="fw-bold">{{ rupiah($subTotal - $member_diskon - $diskon_alquran) }}</span>
                                            </div>
                                        </div>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal Alamat --}}
    <div class="modal fade" id="modal-alamat" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Alamat Penerima</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-tambah-alamat">
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" for="no_telepon">
                                            Nama Penerima
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="nama_penerima" class="form-control"
                                            placeholder="Nama Penerima" />
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" for="no_telepon">
                                            Nomor Telepon Penerima
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="no_telp_penerima" class="form-control"
                                            placeholder="Nomor Telepon" />
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <!-- input -->
                                        <label class="form-label" for="alamat">Alamat <span
                                                class="text-danger">*</span></label>
                                        <textarea rows="3" id="alamat_penerima" name="alamat" class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <!-- input -->
                                        <label class="form-label" for="provinsi_penerima">Provinsi</label>
                                        <select name="provinsi" id="provinsi_penerima" class="form-select">
                                            <option value="">Pilih Provinsi</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <!-- input -->
                                        <label class="form-label" for="kota_penerima">Kota</label>
                                        <select name="kota" id="kota_penerima" class="form-select">
                                            <option value="">Pilih Kota</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <!-- input -->
                                        <label class="form-label" for="desa_penerima">Kecamatan</label>
                                        <select name="desa" id="desa_penerima" class="form-select">
                                            <option value="">Pilih Kecamatan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label" for="kode_pos">
                                            Kode Pos
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="kode_pos" class="form-control"
                                            placeholder="Kode Pos" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="modal-edit" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Pengguna</h5>
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
                                <input type="text" id="nama" name="nama" class="form-control"
                                    placeholder="Nama Lengkap" value="{{ $data[0]->user->name }}" />
                                <input type="hidden" name="id_user" value="{{ $data[0]->user->id }}" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="no_telepon">
                                    Nomor Telepon
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="hidden" name="email" value="{{ $data[0]->user->email }}">
                                <input type="text" id="no_telepon" name="no_telepon" class="form-control"
                                    placeholder="Nomor Telepon" value="{{ $data[0]->user->no_telp }}" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <!-- input -->
                                <label class="form-label" for="alamat">Alamat</label>
                                <textarea rows="3" id="alamat" name="alamat" class="form-control" placeholder="Nama Lengkap">{{ $data[0]->user->alamat }}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <!-- input -->
                                <label class="form-label" for="provinsi">Provinsi</label>
                                <select name="provinsi" id="provinsi" class="form-select">
                                    <option value="">Pilih Provinsi</option>
                                    <option value="{{ $data[0]->user->provinsi }}" selected>
                                        {{ $data[0]->user->province ? $data[0]->user->province->name : '' }}</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <!-- input -->
                                <label class="form-label" for="kota">Kota</label>
                                <select name="kota" id="kota" class="form-select">
                                    <option value="">Pilih Kota</option>
                                    <option value="{{ $data[0]->user->kota }}" selected>
                                        {{ $data[0]->user->city ? $data[0]->user->city->name : '' }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <!-- input -->
                                <label class="form-label" for="desa">Kecamatan</label>
                                <select name="desa" id="desa" class="form-select">
                                    <option value="">Pilih Kecamatan</option>
                                    <option value="{{ $data[0]->user->district ? $data[0]->user->district->id : '' }}"
                                        selected>
                                        {{ $data[0]->user->district ? $data[0]->user->district->name : '' }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <!-- input -->
                                <label class="form-label" for="kode_pos">Kode Pos</label>
                                <input type="text" id="kode_pos" name="kode_pos"
                                    value="{{ $data[0]->user->kode_pos ?? '' }}" class="form-control"
                                    placeholder="Kode Pos" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Bukti Transaksi -->
    <div class="modal fade" id="modal-bukti" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Pilih Pembayaran
                    </h5>
                </div>
                <div class="modal-body">

                    <div class="card text-start">
                        <div class="card-body">

                            <h6 class="mb-3">Transfer Bank (Verifikasi Manual)</h6>

                            <!-- nav -->
                            <ul class="nav nav-category" id="categoryCollapseMenu">
                                <li class="nav-item border-bottom w-100">
                                    <a href="#" class="nav-link collapsed py-3" data-bs-toggle="collapse"
                                        data-bs-target="#categoryFlushOne" aria-expanded="false"
                                        aria-controls="categoryFlushOne">
                                        <div>
                                            <img style="width: 40px" class="me-4"
                                                src="{{ asset('images/bank/logo_bri.png') }}" alt=""
                                                srcset="">
                                            Bank BRI
                                        </div>
                                        <i class="feather-icon icon-chevron-right"></i>
                                    </a>
                                    <!-- accordion collapse -->
                                    <div id="categoryFlushOne" class="accordion-collapse collapse"
                                        data-bs-parent="#categoryCollapseMenu">
                                        <div class="my-4">
                                            <form id="form-bri">
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">No.
                                                        Rekening</label>
                                                    <input type="text" class="form-control" name="no_rekening">
                                                    <input type="hidden" name="transfer_ke" value="BRI">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1" class="form-label">Nama
                                                        Pemilik</label>
                                                    <input type="text" class="form-control" name="nama_rekening">
                                                    <input type="hidden" name="id_order" class="id_order">
                                                </div>
                                                <div class="alert alert-warning" role="alert">
                                                    <ol class="ms-0 ps-0 ps-5">
                                                        <li>Masukkan Info terkait diatas sesuai pada buku tabungan</li>
                                                        <li>Untuk pembayaran melalui teller, isi <strong>"No
                                                                Rekening"</strong> dengan 0000 dan <strong>"Nama
                                                                Pemilik"</strong> dengan nama anda</li>
                                                    </ol>
                                                </div>
                                                <div class="mb-3 float-end">
                                                    <button type="submit" class="btn btn-primary btn-bayar">Bayar
                                                        Sekarang</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item border-bottom w-100">
                                    <a href="#" class="nav-link collapsed py-3" data-bs-toggle="collapse"
                                        data-bs-target="#categoryFlushTwo" aria-expanded="false"
                                        aria-controls="categoryFlushTwo">
                                        <div>
                                            <img style="width: 40px" class="me-4"
                                                src="{{ asset('images/bank/logo_bca.png') }}" alt=""
                                                srcset="">
                                            Bank BCA
                                        </div>
                                        <i class="feather-icon icon-chevron-right"></i>
                                    </a>
                                    <!-- accordion collapse -->
                                    <div id="categoryFlushTwo" class="accordion-collapse collapse"
                                        data-bs-parent="#categoryCollapseMenu">
                                        <div>
                                            <form id="form-bca">
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">No.
                                                        Rekening</label>
                                                    <input type="text" class="form-control" name="no_rekening">
                                                    <input type="hidden" name="transfer_ke" value="BCA">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1" class="form-label">Nama
                                                        Pemilik</label>
                                                    <input type="text" class="form-control" name="nama_rekening">
                                                    <input type="hidden" name="id_order" class="id_order">
                                                </div>
                                                <div class="alert alert-warning" role="alert">
                                                    <ol class="ms-0 ps-0 ps-5">
                                                        <li>Masukkan Info terkait diatas sesuai pada buku tabungan</li>
                                                        <li>Untuk pembayaran melalui teller, isi <strong>"No
                                                                Rekening"</strong> dengan 0000 dan <strong>"Nama
                                                                Pemilik"</strong> dengan nama anda</li>
                                                    </ol>
                                                </div>
                                                <div class="mb-3 float-end">
                                                    <button type="submit" class="btn btn-primary btn-bayar">Bayar
                                                        Sekarang</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item border-bottom w-100">
                                    <a href="#" class="nav-link collapsed py-3" data-bs-toggle="collapse"
                                        data-bs-target="#categoryFlushThree" aria-expanded="false"
                                        aria-controls="categoryFlushThree">
                                        <div>
                                            <img style="width: 40px" class="me-4"
                                                src="{{ asset('images/bank/logo_bsi.svg') }}" alt=""
                                                srcset="">
                                            Bank BSI
                                        </div>
                                        <i class="feather-icon icon-chevron-right"></i>
                                    </a>
                                    <!-- accordion collapse -->
                                    <div id="categoryFlushThree" class="accordion-collapse collapse"
                                        data-bs-parent="#categoryCollapseMenu">
                                        <div>
                                            <form id="form-bsi">
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">No.
                                                        Rekening</label>
                                                    <input type="text" class="form-control" name="no_rekening">
                                                    <input type="hidden" name="transfer_ke" value="BSI">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleInputPassword1" class="form-label">Nama
                                                        Pemilik</label>
                                                    <input type="text" class="form-control" name="nama_rekening">
                                                    <input type="hidden" name="id_order" class="id_order">
                                                </div>
                                                <div class="alert alert-warning" role="alert">
                                                    <ol class="ms-0 ps-0 ps-5">
                                                        <li>Masukkan Info terkait diatas sesuai pada buku tabungan</li>
                                                        <li>Untuk pembayaran melalui teller, isi <strong>"No
                                                                Rekening"</strong> dengan 0000 dan <strong>"Nama
                                                                Pemilik"</strong> dengan nama anda</li>
                                                    </ol>
                                                </div>
                                                <div class="mb-3 float-end">
                                                    <button type="submit" class="btn btn-primary btn-bayar">Bayar
                                                        Sekarang</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            // Modal
            if (`{{ $data[0]->user->alamat }}` == '') {
                $('#modal-edit').modal('show')
            }

            // Card Input Radio
            $('input:radio[name="alamat"]').change(function() {
                $('.card-input').removeClass("card-shadow")
                if ($(this).is(':checked')) {
                    $(this).parent().parent().addClass("card-shadow")
                }
            });

            // Init Select 2    
            $('#provinsi').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Provinsi --',
                dropdownParent: $("#modal-edit")
            });

            // Init Select 2    
            $('#desa').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Kecamatan --',
                dropdownParent: $("#modal-edit")
            });

            // Select Provinsi
            $.ajax({
                url: "{{ route('user.profile.provinsi') }}",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(response) {
                    $.each(response.data, function(index, value) {
                        $("#provinsi").append(
                            `<option value="${value['id']}">${value['name']}</option>`);
                    });
                },
            });

            // Init Select 2
            $('#kota').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Kota --',
                dropdownParent: $("#modal-edit")
            });

            // Select Kota
            var kota = "{{ route('user.profile.kota', ':id') }}";
            kota = kota.replace(':id', `{{ $data[0]->user->provinsi }}`);

            $.ajax({
                url: kota,
                dataType: "JSON",
                delay: 250,
                success: function(data) {
                    $.each(data.data, function(index, value) {
                        $("#kota").append(
                            `<option value="${value['id']}"> ${value['name']} </option>`)
                    });
                }
            });

            // Select Kota
            $('#provinsi').on('select2:select', function(e) {
                var id = e.params.data.id;

                var link = "{{ route('user.profile.kota', ':id') }}";
                link = link.replace(':id', id);

                $.ajax({
                    url: link,
                    data: $(this).serialize(),
                    dataType: "JSON",
                    delay: 250,
                    beforeSend: function() {
                        $('#kota').attr('disabled', 'disabled');
                        $('#kota').empty().append(
                            '<option value="" selected disabled>-- Pilih Kota/Kabupaten --</option>'
                        );

                        $('#desa').attr('disabled', 'disabled');
                        $('#desa').empty().append(
                            '<option value="" selected disabled>-- Pilih Desa/Kelurahan --</option>'
                        );
                    },
                    success: function(data) {
                        $.each(data.data, function(index, value) {
                            $("#kota").append("<option value='" + value['id'] + "'>" +
                                value['name'] + "</option>");
                        });
                        $('#kota').removeAttr('disabled');
                    },
                    error: function() {
                        $('#kota').removeAttr('disabled');
                    }
                });
            })

            // Select Desa
            $('#kota').on('select2:select', function(e) {
                var id = e.params.data.id;

                var link = "{{ route('user.profile.desa', ':id') }}";
                link = link.replace(':id', id);

                $.ajax({
                    url: link,
                    data: $(this).serialize(),
                    dataType: "JSON",
                    delay: 250,
                    beforeSend: function() {
                        $('#desa').attr('disabled', 'disabled');
                        $('#desa').empty().append(
                            '<option value="" selected disabled>-- Pilih Desa/Kelurahan --</option>'
                        );
                    },
                    success: function(data) {
                        $.each(data.data, function(index, value) {
                            $("#desa").append("<option value='" + value['id'] + "'>" +
                                value['name'] + "</option>");
                        });
                        $('#desa').removeAttr('disabled');
                    },
                    error: function() {
                        $('#desa').removeAttr('disabled');
                    }
                });
            })

            // Card Input Radio
            $('#daftar_paket').on('input:radio[name="kurir"]').change(function() {
                $(this).siblings(":last").children().children().removeClass('disabled')
                $(this).find('.card-input').removeClass('card-shadow');
                $(this).find('input:radio[name="kurir"]:checked').parent().parent().addClass(
                    'card-shadow');
            });

            // Select Provinsi Dropship
            $.ajax({
                url: "{{ route('user.profile.provinsi') }}",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(response) {
                    $.each(response.data, function(index, value) {
                        $("#provinsi_penerima").append(
                            `<option value="${value['id']}">${value['name']}</option>`);
                    });
                },
            });

            // Init Select 2 Dropship  
            $('#provinsi_penerima').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Provinsi --',
                dropdownPosition: 'below',
                dropdownParent: $("#modal-alamat")
            });

            // Init Select 2 Dropship
            $('#desa_penerima').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Kecamatan --',
                dropdownPosition: 'below',
                dropdownParent: $("#modal-alamat")
            });

            // Init Select 2 Dropship
            $('#kota_penerima').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Kota --',
                dropdownPosition: 'below',
                dropdownParent: $("#modal-alamat")
            });

            // Select Kota Dropship
            $('#provinsi_penerima').on('select2:select', function(e) {
                var id = e.params.data.id;

                var link = "{{ route('user.profile.kota', ':id') }}";
                link = link.replace(':id', id);

                $.ajax({
                    url: link,
                    data: $(this).serialize(),
                    dataType: "JSON",
                    delay: 250,
                    beforeSend: function() {
                        $('#kota_penerima').attr('disabled', 'disabled');
                        $('#kota_penerima').empty().append(
                            '<option value="" selected disabled>-- Pilih Kota/Kabupaten --</option>'
                        );

                        $('#desa_penerima').attr('disabled', 'disabled');
                        $('#desa_penerima').empty().append(
                            '<option value="" selected disabled>-- Pilih Desa/Kelurahan --</option>'
                        );
                    },
                    success: function(data) {
                        $.each(data.data, function(index, value) {
                            $("#kota_penerima").append("<option value='" + value['id'] +
                                "'>" +
                                value['name'] + "</option>");
                        });
                        $('#kota_penerima').removeAttr('disabled');
                    },
                    error: function() {
                        $('#kota_penerima').removeAttr('disabled');
                    }
                });
            })

            // Select Desa Dropship
            $('#kota_penerima').on('select2:select', function(e) {
                var id = e.params.data.id;

                var link = "{{ route('user.profile.desa', ':id') }}";
                link = link.replace(':id', id);

                $.ajax({
                    url: link,
                    data: $(this).serialize(),
                    dataType: "JSON",
                    delay: 250,
                    beforeSend: function() {
                        $('#desa_penerima').attr('disabled', 'disabled');
                        $('#desa_penerima').empty().append(
                            '<option value="" selected disabled>-- Pilih Desa/Kelurahan --</option>'
                        );
                    },
                    success: function(data) {
                        $.each(data.data, function(index, value) {
                            $("#desa_penerima").append("<option value='" + value['id'] +
                                "'>" +
                                value['name'] + "</option>");
                        });
                        $('#desa_penerima').removeAttr('disabled');
                    },
                    error: function() {
                        $('#desa_penerima').removeAttr('disabled');
                    }
                });
            })

            // Tambah Alamat
            $('.btn-tambah-alamat').click(function(e) {
                e.preventDefault();
                $('#modal-alamat').modal('show');
            });

            // Store Alamat
            $('#form-tambah-alamat').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.order.store_alamat') }}",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        location.reload()
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay('hide');
                    },
                });

            });

            // dropship
            $('#dropship').change(function(e) {
                e.preventDefault();
                $('#card_dropship').empty()
                if ($(this).is(':checked')) {
                    $('#card_dropship').append(`<div class="card">
                                                        <div class="card-header">
                                                            <span class="fw-bold"><i class="fa-solid fa-xmark me-2"></i>
                                                                Dropship</span>
                                                        </div>
                                                        <div class="card-body">
                                                            <p style="font-size: 13px">Kirim pesanan dengan namamu sebagai
                                                                pelapak</p>
    
                                                            <div class="mb-3">
                                                                <label for="nama_pengirim" class="form-label"
                                                                    style="font-size: 13px">Nama
                                                                    Pengirim</label>
                                                                <input type="hidden" name="id_dropship" id="id_dropship"
                                                                    value="{{ $dropship ? $dropship->id : '' }}" />
                                                                <input type="text" class="form-control" value="{{ $dropship ? $dropship->nama_pengirim : '' }}" id="nama_pengirim">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="tambahan" class="form-label"
                                                                    style="font-size: 13px">Info Tambahan (No. Handphone
                                                                    Aktif)</label>
                                                                <input type="text" class="form-control" value="{{ $dropship ? $dropship->no_telp_pengirim : '' }}" id="tambahan">
                                                            </div>
    
                                                            <input style="cursor: pointer;" class="form-check-input me-2 mb-3"
                                                                id="simpan_dropship" type="checkbox"><label class="fw-bold"
                                                                style="cursor: pointer;" for="simpan_dropship">Simpan dropshiper
                                                            </label>
    
                                                            <p class="text-secondary" style="font-size: 12px">
                                                                Menyimpan data dropshipper akan mempermudah anda
                                                                untuk pengisian pesanan yang akan datang.
                                                            </p>
    
                                                        </div>
                                                    </div>`)
                }
            });

            // Get Paket Pengiriman
            $('#jasa_pengiriman').change(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "GET",
                    url: "{{ route('user.order.ongkir') }}",
                    data: {
                        city_destination: $("input[name=alamat]").val(),
                        courier: $('#jasa_pengiriman').val(),
                        weight: "{{ $beratProduk }}"
                    },
                    beforeSend: function() {

                        $('#pilih_paket').empty()
                        $("#daftar_paket").empty()

                        $('#daftar_paket').on('input:radio[name="kurir"]').siblings(":last")
                            .children().children().siblings(":first").addClass('disabled')

                        $("#loading").append(
                            `<div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>`);
                    },
                    dataType: "JSON",
                    success: function(response) {

                        $('#loading').empty()

                        $.each(response.data[0].costs, function(index, value) {

                            let ongkos = 'Rp. ' + Intl.NumberFormat('en-DE').format(
                                `${value['cost'][0].value}`)

                            $("#daftar_paket").append(`
                                <div class="col-lg-6">
                                    <label class="d-block">
                                        <div class="card card-body card-input">
                                                <h6 class="card-title">
                                                    <input class="form-check-input mt-0 me-2" type="radio"
                                                        name="kurir" id="homeRadio" value="${value['cost'][0].value}" />
                                                            <span class="form-check-label" for="homeRadio">${value['service']}</span>
                                                </h6>
                                                <p class="card-text">
                                                    <ul>
                                                        <li>Ongkos Kirim : <span class="fw-bold">${ongkos}</span></li>
                                                        <li id="deskripsi">Deskripsi : (${value['service']}) ${value['description']}</li>
                                                        <li>Est. : ${value['cost'][0].etd} hari</li>
                                                    </ul>
                                                </p>
                                        </div>
                                    </label>
                                </div>
                            `)
                        });
                    }
                });
            });

            // Edit Alamat
            $('.btn-edit-alamat').click(function(e) {
                e.preventDefault()

                $('#modal-edit').modal('show')
            })

            // Update Data
            $('#form-edit').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.profile.store') }}",
                    data: $(this).serialize(),
                    dataType: "JSON",
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
                                location.reload()
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay('hide');
                        console.log(xhr);
                        switch (xhr.status) {
                            case 422:
                                $.each(xhr.responseJSON.data, function(index, value) {
                                    $('input[name="' + index + '"]').addClass(
                                        "is-invalid")
                                    $('textarea[name="' + index + '"]').addClass(
                                        "is-invalid")
                                    $('select[name="' + index + '"]').addClass(
                                        "is-invalid")
                                });
                                Swal.fire('Data Gagal Disimpan!',
                                    'Periksa Kembali data anda',
                                    'error');
                                break;
                            default:
                                Swal.fire('Data Gagal Disimpan!',
                                    'Kesalahan Server',
                                    'error');
                                break;
                        }
                    },
                });

            });

            // Dropship
            $("#card_dropship").on('#simpan_dropship').change(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "PUT",
                    url: "{{ route('user.order.edit_dropship') }}",
                    data: {
                        id_dropship: $('#id_dropship').val(),
                        nama_pengirim: $('#nama_pengirim').val(),
                        no_telp_pengirim: $('#tambahan').val(),
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        $("#card_dropship").on('#simpan_dropship').prop('checked', true)
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay('hide');
                        console.log(xhr);
                        switch (xhr.status) {
                            case 422:
                                $.each(xhr.responseJSON.data, function(index, value) {
                                    $('input[name="' + index + '"]').addClass(
                                        "is-invalid")
                                    $('textarea[name="' + index + '"]').addClass(
                                        "is-invalid")
                                    $('select[name="' + index + '"]').addClass(
                                        "is-invalid")
                                });
                                Swal.fire('Data Gagal Disimpan!',
                                    'Periksa Kembali data anda',
                                    'error');
                                break;
                            default:
                                Swal.fire('Data Gagal Disimpan!',
                                    'xhr.responseJSON.meta.message',
                                    'error');
                                break;
                        }
                    },
                });

            });

            const js = {{ Js::from($data) }}

            // Pesan
            $('#pesan').click(function(e) {
                e.preventDefault();

                var dropship = 0

                if ($('#dropship:checkbox:checked').length > 0) {
                    dropship = 1
                } else {
                    dropship = 0
                }

                let kurir_detail = $('#daftar_paket').find('input:radio[name="kurir"]:checked').parent()
                    .parent().find('#deskripsi').text()
                let biaya_pengiriman = $('#daftar_paket').find('input:radio[name="kurir"]:checked').val()
                let destination = $('input:radio[name="alamat"]:checked').val()

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.order.store_manual') }}",
                    data: {
                        user: "{{ Auth::user()->id }}",
                        courier: $('#jasa_pengiriman').val(),
                        courier_detail: kurir_detail,
                        biaya_pengiriman: biaya_pengiriman,
                        origin: "{{ config('rajaongkir.origin') }}",
                        destination: destination,
                        catatan: $('#catatan').val(),
                        status_dropship: dropship,
                        data: js,
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');

                        $('#modal-bukti').modal('show')
                        $('#modal-bukti .id_order').val(response.data.id)
                    },
                    error: function(response) {
                        $.LoadingOverlay('hide');
                        if (response.responseJSON) {
                            Swal.fire('Gagal!', response.responseJSON.data, 'error');
                        } else {
                            Swal.fire('Gagal!', 'Periksa kembali data anda', 'error');
                        }
                    },
                });
            });

            // Submit Simpan
            $('#form-bri').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.order.addBukti') }}",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        if (response.meta.status == "success") {

                            let a = "{{ route('user.order.detail_konfirmasi', ':id') }}"
                            let b = a.replace(':id', $('#modal-bukti .id_order').val())

                            Swal.fire({
                                icon: 'success',
                                title: "Sukses!",
                                text: response.meta.message,
                            }).then((result) => {
                                location.href = b
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Gagal!', 'Periksa kembali data anda.', 'error');
                        switch (xhr.status) {
                            case 422:
                                $.each(xhr.responseJSON.data, function(index, value) {
                                    $('input[name="' + index + '"]').addClass(
                                        "is-invalid")
                                });
                                break;
                            default:
                                Swal.fire('Data Gagal Disimpan!',
                                    'Periksa kembali data anda',
                                    'error');
                                break;
                        }
                        console.log(response.responseJSON);
                    },
                });
            });

            // Submit Simpan
            $('#form-bca').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.order.addBukti') }}",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        if (response.meta.status == "success") {

                            let a = "{{ route('user.order.detail_konfirmasi', ':id') }}"
                            let b = a.replace(':id', $('#modal-bukti .id_order').val())

                            Swal.fire({
                                icon: 'success',
                                title: "Sukses!",
                                text: response.meta.message,
                            }).then((result) => {
                                location.href = b
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Gagal!', 'Periksa kembali data anda.', 'error');
                        switch (xhr.status) {
                            case 422:
                                $.each(xhr.responseJSON.data, function(index, value) {
                                    $('input[name="' + index + '"]').addClass(
                                        "is-invalid")
                                });
                                break;
                            default:
                                Swal.fire('Data Gagal Disimpan!',
                                    'Periksa kembali data anda',
                                    'error');
                                break;
                        }
                        console.log(response.responseJSON);
                    },
                });
            });
            
            // Submit Simpan
            $('#form-bsi').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.order.addBukti') }}",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        if (response.meta.status == "success") {

                            let a = "{{ route('user.order.detail_konfirmasi', ':id') }}"
                            let b = a.replace(':id', $('#modal-bukti .id_order').val())

                            Swal.fire({
                                icon: 'success',
                                title: "Sukses!",
                                text: response.meta.message,
                            }).then((result) => {
                                location.href = b
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Gagal!', 'Periksa kembali data anda.', 'error');
                        switch (xhr.status) {
                            case 422:
                                $.each(xhr.responseJSON.data, function(index, value) {
                                    $('input[name="' + index + '"]').addClass(
                                        "is-invalid")
                                });
                                break;
                            default:
                                Swal.fire('Data Gagal Disimpan!',
                                    'Periksa kembali data anda',
                                    'error');
                                break;
                        }
                        console.log(response.responseJSON);
                    },
                });
            });

            
        });
    </script>
@endsection
