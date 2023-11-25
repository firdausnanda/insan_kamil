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
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Buku Anak</a></li>

                            <li class="breadcrumb-item active" aria-current="page">My First Book 100 Kata Pertamaku</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{-- Konten --}}
    <section class="mt-8">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="slider slider-for">
                        <div>
                            <div class="zoom" onmousemove="zoom(event)"
                                style="background-image: url(../images/products/product-single-img-1.jpg)">
                                <!-- img -->
                                <!-- img -->
                                <img src="../images/products/product-single-img-1.jpg" alt="" />
                            </div>
                        </div>
                        <div>
                            <div class="zoom" onmousemove="zoom(event)"
                                style="background-image: url(../images/products/product-single-img-2.jpg)">
                                <!-- img -->
                                <!-- img -->
                                <img src="../images/products/product-single-img-2.jpg" alt="" />
                            </div>
                        </div>
                        <div>
                            <div class="zoom" onmousemove="zoom(event)"
                                style="background-image: url(../images/products/product-single-img-3.jpg)">
                                <!-- img -->
                                <!-- img -->
                                <img src="../images/products/product-single-img-3.jpg" alt="" />
                            </div>
                        </div>
                        <div>
                            <div class="zoom" onmousemove="zoom(event)"
                                style="background-image: url(../images/products/product-single-img-1.jpg)">
                                <!-- img -->
                                <!-- img -->
                                <img src="../images/products/product-single-img-1.jpg" alt="" />
                            </div>
                        </div>
                        <div>
                            <div class="zoom" onmousemove="zoom(event)"
                                style="background-image: url(../images/products/product-single-img-4.jpg)">
                                <!-- img -->
                                <!-- img -->
                                <img src="../images/products/product-single-img-4.jpg" alt="" />
                            </div>
                        </div>
                    </div>
                    <div class="slider slider-nav mt-4">
                        <div>
                            <img src="../images/products/product-single-img-1.jpg" alt="" class="w-100 rounded" />
                        </div>
                        <div>
                            <img src="../images/products/product-single-img-2.jpg" alt="" class="w-100 rounded" />
                        </div>
                        <div>
                            <img src="../images/products/product-single-img-3.jpg" alt="" class="w-100 rounded" />
                        </div>
                        <div>
                            <img src="../images/products/product-single-img-1.jpg" alt="" class="w-100 rounded" />
                        </div>
                        <div>
                            <img src="../images/products/product-single-img-4.jpg" alt="" class="w-100 rounded" />
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="ps-lg-10 mt-6 mt-md-0">
                        <!-- content -->
                        <a href="#!" class="mb-4 d-block">Buku Anak</a>
                        <!-- heading -->
                        <h1 class="mb-1">My First Book 100 Kata Pertamaku</h1>
                        <div class="mb-4">
                            <!-- rating -->
                            <!-- rating -->
                            <small class="text-warning">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-half"></i>
                            </small>
                            <a href="#" class="ms-2">(30 reviews)</a>
                        </div>
                        <div class="fs-4">
                            <!-- price -->
                            <span class="fw-bold text-dark">Rp. 15.000</span>
                            <span class="text-decoration-line-through text-muted">Rp. 20.000</span>
                        </div>
                        <!-- hr -->
                        <hr class="my-6" />
                        <div>
                            <!-- input -->
                            <div class="input-group input-spinner">
                                <input type="button" value="-" class="button-minus btn btn-sm"
                                    data-field="quantity" />
                                <input type="number" step="1" max="10" value="1" name="quantity"
                                    class="quantity-field form-control-sm form-input" />
                                <input type="button" value="+" class="button-plus btn btn-sm" data-field="quantity" />
                            </div>
                        </div>
                        <div class="mt-3 row justify-content-start g-2 align-items-center">
                            <div class="col-xxl-4 col-lg-4 col-md-6 col-5 d-grid">
                                <!-- button -->
                                <!-- btn -->
                                <button type="button" class="btn btn-outline-primary" style="font-size: 12px">
                                    <i class="feather-icon icon-shopping-bag me-2"></i>
                                    Masukkan Keranjang
                                </button>
                            </div>
                            <div class="col-md-4 col-4">
                              <!-- btn -->
                              <a class="btn btn-primary" style="font-size: 12px">Beli Sekarang</a>
                           </div>
                        </div>
                        <!-- hr -->
                        <hr class="my-6" />
                        <div>
                            <!-- table -->
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td>Kategori:</td>
                                        <td>Buku Anak</td>
                                    </tr>
                                    <tr>
                                        <td>Bahasa:</td>
                                        <td>Indonesia</td>
                                    </tr>
                                    <tr>
                                        <td>Ukuran:</td>
                                        <td>25 x 25 <span class="text-muted">cm</span></td>
                                    </tr>
                                    <tr>
                                        <td>Berat:</td>
                                        <td>585 <span class="text-muted">gr</span></td>
                                    </tr>
                                    <tr>
                                        <td>Halaman:</td>
                                        <td>
                                            <small>
                                                24
                                                <span class="text-muted">Halaman</span>
                                            </small>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-8">
                            <!-- dropdown -->
                            <div class="dropdown">
                                <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">Share</a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi bi-facebook me-2"></i>
                                            Facebook
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi bi-twitter me-2"></i>
                                            Twitter
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="bi bi-instagram me-2"></i>
                                            Instagram
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Produk Information --}}
    <section class="mt-lg-14 mt-8">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills nav-lb-tab" id="myTab" role="tablist">
                        <!-- nav item -->
                        <li class="nav-item" role="presentation">
                            <!-- btn -->
                            <button class="nav-link active" id="product-tab" data-bs-toggle="tab"
                                data-bs-target="#product-tab-pane" type="button" role="tab"
                                aria-controls="product-tab-pane" aria-selected="true">
                                Product Details
                            </button>
                        </li>
                    </ul>
                    <!-- tab content -->
                    <div class="tab-content" id="myTabContent">
                        <!-- tab pane -->
                        <div class="tab-pane fade show active" id="product-tab-pane" role="tabpanel"
                            aria-labelledby="product-tab" tabindex="0">
                            <div class="my-8">
                                <div class="mb-5">
                                    <!-- text -->
                                    <p>MY FIRST BOOK 100 KATA PERTAMAKU</p>

