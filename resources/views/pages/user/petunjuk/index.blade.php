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
                                    <h2 style="font-size: 20px;" class="mb-0">Petunjuk Penggunaan Sistem E-Commerce Penerbit
                                        Insan Kamil</h2>
                                </div>
                            </div>
                            <div class="mt-8">
                                <div class="accordion" id="petunjukAccordion">

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                <b>A. Keanggotaan</b>
                                            </button>
                                        </h2>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#petunjukAccordion">
                                            <div class="accordion-body">
                                                <p>Keanggotaan pada sistem e-commerce Penerbit Insan Kamil terbagi menjadi
                                                    dua jenis :</p>
                                                <ol>

                                                    <li class="fw-bold">Member</li>
                                                    <p>Siapa saja yang mendaftar secara resmi sebagai pelanggan di
                                                        website resmi https://insankamil.id/..</p>

                                                    <li class="fw-bold">Agent Insan Kamil</li>
                                                    <ol type="a">
                                                        <li>Member yang berkomitmen untuk menjual produk-produk terbitan
                                                            Penerbit Insan Kamil sesuai dengan syarat dan ketentuan yang
                                                            telah ditetapkan</li>
                                                        <li>Berhak mendapatkan keuntungan berupa diskon sesuai jenjang
                                                            keanggotaan</li>
                                                    </ol>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTwo">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                aria-expanded="false" aria-controls="collapseTwo">
                                                <b>B. Akad Terkait Jual Beli</b>
                                            </button>
                                        </h2>
                                        <div id="collapseTwo" class="accordion-collapse collapse"
                                            aria-labelledby="headingTwo" data-bs-parent="#petunjukAccordion">
                                            <div class="accordion-body">
                                                <ol>
                                                    <li class="fw-bold">Distributor</li>
                                                    <ol type="a">
                                                        <li>Distributor adalah Agen Insan Kamil aktif yang memiliki stok
                                                            produk di toko/gudang pribadi untuk dijual langsung ke konsumen
                                                        </li>
                                                        <li>Keuntungan diperoleh dari selisih (potongan diskon Agen Insan
                                                            Kamil) antara harga beli dan harga jual.</li>
                                                    </ol>
                                                    <li class="fw-bold">Dropshipper</li>
                                                    <ol type="a">
                                                        <li>
                                                            Dropshipper adalah Agen Insan Kamil aktif yang menjadi wakil
                                                            untuk menjualkan produk-produk Insan Kamil sesuai syarat dan
                                                            ketentuan.
                                                        </li>
                                                        <li>
                                                            Tidak perlu memiliki stok barang sendiri.
                                                        </li>
                                                        <li>
                                                            Dapat mempromosikan produk-produk Insan Kamil dan mendapatkan
                                                            keuntungan berupa potongan diskon sesuai syarat dan ketentuan.
                                                        </li>
                                                        <li>
                                                            Dropshipper menerima pembayaran dari konsumen, kemudian
                                                            diteruskan ke Insan Kamil dipotong dengan nominal diskon yang
                                                            sudah didadapatkan dari Insan Kamil, yang mana nominal diskon
                                                            itulah keuntungan yang didapat dropshipper atas penjualan produk
                                                            Kamil. Produk dikirimkan langsung dari gudang Insan Kamil ke
                                                            alamat
                                                            konsumen (pengirim boleh menggunakan nama/toko pribadi di label
                                                            pengiriman).
                                                        </li>

                                                    </ol>

                                                </ol>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingThree">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                aria-expanded="false" aria-controls="collapseThree">
                                                <b>C. Ketentuan Keanggotaan</b>
                                            </button>
                                        </h2>
                                        <div id="collapseThree" class="accordion-collapse collapse"
                                            aria-labelledby="headingThree" data-bs-parent="#petunjukAccordion">
                                            <div class="accordion-body">
                                                <p>Siapa pun dapat bergabung menjadi Agen Aktif Insan Kamil apabila memenuhi
                                                    kriteria berikut:</p>
                                                <ol>
                                                    <li>
                                                        Melengkapi data pendaftaran pada platform e-commerce Penerbit Insan
                                                        Kamil.
                                                    </li>
                                                    <li>
                                                        Memiliki riwayat penjualan yang konsisten, seperti menjual minimal
                                                        10 produk dalam periode tertentu.
                                                    </li>
                                                    <li>
                                                        Serius dan memiliki kemauan tinggi untuk menjual serta mempromosikan
                                                        produk-produk Insan Kamil (buku dan media edukasi).
                                                    </li>

                                                    <li>
                                                        Mampu melakukan promosi melalui media sosial, marketplace, atau
                                                        jaringan pribadi.
                                                    </li>

                                                    <li>
                                                        Bersedia meluangkan waktu untuk menjalankan aktivitas sebagai agen,
                                                        termasuk promosi, penjualan, dan pelayanan pelanggan.
                                                    </li>

                                                    <li>
                                                        Komitmen dan bersedia mencapai target penjualan tertentu per bulan
                                                        atau per tahun (jika diberlakukan).
                                                    </li>

                                                    <li>
                                                        Terbukti aktif menjual dan mempromosikan produk selama tiga bulan
                                                        pertama.
                                                    </li>
                                                    <li>
                                                        Diperbolehkan mempromosikan produk Insan Kamil melalui media online
                                                        atau offline menggunakan materi promosi resmi dari Insan Kamil
                                                        ataupun kreasi sendiri sesuai ketentuan hukum yang berlaku.
                                                    </li>
                                                    <li>
                                                        Dilarang melakukan tindakan yang mengarah pada spekulasi atau
                                                        mempermainkan stok tanpa transaksi.
                                                    </li>
                                                    <li>
                                                        Pencapaian Target Bonus:
                                                        <ol type="a">
                                                            <li>
                                                                Agen Member dapat disertakan target tertentu, seperti
                                                                pencapaian reward loyalty point atau bonus penjualan bulanan
                                                                (opsional).
                                                            </li>
                                                        </ol>
                                                    <li>
                                                        Mematuhi aturan dan kebijakan e-commerce Penerbit Insan Kamil,
                                                        termasuk:
                                                        <ol type="a">
                                                            <li>
                                                                Tidak menjual produk di bawah harga resmi (harga
                                                                distributor).
                                                            </li>
                                                            <li>
                                                                Tidak melakukan pelanggaran seperti spam atau penyebaran
                                                                informasi yang menyesatkan dalam pemasaran
                                                            </li>
                                                        </ol>
                                                    </li>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFour">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                aria-expanded="false" aria-controls="collapseFour">
                                                <b>D. Jenjang & Diskon Keanggotaan</b>
                                            </button>
                                        </h2>
                                        <div id="collapseFour" class="accordion-collapse collapse"
                                            aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <ol>
                                                    <li class="fw-bold">
                                                        Penentuan Jenjang Keanggotaan
                                                    </li>
                                                    <p>
                                                        Jenjang keanggotaan ditentukan berdasarkan total pembelanjaan
                                                        pertama (bruto) yang dilakukan dalam satu kali pemesanan (tidak
                                                        termasuk ongkos kirim) dan dikurangi diskon member agen Insan Kamil.
                                                        Berikut rincian jenjang dan diskonnya:
                                                    </p>
                                                    <table class="table table-bordered" style="width: 50%;">
                                                        <thead>
                                                            <tr>
                                                                <th>Minimal Pembeliaan (Bruto)</th>
                                                                <th>Jenjang</th>
                                                                <th>Diskon</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>Rp. 100.000</td>
                                                                <td>Bronze</td>
                                                                <td>20%</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Rp. 1.000.000</td>
                                                                <td>Silver</td>
                                                                <td>25%</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Rp. 3.000.000</td>
                                                                <td>Gold</td>
                                                                <td>35%</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Rp. 5.000.000</td>
                                                                <td>Platinum</td>
                                                                <td>40%</td>
                                                            </tr>
                                                            <tr>
                                                                <td>Rp. 25.000.000</td>
                                                                <td>Prioritas</td>
                                                                <td>45%</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                    <li class="fw-bold">
                                                        Syarat Diskon Keanggotaan
                                                    </li>
                                                    <ol type="a">
                                                        <li>
                                                            Diskon berlaku langsung saat pembelian pertama.
                                                        </li>
                                                        <li>
                                                            Pembelian selanjutnya akan mengikuti jenjang keanggotaan yang
                                                            telah diperoleh.
                                                        </li>
                                                        <li>
                                                            Untuk mempertahankan level keanggotaan dan diskon khusus yang
                                                            telah Anda peroleh, setiap agen diwajibkan untuk memenuhi
                                                            komitmen pembelanjaan bulanan sesuai dengan ketentuan berikut
                                                        </li>
                                                        <table class="table table-bordered" style="width: 50%;">
                                                            <thead>
                                                                <tr>
                                                                    <th>Jenjang</th>
                                                                    <th>Diskon</th>
                                                                    <th>Komitmen Omset Net /Bulan</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Bronze</td>
                                                                    <td>20%</td>
                                                                    <td>0</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Silver</td>
                                                                    <td>25%</td>
                                                                    <td>0</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Gold</td>
                                                                    <td>35%</td>
                                                                    <td>0</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Platinum</td>
                                                                    <td>40%</td>
                                                                    <td>Rerata min Rp. 100.000</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Prioritas</td>
                                                                    <td>45%</td>
                                                                    <td>Rerata min Rp. 10.000.000</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </ol>

                                                    <li class="fw-bold">
                                                        Ketentuan Komitmen Pembelanjaan untuk Keanggotaan Platinum dan
                                                        Prioritas
                                                    </li>
                                                    <p>Untuk mempertahankan jenjang keanggotaan serta manfaat eksklusif yang
                                                        telah Anda dapatkan, berikut adalah ketentuan komitmen pembelanjaan
                                                        bulanan khusus bagi anggota <strong>Platinum</strong> dan
                                                        <strong>Prioritas</strong>:
                                                    </p>
                                                    <ol type="a">
                                                        <li>
                                                            Keanggotaan Platinum
                                                        </li>
                                                        <ul>
                                                            <li>
                                                                Pembelanjaan rata-rata per bulan minimal Rp 100.000.
                                                            </li>
                                                            <li>
                                                                Jika komitmen ini tidak terpenuhi dalam satu bulan kalender,
                                                                status keanggotaan Platinum Anda dapat diturunkan ke jenjang
                                                                di bawahnya
                                                            </li>
                                                        </ul>
                                                        <li>
                                                            Keanggotaan Prioritas
                                                        </li>
                                                        <ul>
                                                            <li>
                                                                Pembelanjaan rata-rata per bulan minimal Rp 10.000.000.
                                                            </li>
                                                            <li>
                                                                Jika komitmen ini tidak dipenuhi dalam satu bulan
                                                                kalender, status keanggotaan Prioritas Anda dapat diturunkan
                                                                ke jenjang di bawahnya
                                                            </li>
                                                        </ul>
                                                        <li>Manfaat Memenuhi Komitmen</li>
                                                        <ul>
                                                            <li>
                                                                Memastikan Anda tetap menikmati diskon eksklusif, prioritas
                                                                layanan, dan akses ke berbagai program insentif.
                                                            </li>
                                                            <li>
                                                                Mempertahankan reputasi dan status sebagai agen terpercaya
                                                                di platform e-commerce Penerbit Insan Kamil.
                                                            </li>
                                                        </ul>
                                                        <li>Evaluasi Komitmen dan Omset Bulanan</li>
                                                        <p>
                                                            Evaluasi terkait pemenuhan komitmen omset netto setiap jenjang
                                                            akan dilakukan pada setiap akhir bulan (tanggal 30/31). Jika
                                                            agen tidak memenuhi target omset yang disyaratkan untuk jenjang
                                                            tertentu, jenjang dan diskon akan disesuaikan ke level yang
                                                            lebih rendah di bulan berikutnya.
                                                        </p>
                                                        <li>Peringatan Status</li>
                                                        <p>Sistem kami akan memberikan notifikasi jika pembelanjaan Anda
                                                            belum mencapai batas minimum hingga mendekati akhir bulan,
                                                            sehingga Anda dapat segera memenuhinya</p>
                                                        <li>Ketentuan Penurunan Jenjang & Diskon</li>
                                                        <p>
                                                            Jenjang keanggotaan dan diskon yang telah diperoleh dapat
                                                            mengalami penurunan jika agen tidak memenuhi komitmen omset
                                                            netto setiap bulan (untuk jenjang Platinum dan Prioritas).
                                                            Penurunan ini berlaku berdasarkan evaluasi yang dilakukan oleh
                                                            tim kami.
                                                        </p>
                                                        <table class="table table-bordered" style="width: 50%;">
                                                            <thead>
                                                                <tr>
                                                                    <th>Jenjang</th>
                                                                    <th>Rerata Omset Per Bulan</th>
                                                                    <th>Tercapai</th>
                                                                    <th>Tidak</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Bronze</td>
                                                                    <td>-</td>
                                                                    <td>Tetap</td>
                                                                    <td>Tetap</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Silver</td>
                                                                    <td>-</td>
                                                                    <td>Tetap</td>
                                                                    <td>Tetap</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Gold</td>
                                                                    <td>-</td>
                                                                    <td>Tetap</td>
                                                                    <td>Tetap</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Platinum</td>
                                                                    <td>Rp. 100.000</td>
                                                                    <td>Tetap</td>
                                                                    <td>Turun ke 35%</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Prioritas</td>
                                                                    <td>Rp. 10.000.000</td>
                                                                    <td>Tetap</td>
                                                                    <td>Turun ke 40%</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </ol>

                                                    <li class="fw-bold">
                                                        Benefit Keanggotaan
                                                    </li>
                                                    <p>Berikut adalah rincian Benefit Keanggotaan dan ketentuan yang
                                                        didapatkan oleh setiap agen berdasarkan level keanggotaan di
                                                        Penerbit Insan Kamil:</p>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Ketentuan & Benefit </th>
                                                                <th>Bronze</th>
                                                                <th>Silver</th>
                                                                <th>Gold</th>
                                                                <th>Platinum</th>
                                                                <th>Prioritas</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>Rerata omset per bulan</td>
                                                                <td>0</td>
                                                                <td>0</td>
                                                                <td>0</td>
                                                                <td>min 100ribu</td>
                                                                <td>min 10juta</td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>Diskon</td>
                                                                <td>20%</td>
                                                                <td>25%</td>
                                                                <td>35%</td>
                                                                <td>40%</td>
                                                                <td>45%</td>
                                                            </tr>
                                                            <tr>
                                                                <td>3</td>
                                                                <td>Channel Official</td>
                                                                <td>Tidak</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                            </tr>
                                                            <tr>
                                                                <td>4</td>
                                                                <td>Channel Real Pict</td>
                                                                <td>Tidak</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                            </tr>
                                                            <tr>
                                                                <td>5</td>
                                                                <td>Channel Info Update</td>
                                                                <td>Tidak</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                            </tr>
                                                            <tr>
                                                                <td>6</td>
                                                                <td>Katalog Produk</td>
                                                                <td>Tidak</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                            </tr>
                                                            <tr>
                                                                <td>7</td>
                                                                <td>Point Reward</td>
                                                                <td>Tidak</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                            </tr>
                                                            <tr>
                                                                <td>8</td>
                                                                <td>Grub Agen Insan Kamil</td>
                                                                <td>Tidak</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                            </tr>
                                                            <tr>
                                                                <td>9</td>
                                                                <td>Keep Pre Order</td>
                                                                <td>Tidak</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                            </tr>
                                                            <tr>
                                                                <td>10</td>
                                                                <td>PIC + Layanan Khusus</td>
                                                                <td>Tidak</td>
                                                                <td>Tidak</td>
                                                                <td>Tidak</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                            </tr>
                                                            <tr>
                                                                <td>11</td>
                                                                <td>Penawaran Spesial</td>
                                                                <td>Tidak</td>
                                                                <td>Tidak</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                            </tr>
                                                            <tr>
                                                                <td>12</td>
                                                                <td>Layanan Prioritas Pemesanan, Pengiriman, dan Komplain
                                                                </td>
                                                                <td>Tidak</td>
                                                                <td>Tidak</td>
                                                                <td>Tidak</td>
                                                                <td>Ya</td>
                                                                <td>Ya</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingFive">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                aria-expanded="false" aria-controls="collapseFive">
                                                <b>E. Syarat dan Ketentuan Khusus</b>
                                            </button>
                                        </h2>
                                        <div id="collapseFive" class="accordion-collapse collapse"
                                            aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <ol>
                                                    <li class="fw-bold">
                                                        Pendaftaran Akun
                                                    </li>
                                                    <ol type="a">
                                                        <li>
                                                            Pendaftaran: Untuk mendaftar di platform e-commerce Penerbit
                                                            Insan Kamil melalui https://insankamil.id/, pengguna dapat
                                                            membuat akun baru atau login menggunakan akun Google. Setelah
                                                            pendaftaran berhasil, pengguna dapat mengakses berbagai fitur
                                                            dan layanan yang tersedia, seperti pembelian produk, pemantauan
                                                            pesanan, dan informasi terbaru. Akun yang telah terdaftar juga
                                                            memungkinkan pengguna untuk mendapatkan manfaat keanggotaan
                                                            sesuai jenjangnya.
                                                        </li>
                                                        <li>
                                                            Keamanan Akun: Pengguna bertanggung jawab untuk menjaga
                                                            kerahasiaan informasi akun (seperti username dan password) dan
                                                            bertanggung jawab penuh atas semua aktivitas yang terjadi pada
                                                            akun mereka.
                                                        </li>
                                                        <li>
                                                            Validasi Akun: Penerbit Insan Kamil berhak untuk menangguhkan
                                                            atau membatalkan akun pengguna jika ditemukan aktivitas yang
                                                            mencurigakan atau melanggar syarat dan ketentuan.
                                                        </li>
                                                    </ol>

                                                    <li class="fw-bold">
                                                        Penggunaan Platform
                                                    </li>
                                                    <ol type="a">
                                                        <li>
                                                            Pengguna hanya diperbolehkan menggunakan platform e-commerce
                                                            untuk tujuan bisnis yang sah dan sesuai dengan kebijakan
                                                            Penerbit Insan Kamil.
                                                        </li>
                                                        <li>
                                                            Dilarang melakukan tindakan yang merugikan atau mengganggu
                                                            operasional platform, seperti menyebarkan malware, spamming,
                                                            atau penggunaan akun untuk tujuan yang melanggar hukum.
                                                        </li>
                                                    </ol>

                                                    <li class="fw-bold">
                                                        Transaksi Pembelian dan Penjualan
                                                    </li>
                                                    <ol type="a">
                                                        <li>
                                                            Semua transaksi antara agen dan Penerbit Insan Kamil harus
                                                            dilakukan melalui sistem e-commerce yang sah, termasuk
                                                            pembayaran yang harus dilakukan sesuai dengan metode yang
                                                            disediakan oleh platform.
                                                        </li>
                                                        <li>
                                                            Agen wajib memenuhi komitmen pembelanjaan bulanan sesuai
                                                            dengan ketentuan yang berlaku agar dapat mempertahankan status
                                                            dan diskon yang didapatkan
                                                        </li>
                                                    </ol>

                                                    <li class="fw-bold">
                                                        Batas Diskon Penjualan
                                                    </li>
                                                    <ol type="a">
                                                        <li>
                                                            Agen tidak diperkenankan memberikan diskon melebihi batas diskon
                                                            jenjang yang telah ditetapkan sesuai level keanggotaan.
                                                        </li>
                                                        <li>
                                                            Khusus untuk Agen Prioritas, diskon maksimal yang diperbolehkan
                                                            adalah 40% dari harga terendah untuk penjualan produk kepada
                                                            konsumen.
                                                        </li>
                                                    </ol>

                                                    <li class="fw-bold">
                                                        Keanggotaan dan Level Diskon
                                                    </li>
                                                    <ol type="a">
                                                        <li>
                                                            Setiap agen wajib memenuhi target pembelanjaan bulanan untuk
                                                            mempertahankan level keanggotaan dan diskon yang sesuai.
                                                        </li>
                                                        <li>
                                                            Penurunan atau pembekuan level keanggotaan dapat dilakukan jika
                                                            agen tidak memenuhi komitmen pembelanjaan yang telah ditentukan.
                                                        </li>
                                                    </ol>

                                                    <li class="fw-bold">
                                                        Penyalahgunaan Diskon dan Keanggotaan
                                                    </li>
                                                    <ol type="a">
                                                        <li>
                                                            Pengguna yang menyalahgunakan program diskon atau keanggotaan
                                                            (misalnya dengan melakukan manipulasi harga atau transaksi
                                                            fiktif) akan dikenakan sanksi, termasuk pembekuan akun atau
                                                            penghentian kerjasama
                                                        </li>
                                                    </ol>

                                                    <li class="fw-bold">
                                                        Perubahan dan Pembaruan
                                                    </li>
                                                    <ol type="a">
                                                        <li>
                                                            Penerbit Insan Kamil berhak untuk melakukan perubahan atau
                                                            pembaruan pada sistem, harga, kebijakan pengembalian barang,
                                                            atau syarat & ketentuan kapan saja tanpa pemberitahuan terlebih
                                                            dahulu.
                                                        </li>
                                                        <li>
                                                            Pengguna setuju untuk mematuhi perubahan yang diberlakukan dan
                                                            disarankan untuk memeriksa syarat & ketentuan secara berkala.
                                                        </li>
                                                    </ol>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSix">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                                aria-expanded="false" aria-controls="collapseSix">
                                                <b>F. Saksi</b>
                                            </button>
                                        </h2>
                                        <div id="collapseSix" class="accordion-collapse collapse"
                                            aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <p>Agen yang terbukti melanggar syarat dan ketentuan khusus akan dikenakan
                                                    sanksi tegas tanpa pemberian surat teguran terlebih dahulu, berupa:</p>
                                                <ol>
                                                    <li>
                                                        Penurunan Diskon Permanen
                                                    </li>
                                                    <p>
                                                        Diskon agen akan dikurangi, dan diskon tersebut tidak dapat
                                                        dinaikkan kembali meskipun agen meningkatkan omset atau memenuhi
                                                        persyaratan lain
                                                    </p>

                                                    <li>
                                                        Penonaktifan Keanggotaan
                                                    </li>
                                                    <p>
                                                        Akun agen akan dinonaktifkan dari sistem e-commerce Penerbit
                                                        Insan Kamil, sehingga tidak lagi dapat melakukan transaksi atau
                                                        menikmati benefit keanggotaan.
                                                    </p>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingSeven">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseSeven"
                                                aria-expanded="false" aria-controls="collapseSeven">
                                                <b>G. Pre Order</b>
                                            </button>
                                        </h2>
                                        <div id="collapseSeven" class="accordion-collapse collapse"
                                            aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <ol>
                                                    <li class="fw-bold">
                                                        Apa itu Pre Order?
                                                    </li>
                                                    <p>Pre-Order (PO) adalah sistem pemesanan di mana agen member melakukan
                                                        pemesanan dan pembayaran terlebih dahulu sebelum produk siap di
                                                        stok. Estimasi waktu pengiriman akan diinformasikan dan disepakati
                                                    </p>

                                                    <li class="fw-bold">
                                                        Cara Mengikuti Promo Pre-Order
                                                    </li>
                                                    <ol type="a">
                                                        <li>
                                                            Agen member harus mengisi jumlah daftar Pre-Order di Stok
                                                            Pre-Order
                                                        </li>
                                                        <li>
                                                            Pembayaran dapat dilakukan mendekati produk ready stock sesuai
                                                            dengan
                                                            timeline pre-order
                                                        </li>
                                                    </ol>

                                                    <li class="fw-bold">
                                                        Kewajiban Pembayaran
                                                    </li>
                                                    <ol type="a">
                                                        <li>
                                                            Agen member wajib melakukan Checkout dan pembayaran sesuai
                                                            timeline yang
                                                            sudah disepakati
                                                        </li>
                                                        <li>
                                                            Batas Pembatalan: Pembatalan daftar list pre-order hanya bisa
                                                            dilakukan selama periode pre-order masih terbuka, dengan
                                                            maksimal pengurangan atau pembatalan 20% dari total list yang
                                                            telah terdaftar.
                                                        </li>
                                                    </ol>

                                                    <li class="fw-bold">
                                                        Sanksi Jika Tidak Checkout
                                                    </li>
                                                    <ol type="a">
                                                        <li>
                                                            Jika agen member tidak melakukan checkout sesuai batas waktu,
                                                            akan ada sanksi pengurangan diskon yang diberlakukan mulai H+5
                                                            setelah batas akhir pembayaran
                                                        </li>
                                                        <li>
                                                            Besaran sanksi bervariasi antara 1% hingga penonaktifan
                                                            keanggotaan, tergantung pada banyaknya produk yang tidak dibayar
                                                        </li>
                                                    </ol>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingEight">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseEight"
                                                aria-expanded="false" aria-controls="collapseEight">
                                                <b>H. Pembayaran Pesanan</b>
                                            </button>
                                        </h2>
                                        <div id="collapseEight" class="accordion-collapse collapse"
                                            aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <ol>
                                                    <li class="fw-bold">
                                                        Cara Melakukan Pembayaran
                                                    </li>
                                                    <ol type="a">
                                                        <li>
                                                            Lakukan pembayaran melalui transfer rekening sesuai informasi
                                                            di situs https://insankamil.id/
                                                        </li>
                                                        <li>
                                                            Setelah melakukan transfer, silakan unggah bukti pembayaran
                                                            (foto/scan) melalui dashboard akun di situs. Caranya, buka menu
                                                            Pesanan, lalu klik ikon titik tiga pada pesanan yang ingin
                                                            dikonfirmasi. Setelah itu, pilih opsi Upload Bukti Pembayaran
                                                            dan unggah file bukti transfer Anda. Pastikan bukti pembayaran
                                                            terlihat jelas dan sesuai dengan nominal pada invoice untuk
                                                            mempermudah proses verifikasi.
                                                        </li>
                                                    </ol>

                                                    <li class="fw-bold">
                                                        Ketentuan Pembayaran
                                                    </li>
                                                    <ol type="a">
                                                        <li>
                                                            Nominal transfer harus sesuai dengan jumlah yang tercantum di
                                                            invoice pesanan
                                                        </li>
                                                        <li>
                                                            Konfirmasi pembayaran wajib dilakukan dalam waktu 24 jam
                                                            setelah checkout.
                                                        </li>
                                                        <li>
                                                            Pesanan akan dibatalkan otomatis jika konfirmasi pembayaran
                                                            tidak dilakukan dalam batas waktu yang ditentukan
                                                        </li>
                                                    </ol>

                                                    <li class="fw-bold">
                                                        Konfirmasi Pesanan Berhasil Dibayar
                                                    </li>
                                                    <ol type="a">
                                                        <li>
                                                            Setelah pembayaran terverifikasi, Anda akan menerima notifikasi
                                                            melalui
                                                            WhatsApp Gateway
                                                        </li>
                                                        <li>
                                                            Pesanan yang telah dibayar dan diproses tidak dapat diubah
                                                            (termasuk produk, jumlah, alamat, dan pilihan ekspedisi).
                                                        </li>
                                                    </ol>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingNine">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseNine"
                                                aria-expanded="false" aria-controls="collapseNine">
                                                <b>I. Proses Pengiriman Barang</b>
                                            </button>
                                        </h2>
                                        <div id="collapseNine" class="accordion-collapse collapse"
                                            aria-labelledby="headingNine" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <ol>
                                                    <li class="fw-bold">
                                                        Waktu Pemrosesan Pesanan
                                                    </li>
                                                    <ol type="a">
                                                        <li>
                                                            Produk ready stock diproses dalam waktu maksimal 1 x 24 jam
                                                            setelah konfirmasi pembayaran diterima
                                                        </li>
                                                        <li>
                                                            Untuk produk pre-order, proses pengiriman mengikuti timeline
                                                            yang
                                                            telah ditentukan
                                                        </li>
                                                    </ol>

                                                    <li class="fw-bold">
                                                        Layanan Ekspedisi
                                                    </li>
                                                    <ol type="a">
                                                        <li>
                                                            Pengiriman dilakukan melalui jasa ekspedisi yang bekerja sama
                                                            dengan Penerbit Insan Kamil
                                                        </li>
                                                        <li>
                                                            Anda dapat memilih layanan ekspedisi saat checkout pesanan
                                                        </li>
                                                    </ol>

                                                    <li class="fw-bold">
                                                        Upload Nomor Resi
                                                    </li>
                                                    <ol type="a">
                                                        <li>
                                                            Layanan Reguler: Resi diunggah maksimal 1 x 24 jam setelah
                                                            pickup.
                                                        </li>
                                                        <li>
                                                            Layanan Cargo: Resi diunggah maksimal 2 x 24 jam setelah pickup
                                                        </li>
                                                    </ol>

                                                    <li class="fw-bold">
                                                        Catatan Penting
                                                    </li>
                                                    <p>
                                                        Pastikan alamat pengiriman yang diinput sudah benar. Kesalahan
                                                        alamat pengiriman bukan menjadi tanggung jawab Penerbit Insan Kamil.
                                                        Biaya tambahan terkait kesalahan alamat akan menjadi tanggung jawab
                                                        agen member
                                                    </p>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTen">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseTen"
                                                aria-expanded="false" aria-controls="collapseTen">
                                                <b>J. Komplain dan Pengembalian Produk (Retur)</b>
                                            </button>
                                        </h2>
                                        <div id="collapseTen" class="accordion-collapse collapse"
                                            aria-labelledby="headingTen" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <ol>
                                                    <li class="fw-bold">
                                                        Prosedur Komplain
                                                    </li>
                                                    <p>
                                                        Agen member dapat mengajukan komplain jika produk tidak sesuai atau
                                                        rusak. Komplain harus disertai dengan video unboxing yang
                                                        menunjukkan resi dan label pengiriman
                                                    </p>

                                                    <li class="fw-bold">
                                                        Batas Waktu Komplain
                                                    </li>
                                                    <ol type="a">
                                                        <li>
                                                            Komplain produk yang belum diterima harus diajukan dalam
                                                            maksimal
                                                            20 hari setelah resi pengiriman diterima
                                                        </li>
                                                        <li>
                                                            Komplain produk yang rusak/cacat/tidak sesuai harus diajukan
                                                            dalam maksimal 1 x 24 jam setelah barang diterima
                                                        </li>
                                                    </ol>

                                                    <li class="fw-bold">
                                                        Penggantian Produk
                                                    </li>
                                                    <p>
                                                        Jika produk rusak atau tidak sesuai, Insan Kamil akan mengganti
                                                        dengan produk baru sesuai pesanan atau refund jika stok produk
                                                        pengganti kosong
                                                    </p>


                                                    <li class="fw-bold">
                                                        Biaya Ongkos Kirim Retur
                                                    </li>
                                                    <p>
                                                        Biaya ongkos kirim untuk retur barang yang rusak atau cacat akan
                                                        ditanggung oleh Insan Kamil. Namun, tidak termasuk produk yang rusak
                                                        selama pengiriman
                                                    </p>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingEleven">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapseEleven"
                                                aria-expanded="false" aria-controls="collapseEleven">
                                                <b>K. Reward</b>
                                            </button>
                                        </h2>
                                        <div id="collapseEleven" class="accordion-collapse collapse"
                                            aria-labelledby="headingEleven" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <ol>
                                                    <li class="fw-bold">
                                                        Cara Melakukan Penukaran di Sistem E-Commerce Penerbit Insan Kamil
                                                    </li>
                                                    <ol type="a">
                                                        <li class="fw-bold">
                                                            Login ke Akun Anda
                                                        </li>
                                                        <p>Masuk ke akun Anda melalui situs resmi https://insankamil.id/</p>

                                                        <li class="fw-bold">
                                                            Akses ke menu Reward
                                                        </li>
                                                        <ul>
                                                            <li>
                                                                Setelah login masuk ke Profil Anda
                                                            </li>
                                                            <li>
                                                                Pilih Menu Reward Point yang tersedia dibagian Dashboard
                                                            </li>
                                                        </ul>

                                                        <li class="fw-bold">
                                                            Pilih Reward yang tersedia
                                                        </li>
                                                        <ul>
                                                            <li>
                                                                Lihat daftar reward yang sesuai dengan jumlah poin yang Anda
                                                                miliki.
                                                            </li>
                                                            <li>
                                                                Pilih reward yang ingin diinginkan, pastikan poin anda cukup
                                                            </li>
                                                        </ul>

                                                        <li class="fw-bold">
                                                            Isi data penukaran
                                                        </li>
                                                        <p>Pastikan semua data anda sudah benar, termasuk :</p>
                                                        <ul>
                                                            <li>Foto KTP</li>
                                                            <li>Nama Pemilik Rekening dan Nomor Rekening</li>
                                                            <li>Pilih reward yang ingin diinginkan</li>
                                                        </ul>

                                                        <li class="fw-bold">
                                                            Konfirmasi Reedem
                                                        </li>
                                                        <ul>
                                                            <li>Klik tombol Konfirmasi Redeem untuk menyelesaikan proses
                                                                penukaran</li>
                                                            <li>Sistem akan memproses pengajuan Anda, dan statusnya akan
                                                                diperbarui di akun Anda</li>
                                                        </ul>

                                                        <li class="fw-bold">
                                                            Tunggu Pengiriman Reward
                                                        </li>
                                                        <p>
                                                            Reward akan diproses dan dikirimkan dalam waktu maksimal 20 hari
                                                            kerja setelah konfirmasi redeem.
                                                        </p>
                                                    </ol>

                                                    <li class="fw-bold">
                                                        Kriteria Penerima
                                                    </li>
                                                    <ol type="a">
                                                        <li>
                                                            Setiap agen aktif berhak mengikuti program reward tahunan
                                                            sesuai syarat dan ketentuan
                                                        </li>
                                                        <li>
                                                            Agen dianggap aktif jika melakukan transaksi secara berkala
                                                            sepanjang tahun
                                                        </li>
                                                    </ol>

                                                    <li class="fw-bold">
                                                        Perhitungan Point
                                                    </li>
                                                    <ol type="a">
                                                        <li>
                                                            Setiap transaksi netto sebesar Rp 50.000 akan dikonversi menjadi
                                                            1 poin reward
                                                        </li>
                                                        <li>
                                                            Total poin dihitung dari akumulasi transaksi netto selama 1
                                                            Januari hingga 31 Desember setiap tahun
                                                        </li>
                                                    </ol>

                                                    <li class="fw-bold">
                                                        Keberlanjutan Program
                                                    </li>
                                                    <ol type="a">
                                                        <li>
                                                            Program poin berlaku hanya untuk periode satu tahun, dan
                                                            perhitungan poin akan direset ke nol setiap 1 Januari.
                                                        </li>
                                                        <li>
                                                            Poin yang tidak ditukarkan dalam periode yang ditentukan akan
                                                            dinyatakan hangus
                                                        </li>
                                                    </ol>
                                                    <div class="text-center">
                                                        <img src="{{ asset('images/reward/1.jpg') }}"
                                                            alt="Ilustrasi Reward" class="img-fluid"
                                                            style="max-width: 500px;">
                                                    </div>

                                                    <li class="fw-bold">
                                                        Penukaran point dalam 1 tahun di akhir tahun
                                                    </li>
                                                    <ol type="a">
                                                        <li>
                                                            Setiap agen hanya dapat menukarkan point untuk satu jenis reward
                                                            sesuai ketentuan
                                                        </li>
                                                        <div class="text-center">
                                                            <img src="{{ asset('images/reward/2.jpg') }}"
                                                                alt="Ilustrasi Reward" class="img-fluid"
                                                                style="max-width: 500px;">
                                                        </div>
                                                        <li>
                                                            Poin sisa setelah penukaran reward akhir tahun dinyatakan tidak
                                                            terpakai (hangus).
                                                        </li>
                                                        <li>
                                                            Perhitungan poin reward pada tahun berikutnya dimulai dari NOL,
                                                            tanpa carry-over poin. Artinya poin tersebut tidak akan dibawa
                                                            ke tahun berikutnya dan dinyatakan hangus
                                                        </li>
                                                        <div class="text-center">
                                                            <img src="{{ asset('images/reward/3.jpg') }}"
                                                                alt="Ilustrasi Reward" class="img-fluid"
                                                                style="max-width: 500px;">
                                                        </div>
                                                    </ol>

                                                    <li class="fw-bold">
                                                        Informasi Penting untuk Agen
                                                    </li>
                                                    <ol type="a">
                                                        <li>
                                                            Maksimal 2 Reward: Agen dapat menukarkan maksimal 2 reward
                                                            sesuai jumlah poin yang dimiliki, menggunakan salah satu dari
                                                            dua opsi di atas.
                                                        </li>
                                                        <li>
                                                            Redeem Bertahap atau Sekaligus:
                                                            <ul>
                                                                <li>Opsi A: Penukaran bertahap memungkinkan sisa poin
                                                                    digunakan di akhir periode</li>
                                                                <li>Opsi B: Penukaran sekaligus di akhir periode untuk agen
                                                                    yang ingin memaksimalkan poin</li>
                                                            </ul>
                                                        </li>
                                                        <li>
                                                            Sisa Poin Hangus: Poin yang tidak mencukupi untuk reward apa pun
                                                            akan dianggap hangus setelah tanggal 8 Desember 2026
                                                        </li>
                                                        <li>
                                                            Reset Poin: Setelah periode redeem berakhir, perhitungan poin
                                                            untuk tahun berikutnya dimulai dari 0 (nol).
                                                        </li>
                                                    </ol>
                                                </ol>
                                            </div>
                                        </div>
                                    </div>


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
            $('#modal-alamat').modal('show');
        });
    </script>
@endsection
