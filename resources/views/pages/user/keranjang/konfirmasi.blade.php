@extends('layouts.landing.main')

@section('content')
    {{-- Konten --}}
    <section class="mt-8">
        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">
                <div class="col-xl-12 col-12 mb-5">
                    <!-- card -->
                    <div class="card h-100 card-lg pb-5">
                        <div class="card-body p-6">
                            <div class="d-md-flex justify-content-between">
                                <div class="d-flex align-items-center mb-2 mb-md-0">
                                    <h2 class="mb-0">Data Pesanan</h2>
                                </div>
                            </div>
                            <div class="mt-8">

                                {{-- Menu Navigation --}}
                                <div class="gap-2" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check btn-status" name="status" id="btnradio1"
                                        value="1" autocomplete="off" checked="">
                                    <label class="btn btn-outline-primary" for="btnradio1">Semua</label>

                                    <input type="radio" class="btn-check btn-status" name="status" id="btnradio2"
                                        value="2" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btnradio2">Menunggu Pembayaran</label>

                                    <input type="radio" class="btn-check btn-status" name="status" id="btnradio3"
                                        value="3" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btnradio3">Pengemasan</label>

                                    <input type="radio" class="btn-check btn-status" name="status" id="btnradio4"
                                        value="4" autocomplete="off">
                                    <label class="btn btn-outline-primary" for="btnradio4">Dikirim</label>

                                </div>

                                <div class="table-responsive mt-5">
                                    <table class="table table-striped w-100" id="konfirmasi">
                                        <thead>
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">Tanggal Transaksi</th>
                                                <th scope="col">Total Transaksi</th>
                                                <th scope="col">Status Transaksi</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>


                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">

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
            var table = $('#konfirmasi').DataTable({
                lengthChange: false,
                ordering: false,
                processing: true,
                ajax: {
                    url: "{{ route('user.order.konfirmasi') }}",
                    type: "GET",
                    data: function(d) {
                        d.id_user = "{{ Auth::user()->id }}";
                        d.status = $("input[type='radio'][name='status']:checked").val();
                    }
                },
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
                        data: 'created_at',
                        render: function(data, type, row, meta) {
                            if (data)
                                return `${moment(row.created_at).format('DD-MM-YYYY', 'de')} <br> <i>${moment(row.created_at).format('hh:mm:ss', 'de')}`
                            return `-`
                        }
                    },
                    {
                        targets: 2,
                        className: 'align-middle',
                        render: function(data, type, row, meta) {
                            if (row.pembayaran_sum_harga_jual) {
                                return $.fn.dataTable.render.number('.', ',', 0, 'Rp ', ',-')
                                    .display(row.pembayaran_sum_harga_jual)
                            }else{
                                return 0
                            }
                        }
                    },
                    {
                        targets: 3,
                        className: 'align-middle',
                        data: 'status',
                        render: function(data, type, row, meta) {
                            switch (data) {
                                case '1':
                                    return '<span class="badge bg-warning">Menunggu Pembayaran</span>'
                                    break;
                                case '2':
                                    return '<span class="badge bg-primary">Sudah Dibayar</span>'
                                    break;
                                case '3':
                                    return '<span class="badge bg-primary">Pengemasan</span>'
                                    break;
                                case '4':
                                    return '<span class="badge bg-info">Proses Pengiriman</span>'
                                    break;
                                case '5':
                                    return '<span class="badge bg-success">Selesai</span>'
                                    break;
                                case '6':
                                    return '<span class="badge bg-danger">Gagal / Kadaluarsa</span>'
                                    break;

                                default:
                                    break;
                            }
                        }
                    },
                    {
                        targets: 4,
                        className: 'align-middle',
                        render: function(data, type, row, meta) {
                            return '<button class="btn btn-info btn-detail btn-sm">Detail</button>';
                        }
                    },
                ]
            });

            // Filter
            $('input:radio').change(function() {
                var radioClicked = $(this).attr('id');
                table.ajax.reload();
            });

            // Detail
            $('#konfirmasi tbody').on('click', '.btn-detail', function(event) {
                event.preventDefault();

                var data = table.row($(this).parents('tr')).data();

                var link = "{{ route('user.order.detail_konfirmasi', ':id') }}"
                var url = link.replace(':id', data.id);

                location.href = url;
            });

        });
    </script>
@endsection