<p>Ayah Bunda, masa golden age adalah periode yang tepat untuk menstimulasi tumbuh kembang si kecil. Stimulasi harus diberikan sejak dini karena dapat meningkatkan perkembangan otak si kecil</p>

<p>Maka berikan stimulus yang baik untuk buah hati dimulai dari mengenalkan benda-benda di sekitar dengan cara yang menyenangkan &#55357;&#56842;</p>

<p>Kabar baiknya, kini telah kami hadirkan kembali, buku best seller &ldquo;MY FIRST BOOK 100 KATA PERTAMAKU&rdquo;</p>

<p>Ada banyak benda yang dikenalkan di buku ini, mulai dari pakaian, anggota tubuh manusia, hewan peliharaan, kendaraan, benda-benda di kamar mandi, benda-benda di ruang makan, dan lainnya. Yuk perkaya kosa kata si kecil sejak dini agar wawasannya bertambah &#55357;&#56842;</p>

<p>Dengan buku boardbook yang didesain aman untuk anak, harapannya si kecil memiliki beragam kosakata baru sehingga dapat meningkatkan kemampuan bahasa, kognitif, dan motoriknya. Yuk, manfaatkan dengan baik masa emas si kecil dengan memperkaya kosakatanya! &#55357;&#56835;</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Items -->
    <section class="my-lg-14 my-14">
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-12">
                    <!-- heading -->
                    <h3>Related Items</h3>
                </div>
            </div>
            <!-- row -->
            <div class="row g-4 row-cols-lg-5 row-cols-2 row-cols-md-2 mt-2">
                <!-- col -->
                <div class="col">
                    <div class="card card-product">
                        <div class="card-body">
                            <!-- badge -->

                            <div class="text-center position-relative">
                                <div class="position-absolute top-0 start-0">
                                    <span class="badge bg-danger">Sale</span>
                                </div>
                                <a href="#!">
                                    <!-- img -->
                                    <img src="../images/products/product-img-1.jpg" alt="Grocery Ecommerce Template"
                                        class="mb-3 img-fluid" />
                                </a>
                                <!-- action btn -->
                                <div class="card-product-action">
                                    <a href="#!" class="btn-action" data-bs-toggle="modal"
                                        data-bs-target="#quickViewModal">
                                        <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true"
                                            title="Quick View"></i>
                                    </a>
                                    <a href="shop-wishlist.html" class="btn-action" data-bs-toggle="tooltip"
                                        data-bs-html="true" title="Wishlist"><i class="bi bi-heart"></i></a>
                                    <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                                        title="Compare"><i class="bi bi-arrow-left-right"></i></a>
                                </div>
                            </div>
                            <!-- heading -->
                            <div class="text-small mb-1">
                                <a href="#!" class="text-decoration-none text-muted"><small>Snack &
                                        Munchies</small></a>
                            </div>
                            <h2 class="fs-6"><a href="#!" class="text-inherit text-decoration-none">Haldiram's Sev
                                    Bhujia</a></h2>
                            <div>
                                <!-- rating -->
                                <small class="text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </small>
                                <span class="text-muted small">4.5(149)</span>
                            </div>
                            <!-- price -->
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    <span class="text-dark">$18</span>
                                    <span class="text-decoration-line-through text-muted">$24</span>
                                </div>
                                <!-- btn -->
                                <div>
                                    <a href="#!" class="btn btn-primary btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                        Add
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- col -->
                <div class="col">
                    <div class="card card-product">
                        <div class="card-body">
                            <!-- badge -->
                            <div class="text-center position-relative">
                                <a href="#!"><img src="../images/products/product-img-2.jpg"
                                        alt="Grocery Ecommerce Template" class="mb-3 img-fluid" /></a>
                                <!-- action btn -->
                                <div class="card-product-action">
                                    <a href="#!" class="btn-action" data-bs-toggle="modal"
                                        data-bs-target="#quickViewModal">
                                        <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true"
                                            title="Quick View"></i>
                                    </a>
                                    <a href="shop-wishlist.html" class="btn-action" data-bs-toggle="tooltip"
                                        data-bs-html="true" title="Wishlist"><i class="bi bi-heart"></i></a>
                                    <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                                        title="Compare"><i class="bi bi-arrow-left-right"></i></a>
                                </div>
                            </div>
                            <!-- heading -->
                            <div class="text-small mb-1">
                                <a href="#!" class="text-decoration-none text-muted"><small>Bakery &
                                        Biscuits</small></a>
                            </div>
                            <h2 class="fs-6"><a href="#!" class="text-inherit text-decoration-none">NutriChoice
                                    Digestive</a></h2>
                            <div class="text-warning">
                                <small>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </small>
                                <span class="text-muted small">4.5 (25)</span>
                            </div>
                            <!-- price -->
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div><span class="text-dark">$24</span></div>
                                <!-- btn -->
                                <div>
                                    <a href="#!" class="btn btn-primary btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                        Add
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- col -->
                <div class="col">
                    <div class="card card-product">
                        <div class="card-body">
                            <!-- badge -->
                            <div class="text-center position-relative">
                                <a href="#!"><img src="../images/products/product-img-3.jpg"
                                        alt="Grocery Ecommerce Template" class="mb-3 img-fluid" /></a>
                                <!-- action btn -->
                                <div class="card-product-action">
                                    <a href="#!" class="btn-action" data-bs-toggle="modal"
                                        data-bs-target="#quickViewModal">
                                        <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true"
                                            title="Quick View"></i>
                                    </a>
                                    <a href="shop-wishlist.html" class="btn-action" data-bs-toggle="tooltip"
                                        data-bs-html="true" title="Wishlist"><i class="bi bi-heart"></i></a>
                                    <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                                        title="Compare"><i class="bi bi-arrow-left-right"></i></a>
                                </div>
                            </div>
                            <!-- heading -->
                            <div class="text-small mb-1">
                                <a href="#!" class="text-decoration-none text-muted"><small>Bakery &
                                        Biscuits</small></a>
                            </div>
                            <h2 class="fs-6"><a href="#!" class="text-inherit text-decoration-none">Cadbury 5 Star
                                    Chocolate</a></h2>
                            <div class="text-warning">
                                <small>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </small>
                                <span class="text-muted small">5 (469)</span>
                            </div>
                            <!-- price -->
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    <span class="text-dark">$32</span>
                                    <span class="text-decoration-line-through text-muted">$35</span>
                                </div>
                                <!-- btn -->
                                <div>
                                    <a href="#!" class="btn btn-primary btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                        Add
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- col -->
                <div class="col">
                    <div class="card card-product">
                        <div class="card-body">
                            <!-- badge -->
                            <div class="text-center position-relative">
                                <a href="#!"><img src="../images/products/product-img-4.jpg"
                                        alt="Grocery Ecommerce Template" class="mb-3 img-fluid" /></a>
                                <!-- action btn -->
                                <div class="card-product-action">
                                    <a href="#!" class="btn-action" data-bs-toggle="modal"
                                        data-bs-target="#quickViewModal">
                                        <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true"
                                            title="Quick View"></i>
                                    </a>
                                    <a href="shop-wishlist.html" class="btn-action" data-bs-toggle="tooltip"
                                        data-bs-html="true" title="Wishlist"><i class="bi bi-heart"></i></a>
                                    <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                                        title="Compare"><i class="bi bi-arrow-left-right"></i></a>
                                </div>
                            </div>
                            <!-- heading -->
                            <div class="text-small mb-1">
                                <a href="#!" class="text-decoration-none text-muted"><small>Snack &
                                        Munchies</small></a>
                            </div>
                            <h2 class="fs-6"><a href="#!" class="text-inherit text-decoration-none">Onion Flavour
                                    Potato</a></h2>
                            <div class="text-warning">
                                <small>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                    <i class="bi bi-star"></i>
                                </small>
                                <span class="text-muted small">3.5 (456)</span>
                            </div>
                            <!-- price -->
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    <span class="text-dark">$3</span>
                                    <span class="text-decoration-line-through text-muted">$5</span>
                                </div>
                                <!-- btn -->
                                <div>
                                    <a href="#!" class="btn btn-primary btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                        Add
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- col -->
                <div class="col">
                    <div class="card card-product">
                        <div class="card-body">
                            <!-- badge -->
                            <div class="text-center position-relative">
                                <a href="#!"><img src="../images/products/product-img-9.jpg"
                                        alt="Grocery Ecommerce Template" class="mb-3 img-fluid" /></a>
                                <!-- action btn -->
                                <div class="card-product-action">
                                    <a href="#!" class="btn-action" data-bs-toggle="modal"
                                        data-bs-target="#quickViewModal">
                                        <i class="bi bi-eye" data-bs-toggle="tooltip" data-bs-html="true"
                                            title="Quick View"></i>
                                    </a>
                                    <a href="shop-wishlist.html" class="btn-action" data-bs-toggle="tooltip"
                                        data-bs-html="true" title="Wishlist"><i class="bi bi-heart"></i></a>
                                    <a href="#!" class="btn-action" data-bs-toggle="tooltip" data-bs-html="true"
                                        title="Compare"><i class="bi bi-arrow-left-right"></i></a>
                                </div>
                            </div>
                            <!-- heading -->
                            <div class="text-small mb-1">
                                <a href="#!" class="text-decoration-none text-muted"><small>Snack &
                                        Munchies</small></a>
                            </div>
                            <h2 class="fs-6"><a href="#!" class="text-inherit text-decoration-none">Slurrp Millet
                                    Chocolate</a></h2>
                            <div class="text-warning">
                                <small>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </small>
                                <span class="text-muted small">4.5 (67)</span>
                            </div>
                            <!-- price -->
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <div>
                                    <span class="text-dark">$6</span>
                                    <span class="text-decoration-line-through text-muted">$10</span>
                                </div>
                                <!-- btn -->
                                <div>
                                    <a href="#!" class="btn btn-primary btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                        Add
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
