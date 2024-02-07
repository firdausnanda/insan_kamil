@extends('layouts.dashboard.main')

@section('content')
    <main class="main-content-wrapper">
        <div class="container">
            <div class="row mb-8">
                <div class="col-md-12">
                    <!-- page header -->
                    <div class="d-md-flex justify-content-between align-items-center">
                        <div>
                            <h2>Blog</h2>
                            <!-- breacrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Blog</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- button -->
                        <div>
                            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">Tambah Blog</a>
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

                            <div class="table-responsive p-5">
                                <table class="table table-striped" id="produks">
                                    <thead>
                                        <th scope="col">No.</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Init Datatable 
            var table = $('#produks').DataTable({
                ajax: {
                    url: "{{ route('admin.blog.index') }}",
                    type: "GET"
                },
                lengthChange: false,
                ordering: false,
                processing: true,
                columnDefs: [{
                        targets: 0,
                        width: '10%',
                        className: 'align-middle text-center',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        targets: 1,
                        className: 'align-middle',
                        data: 'judul',
                    },
                    {
                        targets: 2,
                        className: 'align-middle',
                        data: 'status',
                        render: function(data, type, row, meta) {
                            if (data == 1) return '<span class="badge bg-primary">Aktif</span>'
                            return '<span class="badge bg-danger">Tidak Aktif</span>'
                        }
                    },
                    {
                        targets: 3,
                        className: 'align-middle text-center',
                        data: 'status',
                        render: function(data, type, row, meta) {
                            if (data == 1) {
                                return `<div class="dropdown">
                                            <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="feather-icon icon-more-vertical fs-5"></i>
                                            </a>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <button class="dropdown-item btn-edit" type="button">
                                                        <i class="bi bi-pencil-square me-3"></i>
                                                        Edit
                                                    </button>
                                                </li>
                                                <li>
                                                    <button class="dropdown-item btn-aktif" type="button">
                                                        <i class="bi bi-lock me-3"></i>
                                                        Non - Aktifkan
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>`;
                            }
                            return `<div class="dropdown">
                                                <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="feather-icon icon-more-vertical fs-5"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <button class="dropdown-item btn-edit" type="button">
                                                            <i class="bi bi-pencil-square me-3"></i>
                                                            Edit
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item btn-aktif" type="button">
                                                            <i class="bi bi-lock me-3"></i>
                                                            Aktifkan
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>`;
                        }
                    },
                ]
            });

            // Modal Edit
            $('#produks tbody').on('click', '.btn-edit', function(event) {
                event.preventDefault();

                var data = table.row($(this).parents('tr')).data();
                var id = data.id;

                link = "{{ route('admin.blog.edit', ':id') }}"
                url = link.replace(':id', id)

                location.href = url
            });
            
            // Modal Edit
            $('#produks tbody').on('click', '.btn-aktif', function(event) {
                event.preventDefault();

                var data = table.row($(this).parents('tr')).data();
                var id = data.id;
                var status = data.status;

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.blog.aktif') }}",
                    data: {
                        id: data.id,
                        status: data.status
                    },
                    dataType: "JSON",
                    beforeSend: function (){
                        $.LoadingOverlay('show');
                    },
                    success: function (response) {
                        $.LoadingOverlay('hide');
                        table.ajax.reload()
                        Swal.fire('Sukses', 'Data berhasil diubah', 'success')
                    }
                });
            });
        });
    </script>
@endsection
