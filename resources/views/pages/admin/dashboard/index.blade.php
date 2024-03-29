@extends('layouts.dashboard.main')

@section('content')
    <main class="main-content-wrapper">
        <section class="container">
            <!-- row -->
            <div class="row mb-8">
                <div class="col-md-12">
                    <!-- card -->
                    <div class="card bg-light border-0 rounded-4"
                        style="background-image: url({{ asset('images/slider/slider-image') }}-1.jpg); background-repeat: no-repeat; background-size: cover; background-position: right;">
                        <div class="card-body p-lg-12">
                            <h2>Selamat Datang Kembali!
                            </h2>
                            <p>{{ strip_tags($quote) }}.</p>
                            <a href="{{ route('admin.produk.index') }}" class="btn btn-primary">
                                Create Product
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- table -->

            <div class="row">
                <div class="col-lg-4 col-12 mb-6">
                    <!-- card -->
                    <div class="card h-100 card-lg">
                        <!-- card body -->
                        <div class="card-body p-6">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-6">
                                <div>
                                    <h4 class="mb-0 fs-5">Transaksi</h4>
                                </div>
                                <div class="icon-shape icon-md bg-light-danger text-dark-danger rounded-circle">
                                    <i class="bi bi-currency-dollar fs-5"></i>
                                </div>
                            </div>
                            <!-- project number -->
                            <div class="lh-1">
                                <h1 class=" mb-2 fw-bold fs-2">{{ rupiah($total_transaksi) }}</h1>
                                <span>Total Transaksi Bulan ini</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 mb-6">
                    <!-- card -->
                    <div class="card h-100 card-lg">
                        <!-- card body -->
                        <div class="card-body p-6">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-6">
                                <div>
                                    <h4 class="mb-0 fs-5">Order</h4>
                                </div>
                                <div class="icon-shape icon-md bg-light-warning text-dark-warning rounded-circle">
                                    <i class="bi bi-cart fs-5"></i>
                                </div>
                            </div>
                            <!-- project number -->
                            <div class="lh-1">
                                <h1 class=" mb-2 fw-bold fs-2">{{ $jumlah_order->count() }}</h1>
                                <span><span class="text-dark me-1">{{ $jumlah_order_bulan_ini }}+</span>Bulan ini</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12 mb-6">
                    <!-- card -->
                    <div class="card h-100 card-lg">
                        <!-- card body -->
                        <div class="card-body p-6">
                            <!-- heading -->
                            <div class="d-flex justify-content-between align-items-center mb-6">
                                <div>
                                    <h4 class="mb-0 fs-5">Customer</h4>
                                </div>
                                <div class="icon-shape icon-md bg-light-info text-dark-info rounded-circle">
                                    <i class="bi bi-people fs-5"></i>
                                </div>
                            </div>
                            <!-- project number -->
                            <div class="lh-1">
                                <h1 class=" mb-2 fw-bold fs-2">{{ $customer->count() }}</h1>
                                <span><span class="text-dark me-1">{{ $customer_bulan_ini }}+</span>Customer baru bulan
                                    ini</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- row -->
            <div class="row ">
                <div class="col-xl-8 col-lg-6 col-md-12 col-12 mb-6">
                    <!-- card -->
                    <div class="card h-100 card-lg">
                        <div class="card-body p-6">
                            <!-- heading -->
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="mb-1 fs-5">Pendapatan </h3>
                                    <small>({{ $persentase_transaksi[1] . $persentase_transaksi[0] }}%) dibanding tahun
                                        lalu)</small>
                                </div>
                                <div>
                                    <!-- select option -->
                                    {{-- <select class="form-select ">
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                        <option value="2023" selected>2023</option>
                                    </select> --}}
                                </div>

                            </div>
                            <!-- chart -->
                            <div id="revenueChart" class="mt-6"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-12 mb-6">
                    <!-- card -->
                    <div class="card h-100 card-lg">
                        <!-- card body -->
                        <div class="card-body p-6">
                            <!-- heading -->
                            <h3 class="mb-0 fs-5">Total Penjualan </h3>
                            <div id="totalSale" class="mt-6 d-flex justify-content-center"></div>
                            <div class="mt-4">
                                <!-- list -->
                                {{-- <ul class="list-unstyled mb-0">
                                    <li class="mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="8"
                                            fill="currentColor" class="bi bi-circle-fill text-primary" viewBox="0 0 16 16">
                                            <circle cx="8" cy="8" r="8" />
                                        </svg> <span class="ms-1"><span class="text-dark">Produk
                                                6000</span> (2%)</span></li>
                                    <li class="mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="8"
                                            fill="currentColor" class="bi bi-circle-fill text-warning" viewBox="0 0 16 16">
                                            <circle cx="8" cy="8" r="8" />
                                        </svg> <span class="ms-1"><span class="text-dark">Order 1000</span>
                                            (11%)</span></li>
                                    <li class="mb-2"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="8"
                                            fill="currentColor" class="bi bi-circle-fill text-danger" viewBox="0 0 16 16">
                                            <circle cx="8" cy="8" r="8" />
                                        </svg> <span class="ms-1"><span class="text-dark">Terjual
                                                600</span>
                                            (1%)</span></li>
                                </ul> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- row -->
            <div class="row ">
                <div class="col-xl-12 col-lg-12 col-md-12 col-12 mb-6">
                    <div class="card h-100 card-lg">
                        <!-- heading -->
                        <div class="p-6">
                            <h3 class="mb-0 fs-5">Transaksi Terbaru</h3>
                        </div>
                        <div class="card-body">
                            <!-- table -->
                            <div class="table-responsive">
                                <table class="table table-centered table-borderless text-nowrap table-hover w-100"
                                    id="transaksi">
                                    <thead class="bg-light">
                                        <tr>
                                            <th scope="col">ID Transaksi</th>
                                            <th scope="col">Nama Pelanggan</th>
                                            <th scope="col">Tanggal Order</th>
                                            <th scope="col">Total Transaksi</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            // Init Datatable
            var table = $('#transaksi').DataTable({
                ajax: {
                    url: "{{ route('admin.index') }}",
                    type: "GET"
                },
                lengthChange: false,
                ordering: false,
                processing: true,
                iDisplayLength: 7,
                columnDefs: [{
                        targets: 0,
                        className: 'align-middle',
                        data: 'no_invoice',
                    },
                    {
                        targets: 1,
                        className: 'align-middle text-center',
                        data: 'user.name'
                    },
                    {
                        targets: 2,
                        className: 'align-middle text-center',
                        data: 'created_at',
                        render: function(data, type, row, meta) {
                            return `${moment(data).format('DD-MM-YYYY')}`;
                        }
                    },
                    {
                        targets: 3,
                        className: 'align-middle text-center',
                        data: 'pembayaran[0].harga_jual',
                        render: function(data, type, row, meta) {
                            return $.fn.dataTable.render.number('.', ',', 0, 'Rp ', ',-')
                                .display(data);
                        }
                    },
                    {
                        targets: 4,
                        className: 'align-middle text-center',
                        data: 'status',
                        render: function(data, type, row, meta) {
                            var nilai = '';
                            switch (data) {
                                case '2':
                                    nilai =
                                        `<span class="badge bg-light-danger text-dark-danger">Belum Diproses</span>`
                                    break;
                                case '3':
                                    nilai =
                                        `<span class="badge bg-light-info text-dark-info">Pengemasan</span>`
                                    break;
                                case '4':
                                    nilai =
                                        `<span class="badge bg-light-warning text-dark-warning">Proses Pengiriman</span>`
                                    break;
                                case '5':
                                    nilai =
                                        `<span class="badge bg-light-primary text-dark-primary">Selesai</span>`
                                    break;

                                default:
                                    nilai =
                                        `<span class="badge bg-light-danger text-dark-danger">-</span>`
                                    break;
                            }
                            // console.log(nilai);

                            return nilai;
                        }
                    },
                    {
                        targets: 5,
                        className: 'align-middle text-center',
                        render: function(data, type, row, meta) {
                            return `<button class="btn btn-sm btn-primary btn-detail"><i class="fa-solid fa-magnifying-glass"></i></button>`;
                        }
                    },
                ]
            });

            // btn detail
            $('#transaksi tbody').on('click', '.btn-detail', function(e) {
                e.preventDefault();

                let data = table.row($(this).parents('tr')).data();

                let url = `{{ route('admin.order.detail', ':id') }}`;
                let link = url.replace(':id', data.id)

                location.href = link
            });

            // Chart Pendapatan
            $.ajax({
                type: "GET",
                url: "{{ route('admin.index') }}",
                dataType: "JSON",
                data: {
                    chart: 1
                },
                success: function(response) {

                    // Option Pendapatan
                    let pendapatan = {
                        series: [{
                            name: "Total Income",
                            data: [31, 40, 28, 51, 42, 67, 100]
                        }],
                        labels: ["Jan", "Feb", "March", "April", "May", "Jun", "Jul", "Aug", "Sep",
                            "Oct",
                            "Nov", "Dec"
                        ],
                        chart: {
                            height: 350,
                            type: "area",
                            toolbar: {
                                show: !1
                            }
                        },
                        dataLabels: {
                            enabled: !1
                        },
                        markers: {
                            size: 5,
                            hover: {
                                size: 6,
                                sizeOffset: 3
                            }
                        },
                        colors: ["#0aad0a"],
                        stroke: {
                            curve: "smooth",
                            width: 2
                        },
                        grid: {
                            borderColor: window.theme.gray300
                        },
                        xaxis: {
                            labels: {
                                show: !0,
                                align: "right",
                                minWidth: 0,
                                maxWidth: 160,
                                style: {
                                    fontSize: "12px",
                                    fontWeight: 400,
                                    colors: [window.theme.gray600],
                                    fontFamily: '"Inter", "sans-serif"'
                                }
                            },
                            axisBorder: {
                                show: !0,
                                color: window.theme.gray300,
                                height: 1,
                                width: "100%",
                                offsetX: 0,
                                offsetY: 0
                            },
                            axisTicks: {
                                show: !0,
                                borderType: "solid",
                                color: window.theme.gray300,
                                height: 6,
                                offsetX: 0,
                                offsetY: 0
                            }
                        },
                        legend: {
                            position: "top",
                            fontWeight: 600,
                            color: window.theme.gray600,
                            markers: {
                                width: 8,
                                height: 8,
                                strokeWidth: 0,
                                strokeColor: "#fff",
                                fillColors: void 0,
                                radius: 12,
                                customHTML: void 0,
                                onClick: void 0,
                                offsetX: 0,
                                offsetY: 0
                            },
                            labels: {
                                colors: window.theme.gray600,
                                useSeriesColors: !1
                            }
                        },
                        yaxis: {
                            labels: {
                                formatter: function(e) {
                                    return e + "k"
                                },
                                show: !0,
                                align: "right",
                                minWidth: 0,
                                maxWidth: 160,
                                style: {
                                    fontSize: "12px",
                                    fontWeight: 400,
                                    colors: window.theme.gray600,
                                    fontFamily: '"Inter", "sans-serif"'
                                }
                            }
                        }
                    }

                    let bulan = []
                    let totalTransaksi = []
                    $.each(response.data, function(i, v) {
                        bulan.push(v['bulan'])
                        totalTransaksi.push(v['total'])
                    });

                    pendapatan['labels'] = bulan
                    pendapatan.series[0].data = totalTransaksi

                    // Init Chart Pendapatan
                    var chartPendapatan = new ApexCharts(document.querySelector("#revenueChart"),
                        pendapatan);
                    chartPendapatan.render();
                }
            });

            // Chart Penjualan
            $.ajax({
                type: "GET",
                url: "{{ route('admin.index') }}",
                dataType: "JSON",
                data: {
                    chart: 2
                },
                success: function(response) {

                    // Option Pendapatan
                    let penjualan = {
                        series: [6e3, 1e3, 600],
                        labels: ["Total Order", "Pengemasan", "Pengiriman", "Selesai"],
                        colors: ["#0aad0a", "#ffc107", "#db3030"],
                        chart: {
                            type: "donut",
                            height: 280
                        },
                        legend: {
                            show: !1
                        },
                        dataLabels: {
                            enabled: !1
                        },
                        plotOptions: {
                            pie: {
                                donut: {
                                    size: "85%",
                                    background: "transparent",
                                    labels: {
                                        show: !0,
                                        name: {
                                            show: !0,
                                            fontSize: "22px",
                                            fontFamily: '"Inter", "sans-serif"',
                                            fontWeight: 600,
                                            colors: [window.theme.gray600],
                                            offsetY: -10,
                                            formatter: function(e) {
                                                return e
                                            }
                                        },
                                        value: {
                                            show: !0,
                                            fontSize: "24px",
                                            fontFamily: '"Inter", "sans-serif"',
                                            fontWeight: 800,
                                            colors: window.theme.gray800,
                                            offsetY: 8,
                                            formatter: function(e) {
                                                return e
                                            }
                                        },
                                        total: {
                                            show: !0,
                                            showAlways: !1,
                                            label: "Total Penjualan",
                                            fontSize: "16px",
                                            fontFamily: '"Inter", "sans-serif"',
                                            fontWeight: 400,
                                            colors: window.theme.gray400,
                                            formatter: function(e) {
                                                return e.globals.seriesTotals.reduce((e, r) =>
                                                    e + r, 0)
                                            }
                                        }
                                    }
                                }
                            }
                        },
                        stroke: {
                            width: 0
                        },
                        responsive: [{
                            breakpoint: 1400,
                            options: {
                                chart: {
                                    type: "donut",
                                    width: 290,
                                    height: 330
                                }
                            }
                        }]
                    }

                    let status = []
                    let total = []
                    
                    $.each(response.data, function(i, v) {
                        status.push(v['status'])
                        total.push(parseInt(v['total']))
                    });

                    penjualan.series = total
                    penjualan.labels = status

                    // Init Chart Pendapatan
                    var chartPenjualan = new ApexCharts(document.querySelector("#totalSale"),
                        penjualan);
                    chartPenjualan.render();

                    console.log(response);
                }
            });

            window.theme = theme
        });
    </script>
@endsection
