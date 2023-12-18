{{-- Navbar Desktop --}}
<nav class="navbar-vertical-nav d-none d-xl-block ">
    <div class="navbar-vertical">
        <div class="px-4 py-5">
            <a href="{{ route('admin.index') }}" class="navbar-brand">
                <img style="max-width: 160px;" src="{{ asset('images/logo/logo2.png') }}" alt="">
            </a>
        </div>
        <div class="navbar-vertical-content flex-grow-1" data-simplebar="">
            <ul class="navbar-nav flex-column" id="sideNavbar">

                <li class="nav-item ">
                    <a class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }}"
                        href="{{ route('admin.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"> <i class="bi bi-house"></i></span>
                            <span class="nav-link-text">Dashboard</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item mt-6 mb-3">
                    <span class="nav-label">Store Managements</span>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ request()->routeIs('admin.produk.*') ? 'active' : '' }}"
                        href="{{ route('admin.produk.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"> <i class="bi bi-cart"></i></span>
                            <span class="nav-link-text">Products</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}"
                        href="{{ route('admin.kategori.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"> <i class="bi bi-list-task"></i></span>
                            <span class="nav-link-text">Kategori</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ request()->routeIs('admin.penerbit.*') ? 'active' : '' }}"
                        href="{{ route('admin.penerbit.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"> <i class="bi bi-book"></i></span>
                            <span class="nav-link-text">Penerbit</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ request()->routeIs('admin.order.*') ? 'active' : '' }}"
                        href="{{ route('admin.order.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"><i class="bi bi-bag"></i></span>
                            <span class="nav-link-text">Order</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ request()->routeIs('admin.pengguna.*') ? 'active' : '' }}"
                        href="{{ route('admin.pengguna.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"> <i class="bi bi-people"></i></span>
                            <span class="nav-link-text">Pengguna</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ request()->routeIs('admin.ulasan.*') ? 'active' : '' }}"
                        href="{{ route('admin.ulasan.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"> <i class="bi bi-star"></i></span>
                            <span class="nav-link-text">Ulasan</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}"
                        href="{{ route('admin.blog.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"> <i class="bi bi-brush"></i></span>
                            <span class="nav-link-text">Blog</span>
                        </div>
                    </a>
                </li>

                <li class="nav-item mt-6 mb-3">
                    <span class="nav-label">System Monitoring</span>
                </li>

                <li class="nav-item ">
                    <a class="nav-link " href="{{ route('queue-monitor::index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"> <i class="bi bi-display"></i></span>
                            <span class="nav-link-text">Queue Monitor</span>
                        </div>
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link {{ request()->routeIs('admin.activity.*') ? 'active' : '' }}"
                        href="{{ route('admin.activity.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"> <i class="bi bi-activity"></i></span>
                            <span class="nav-link-text">Activity Logs</span>
                        </div>
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link {{ request()->routeIs('admin.backupdb.*') ? 'active' : '' }}"
                        href="{{ route('admin.backupdb.index') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"> <i class="bi bi-database"></i></span>
                            <span class="nav-link-text">Database Backup</span>
                        </div>
                    </a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link " href="{{ url('/log-viewer') }}">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"> <i class="bi bi-bug"></i></span>
                            <span class="nav-link-text">Error Logs</span>
                        </div>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>

{{-- Navbar Responsive --}}
<nav class="navbar-vertical-nav offcanvas offcanvas-start navbar-offcanvac" tabindex="-1" id="offcanvasExample">
    <div class="navbar-vertical">
        <div class="px-4 py-5 d-flex justify-content-between align-items-center">
            <a href="../index.html" class="navbar-brand">
                <img src="{{ asset('images/logo/freshcart-logo') }}.svg" alt="">
            </a>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="navbar-vertical-content flex-grow-1" data-simplebar="">
            <ul class="navbar-nav flex-column">
                <li class="nav-item ">
                    <a class="nav-link  active " href="../dashboard/index.html">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"> <i class="bi bi-house"></i></span>
                            <span>Dashboard</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item mt-6 mb-3">
                    <span class="nav-label">Store Managements</span>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " href="../dashboard/products.html">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"> <i class="bi bi-cart"></i></span>
                            <span class="nav-link-text">Products</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " href="../dashboard/categories.html">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"> <i class="bi bi-list-task"></i></span>
                            <span class="nav-link-text">Categories</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link   collapsed " href="#" data-bs-toggle="collapse"
                        data-bs-target="#navOrders" aria-expanded="false" aria-controls="navOrders">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"> <i class="bi bi-bag"></i></span>
                            <span class="nav-link-text">Orders</span>
                        </div>
                    </a>
                    <div id="navOrders" class="collapse " data-bs-parent="#sideNavbar">
                        <ul class="nav flex-column">
                            <li class="nav-item ">
                                <a class="nav-link " href="../dashboard/order-list.html">
                                    List
                                </a>
                            </li>
                            <!-- Nav item -->
                            <li class="nav-item ">
                                <a class="nav-link " href="../dashboard/order-single.html">
                                    Single

                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " href="../dashboard/vendor-grid.html">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"> <i class="bi bi-shop"></i></span>
                            <span class="nav-link-text">Sellers / Vendors</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " href="../dashboard/customers.html">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"> <i class="bi bi-people"></i></span>
                            <span class="nav-link-text">Customers</span>
                        </div>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link " href="../dashboard/reviews.html">
                        <div class="d-flex align-items-center">
                            <span class="nav-link-icon"> <i class="bi bi-star"></i></span>
                            <span class="nav-link-text">Reviews</span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>

</nav>
