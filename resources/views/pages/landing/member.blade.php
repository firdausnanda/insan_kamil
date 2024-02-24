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
                            <li class="breadcrumb-item active" aria-current="page">Member</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{-- Konten --}}
    <section class="mt-8 mb-5">
        <div class="container">

            <div class="card text-start mb-3">
                <div class="card-body">
                    <h4 class="card-title">Tingkatkan membership anda</h4>
                    <p class="card-text mb-0">Tingkatkan membership anda dan dapatkan banyak keuntungan menarik</p>
                    @if (Auth::user()->id_member && Auth::user()->member)
                        <h4 class="mt-2 d-inline-block me-2">
                            <span class="badge bg-{{ Str::lower(Auth::user()->member->nama) }}">Member
                                {{ Auth::user()->member->nama }}</span>
                        </h4>
                        <p class="fw-bold d-inline-block">Anda mendapatkan diskon setiap pembelian sebesar {{ Auth::user()->member->diskon }}%</p>
                    @else
                        <h4 class="mt-2">
                            <span class="badge bg-secondary">Non Member</span>
                        </h4>
                    @endif
                </div>
            </div>

            <div class="card text-start">
                <div class="card-body">
                    <h4 class="card-title">Syarat Upgrade Member</h4>
                    <p class="card-text mb-0">Total belanja (diluar ongkos kirim) dalam pembelian dan berlaku selamanya</p>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Keanggotaan</th>
                                <th scope="col">Syarat Minimum Pembelian</th>
                                <th scope="col">Potongan Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($member as $m)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $m->nama }}</td>
                                    <td>{{ rupiah($m->pembelian_minimum) }}</td>
                                    <td>{{ $m->diskon }}%</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Data tidak ada</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
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
