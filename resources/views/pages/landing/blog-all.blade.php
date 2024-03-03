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
                            <li class="breadcrumb-item active" aria-current="page">Blog</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- section -->
    <div class="mt-8 mb-lg-14 mb-8">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row gx-10">

                @forelse ($blog as $b)
                    <div class="col-lg-4">
                        <div class="card border-0 px-0">
                            <a href="{{ route('landing.detail_blog', $b->id) }}">
                                <div class="img-zoom">
                                    @if ($b->gambar)
                                        <img src="{{ asset('storage/blog/' . $b->gambar) }}" style="max-height: 225px;"
                                            alt="" class="img-fluid rounded w-100" style="max-height: 225px">
                                    @else
                                        <img src="{{ asset('images/avatar/no-image.png') }}" style="max-height: 225px;"
                                            alt="" class="img-fluid rounded w-100">
                                    @endif
                                </div>
                            </a>
                            <div class="card-body">
                                <h4 class="h5"><a href="{{ route('landing.detail_blog', $b->id) }}"
                                        class="text-inherit">{{ $b->judul }}</a></h4>
                                <p class="card-text">{!! Str::limit(strip_tags($b->isi), 75) !!}</p>
                                <div class="d-flex align-items-center lh-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                        fill="currentColor" class="bi bi-clock text-dark" viewBox="0 0 16 16">
                                        <path
                                            d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z">
                                        </path>
                                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z">
                                        </path>
                                    </svg>
                                    <small class="ms-1"><span
                                            class="text-dark fw-bold">{{ nicetime($b->updated_at) }}</small>
                                </div>
                            </div>
                        </div>

                    </div>
                @empty
                    Data belum tersedia
                @endforelse

            </div>

            <div class="row mt-8">
                <div class="col">
                    @if ($blog->count() > 0)
                        {{-- Pagination --}}
                        @if ($blog instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link mx-1"
                                            href="{{ $blog->previousPageUrl() }}">Prev</a>
                                    </li>
                                    @for ($i = 1; $i <= $blog->lastPage(); $i++)
                                        <li class="page-item {{ $blog->currentPage() == $i ? 'active' : '' }}">
                                            <a class="page-link mx-1" href="{{ $blog->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor
                                    <li class="page-item"><a class="page-link mx-1"
                                            href="{{ $blog->nextPageUrl() }}">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
