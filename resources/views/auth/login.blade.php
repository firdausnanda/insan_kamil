@extends('layouts.landing.main')

@section('content')
    <!-- section -->
    <section class="my-lg-14 my-8">
        <div class="container">
            <!-- row -->
            <div class="row justify-content-center align-items-center">
                <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2 d-sm-none d-none d-md-block">
                    <!-- img -->
                    <img src="{{ asset('images/svg-graphics/signin-g.svg') }}" alt="" class="img-fluid" />
                </div>
                <!-- col -->
                <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
                    <div class="mb-lg-9 mb-5">
                        <h1 class="mb-1 h2 fw-bold">Login Insan Kamil</h1>
                        <p>Selamat datang di Insan Kamil! Masukan Email dan Password anda.</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}" class="needs-validation">
                        @csrf
                        <div class="row g-3">
                            <!-- row -->


                            <div class="col-12">
                                <!-- input -->
                                <label for="formSigninEmail" class="form-label visually-hidden">Email address</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email"
                                    placeholder="Email" autofocus />

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <!-- input -->
                                <div class="password-field position-relative">
                                    <label for="formSigninPassword" class="form-label visually-hidden">Password</label>
                                    <div class="password-field position-relative">
                                        <input type="password"
                                            class="form-control fakePassword @error('password') is-invalid @enderror"
                                            id="formSigninPassword" placeholder="*****" name="password" required
                                            autocomplete="current-password" />
                                        <span><i class="bi bi-eye-slash passwordToggler"></i></span>
                                    </div>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <!-- form check -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" name="remember"
                                        id="remember" {{ old('remember') ? 'checked' : '' }} />
                                    <!-- label -->
                                    <label class="form-check-label" for="remember">Remember me</label>
                                </div>
                                <div>
                                    Lupa Password?
                                    {{-- <a href="{{ route('password.request') }}">Reset</a> --}}
                                    <a href="#">Reset</a>
                                </div>
                            </div>
                            <!-- btn -->
                            <div class="col-12 d-grid"><button type="submit" class="btn btn-primary">Login</button>
                            </div>
                            <div class="col-12 d-grid"><a href="{{'/auth/redirect'}}" type="button" class="btn btn-outline-primary"><i
                                        class="fa-brands fa-google me-2"></i> Login With Google</a></div>
                            <!-- link -->
                            <div>
                                Tidak Punya Akun?
                                <a href="{{ route('register') }}">Daftar</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
