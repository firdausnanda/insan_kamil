@extends('layouts.landing.main')

@section('content')
    <section class="my-lg-14 my-8">
        <!-- container -->
        <div class="container">
            <div class="row">
                <!-- col -->
                <div class="offset-lg-2 col-lg-8 col-12">

                    @if ($user->member)
                        <div class="card bg-{{ Str::lower($user->member->nama) }} mb-8">
                            <div class="card-body rounded">
                                <div class="row">
                                    <div class="col-lg-6 align-items-center d-flex">
                                        <img class="logo-member" src="{{ asset('images/member/logo-' . Str::lower($user->member->nama) . '.png') }}"
                                            alt="">
                                        <h2 class="card-title text-white mb-0">Member {{ $user->member->nama }}</h2>
                                    </div>
                                    <div class="col-lg-6">
                                        <h4 class="card-title text-white">Diskon {{ $user->member->diskon }}%</h4>
                                        <p class="card-text text-white" style="font-size: 12px">Yeyy! Anda mendapatkan
                                            potongan
                                            setiap pembelian</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-bottom-{{ Str::lower($user->member->nama) }} text-white">
                                <div class="row align-items-center">
                                    <div class="col-9">
                                        Naikin levelmu ke Member Selanjutnya untuk mendapatkan keuntungan menarik lainnya.
                                    </div>
                                    <div class="col-3">
                                        <a href="{{ route('landing.member') }}"
                                            class="btn btn-danger btn-sm float-end">Pelajari
                                            Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="mb-8">
                        <div class="row">
                            <div class="col-lg">
                                <!-- heading -->
                                <h1 class="h3">Profil Pengguna</h1>
                                <p>Profil pengguna harap dilengkapi</p>
                            </div>
                            <div class="col-lg">
                                <a href="{{ route('user.profile.index') }}" class="btn btn-primary float-end">Update
                                    Data</a>
                            </div>
                        </div>
                    </div>

                    <!-- form -->
                    <form id="profile" class="row">
                        <!-- input -->
                        <div class="col-md-12 mb-3">
                            <!-- input -->
                            <label class="form-label" for="nama">
                                Nama Lengkap
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="nama" name="nama" value="{{ $user->name ?? '' }}"
                                class="form-control-plaintext" readonly placeholder="Nama Lengkap" required />
                            <input type="hidden" name="id_user" value="{{ $user->id }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="no_telepon">
                                Nomor Telepon
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="no_telepon" name="no_telepon" value="{{ $user->no_telp ?? '' }}"
                                class="form-control-plaintext" readonly placeholder="Nomor Telepon" required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- input -->
                            <label class="form-label" for="email">Email</label>
                            <input type="text" name="email" value="{{ $user->email ?? '' }}"
                                class="form-control-plaintext" readonly placeholder="Email" required />
                        </div>
                        <div class="col-md-12 mb-3">
                            <!-- input -->
                            <label class="form-label" for="alamat">Alamat</label>
                            <textarea rows="3" id="alamat" name="alamat" class="form-control-plaintext" readonly
                                placeholder="Nama Lengkap" required>{{ $user->alamat ?? '' }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <!-- input -->
                            <label class="form-label" for="provinsi">Provinsi</label>
                            <input type="text" id="provinsi" name="provinsi"
                                value="{{ $user->province ? $user->province->name : '' }}" class="form-control-plaintext"
                                readonly />
                        </div>
                        <div class="col-md-12 mb-3">
                            <!-- input -->
                            <label class="form-label" for="kota">Kota</label>
                            <input type="text" id="kota" name="kota"
                                value="{{ $user->city ? $user->city->name : '' }}" class="form-control-plaintext"
                                readonly />
                        </div>
                        <div class="col-md-12 mb-3">
                            <!-- input -->
                            <label class="form-label" for="desa">Kecamatan</label>
                            <input type="text" id="desa" name="desa"
                                value="{{ $user->district ? $user->district->name : '' }}" class="form-control-plaintext"
                                readonly />
                        </div>
                        <div class="col-md-12 mb-3">
                            <!-- input -->
                            <label class="form-label" for="kode_pos">Kode Pos</label>
                            <input type="text" id="kode_pos" name="kode_pos" value="{{ $user->kode_pos ?? '' }}"
                                class="form-control-plaintext" placeholder="Kode Pos" readonly required />
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <hr class="my-10" />

    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

        });
    </script>
@endsection
