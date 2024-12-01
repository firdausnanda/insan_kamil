@extends('layouts.landing.main')

@section('content')
    <section class="my-lg-14 my-8">

        <!-- container -->
        <div class="container">
            <div class="row g-4">
                <!-- col -->
                <div class="offset-lg-2 col-lg-8 col-12">

                    @if (session('error'))    
                        <div class="alert alert-danger" role="alert">
                            <div class="fw-bold">Gagal!</div> 
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="card text-start border-dashed">
                                <div class="card-body p-0 p-2">
                                    <h5 class="card-title mb-0">Redeem Point</h5>
                                </div>
                            </div>

                            <div class="container mt-5">
                                <div class="row align-items-stretch">
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
                                    <div class="col-lg-5">
                                        <img style="max-width: 300px" src="{{ asset('images/point/promo_point.jpg') }}" alt="">
                                    </div>
                                    <div class="col-lg-7">
                                        <h5>Semangat bertransaksi untuk menambah Poin</h5>
                                        <p>Kumpulkan lagi Poinmu dengan banyak melakukan transaksi, bagi pelanggan atau agen
                                            Penerbit Insan Kamil, minimum pembelian Rp50.000 per transaksi akan mendapat 1
                                            Poin. Tukar dan nikmati berbagai reward menarik dari Penerbit Insan Kamil.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer mt-3"></div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h5 class="card-title mb-0">View Rewards Point</h5>
                                </div>
                                <div class="col-lg-6 text-end">
                                    <a href="{{ route('user.point.history') }}"
                                        class="text-secondary text-decoration-underline">View History</a>
                                </div>
                            </div>
                        </div>

                        <div class="container mb-3">
                            <div class="row g-4">
                                @foreach ($reward as $item)
                                    <div class="col-lg-6">
                                        <div class="card border-dashed" style="background-image: url({{ asset('storage/reward/' . $item->gambar) }}); background-size: cover; background-position: center;">
                                            <div class="card-body">
                                                <div class="row align-items-center g-2 justify-content-center">
                                                    <div class="col-lg-3">
                                                        {{-- @if ($item->gambar != '' || $item->gambar != null)
                                                            <img class="img-fluid" style="min-width: 90px"
                                                                src="{{ asset('storage/reward/' . $item->gambar) }}"
                                                                alt="">
                                                        @else
                                                            <img class="img-fluid" style="min-width: 90px"
                                                                src="{{ asset('images/avatar/no-image.png') }}"
                                                                alt="">
                                                        @endif --}}
                                                    </div>
                                                    <div class="col-lg-9 text-center">
                                                        <h5 class="card-title mb-0">{{ strtoupper($item->nama) }}</h5>
                                                        <h6 style="font-size: 15px" class="card-title mb-0">
                                                            {{ $item->deskripsi }}</h6>

                                                        <div class="card border-dashed mt-2 w-50 mx-auto">
                                                            <div class="card-body p-0 py-2">
                                                                <div class="fw-bold">
                                                                    {{ number_format($item->point_total, 0, ',', '.') }}
                                                                </div>
                                                                <div>Points</div>
                                                            </div>
                                                        </div>

                                                        @if ($item->kuota > 0 && $item->point_total <= $user->total_points)
                                                            <button class="btn btn-primary btn-sm w-50 mt-3 btn-redeem"
                                                                data-id="{{ $item->id }}">Redeem</button>
                                                        @elseif ($item->point_total > $user->total_points)
                                                            <button class="btn btn-secondary btn-sm w-50 mt-3"
                                                                disabled>Point Tidak Mencukupi</button>
                                                        @else
                                                            <button class="btn btn-secondary btn-sm w-50 mt-3"
                                                                disabled>Kuota Habis</button>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

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

    {{-- Modal Redeem --}}
    <div class="modal fade" id="modalRedeem" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalRedeemTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalRedeemTitleId">Redeem</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('user.point.redeem.store') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <h6 class="mb-0">Silakan isi form dibawah ini untuk menggunakan poin</h6>
                        <p class="mb-3">Pastikan data yang diisi sudah benar dan sesuai dengan data diri kamu</p>
                        @csrf

                        <input type="hidden" name="id_reward" id="id_reward">

                        <div class="form-group mb-3">
                            <label for="no_rekening">Nomor Rekening Bank</label>
                            <input type="number" name="no_rekening" id="no_rekening" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama_pemilik">Nama Pemilik Rekening</label>
                            <input type="text" name="nama_pemilik" id="nama_pemilik" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="colFormLabel" class="col-sm-4 col-form-label">KK atau KTP</label>
                            <!-- input -->
                            <input type="file" class="upload-berkas-dropify" name="gambar" data-max-file-size="2M"
                                data-allowed-file-extensions="jpg png jpeg" id="berkas"
                                data-errors-position="outside" />

                        </div>


                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Redeem</button>
                    </div>
                </form>

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

            // Modal Redeem
            $('.btn-redeem').click(function() {
                var id = $(this).data('id');
                $('#id_reward').val(id);
                $('#modalRedeem').modal('show');
            });

            // Init Dropify
            if ($('.upload-berkas-dropify')) {
                $('.upload-berkas-dropify').dropify({
                    messages: {
                        'default': '<i class="fa-regular fa-image icon-file"></i> <br> Unggah gambar anda disini <br> <span>  Type: JPG | JPEG | PNG (Max. 2MB) </span> <br> <button class="btn btn-yellow mt-3">Pilih File</button>',
                        'replace': 'Klik untuk mengganti gambar anda',
                        'remove': 'Hapus',
                        'error': 'Ooops, something wrong happended.'
                    },
                });
            }
        });
    </script>
@endsection
