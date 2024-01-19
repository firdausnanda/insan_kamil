<div class="border-bottom ">
    {{-- Top Navbar --}}
    <div class="bg-light py-1">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12 text-center text-md-start"><span> Penawaran Menarik - <a
                            href="">Gunakan Kupon Gratis</a> </span>
                </div>
            </div>
        </div>
    </div>


    <div class="py-5">
        <div class="container">
            <div class="row w-100 align-items-center gx-lg-2 gx-0">
                <div class="col-xxl-2 col-lg-3">
                    <a class="navbar-brand d-none d-lg-block" href="{{ url('/') }}">
                        <img src="{{ asset('images/logo/logo2.png') }}" style="max-width: 160px;"
                            alt="Insan Kamil">
                    </a>
                    <div class="d-flex justify-content-between w-100 d-lg-none">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ asset('images/logo/logo2.png') }}" style="max-width: 160px;"
                                alt="Insan Kamil">

                        </a>

                        <div class="d-flex align-items-center lh-1">

                            <div class="list-inline me-4">
                                @guest
                                    <div class="list-inline-item me-5">
                                        <a href="{{ route('login') }}" class="text-muted">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                        </a>
                                    </div>

                                @endguest
                                @auth
                                    @if (Auth::user()->roles[0]->name == 'user')
                                        {{-- Button Keranjang --}}
                                        <div class="list-inline-item mx-5">

                                            <a class="text-muted position-relative "
                                                href="{{ route('user.keranjang.index') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-shopping-bag">
                                                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                                    <line x1="3" y1="6" x2="21" y2="6">
                                                    </line>
                                                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                                                </svg>
                                                @if ($cart >= 1)
                                                    <span
                                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                                        {{ $cart }}
                                                        <span class="visually-hidden">unread messages</span>
                                                    </span>
                                                @endif
                                            </a>

                                        </div>

                                        {{-- Button Icon Profil --}}
                                        <div class="list-inline-item">
                                            <a href="#" role="button" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                @if (Auth::user()->avatar == null)
                                                    <img src="{{ asset('images/avatar/user.png') }}" alt=""
                                                        class="avatar avatar-md rounded-circle">
                                                @else
                                                    <img src="{{ Auth::user()->avatar }}" alt=""
                                                        class="avatar avatar-md rounded-circle">
                                                @endif
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end p-0">

                                                <div class="lh-1 px-5 py-4 border-bottom">
                                                    <h5 class="mb-1 h6">{{ Auth::user()->name }}</h5>
                                                    <small>{{ Auth::user()->email }}</small>
                                                </div>

                                                <ul class="list-unstyled px-2 py-3">
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('user.profile.index') }}">
                                                            Profile
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('user.order.konfirmasi') }}">
                                                            Pesanan
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('user.order.konfirmasi') }}">
                                                            Riwayat Transaksi
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="border-top px-5 py-3">
                                                    <a class="d-block" href="{{ route('logout') }}"
                                                        onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">
                                                        Logout
                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                        class="d-none">
                                                        @csrf
                                                    </form>
                                                </div>



                                            </div>
                                        </div>
                                    @elseif (Auth::user()->roles[0]->name == 'admin')
                                        <a href="{{ route('login') }}" role="button">
                                            @if (Auth::user()->avatar == null)
                                                <img src="{{ asset('images/avatar/user.png') }}" alt=""
                                                    class="avatar avatar-md rounded-circle">
                                            @else
                                                <img src="{{ Auth::user()->avatar }}" alt=""
                                                    class="avatar avatar-md rounded-circle">
                                            @endif
                                        </a>
                                    @endif

                                @endauth

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-xxl-5 col-lg-5 d-none d-lg-block">

                    <form action="#">
                        <div class="input-group ">
                            <input class="form-control rounded" type="search" placeholder="Cari Judul Buku">
                            <span class="input-group-append">
                                <button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end"
                                    type="button">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-search">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                </button>
                            </span>
                        </div>

                    </form>
                </div>
                <div class="col-md-2 col-xxl-3 d-none d-lg-block">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn  btn-outline-gray-400 text-muted" data-bs-toggle="modal"
                        data-bs-target="#locationModal">
                        <i class="fa-solid fa-magnifying-glass me-2"></i>Cari
                    </button>


                </div>
                <div class="col-md-2 col-xxl-2 text-end d-none d-lg-block">

                    <div class="list-inline">
                        @guest
                            <div class="list-inline-item me-5">
                                <a href="{{ route('login') }}" class="text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="12" cy="7" r="4"></circle>
                                    </svg>
                                </a>
                            </div>

                        @endguest
                        @auth
                            @if (Auth::user()->roles[0]->name == 'user')
                                {{-- Button Keranjang --}}
                                <div class="list-inline-item mx-5">

                                    <a class="text-muted position-relative " href="{{ route('user.keranjang.index') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="feather feather-shopping-bag">
                                            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                            <line x1="3" y1="6" x2="21" y2="6"></line>
                                            <path d="M16 10a4 4 0 0 1-8 0"></path>
                                        </svg>
                                        @if ($cart >= 1)
                                            <span
                                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                                {{ $cart }}
                                                <span class="visually-hidden">unread messages</span>
                                            </span>
                                        @endif
                                    </a>

                                </div>

                                {{-- Button Icon Profil --}}
                                <div class="list-inline-item">
                                    <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        @if (Auth::user()->avatar == null)
                                            <img src="{{ asset('images/avatar/user.png') }}" alt=""
                                                class="avatar avatar-md rounded-circle">
                                        @else
                                            <img src="{{ Auth::user()->avatar }}" alt=""
                                                class="avatar avatar-md rounded-circle">
                                        @endif
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-end p-0">

                                        <div class="lh-1 px-5 py-4 border-bottom">
                                            <h5 class="mb-1 h6">{{ Auth::user()->name }}</h5>
                                            <small>{{ Auth::user()->email }}</small>
                                        </div>

                                        <ul class="list-unstyled px-2 py-3">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('user.profile.index') }}">
                                                    Profile
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('user.order.konfirmasi') }}">
                                                    Pesanan
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('user.order.konfirmasi') }}">
                                                    Riwayat Transaksi
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="border-top px-5 py-3">
                                            <a class="d-block" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                  document.getElementById('logout-formm').submit();">
                                                Logout
                                            </a>

                                            <form id="logout-formm" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </div>



                                    </div>
                                </div>
                            @elseif (Auth::user()->roles[0]->name == 'admin')
                                <a href="{{ route('login') }}" role="button">
                                    @if (Auth::user()->avatar == null)
                                        <img src="{{ asset('images/avatar/user.png') }}" alt=""
                                            class="avatar avatar-md rounded-circle">
                                    @else
                                        <img src="{{ Auth::user()->avatar }}" alt=""
                                            class="avatar avatar-md rounded-circle">
                                    @endif
                                </a>
                            @endif

                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
