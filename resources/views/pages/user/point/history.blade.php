@extends('layouts.landing.main')

@section('content')
    <section class="my-lg-14 my-8">

        <!-- container -->
        <div class="container">
            <div class="row g-4">
                <!-- col -->
                <div class="offset-lg-2 col-lg-8 col-12">

                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="card text-start border-dashed">
                                <div class="card-body p-0 p-2">
                                    <h5 class="card-title mb-0">Riwayat Redeem</h5>
                                </div>
                            </div>

                            <div class="container mt-5 px-0">
                                <div class="row align-items-stretch px-4">
                                    <div class="col-5 border rounded-start p-2">
                                        <img src="{{ asset('images/point/1.png') }}" style="width: 20px" alt="">
                                        <span class="fw-bold ms-2">{{ $user->total_points }}</span>
                                        <span class="ms-2">Loyalty Point</span>
                                    </div>
                                    <div class="col-7 border rounded-end p-2">
                                        <span class="fw-bold">{{ rupiah($total_order) }}</span>
                                        <span class="ms-2">Setiap Pembelanjaan (1 P. = Rp. 50.000)</span>
                                    </div>
                                </div>

                                <div class="row mt-4 align-items-center">
                                    <table class="table table-bordered" id="table-history">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Reward</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer mt-3"></div>

                        <div class="container mb-5">
                            <div class="card bg-dark" style="height: 200px">
                                <div class="card-body text-center">
                                    <img src="{{ asset('images/point/5.png') }}" class="img-fluid rounded-top mb-4" />

                                    <h5 class="card-title text-light">No debat! Tukarkan Point-nya, Dapatkan Reward-nya
                                    </h5>

                                    <button class="btn btn-info mt-5 rounded-pill btn-info-reward">Info
                                        Reward</button>
                                </div>
                            </div>

                        </div>



                    </div>

                </div>

            </div>
        </div>
    </section>

    {{-- Modal Info Reward --}}
    <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <div class="card w-100">
                        <div class="card-body border-dashed">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="modal-title" id="modalTitleId">
                                    Info Reward
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <h5>Point Rewards</h5>

                        <p>Jazakallahu khairan</p>

                        <p>Kumpulkan Point Reward mu dan tukarkan dengan hadiahnya! Setiap kali kalian berbelanja, akan
                            diberikan poin reward yang bisa dikumpulkan dan ditukarkan dengan hadiah menarik seperti voucher
                            belanja, atau hadiah eksklusif lainnya.</p>

                        <p>Dengan melakukan beberapa hal dibawah ini kamu bisa menambah pundi pundi point yang nantinya
                            ditukarkan dengan hadiah pilihanmu, diantaranya adalah: </p>

                        <ul>
                            <li>
                                Registrasi Akun Gratis
                                <ol>
                                    <li>Buka website dan klik tombol Login With Google untuk registrasi</li>
                                    <li>Isi form profile dengan informasi yang diperlukan, seperti nama lengkap, nomor
                                        telepon, dan alamat pengiriman.</li>
                                    <li>Setelah akun terdaftar, kamu bisa melakukan transaksi pembelian dan akan mendapatkan
                                        Point</li>
                                </ol>
                            </li>
                            <li>Setiap pembelian produk dengan minimal pembelanjaan Rp. 50.000
                                <ol>
                                    <li>Lakukan pembelian produk dengan mencapai minimal pembelanjaan yang ditentukan
                                        <a href="https://new.insankamil.id/" target="_blank">https://insankamil.id/</a>.
                                    </li>
                                    <li>Poin reward akan diberikan secara otomatis setelah pembelian selesai dan produk
                                        telah diterima</li>
                                </ol>
                            </li>
                            <li>Dengan menjadi pelanggan tetap
                                <ol>
                                    <li>Lakukan pembelian produk secara berkala pada <a href="https://insankamil.id/"
                                            target="_blank">https://insankamil.id/</a>
                                        dengan berbagai
                                        macam
                                        product.</li>
                                    <li>Poin reward akan diberikan secara otomatis setiap kali kamu melakukan pembelian,
                                        syarat dan ketentuan yang ditetapkan oleh <a href="https://insankamil.id/"
                                            target="_blank">https://insankamil.id/</a>.
                                    </li>
                                </ol>
                            </li>

                        </ul>

                    </div>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            // Modal Info Reward
            $('.btn-info-reward').click(function() {
                $('#modalId').modal('show');
            });

            // Init DataTable
            $('#table-history').DataTable({
                lengthChange: false,
                ordering: false,
                processing: true,
                ajax: {
                    url: "{{ route('user.point.history') }}",
                    type: "GET",
                },
                columns: [{
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
                        return moment(data).format('DD MMMM YYYY');
                    }
                },
                {
                    targets: 2,
                    className: 'align-middle',
                    data: 'reward.nama',
                    render: function(data, type, row, meta) {
                        return `${data} <br><span class="text-primary" style="font-size: 12px;">${row.reward.point_total.toLocaleString('id-ID')} point</span>`;
                    }
                },
                {
                    targets: 3,
                    className: 'align-middle text-center',
                    data: 'status',
                    render: function(data, type, row, meta) {
                        if (data == 'process') {
                            return `<span class="badge bg-warning">Proses</span>`;
                        } else if (data == 'success') {
                            return `<span class="badge bg-success">Berhasil</span>`;
                        } else {
                            return `<span class="badge bg-danger">Gagal</span>`;
                        }
                    }
                }
            ]
            });

        });
    </script>
@endsection
