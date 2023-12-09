@extends('layouts.dashboard.main')

@section('content')
    <main class="main-content-wrapper">
        <div class="container">
            <div class="row mb-8">
                <div class="col-md-12">
                    <!-- page header -->
                    <div class="d-md-flex justify-content-between align-items-center">
                        <div>
                            <h2>Produk</h2>
                            <!-- breacrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Produk</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- button -->
                        <div>
                            <a href="{{ route('admin.produk.create') }}" class="btn btn-primary">Tambah Produk</a>
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
                                    <label for="kategori">Kategori</label>
                                    <select id="kategori" class="form-select">
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="table-responsive p-5">
                                <table class="table table-striped" id="produks">
                                    <thead>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Kategori Produk</th>
                                        <th scope="col">Harga</th>
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

            // Filter
            $('#kategori').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Kategori --',
            });

            // Init Datatable
            var table = $('#produks').DataTable({
                ajax: {
                    url: "{{ route('admin.produk.index') }}",
                    type: "GET",
                    data: function(d) {
                        d.kategori = $('#kategori').val()
                    }
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
                        data: 'nama_produk',
                    },
                    {
                        targets: 2,
                        className: 'align-middle text-center',
                        data: 'kategori.nama_kategori',
                    },
                    {
                        targets: 3,
                        className: 'align-middle text-center',
                        data: 'harga.harga_akhir',
                        render: function(data, type, row, meta) {
                            return $.fn.dataTable.render.number('.', ',', 0, 'Rp ', ',-').display(
                                data)
                        }
                    },
                    {
                        targets: 4,
                        className: 'align-middle text-center',
                        data: 'status',
                        render: function(data, type, row, meta) {
                            if (data == 1) {
                                return `<span class="badge bg-light-primary text-dark-primary">Aktif</span>`
                            } else if (data == 2) {
                                return `<span class="badge bg-light-danger text-dark-danger">Tidak Aktif</span>`
                            } else {
                                return `<span class="badge bg-light-info text-dark-info">Draft</span>`
                            }
                        }
                    },
                    {
                        targets: 5,
                        className: 'align-middle text-center',
                        data: 'id',
                        render: function(data, type, row, meta) {

                            var link = "{{ route('admin.produk.edit', ':id') }}";
                            link = link.replace(':id', data);

                            return `<div class="dropdown">
                                        <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="feather-icon icon-more-vertical fs-5"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="${link}">
                                                    <i class="bi bi-pencil-square me-3"></i>
                                                    Edit
                                                </a>
                                            </li>
                                        </ul>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <i class="bi bi-pencil-square me-3"></i>
                                                    Non Aktifkan
                                                </a>
                                            </li>
                                        </ul>
                                    </div>`;
                        }
                    },
                ]
            });

            // Filter
            $('#kategori').change(function(e) {
                e.preventDefault();
                table.ajax.reload()
            });
        });
    </script>
@endsection
