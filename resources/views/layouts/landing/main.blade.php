<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta content="Codescandy" name="author">
  <title>Insan Kamil - Book Store </title>
  <link href="{{ asset('vendor/tiny-slider/dist/tiny-slider.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/slick-carousel/slick/slick.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/slick-carousel/slick/slick-theme.css') }}" rel="stylesheet">
  <!-- Favicon icon-->
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon/favicon.ico') }}">


  <!-- Libs CSS -->
  <link href="{{ asset('vendor/bootstrap-icons/font/bootstrap-icons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/feather-webfont/dist/feather-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('vendor/simplebar/dist/simplebar.min.css') }}" rel="stylesheet">


  <!-- Theme CSS -->
  <link rel="stylesheet" href="{{ asset('css/theme.min.css') }}">
  <!-- Google tag (gtag.js) -->



  <!-- End Tag -->
</head>

<body>
  <div class="border-bottom ">
    <div class="bg-light py-1">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-12 text-center text-md-start"><span> Super Value Deals - Save more with
              coupons</span>
          </div>
        </div>
      </div>
    </div>
    <div class="py-5">
      <div class="container">
        <div class="row w-100 align-items-center gx-lg-2 gx-0">
          <div class="col-xxl-2 col-lg-3">
            <a class="navbar-brand d-none d-lg-block" href="./index.html">
              <img src="{{ asset('images/logo/freshcart-logo.svg') }}" alt="Insan Kamil">

            </a>
            <div class="d-flex justify-content-between w-100 d-lg-none">
              <a class="navbar-brand" href="./index.html">
                <img src="{{ asset('images/logo/freshcart-logo.svg') }}" alt="Insan Kamil">

              </a>

              <div class="d-flex align-items-center lh-1">

                <div class="list-inline me-4">
                  <div class="list-inline-item">

                    <a href="#!" class="text-muted" data-bs-toggle="modal" data-bs-target="#userModal">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-user">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                      </svg>
                    </a>
                  </div>
                  <div class="list-inline-item">

                    <a class="text-muted position-relative " data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                      href="#offcanvasExample" role="button" aria-controls="offcanvasRight">
                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-shopping-bag">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                      </svg>
                      <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                        1
                        <span class="visually-hidden">unread messages</span>
                      </span>
                    </a>
                  </div>

                </div>
                <!-- Button -->
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="offcanvas"
                  data-bs-target="#navbar-default" aria-controls="navbar-default" aria-label="Toggle navigation">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                    class="bi bi-text-indent-left text-primary" viewBox="0 0 16 16">
                    <path
                      d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                  </svg>
                </button>

              </div>
            </div>

          </div>
          <div class="col-xxl-5 col-lg-5 d-none d-lg-block">

            <form action="#">
              <div class="input-group ">
                <input class="form-control rounded" type="search" placeholder="Cari Judul Buku">
                <span class="input-group-append">
                  <button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end" type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
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
              <i class="feather-icon icon-map-pin me-2"></i>Lokasi
            </button>


          </div>
          <div class="col-md-2 col-xxl-2 text-end d-none d-lg-block">

            <div class="list-inline">
              <div class="list-inline-item me-5">

                <a href="#!" class="text-muted" data-bs-toggle="modal" data-bs-target="#userModal">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-user">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                  </svg>
                </a></div>
              <div class="list-inline-item">

                <a class="text-muted position-relative " data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
                  href="#offcanvasExample" role="button" aria-controls="offcanvasRight">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-shopping-bag">
                    <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <path d="M16 10a4 4 0 0 1-8 0"></path>
                  </svg>
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                    1
                    <span class="visually-hidden">unread messages</span>
                  </span>
                </a>

              </div>





            </div>
          </div>
        </div>
      </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light navbar-default py-0 " aria-label="Offcanvas navbar large">
      <div class="container">


        <div class="offcanvas offcanvas-start" tabindex="-1" id="navbar-default" aria-labelledby="navbar-defaultLabel">
          <div class="offcanvas-header pb-1">
            <a href="./index.html"><img src="{{ asset('images/logo/freshcart-logo.svg') }}" alt="Insan Kamil"></a>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
        </div>
      </div>
    </nav>


  </div>
  <!-- Modal -->
  <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content p-4">
        <div class="modal-header border-0">
          <h5 class="modal-title fs-3 fw-bold" id="userModalLabel">Sign Up</h5>

          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="mb-3">
              <label for="fullName" class="form-label">Name</label>
              <input type="text" class="form-control" id="fullName" placeholder="Enter Your Name" required="">
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input type="email" class="form-control" id="email" placeholder="Enter Email address" required="">
            </div>

            <div class="mb-5">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" placeholder="Enter Password" required="">
              <small class="form-text">By Signup, you agree to our <a href="#!">Terms of Service</a> & <a
                  href="#!">Privacy Policy</a></small>
            </div>

            <button type="submit" class="btn btn-primary">Sign Up</button>
          </form>
        </div>
        <div class="modal-footer border-0 justify-content-center">

          Already have an account? <a href="#">Sign in</a>
        </div>
      </div>
    </div>
  </div>



  <!-- Shop Cart -->

  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header border-bottom">
      <div class="text-start">
        <h5 id="offcanvasRightLabel" class="mb-0 fs-4">Shop Cart</h5>
        <small>Location in 382480</small>
      </div>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

      <div class="">
        <!-- alert -->
        <div class="alert alert-danger p-2" role="alert">
          You’ve got FREE delivery. Start <a href="#!" class="alert-link">checkout now!</a>
        </div>
        <ul class="list-group list-group-flush">
          <!-- list group -->
          <li class="list-group-item py-3 ps-0 border-top">
            <!-- row -->
            <div class="row align-items-center">

              <div class="col-6 col-md-6 col-lg-7">
                <div class="d-flex">
                  <img src="{{ asset('images/products/product-img-1.jpg') }}" alt="Ecommerce" class="icon-shape icon-xxl">
                  <div class="ms-3">
                    <!-- title -->
                    <a href="./pages/shop-single.html" class="text-inherit">
                      <h6 class="mb-0">Haldiram's Sev Bhujia</h6>
                    </a>
                    <span><small class="text-muted">.98 / lb</small></span>
                    <!-- text -->
                    <div class="mt-2 small lh-1"> <a href="#!" class="text-decoration-none text-inherit"> <span
                          class="me-1 align-text-bottom">
                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-trash-2 text-success">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                            </path>
                            <line x1="10" y1="11" x2="10" y2="17"></line>
                            <line x1="14" y1="11" x2="14" y2="17"></line>
                          </svg></span><span class="text-muted">Remove</span></a></div>
                  </div>
                </div>
              </div>
              <!-- input group -->
              <div class="col-4 col-md-3 col-lg-3">
                <!-- input -->
                <!-- input -->
                <div class="input-group input-spinner  ">
                  <input type="button" value="-" class="button-minus  btn  btn-sm " data-field="quantity">
                  <input type="number" step="1" max="10" value="1" name="quantity"
                    class="quantity-field form-control-sm form-input   ">
                  <input type="button" value="+" class="button-plus btn btn-sm " data-field="quantity">
                </div>

              </div>
              <!-- price -->
              <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                <span class="fw-bold">$5.00</span>

              </div>
            </div>

          </li>
          <!-- list group -->
          <li class="list-group-item py-3 ps-0">
            <!-- row -->
            <div class="row align-items-center">
              <div class="col-6 col-md-6 col-lg-7">
                <div class="d-flex">
                  <img src="{{ asset('images/products/product-img-2.jpg') }}" alt="Ecommerce" class="icon-shape icon-xxl">
                  <div class="ms-3">
                    <a href="./pages/shop-single.html" class="text-inherit">
                      <h6 class="mb-0">NutriChoice Digestive </h6>
                    </a>
                    <span><small class="text-muted">250g</small></span>
                    <!-- text -->
                    <div class="mt-2 small lh-1"> <a href="#!" class="text-decoration-none text-inherit"> <span
                          class="me-1 align-text-bottom">
                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-trash-2 text-success">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                            </path>
                            <line x1="10" y1="11" x2="10" y2="17"></line>
                            <line x1="14" y1="11" x2="14" y2="17"></line>
                          </svg></span><span class="text-muted">Remove</span></a></div>
                  </div>
                </div>
              </div>


              <!-- input group -->
              <div class="col-4 col-md-3 col-lg-3">
                <!-- input -->
                <!-- input -->
                <div class="input-group input-spinner  ">
                  <input type="button" value="-" class="button-minus  btn  btn-sm " data-field="quantity">
                  <input type="number" step="1" max="10" value="1" name="quantity"
                    class="quantity-field form-control-sm form-input   ">
                  <input type="button" value="+" class="button-plus btn btn-sm " data-field="quantity">
                </div>
              </div>
              <!-- price -->
              <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                <span class="fw-bold text-danger">$20.00</span>
                <div class="text-decoration-line-through text-muted small">$26.00</div>
              </div>
            </div>

          </li>
          <!-- list group -->
          <li class="list-group-item py-3 ps-0">
            <!-- row -->
            <div class="row align-items-center">

              <div class="col-6 col-md-6 col-lg-7">
                <div class="d-flex">
                  <img src="{{ asset('images/products/product-img-3.jpg') }}" alt="Ecommerce" class="icon-shape icon-xxl">
                  <div class="ms-3">
                    <!-- title -->
                    <a href="./pages/shop-single.html" class="text-inherit">
                      <h6 class="mb-0">Cadbury 5 Star Chocolate</h6>
                    </a>
                    <span><small class="text-muted">1 kg</small></span>
                    <!-- text -->
                    <div class="mt-2 small lh-1"> <a href="#!" class="text-decoration-none text-inherit"> <span
                          class="me-1 align-text-bottom">
                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-trash-2 text-success">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                            </path>
                            <line x1="10" y1="11" x2="10" y2="17"></line>
                            <line x1="14" y1="11" x2="14" y2="17"></line>
                          </svg></span><span class="text-muted">Remove</span></a></div>
                  </div>
                </div>
              </div>

              <!-- input group -->
              <div class="col-4 col-md-3 col-lg-3">
                <!-- input -->
                <!-- input -->
                <div class="input-group input-spinner  ">
                  <input type="button" value="-" class="button-minus  btn  btn-sm " data-field="quantity">
                  <input type="number" step="1" max="10" value="1" name="quantity"
                    class="quantity-field form-control-sm form-input   ">
                  <input type="button" value="+" class="button-plus btn btn-sm " data-field="quantity">
                </div>
              </div>
              <!-- price -->
              <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                <span class="fw-bold">$15.00</span>
                <div class="text-decoration-line-through text-muted small">$20.00</div>
              </div>
            </div>

          </li>
          <!-- list group -->
          <li class="list-group-item py-3 ps-0">
            <!-- row -->
            <div class="row align-items-center">
              <div class="col-6 col-md-6 col-lg-7">
                <div class="d-flex">
                  <img src="{{ asset('images/products/product-img-4.jpg') }}" alt="Ecommerce" class="icon-shape icon-xxl">
                  <div class="ms-3">
                    <!-- title -->
                    <!-- title -->
                    <a href="./pages/shop-single.html" class="text-inherit">
                      <h6 class="mb-0">Onion Flavour Potato</h6>
                    </a>
                    <span><small class="text-muted">250g</small></span>
                    <!-- text -->
                    <div class="mt-2 small lh-1"> <a href="#!" class="text-decoration-none text-inherit"> <span
                          class="me-1 align-text-bottom">
                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-trash-2 text-success">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                            </path>
                            <line x1="10" y1="11" x2="10" y2="17"></line>
                            <line x1="14" y1="11" x2="14" y2="17"></line>
                          </svg></span><span class="text-muted">Remove</span></a></div>
                  </div>
                </div>
              </div>

              <!-- input group -->
              <div class="col-4 col-md-3 col-lg-3">
                <!-- input -->
                <!-- input -->
                <div class="input-group input-spinner  ">
                  <input type="button" value="-" class="button-minus  btn  btn-sm " data-field="quantity">
                  <input type="number" step="1" max="10" value="1" name="quantity"
                    class="quantity-field form-control-sm form-input   ">
                  <input type="button" value="+" class="button-plus btn btn-sm " data-field="quantity">
                </div>
              </div>
              <!-- price -->
              <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                <span class="fw-bold">$15.00</span>
                <div class="text-decoration-line-through text-muted small">$20.00</div>
              </div>
            </div>

          </li>
          <!-- list group -->
          <li class="list-group-item py-3 ps-0 border-bottom">
            <!-- row -->
            <div class="row align-items-center">
              <div class="col-6 col-md-6 col-lg-7">
                <div class="d-flex">
                  <img src="{{ asset('images/products/product-img-5.jpg') }}" alt="Ecommerce" class="icon-shape icon-xxl">
                  <div class="ms-3">
                    <!-- title -->
                    <a href="./pages/shop-single.html" class="text-inherit">
                      <h6 class="mb-0">Salted Instant Popcorn </h6>
                    </a>
                    <span><small class="text-muted">100g</small></span>
                    <!-- text -->
                    <div class="mt-2 small lh-1"> <a href="#!" class="text-decoration-none text-inherit"> <span
                          class="me-1 align-text-bottom">
                          <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-trash-2 text-success">
                            <polyline points="3 6 5 6 21 6"></polyline>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                            </path>
                            <line x1="10" y1="11" x2="10" y2="17"></line>
                            <line x1="14" y1="11" x2="14" y2="17"></line>
                          </svg></span><span class="text-muted">Remove</span></a></div>
                  </div>
                </div>
              </div>

              <!-- input group -->
              <div class="col-4 col-md-3 col-lg-3">
                <!-- input -->
                <!-- input -->
                <div class="input-group input-spinner  ">
                  <input type="button" value="-" class="button-minus  btn  btn-sm " data-field="quantity">
                  <input type="number" step="1" max="10" value="1" name="quantity"
                    class="quantity-field form-control-sm form-input   ">
                  <input type="button" value="+" class="button-plus btn btn-sm " data-field="quantity">
                </div>
              </div>
              <!-- price -->
              <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                <span class="fw-bold">$15.00</span>
                <div class="text-decoration-line-through text-muted small">$25.00</div>
              </div>
            </div>

          </li>

        </ul>
        <!-- btn -->
        <div class="d-flex justify-content-between mt-4">
          <a href="#!" class="btn btn-primary">Continue Shopping</a>
          <a href="#!" class="btn btn-dark">Update Cart</a>
        </div>

      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-body p-6">
          <div class="d-flex justify-content-between align-items-start ">
            <div>
              <h5 class="mb-1" id="locationModalLabel">Choose your Delivery Location</h5>
              <p class="mb-0 small">Enter your address and we will specify the offer you area. </p>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="my-5">
            <input type="search" class="form-control" placeholder="Search your area">
          </div>
          <div class="d-flex justify-content-between align-items-center mb-2">
            <h6 class="mb-0">Select Location</h6>
            <a href="#" class="btn btn-outline-gray-400 text-muted btn-sm">Clear All</a>


          </div>
          <div>
            <div data-simplebar style="height:300px;">
              <div class="list-group list-group-flush">

                <a href="#"
                  class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action active">
                  <span>Alabama</span><span>Min:$20</span></a>
                <a href="#"
                  class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                  <span>Alaska</span><span>Min:$30</span></a>
                <a href="#"
                  class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                  <span>Arizona</span><span>Min:$50</span></a>
                <a href="#"
                  class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                  <span>California</span><span>Min:$29</span></a>
                <a href="#"
                  class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                  <span>Colorado</span><span>Min:$80</span></a>
                <a href="#"
                  class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                  <span>Florida</span><span>Min:$90</span></a>
                <a href="#"
                  class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                  <span>Arizona</span><span>Min:$50</span></a>
                <a href="#"
                  class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                  <span>California</span><span>Min:$29</span></a>
                <a href="#"
                  class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                  <span>Colorado</span><span>Min:$80</span></a>
                <a href="#"
                  class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 list-group-item-action">
                  <span>Florida</span><span>Min:$90</span></a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>


  <main>
    @yield('content')
  </main>


  <!-- Modal -->
  <div class="modal fade" id="modal-subscribe" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-body p-0">
          <div class="d-flex align-items-center">
            <div class="d-none d-lg-block">
              <img src="{{ asset('images/banner/modal_img.jpg') }}" alt="" class="img-fluid rounded-start">
            </div>
            <div class="px-8 py-8 py-lg-0">
              <div class="position-absolute end-0 top-0 m-6">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <span class="bg-light-danger text-danger badge rounded-pill mb-4 px-4 py-2">7 Day Super Sale
              </span>
              <h2 class="display-6 fw-bold">Discount up to <br><span class="text-primary">50%</span>
              </h2>
              <p class="lead mb-5">Seven day of grate deals - what could be better?</p>

              <div class="d-grid">
                <a href="#" class="btn btn-primary" data-bs-dismiss="modal">Start Show Now</a>
              </div>

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>


  <!-- modal -->
  <!-- Modal -->
  <div class="modal fade" id="quickViewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-body p-8">
          <div class="position-absolute top-0 end-0 me-3 mt-3">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <!-- img slide -->
              <div class="product productModal" id="productModal">
                <div class="zoom" onmousemove="zoom(event)" style="
                  background-image: url({{ asset('images/products/product-single-img-1.jpg') }});
                ">
                  <!-- img -->
                  <img src="{{ asset('images/products/product-single-img-1.jpg') }}" alt="">
                </div>
                <div>
                  <div class="zoom" onmousemove="zoom(event)" style="
                    background-image: url({{ asset('images/products/product-single-img-2.jpg') }});
                  ">
                    <!-- img -->
                    <img src="{{ asset('images/products/product-single-img-2.jpg') }}" alt="">
                  </div>
                </div>
                <div>
                  <div class="zoom" onmousemove="zoom(event)" style="
                    background-image: url({{ asset('images/products/product-single-img-3.jpg') }});
                  ">
                    <!-- img -->
                    <img src="{{ asset('images/products/product-single-img-3.jpg') }}" alt="">
                  </div>
                </div>
                <div>
                  <div class="zoom" onmousemove="zoom(event)" style="
                    background-image: url({{ asset('images/products/product-single-img-4.jpg') }});
                  ">
                    <!-- img -->
                    <img src="{{ asset('images/products/product-single-img-4.jpg') }}" alt="">
                  </div>
                </div>
              </div>
              <!-- product tools -->
              <div class="product-tools">
                <div class="thumbnails row g-3" id="productModalThumbnails">
                  <div class="col-3" class="tns-nav-active">
                    <div class="thumbnails-img">
                      <!-- img -->
                      <img src="{{ asset('images/products/product-single-img-1.jpg') }}" alt="">
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="thumbnails-img">
                      <!-- img -->
                      <img src="{{ asset('images/products/product-single-img-2.jpg') }}" alt="">
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="thumbnails-img">
                      <!-- img -->
                      <img src="{{ asset('images/products/product-single-img-3.jpg') }}" alt="">
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="thumbnails-img">
                      <!-- img -->
                      <img src="{{ asset('images/products/product-single-img-4.jpg') }}" alt="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="ps-lg-8 mt-6 mt-lg-0">
                <a href="#!" class="mb-4 d-block">Bakery Biscuits</a>
                <h2 class="mb-1 h1">Napolitanke Ljesnjak</h2>
                <div class="mb-4">
                  <small class="text-warning">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-half"></i></small><a href="#" class="ms-2">(30 reviews)</a>
                </div>
                <div class="fs-4">
                  <span class="fw-bold text-dark">$32</span>
                  <span class="text-decoration-line-through text-muted">$35</span><span><small
                      class="fs-6 ms-2 text-danger">26% Off</small></span>
                </div>
                <hr class="my-6">
                <div class="mb-4">
                  <button type="button" class="btn btn-outline-secondary">
                    250g
                  </button>
                  <button type="button" class="btn btn-outline-secondary">
                    500g
                  </button>
                  <button type="button" class="btn btn-outline-secondary">
                    1kg
                  </button>
                </div>
                <div>
                  <!-- input -->
                  <!-- input -->
                  <div class="input-group input-spinner  ">
                    <input type="button" value="-" class="button-minus  btn  btn-sm " data-field="quantity">
                    <input type="number" step="1" max="10" value="1" name="quantity"
                      class="quantity-field form-control-sm form-input   ">
                    <input type="button" value="+" class="button-plus btn btn-sm " data-field="quantity">
                  </div>
                </div>
                <div class="mt-3 row justify-content-start g-2 align-items-center">

                  <div class="col-lg-4 col-md-5 col-6 d-grid">
                    <!-- button -->
                    <!-- btn -->
                    <button type="button" class="btn btn-primary">
                      <i class="feather-icon icon-shopping-bag me-2"></i>Add to
                      cart
                    </button>
                  </div>
                  <div class="col-md-4 col-5">
                    <!-- btn -->
                    <a class="btn btn-light" href="#" data-bs-toggle="tooltip" data-bs-html="true"
                      aria-label="Compare"><i class="bi bi-arrow-left-right"></i></a>
                    <a class="btn btn-light" href="#!" data-bs-toggle="tooltip" data-bs-html="true"
                      aria-label="Wishlist"><i class="feather-icon icon-heart"></i></a>
                  </div>
                </div>
                <hr class="my-6">
                <div>
                  <table class="table table-borderless">
                    <tbody>
                      <tr>
                        <td>Product Code:</td>
                        <td>FBB00255</td>
                      </tr>
                      <tr>
                        <td>Availability:</td>
                        <td>In Stock</td>
                      </tr>
                      <tr>
                        <td>Type:</td>
                        <td>Fruits</td>
                      </tr>
                      <tr>
                        <td>Shipping:</td>
                        <td>
                          <small>01 day shipping.<span class="text-muted">( Free pickup today)</span></small>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <!-- footer -->
  <footer class="footer bg-dark pb-6 pt-4 pt-md-12">
    <div class="container">
      <!-- Logo -->
      <div class="row align-items-center ">
        <div class="col-8 col-md-12 col-lg-4">
          <a href="#"><img src="{{ asset('images/logo/freshcart-white-logo.svg') }}" alt=""></a>
        </div>
      </div>
      <!-- Menu Footer -->
      <hr class="my-lg-8 opacity-25">
      <div class="row g-4 ">
        <div class="col-12 col-md-12 col-lg-4">
          <div class="row">
            <div class="col-10">
              <!-- list -->
              Jl. Banyuanyar Selatan No. 4 Rt 002 Rw 012, Banyuanyar, Banjarsari, Surakarta, Jawa Tengah
            </div>
          </div>
        </div>
        <div class="col-12 col-md-12 col-lg-8">
          <div class="row g-4">
            <div class="col-6 col-sm-6 col-md-3">
              <h6 class="mb-4 text-white">Tentang Kami</h6>
              <!-- list -->
              <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Company</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">About</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Blog</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Help Center</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Our Value</a></li>
              </ul>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
              <h6 class="mb-4 text-white">Metode Pembayaran</h6>
              <ul class="nav flex-column">
                <!-- list -->
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Payments</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Shipping</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Product Returns</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">FAQ</a></li>
                <li class="nav-item mb-2"><a href="#!" class="nav-link">Shop Checkout</a></li>
              </ul>
            </div>
            <div class="col-6 col-sm-6 col-md-3">
              <h6 class="mb-4 text-white">Sosial Media Kami</h6>
              <ul class="list-inline text-md-start mb-0 small">
                <li class="list-inline-item me-2">
                  <a href="#!" class="social-links"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                      fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                      <path
                        d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                    </svg></a></li>
                <li class="list-inline-item me-2">
                  <a href="#!" class="social-links"> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                      fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                      <path
                        d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                    </svg></a></li>
                <li class="list-inline-item">
                  <a href="#!" class="social-links"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                      fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                      <path
                        d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z" />
                    </svg></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <hr class="mt-8 opacity-25">
      <!-- Footer copyright -->
      <div>
        <div class="row align-items-center">
          <div class="col-md-6"><span class="small text-muted">© 2022 <span id="copyright"> -
                <script>
                  document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                </script>
              </span> Insan Kamil. All rights reserved. Powered by <a
                href="https://codescandy.com/">Codescandy</a>.</span></div>

        </div>

      </div>

    </div>
  </footer>
  <!-- Javascript-->
  <!-- Libs JS -->
  <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('vendor/simplebar/dist/simplebar.min.js') }}"></script>

  <!-- Theme JS -->
  <script src="{{ asset('js/theme.min.js') }}"></script>
  <script src="{{ asset('vendor/slick-carousel/slick/slick.min.js') }}"></script>
  <script src="{{ asset('js/vendors/slick-slider.js') }}"></script>
  <script src="{{ asset('vendor/tiny-slider/dist/min/tiny-slider.js') }}"></script>
  <script src="{{ asset('js/vendors/tns-slider.js') }}"></script>
  <script src="{{ asset('js/vendors/zoom.js') }}"></script>
  <script src="{{ asset('js/vendors/increment-value.js') }}"></script>
  <script src="{{ asset('vendor/jquery-countdown/dist/jquery.countdown.min.js') }}"></script>
  <script src="{{ asset('js/vendors/countdown.js') }}"></script>
  <script src="{{ asset('vendor/sticky-sidebar/dist/sticky-sidebar.min.js') }}"></script>
  <script src="{{ asset('js/vendors/sticky.js') }}"></script>
  <script src="{{ asset('js/vendors/modal.js') }}"></script>


</body>

</html>