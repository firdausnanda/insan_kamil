@extends('layouts.landing.main')

@section('content')
    <!-- section -->
    <section class="my-lg-14 my-8">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
                    <!-- img -->
                    <img src="{{ asset('images/svg-graphics/signup-g.svg') }}" alt="" class="img-fluid" />
                </div>
                <!-- col -->
                <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
                    <div class="mb-lg-9 mb-5">
                        <h1 class="mb-1 h2 fw-bold">Daftar</h1>
                        <p>Daftar dan belanja buku sesuai keinginan anda.</p>
                    </div>
                    <!-- form -->
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <!-- col -->
                            <div class="col-12">
                                <!-- input -->
                                <label for="formSignupfname" class="form-label visually-hidden">Nama</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" placeholder="Nama" required
                                    autocomplete="name" autofocus />
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <!-- input -->
                                <label for="formSignupEmail" class="form-label visually-hidden">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <div class="password-field position-relative">
                                    <label for="formSignupPassword" class="form-label visually-hidden">Password</label>
                                    <div class="password-field position-relative">
                                        <input id="password" type="password"
                                            class="form-control fakePassword @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="new-password" placeholder="*****"
                                            required>
                                        <span><i class="bi bi-eye-slash passwordToggler"></i></span>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="password-field position-relative">
                                    <label for="formSignupPassword" class="form-label visually-hidden">Password</label>
                                    <div class="password-field position-relative">
                                        <input type="password" class="form-control fakePassword" id="password-confirm"
                                            name="password_confirmation" required autocomplete="new-password"
                                            placeholder="*****" required />
                                        <span><i class="bi bi-eye-slash passwordToggler"></i></span>
                                    </div>
                                </div>
                            </div>
                            <!-- btn -->
                            <div class="col-12 d-grid"><button type="submit" class="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
