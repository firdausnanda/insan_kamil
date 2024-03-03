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
                            <li class="breadcrumb-item"><a href="{{ route('blog') }}">Blog</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $b->judul }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{-- Konten --}}
    <section class="mt-8">
        <div class="container">
            <div class="row text-center justify-content-center">
                <h2>{{ $b->judul }}</h2>
                <p class="text-secondary">{{ \Carbon\Carbon::parse($b->created_at)->isoFormat('D MMMM Y') }}</p>

                @if ($b->gambar)
                    <img src="{{ asset('storage/blog/' . $b->gambar) }}" class="img-fluid"
                        style="max-width: 450px; max-height: auto">
                @endif
                <div class="mt-3" style="text-align: justify; text-justify: inter-word;">
                    {!! $b->isi !!}
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
