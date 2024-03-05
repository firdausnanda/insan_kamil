<!-- row -->
<div class="row g-4 row-cols-xl-4 row-cols-lg-3 row-cols-md-2 mt-2">
    @foreach ($produk as $p)
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
                                    style="max-height: 193px; max-width: 193px;">
                            @else
                                <img src="{{ asset('images/avatar/no-image.png') }}" alt="{{ $p->nama_produk }}"
                                    class="mb-3 img-fluid" style="max-height: 193px; max-width: 193px;">
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

<div class="row mt-8">
    <div class="col">
        @if ($produk->count() > 0)
            {{-- Pagination --}}
            @if ($produk instanceof \Illuminate\Pagination\LengthAwarePaginator)
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link mx-1"
                                href="{{ $produk->previousPageUrl() }}">Prev</a>
                        </li>
                        @for ($i = 1; $i <= $produk->lastPage(); $i++)
                            <li class="page-item {{ $produk->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link mx-1" href="{{ $produk->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item"><a class="page-link mx-1" href="{{ $produk->nextPageUrl() }}">Next</a>
                        </li>
                    </ul>
                </nav>
            @endif
        @endif
    </div>
</div>
