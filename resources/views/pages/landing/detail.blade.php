@extends('layouts.landing.main')

@section('content')
    {{-- Breadcrumbs --}}
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
                            <li class="breadcrumb-item"><a
                                    href="{{ route('landing.kategori', $produk->kategori->slug) }}">{{ $produk->kategori->nama_kategori }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $produk->nama_produk }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{-- Konten --}}
    <section class="mt-8">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="slider slider-for">
                        @foreach ($produk->gambar_produk as $g)
                            <div>
                                <div class="zoom" onmousemove="zoom(event)"
                                    style="background-image: url({{ asset('storage/produk/' . $g->gambar) }})">
                                    <!-- img -->
                                    <!-- img -->
                                    <img src="{{ asset('storage/produk/' . $g->gambar) }}" alt="" />
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="slider slider-nav mt-4">
                        @forelse ($produk->gambar_produk as $g)
                            <div>
                                <img src="{{ asset('storage/produk/' . $g->gambar) }}" alt=""
                                    class="w-100 rounded" />
                            </div>
                        @empty
                            <div>
                                <img src="{{ asset('images/avatar/no-image.png') }}" alt="" class="w-100 rounded" />
                            </div>
                        @endforelse
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="ps-lg-10 mt-6 mt-md-0">
                        <!-- content -->
                        <a href="#!" class="mb-4 d-block">{{ $produk->kategori->nama_kategori }}</a>
                        <!-- heading -->
                        <h1 class="mb-1">{{ $produk->nama_produk }}</h1>
                        <input type="hidden" id="id_produk" value="{{ $produk->id }}">
                        @auth
                            <input type="hidden" id="id_user" value="{{ Auth::user()->id }}">
                        @endauth
                        <div class="mb-4">
                            <!-- rating -->
                            <!-- rating -->
                            <small class="text-warning">
                                @if (round($produk->averageRating()) > 0)
                                    {{ tampilkanRating($produk->averageRating()) }}
                                @endif
                            </small>
                            @if (round($produk->averageRating()) > 0)
                                <span class="text-primary small">({{ $produk->ratings()->count() }} reviews)</span>
                            @endif
                        </div>
                        @if ($produk->harga->mulai_diskon <= now() && $produk->harga->diskon > 0)
                            <span class="badge bg-danger rounded-pill mb-3"
                                style="font-size: 12px">{{ '-' . diskon($produk->harga) . '%' }}</span>
                        @endif
                        <div class="fs-4">

                            <!-- price -->
                            <span class="fw-bold text-dark">{{ rupiah($produk->harga->harga_akhir) }}</span>
                            @if ($produk->harga->mulai_diskon <= now() && $produk->harga->diskon > 0)
                                <span
                                    class="text-decoration-line-through text-muted">{{ rupiah($produk->harga->harga_awal) }}</span>
                            @endif
                        </div>
                        <!-- hr -->
                        <hr class="my-6" />
                        @auth
                            <div>
                                <!-- input -->
                                <div class="input-group input-spinner">
                                    <input type="button" value="-" class="button-minus btn btn-sm"
                                        data-field="quantity" />
                                    <input type="number" step="1" max="10" value="1" id="jumlah"
                                        name="quantity" class="quantity-field form-control-sm form-input"
                                        style="width: 5rem!important; min-height: 2.25rem!important" />
                                    <input type="button" value="+" class="button-plus btn btn-sm" data-field="quantity" />
                                </div>
                            </div>
                            <div class="mt-3 row justify-content-start g-2 align-items-center">
                                <div class="col-xxl-4 col-lg-4 col-md-6 col-5 d-grid">
                                    <!-- button -->
                                    <!-- btn -->
                                    <button type="button" class="btn btn-outline-primary" id="btn-keranjang"
                                        style="font-size: 12px">
                                        <i class="feather-icon icon-shopping-bag me-2"></i>
                                        Masukkan Keranjang
                                    </button>
                                </div>
                                <div class="col-md-4 col-4">
                                    <!-- btn -->
                                    <button id="btn-beli" class="btn btn-primary" style="font-size: 12px">Beli
                                        Sekarang</button>
                                </div>
                            </div>
                            @if ($produk->catatan)
                                <div class="mt-3">
                                    <h6><span class="text-danger">*</span> Catatan Pembelian</h6>
                                    <p>{{ $produk->catatan }}</p>
                                </div>
                            @endif
                        @endauth

                        @guest
                            <a href="{{ route('login') }}" class="btn btn-primary w-100"><i
                                    class="fa-solid fa-right-to-bracket me-2"></i> Login</a>

                        @endguest
                        <!-- hr -->
                        <hr class="my-6" />
                        <div>
                            <!-- table -->
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td>ISBN:</td>
                                        <td>{{ $produk->isbn }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status Buku:</td>
                                        @if ($produk->stok->sisa_produk >= 1)
                                            <td>Buku Tersedia</td>
                                        @else
                                            <td>Buku Tidak Tersedia</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Penerbit:</td>
                                        <td>{{ $produk->id_penerbit != null ? $produk->penerbit->nama_penerbit : '-' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Kategori:</td>
                                        <td>{{ $produk->kategori->nama_kategori ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Penulis:</td>
                                        <td>{{ $produk->pengarang ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Cover:</td>
                                        <td>{{ $produk->jenis_cover ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Isi:</td>
                                        <td>{{ $produk->jenis_isi ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Bahasa:</td>
                                        <td>{{ $produk->bahasa->bahasa ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Ukuran:</td>
                                        <td>{{ $produk->ukuran_produk ?? '-' }} <span class="text-muted">cm</span></td>
                                    </tr>
                                    <tr>
                                        <td>Berat:</td>
                                        <td>{{ $produk->berat_produk ?? '-' }} <span class="text-muted">gr</span></td>
                                    </tr>
                                    <tr>
                                        <td>Halaman:</td>
                                        <td>
                                            {{ $produk->halaman_produk }}
                                            <span class="text-muted">Halaman</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Stok:</td>
                                        <td>{{ $produk->stok->sisa_produk ?? '-' }} <span class="text-muted">Pcs</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-8">
                            <!-- dropdown -->
                            <div class="dropdown">
                                <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">Share</a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ 'https://www.facebook.com/sharer/sharer.php?u=' . Request::url() }}"
                                            target="_blank" rel="noopener noreferrer">
                                            <i class="bi bi-facebook me-2"></i>
                                            Facebook
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ 'https://twitter.com/intent/tweet?url=' . Request::url() }}"
                                            target="_blank" rel="noopener noreferrer">
                                            <i class="bi bi-twitter me-2"></i>
                                            Twitter
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ 'https://api.whatsapp.com/send?text=Dapatkan Buku ' . $produk->nama_produk . ' Dapatkan sekarang juga ' . Request::url() }}"
                                            target="_blank" rel="noopener noreferrer">
                                            <i class="bi bi-whatsapp me-2"></i>
                                            Whatsapp
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Produk Information --}}
    <section class="mt-lg-14 mt-8">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills nav-lb-tab" id="myTab" role="tablist">
                        <!-- nav item -->
                        <li class="nav-item" role="presentation">
                            <!-- btn -->
                            <button class="nav-link active" id="product-tab" data-bs-toggle="tab"
                                data-bs-target="#product-tab-pane" type="button" role="tab"
                                aria-controls="product-tab-pane" aria-selected="true">
                                Deskripsi Buku
                            </button>
                        </li>
                        <!-- nav item -->
                        <li class="nav-item" role="presentation">
                            <!-- btn -->
                            <button class="nav-link" id="ulasan" data-bs-toggle="tab" data-bs-target="#ulasan-pane"
                                type="button" role="tab" aria-controls="ulasan-pane" aria-selected="true">
                                Ulasan
                            </button>
                        </li>
                    </ul>
                    <!-- tab content -->
                    <div class="tab-content" id="myTabContent">
                        <!-- tab pane -->
                        <div class="tab-pane fade show active" id="product-tab-pane" role="tabpanel"
                            aria-labelledby="product-tab" tabindex="0">
                            <div class="my-8">
                                <div class="mb-5">
                                    <!-- text -->
                                    {!! $produk->keterangan !!}
                                </div>
                            </div>
                        </div>

                        <!-- tab pane -->
                        <div class="tab-pane fade" id="ulasan-pane" role="tabpanel" aria-labelledby="ulasan"
                            tabindex="0">
                            <div class="my-8">
                                <div class="mb-5">
                                    <!-- text -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="me-lg-12 mb-6 mb-md-0">
                                                <div class="mb-5">
                                                    <!-- title -->
                                                    <h4 class="mb-3">Ulasan Pelanggan</h4>
                                                    <span>
                                                        <!-- rating -->
                                                        @if (round($produk->averageRating()) > 0)
                                                            <small class="text-warning">
                                                                {{ tampilkanRating($produk->averageRating()) }}
                                                            </small>
                                                        @else
                                                            <small class="text-secondary">
                                                                <i class="bi bi-star"></i>
                                                                <i class="bi bi-star"></i>
                                                                <i class="bi bi-star"></i>
                                                                <i class="bi bi-star"></i>
                                                                <i class="bi bi-star"></i>
                                                            </small>
                                                        @endif

                                                        <span class="ms-3">{{ round($produk->averageRating(), 2) }} out
                                                            of
                                                            5</span>
                                                    </span>
                                                </div>
                                                <div class="mb-8">
                                                    <!-- progress -->
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="text-nowrap me-3 text-muted">
                                                            <span class="d-inline-block align-middle text-muted">5</span>
                                                            <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                        </div>
                                                        <div class="w-100">
                                                            <div class="progress" style="height: 6px">
                                                                <div class="progress-bar bg-warning" role="progressbar"
                                                                    style="width: {{ $rate[5] ? ($rate[5] / $produk->ratings()->count()) * 100 : 0 }}%"
                                                                    aria-valuenow="60" aria-valuemin="0"
                                                                    aria-valuemax="100"></div>
                                                            </div>
                                                        </div>
                                                        <span class="text-muted ms-3">{{ $rate[5] }}</span>
                                                    </div>
                                                    <!-- progress -->
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="text-nowrap me-3 text-muted">
                                                            <span class="d-inline-block align-middle text-muted">4</span>
                                                            <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                        </div>
                                                        <div class="w-100">
                                                            <div class="progress" style="height: 6px">
                                                                <div class="progress-bar bg-warning" role="progressbar"
                                                                    style="width: {{ $rate[4] ? ($rate[4] / $produk->ratings()->count()) * 100 : 0 }}%"
                                                                    aria-valuenow="50" aria-valuemin="0"
                                                                    aria-valuemax="50"></div>
                                                            </div>
                                                        </div>
                                                        <span class="text-muted ms-3">{{ $rate[4] }}</span>
                                                    </div>
                                                    <!-- progress -->
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="text-nowrap me-3 text-muted">
                                                            <span class="d-inline-block align-middle text-muted">3</span>
                                                            <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                        </div>
                                                        <div class="w-100">
                                                            <div class="progress" style="height: 6px">
                                                                <div class="progress-bar bg-warning" role="progressbar"
                                                                    style="width: {{ $rate[3] ? ($rate[3] / $produk->ratings()->count()) * 100 : 0 }}%"
                                                                    aria-valuenow="35" aria-valuemin="0"
                                                                    aria-valuemax="35"></div>
                                                            </div>
                                                        </div>
                                                        <span class="text-muted ms-3">{{ $rate[3] }}</span>
                                                    </div>
                                                    <!-- progress -->
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="text-nowrap me-3 text-muted">
                                                            <span class="d-inline-block align-middle text-muted">2</span>
                                                            <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                        </div>
                                                        <div class="w-100">
                                                            <div class="progress" style="height: 6px">
                                                                <div class="progress-bar bg-warning" role="progressbar"
                                                                    style="width: {{ $rate[2] ? ($rate[2] / $produk->ratings()->count()) * 100 : 0 }}%"
                                                                    aria-valuenow="22" aria-valuemin="0"
                                                                    aria-valuemax="22"></div>
                                                            </div>
                                                        </div>
                                                        <span class="text-muted ms-3">{{ $rate[2] }}</span>
                                                    </div>
                                                    <!-- progress -->
                                                    <div class="d-flex align-items-center mb-2">
                                                        <div class="text-nowrap me-3 text-muted">
                                                            <span class="d-inline-block align-middle text-muted">1</span>
                                                            <i class="bi bi-star-fill ms-1 small text-warning"></i>
                                                        </div>
                                                        <div class="w-100">
                                                            <div class="progress" style="height: 6px">
                                                                <div class="progress-bar bg-warning" role="progressbar"
                                                                    style="width: {{ $rate[1] ? ($rate[1] / $produk->ratings()->count()) * 100 : 0 }}%"
                                                                    aria-valuenow="14" aria-valuemin="0"
                                                                    aria-valuemax="14"></div>
                                                            </div>
                                                        </div>
                                                        <span class="text-muted ms-3">{{ $rate[1] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- col -->
                                        <div class="col-md-8">
                                            <div class="mb-10">
                                                <div class="d-flex justify-content-between align-items-center mb-8">
                                                    <div>
                                                        <!-- heading -->
                                                        <h4>Reviews</h4>
                                                    </div>
                                                </div>
                                                @forelse ($ulasan_perorang as $i)
                                                    <div class="d-flex border-bottom pb-6 mb-6">
                                                        <!-- img -->
                                                        <!-- img -->
                                                        @if ($i->user->avatar == null)
                                                            @if ($i->user->id_member && $i->user->member)
                                                                <img src="{{ asset('images/avatar/user.png') }}"
                                                                    alt=""
                                                                    class="avatar avatar-md rounded-circle border border-4 rounded-circle border-{{ Str::lower($i->user->member->nama) }}">
                                                            @else
                                                                <img src="{{ asset('images/avatar/user.png') }}"
                                                                    alt=""
                                                                    class="avatar avatar-md rounded-circle">
                                                            @endif
                                                        @else
                                                            @if ($i->user->id_member && $i->user->member)
                                                                <img src="{{ $i->user->avatar }}" alt=""
                                                                    class="avatar avatar-md rounded-circle border border-4 
                                                                        rounded-circle border-{{ Str::lower($i->user->member->nama) }}">
                                                            @else
                                                                <img src="{{ $i->user->avatar }}" alt=""
                                                                    class="avatar avatar-md rounded-circle">
                                                            @endif
                                                        @endif

                                                        <div class="ms-5 w-100">
                                                            <h6 class="mb-1">{{ $i->user->name }}</h6>
                                                            <!-- select option -->
                                                            <!-- content -->
                                                            <p class="small">
                                                                <span
                                                                    class="text-muted">{{ \Carbon\Carbon::parse($i->created_at)->isoFormat('D MMMM Y') }}</span>
                                                            </p>
                                                            <!-- rating -->
                                                            <div class="mb-2 text-warning">
                                                                {{ tampilkanRating($i->rating) }}
                                                            </div>
                                                            <!-- text-->
                                                            <p>
                                                                {{ $i->comment }}
                                                            </p>
                                                            <!-- icon -->
                                                            <div class="d-flex justify-content-end mt-4">
                                                                <a href="#" class="text-muted">
                                                                    <i class="feather-icon icon-thumbs-up me-1"></i>
                                                                    Helpful
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div>
                                                        Ulasan Belum tersedia
                                                    </div>
                                                @endforelse
                                                <div>
                                                    {{-- @if (count($ulasan_perorang) > 0)
                                                        <a href="#" class="btn btn-outline-gray-400 text-muted">Read
                                                            More Reviews</a>
                                                    @endif --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Items -->
    <section class="my-lg-14 my-14">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <!-- heading -->
                    <h3>Produk Terkait</h3>
                </div>
            </div>
            <!-- row -->
            <div class="row g-4 row-cols-lg-5 row-cols-sm-12 row-cols-md-2 mt-2">
                <!-- col -->
                @foreach ($produk_related as $p)
                    <div class="col">
                        <div class="card card-product" style="min-height: 405px">
                            <div class="card-body">
                                <!-- badge -->

                                <div class="text-center position-relative">
                                    <a href="{{ route('landing.detail', $p->id) }}">
                                        @if ($p->gambar_produk->count() > 0)
                                            <img src="{{ asset('storage/produk/' . $p->gambar_produk[0]->gambar) }}"
                                                alt="{{ $p->nama_produk }}" style="max-height: 210px; max-width: 210px;"
                                                class="mb-3 img-fluid" />
                                        @else
                                            <img src="{{ asset('images/avatar/no-image.png') }}"
                                                alt="{{ $p->nama_produk }}" style="max-height: 210px; max-width: 210px;"
                                                class="mb-3 img-fluid" />
                                        @endif
                                    </a>

                                </div>
                                <!-- heading -->
                                <div class="text-small mb-1">
                                    <a href="{{ route('landing.detail', $p->id) }}"
                                        class="text-decoration-none text-muted"><small>{{ $p->kategori->nama_kategori }}</small></a>
                                </div>
                                @if ($p->harga->mulai_diskon <= now() && $p->harga->diskon > 0)
                                    <span
                                        class="badge bg-danger rounded-pill mb-1">{{ '-' . diskon($p->harga) . '%' }}</span>
                                @endif

                                <h2 class="fs-6"><a href="{{ route('landing.detail', $p->id) }}"
                                        class="text-inherit text-decoration-none">{{ $p->nama_produk }}</a></h2>
                                <div>
                                    <!-- rating -->
                                    <small class="text-warning">
                                        @if (round($p->averageRating()) > 0)
                                            {{ tampilkanRating(round($p->averageRating(), 2)) }}
                                        @endif
                                    </small>
                                    <span class="text-muted small">
                                        @if (round($p->averageRating()) > 0)
                                            {{ round($p->averageRating(), 2) }}({{ $p->ratings()->count() }})
                                        @endif
                                    </span>
                                </div>
                                <!-- price -->
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div>
                                        <span class="text-dark">{{ rupiah($p->harga->harga_akhir) }}</span>
                                        @if ($p->harga->mulai_diskon <= now() && $p->harga->diskon > 0)
                                            <span
                                                class="text-decoration-line-through text-muted">{{ rupiah($p->harga->harga_awal) }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Modal title
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

    <!-- Optional: Place to the bottom of scripts -->
    <script>
        const myModal = new bootstrap.Modal(
            document.getElementById("modalId"),
            options,
        );
    </script>

@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $('#btn-keranjang').click(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.keranjang.store') }}",
                    data: {
                        id_user: $('#id_user').val(),
                        id_produk: $('#id_produk').val(),
                        jumlah: $('#jumlah').val(),
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        if (response.meta.status == "success") {
                            location.href = "{{ route('user.keranjang.index') }}";
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Data Gagal Disimpan!',
                            'Kesalahan Server',
                            'error');
                    }
                });

            });

            $('#btn-beli').click(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.order.beli') }}",
                    data: {
                        id_user: $('#id_user').val(),
                        id_produk: $('#id_produk').val(),
                        jumlah: $('#jumlah').val(),
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        if (response.meta.status == "success") {
                            location.href = "{{ route('user.order.index') }}";
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Data Gagal Disimpan!',
                            'Kesalahan Server',
                            'error');
                    }
                });

            });

        });
    </script>
@endsection
