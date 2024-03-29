<nav class="navbar navbar-expand-lg navbar-glass">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center w-100">
            <div class="d-flex align-items-center">

                <a class="text-inherit d-block d-xl-none me-4" data-bs-toggle="offcanvas" href="#offcanvasExample"
                    role="button" aria-controls="offcanvasExample">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                        class="bi bi-text-indent-right" viewBox="0 0 16 16">
                        <path
                            d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm10.646 2.146a.5.5 0 0 1 .708.708L11.707 8l1.647 1.646a.5.5 0 0 1-.708.708l-2-2a.5.5 0 0 1 0-.708l2-2zM2 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                    </svg>
                </a>
            </div>
            <div>
                <ul class="list-unstyled d-flex align-items-center mb-0 ms-5 ms-lg-0">
                    <li class="dropdown-center ">
                        <a class="position-relative btn-icon btn-ghost-secondary btn rounded-circle" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-bell fs-5"></i>
                            @if ($total_notif && $total_notif > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger mt-2 ms-n2">
                                    {{ $total_notif && $total_notif > 0 ? $total_notif : '' }}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-lg p-0 border-0 ">
                            <div class="border-bottom p-5 d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="mb-1">Notifikasi</h5>
                                    <p class="mb-0 small">Anda memiliki <span class="fw-bold">{{ $total_notif }}</span>
                                        order yang belum dikerjakan</p>
                                </div>
                            </div>
                            @if ($total_notif && $total_notif > 0)
                                <div data-simplebar>
                                    <!-- List group -->
                                    <ul class="list-group list-group-flush notification-list-scroll fs-6">

                                        @foreach ($order_show as $item)
                                            <li class="list-group-item px-5 py-4 list-group-item-action active">
                                                <a href="{{ $item->status == '1' ? route('admin.order.index') : route('admin.order.detail', $item->id) }}"
                                                    class="text-muted">
                                                    <div class="d-flex">

                                                        @if ($item->user->avatar == null)
                                                            @if ($item->user->id_member && $item->user->member)
                                                                <img src="{{ asset('images/avatar/user.png') }}"
                                                                    alt=""
                                                                    class="avatar avatar-md rounded-circle border border-4 rounded-circle border-{{ Str::lower($item->user->member->nama) }}">
                                                            @else
                                                                <img src="{{ asset('images/avatar/user.png') }}"
                                                                    alt=""
                                                                    class="avatar avatar-md rounded-circle">
                                                            @endif
                                                        @else
                                                            @if ($item->user->id_member && $item->user->member)
                                                                <img src="{{ $item->user->avatar }}" alt=""
                                                                    class="avatar avatar-md rounded-circle border border-4 rounded-circle border-{{ Str::lower($item->user->member->nama) }}">
                                                            @else
                                                                <img src="{{ $item->user->avatar }}" alt=""
                                                                    class="avatar avatar-md rounded-circle">
                                                            @endif
                                                        @endif

                                                        <div class="ms-4">
                                                            <p class="mb-1">
                                                                @if ($item->status == 1)
                                                                    <span class="text-dark">{{ $item->user->name }}
                                                                        sudah melakukan pembayaran</span>
                                                                    Menunggu konfirmasi
                                                                    pembayaran
                                                                @else
                                                                    <span class="text-dark">{{ $item->user->name }}
                                                                    </span>
                                                                    sedang menunggu pesanannya dikirimkan
                                                                @endif
                                                            </p>
                                                            <span><svg xmlns="http://www.w3.org/2000/svg" width="12"
                                                                    height="12" fill="currentColor"
                                                                    class="bi bi-clock text-muted" viewBox="0 0 16 16">
                                                                    <path
                                                                        d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
                                                                    <path
                                                                        d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0z" />
                                                                </svg><small class="ms-2">{{ nicetime($item->updated_at) }}</small></span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>
                                <div class="border-top px-5 py-4 text-center">
                                    <a href="{{ route('admin.order.index') }}">
                                        Lihat Selengkapnya
                                    </a>
                                </div>
                            @endif
                        </div>

                    </li>
                    <li class="dropdown ms-4">
                        <a href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('images/avatar/user.png') }}" alt=""
                                class="avatar avatar-md rounded-circle">
                        </a>

                        <div class="dropdown-menu dropdown-menu-end p-0">
                            <div class="lh-1 px-5 py-4 border-bottom">
                                <h5 class="mb-1 h6">{{ Auth::user()->name }}</h5>
                                <small>{{ Auth::user()->email }}</small>
                            </div>

                            <ul class="list-unstyled px-2 py-3">
                                <li>
                                    <a class="dropdown-item" href="#!">
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#!">
                                        Settings
                                    </a>
                                </li>
                            </ul>
                            <div class="border-top px-5 py-3">
                                <a class="d-block" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
