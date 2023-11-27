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
                            <li class="breadcrumb-item"><a href="{{ route('landing.home') }}">Home</a></li>

                            <li class="breadcrumb-item active" aria-current="page">Keranjang</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{-- Konten --}}
    <section class="mt-8">
        <div class="container">
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
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Produk</th>
                                        <th scope="col">Berat</th>
                                        <th scope="col">Harga</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Total</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row px-5 pb-5">
                                <div class="col">
                                    <button class="btn btn-secondary"><i class="fa-solid fa-arrow-left me-2"></i> Lanjutkan
                                        Belanja</button>
                                </div>
                                <div class="col d-flex justify-content-end">
                                    <button class="btn btn-primary btn-checkout"><i
                                            class="fa-solid fa-cart-shopping me-2"></i>
                                        Checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            // Init Datatable
            var table = $('#produks').DataTable({
                lengthChange: false,
                ordering: false,
                ajax: {
                    url: "{{ route('user.keranjang.index') }}",
                    type: "GET",
                    data: function(d) {
                        d.id_user = "{{ Auth::user()->id }}"
                    }
                },
                processing: true,
                paginate: false,
                info: false,
                buttons: [{
                    className: 'btn btn-success btn-sm btn-export',
                    text: '<i class="fa-regular fa-floppy-disk"></i> Simpan Perubahan',
                    action: function(e, dt, button, config) {
                        var data = table.$('input, select').serialize();
                        console.log(data);
                    }
                }],
                columnDefs: [{
                        width: '3%',
                        targets: 0,
                        className: 'select-checkbox align-middle',
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return '<input type="text" name="' + data + '" value="' + data +
                                '" hidden>';
                        }
                    },
                    {
                        targets: 1,
                        className: 'align-middle',
                        data: 'produk.gambar_produk',
                        render: function(data, type, row, meta) {
                            if (data == '' || data == null) {
                                return `<img src="{{ asset('images/avatar/no-image.png') }}}" alt="" class="avatar rounded-circle me-2" /> ${row.produk.nama_produk}`
                            } else {
                                return `<img src="{{ asset('storage/produk/${row.produk.gambar_produk[0].gambar}') }}" alt="" class="avatar rounded-circle me-2" /> ${row.produk.nama_produk}`
                            }
                        }
                    },
                    {
                        targets: 2,
                        className: 'align-middle text-center',
                        data: 'produk.berat_produk',
                        render: function(data, type, row, meta) {
                            if (data == '') return '-'
                            return data
                        }
                    },
                    {
                        targets: 3,
                        className: 'align-middle text-center',
                        data: 'produk.harga.harga_akhir',
                        render: function(data, type, row, meta) {
                            if (data == '') return '-'
                            return $.fn.dataTable.render.number('.', ',', 0, 'Rp ', ',-').display(
                                data)
                        }
                    },
                    {
                        targets: 4,
                        className: 'align-middle text-center',
                        data: 'jumlah_produk',
                        render: function(data, type, row, meta) {
                            return `<input type="number" class="form-control form-control-sm jumlah" value='${data}'>`;
                        }
                    },
                    {
                        targets: 5,
                        className: 'align-middle text-center',
                        render: function(data, type, row, meta) {
                            return $.fn.dataTable.render.number('.', ',', 0, 'Rp ', ',-').display(
                                `${row.produk.harga.harga_akhir * row.jumlah_produk}`)
                        }
                    },
                ],
                select: {
                    style: 'multi',
                    selector: 'td:first-child',
                    blurable: false,
                },
                initComplete: function() {
                    $('#produks').DataTable().buttons().container().appendTo(
                        '#produks_wrapper .col-md-6:eq(0)');
                    $('.btn-export').removeClass("btn-secondary");
                },
            });

            // Edit Jumlah
            $('#produks .dt-buttons').on('click', '.btn-export', function(event) {
                event.preventDefault();
                var data = table.row($(this).parents('tr')).data();
            });

            // Checkout Action
            $('.btn-checkout').click(function(e) {
                e.preventDefault();
                storeCheckout()
            });

            // Store Checkout
            function storeCheckout() {
                var data = table.rows({
                    selected: true
                }).data();

                var dataProduk = [];

                for (var i = 0; i < data.length; i++) {
                    dataProduk.push({
                        id_keranjang: data[i].id,
                        id_produk: data[i].id_produk,
                        id_user: data[i].id_user,
                        jumlah: data[i].jumlah_produk,
                        berat_produk: data[i].produk.berat_produk,
                        harga: data[i].produk.harga.harga_akhir,
                    });
                }


                if (data.length > 0) {

                    // Store Temp Order
                    $.ajax({
                        type: "POST",
                        url: "{{ route('user.order.temp') }}",
                        data: {
                            dataProduk: dataProduk,
                            id_user: "{{ Auth::user()->id }}"
                        },
                        dataType: "JSON",
                        beforeSend: function() {
                            $.LoadingOverlay('show');
                        },
                        success: function(response) {
                            $.LoadingOverlay('hide');
                            if (response.meta.status == "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: "Sukses!",
                                    text: response.meta.message,
                                }).then((result) => {
                                    location.href = "{{ route('user.order.index') }}"
                                });
                            }
                        },
                        error: function(response) {
                            $.LoadingOverlay('hide');
                            Swal.fire('Gagal!', 'Periksa kembali data anda.', 'error');
                        },
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Pilih minimal 1 data!',
                    });
                }
            };
        });
    </script>
@endsection
