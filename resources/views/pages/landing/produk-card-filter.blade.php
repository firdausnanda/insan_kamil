<!-- row -->
<div class="row g-4 row-cols-xl-4 row-cols-lg-3 row-cols-md-2 row-cols-2 mt-2">
    @foreach ($produks as $p)
        <!-- col -->
        <div class="col">
            <!-- card -->
            <div class="card card-product">
                <div class="card-body" style="min-height: 405px">
                    <!-- badge -->
                    <a href="{{ route('landing.detail', $p->id) }}">
                        <div class="text-center position-relative">
                            <!-- img -->
                            @if ($p->gambar_produk->count() > 0)
                                <img src="{{ asset('storage/produk/' . $p->gambar_produk[0]->gambar) }}"
                                    alt="{{ $p->nama_produk }}" class="mb-3 img-fluid"
                                    style="max-height: 193px; width: auto;">
                            @else
                                <img src="{{ asset('images/avatar/no-image.png') }}" alt="{{ $p->nama_produk }}"
                                    class="mb-3 img-fluid" style="max-height: 193px; width: auto;">
                            @endif
                        </div>
                    </a>
                    <!-- heading -->
                    <div class="text-small mb-1">
                        <a href="#!"
                            class="text-decoration-none text-muted"><small>{{ $p->kategori->nama_kategori }}</small></a>
                    </div>
                    <h2 class="fs-6"><a href="{{ route('landing.detail', $p->id) }}"
                            class="text-inherit text-decoration-none">{{ $p->nama_produk }}</a></h2>

                    @if ($p->harga->mulai_diskon <= now() && $p->harga->diskon > 0)
                        <span class="badge bg-danger rounded-pill mb-1">{{ '-' . diskon($p->harga) . '%' }}</span>
                    @endif

                    <span>
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
                    </span>
                    @if (round($p->averageRating()) > 0 and $p->produk_dikirim->whereNotNull('order_dibayar')->count() > 0)
                        <span class="text-secondary">
                            |
                        </span>
                    @endif
                    @if ($p->produk_dikirim->whereNotNull('order_dibayar')->count() > 0)
                        <small class="text-secondary">
                            Terjual
                            {{ $p->produk_dikirim->whereNotNull('order_dibayar')->count() }}
                        </small>
                    @endif
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

<div class="row mt-8">
    <div class="col">
        @if ($produks->count() > 0)
            {{-- Pagination --}}
            @if ($produks instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link mx-1"
                                href="{{ $produks->previousPageUrl() }}">Prev</a>
                        </li>
                        @for ($i = 1; $i <= $produks->lastPage(); $i++)
                            <li class="page-item {{ $produks->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link mx-1" href="{{ $produks->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item"><a class="page-link mx-1" href="{{ $produks->nextPageUrl() }}">Next</a>
                        </li>
                    </ul>
                </nav>
            @endif
        @endif
    </div>
</div>
