@extends('layouts.dashboard.main')

@section('content')
    <main class="main-content-wrapper">
        <div class="container">
            <div class="row mb-8">
                <div class="col-md-12">
                    <!-- page header -->
                    <div class="d-md-flex justify-content-between align-items-center">
                        <div>
                            <h2>Pengguna</h2>
                            <!-- breacrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Pengguna</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- button -->
                        <div>
                            <a href="add-product.html" class="btn btn-primary">Tambah Pengguna</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row ">
                <div class="col-xl-12 col-12 mb-5">
                    <!-- card -->
                    <div class="card h-100 card-lg">

                        <!-- card body -->
                        <div class="card-body p-0">

                            <div class="row pt-5 ps-5">
                                <div class="col-lg-4">
                                    <label for="status">Role</label>
                                    <select name="status" class="form-select">
                                        <option value="selesai">User</option>
                                        <option value="selesai">Admin</option>
                                        <option value="selesai">Superadmin</option>
                                    </select>
                                </div>
                            </div>

                            <div class="table-responsive p-5">
                                <table class="table table-striped" id="produks">
                                    <thead>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama Pengguna</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">No. Telp</th>
                                        <th scope="col">Role</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </thead>
                                    <tbody>
                                        <tr class="">
                                            <td>1</td>
                                            <td>John Doe</td>
                                            <td>admin@admin.com</td>
                                            <td>081 081 081 081</td>
                                            <td>User</td>
                                            <td><span class="badge bg-light-primary text-dark-primary">Aktif</span></td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                       <i class="feather-icon icon-more-vertical fs-5"></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                       <li>
                                                          <a class="dropdown-item" href="#">
                                                             <i class="bi bi-trash me-3"></i>
                                                             Delete
                                                          </a>
                                                       </li>
                                                       <li>
                                                          <a class="dropdown-item" href="#">
                                                             <i class="bi bi-pencil-square me-3"></i>
                                                             Edit
                                                          </a>
                                                       </li>
                                                    </ul>
                                                 </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        {{-- <div class=" border-top d-md-flex justify-content-between align-items-center px-6 py-6">
                            <span>Showing 1 to 8 of 12 entries</span>
                            <nav class="mt-2 mt-md-0">
                                <ul class="pagination mb-0 ">
                                    <li class="page-item disabled"><a class="page-link " href="#!">Previous</a></li>
                                    <li class="page-item"><a class="page-link active" href="#!">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#!">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#!">Next</a></li>
                                </ul>
                            </nav>
                        </div> --}}
                    </div>

                </div>

            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var table = $('#produks').DataTable();
        });
    </script>
@endsection
