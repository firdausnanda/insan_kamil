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
                                    <h2 class="mb-0">Detail Transaksi</h2>
                                    <span class="badge bg-light-warning text-dark-warning ms-2">Pending</span>
                                </div>
                            </div>
                            <div class="mt-8">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" value="" id="dropship">
                                    <label class="form-check-label" for="dropship">
                                        Kirim sebagai Dropshipper
                                    </label>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-6">
                                            <h6>Alamat Pengiriman</h6>
                                            <p class="mb-1 lh-lg">
                                                {{ $data[0]->user->alamat }}
                                                <br>
                                                {{ $data[0]->user->district ? $data[0]->user->district->name : '' }},
                                                {{ $data[0]->user->city ? $data[0]->user->city->name : '' }}
                                                <br>
                                                {{ $data[0]->user->province ? $data[0]->user->province->name : '' }}
                                                Kode Pos.
                                                {{ $data[0]->user->kode_pos ?? '' }}
                                                <br />
                                            </p>
                                            <button class="btn btn-info mt-2 btn-sm btn-ubah" href="#">Ubah
                                                Data</button>
                                            <button class="btn btn-warning mt-2 btn-sm btn-catatan" href="#">Tambah
                                                Catatan Pembelian</button>
                                        </div>
                                        <input type="hidden" id="subdistrict"
                                            value="{{ $data[0]->user->district ? $data[0]->user->district->id : 0 }}">
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-6">
                                            <h6>Customer Details</h6>
                                            <p class="mb-1 lh-lg">
                                                {{ $data[0]->user->name }}
                                                <br />
                                                {{ $data[0]->user->email }}
                                                <br />
                                                {{ $data[0]->user->no_telp }}
                                                <input type="hidden" id="id_member" value="{{ $member_diskon }}">
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-2">
                                            <h6>Detail Pengiriman</h6>
                                            <p class="mb-1 lh-lg">
                                                Jasa Pengiriman:
                                                <select class="form-select" name="jasa_pengiriman" id="jasa_pengiriman">
                                                    <option value="">Pilih Jasa Pengiriman</option>
                                                    @foreach ($courier as $c)
                                                        <option value="{{ $c['kode'] }}">{{ $c['nama'] }}</option>
                                                    @endforeach
                                                </select>
                                            </p>
                                        </div>
                                        <div id="loading" class="spinner-border text-success d-none my-3" role="status">
                                        </div>
                                        <select class="form-select" name="pilih_paket" id="pilih_paket">
                                            <option value="">Pilih Paket Pengiriman</option>
                                        </select>
                                        <input type="hidden" id="detail_kurir">
                                        <button class="btn btn-secondary mt-2" id="pesan" disabled>Lakukan
                                            Pemesanan</button>
                                    </div>

                                    <!-- Dropship -->
                                    <div class="row" id="detail_dropship">

                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <!-- Table -->
                                    <table class="table mb-0 text-nowrap table-centered">
                                        <!-- Table Head -->
                                        <thead class="bg-light">
                                            <tr>
                                                <th>Products</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <!-- tbody -->
                                        <tbody>
                                            @foreach ($data as $d)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div>
                                                                @if ($d->produk->gambar_produk->count() > 0)
                                                                    <img src="{{ asset('storage/produk/' . $d->produk->gambar_produk[0]->gambar) }}"
                                                                        alt="" class="icon-shape icon-lg" />
                                                                @else
                                                                    <img src="{{ asset('images/avatar/no-image.png') }}"
                                                                        alt="" class="icon-shape icon-lg" />
                                                                @endif
                                                            </div>
                                                            <div class="ms-lg-4 mt-2 mt-lg-0">
                                                                <h5 class="mb-0 h6">{{ $d->produk->nama_produk }}</h5>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td><span class="text-body">{{ rupiah($d->harga_jual) }}</span></td>
                                                    <td>{{ $d->jumlah_produk }}</td>
                                                    <td>{{ rupiah($d->harga_jual * $d->jumlah_produk) }}</td>
                                                </tr>
                                            @endforeach

                                            <tr>
                                                <td class="border-bottom-0 pb-0"></td>
                                                <td class="border-bottom-0 pb-0"></td>
                                                <td colspan="1" class="fw-medium text-dark">
                                                    <!-- text -->
                                                    Sub Total :
                                                </td>
                                                <td class="fw-medium text-dark">
                                                    <!-- text -->
                                                    <span id="sub_total">
                                                        {{ rupiah($subTotal) }}
                                                    </span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="border-bottom-0 pb-0"></td>
                                                <td class="border-bottom-0 pb-0"></td>
                                                <td colspan="1" class="fw-medium text-dark">
                                                    <!-- text -->
                                                    Shipping Cost
                                                </td>
                                                <td class="fw-medium text-dark">
                                                    <!-- text -->
                                                    <span id="shipping_cost">
                                                        0
                                                    </span>
                                                </td>
                                            </tr>

                                            @if ($member_diskon)
                                                <tr>
                                                    <td class="border-bottom-0 pb-0"></td>
                                                    <td class="border-bottom-0 pb-0"></td>
                                                    <td colspan="1" class="fw-medium text-success">
                                                        <!-- text -->
                                                        Member Diskon
                                                    </td>
                                                    <td class="fw-medium text-success">
                                                        <!-- text -->
                                                        <span id="member_diskon">
                                                            {{ rupiah($member_diskon) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endif

                                            @if ($diskon_alquran)
                                                <tr>
                                                    <td class="border-bottom-0 pb-0"></td>
                                                    <td class="border-bottom-0 pb-0"></td>
                                                    <td colspan="1" class="fw-medium text-success">
                                                        <!-- text -->
                                                        Diskon Alquran
                                                    </td>
                                                    <td class="fw-medium text-success">
                                                        <!-- text -->
                                                        <span id="diskon_alquran">
                                                            {{ rupiah($diskon_alquran) }}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endif

                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td colspan="1" class="fw-semibold text-dark">
                                                    <!-- text -->
                                                    Grand Total
                                                </td>
                                                <td class="fw-semibold text-dark">
                                                    <!-- text -->
                                                    <span id="grand_total">
                                                        {{ rupiah($subTotal - $member_diskon - $diskon_alquran) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                @if ($data[0]->catatan_pembelian)
                                    <h6 class="px-3"><span class="text-danger">*</span> Catatan Pembelian</h6>
                                    <p class="px-3">{{ $data[0]->catatan_pembelian }}</p>
                                @endif
                            </div>
                            {{-- <div class="col-lg-6 p-5">
                                <div class="container border rounded p-4 text-center position-relative"
                                    style="background-color: #f7c331; bottom: 120px; left: 45px">
                                    <div class="container border border-white border-5 p-4 rounded">
                                        <img src="{{ asset('images/warning.png') }}" style="width: 80px">
                                        <h4 class="text-danger">Perhatian</h4>
                                        <p class="text-dark fs-5">Ditujukan kepada seluruh customer kami untuk mempermudah
                                            administrasi, setiap transaksi pembelian kurang dari Rp 500.00 silahkan
                                            menggunakan pembayaran via <strong>Qris</strong>. Untuk transaksi lebih dari Rp
                                            500.000
                                            dianjurkan pembayaran transfer via bank. Terima kasih atas perhatian
                                            dan kerja samanya.</p>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal Edit --}}
    <div class="modal fade" id="modal-edit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Pengguna</h5>
                </div>
                <form id="form-edit">
                    <div class="modal-body">
                        <div class="row">
                            <!-- input -->
                            <div class="col-md-12 mb-3">
                                <!-- input -->
                                <label class="form-label" for="nama">
                                    Nama Lengkap
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="nama" name="nama" class="form-control"
                                    placeholder="Nama Lengkap" value="{{ $data[0]->user->name }}" />
                                <input type="hidden" name="id_user" value="{{ $data[0]->user->id }}" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="no_telepon">
                                    Nomor Telepon
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="hidden" name="email" value="{{ $data[0]->user->email }}">
                                <input type="text" id="no_telepon" name="no_telepon" class="form-control"
                                    placeholder="Nomor Telepon" value="{{ $data[0]->user->no_telp }}" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <!-- input -->
                                <label class="form-label" for="alamat">Alamat</label>
                                <textarea rows="3" id="alamat" name="alamat" class="form-control" placeholder="Nama Lengkap">{{ $data[0]->user->alamat }}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <!-- input -->
                                <label class="form-label" for="provinsi">Provinsi</label>
                                <select name="provinsi" id="provinsi" class="form-select">
                                    <option value="">Pilih Provinsi</option>
                                    <option value="{{ $data[0]->user->provinsi }}" selected>
                                        {{ $data[0]->user->province ? $data[0]->user->province->name : '' }}</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <!-- input -->
                                <label class="form-label" for="kota">Kota</label>
                                <select name="kota" id="kota" class="form-select">
                                    <option value="">Pilih Kota</option>
                                    <option value="{{ $data[0]->user->kota }}" selected>
                                        {{ $data[0]->user->city ? $data[0]->user->city->name : '' }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <!-- input -->
                                <label class="form-label" for="desa">Kecamatan</label>
                                <select name="desa" id="desa" class="form-select">
                                    <option value="">Pilih Kecamatan</option>
                                    <option value="{{ $data[0]->user->district ? $data[0]->user->district->id : '' }}"
                                        selected>
                                        {{ $data[0]->user->district ? $data[0]->user->district->name : '' }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <!-- input -->
                                <label class="form-label" for="kode_pos">Kode Pos</label>
                                <input type="text" id="kode_pos" name="kode_pos"
                                    value="{{ $data[0]->user->kode_pos ?? '' }}" class="form-control"
                                    placeholder="Kode Pos" required />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Dropship --}}
    <div class="modal fade" id="modal-dropship" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Pengguna</h5>
                </div>
                <form id="form-edit-dropship">
                    <div class="modal-body">
                        <div class="row">

                            <span class="p-3 text-primary">
                                Detail Pengirim
                            </span>

                            <!-- input -->
                            <div class="col-md-12 mb-3">
                                <!-- input -->
                                <label class="form-label" for="nama">
                                    Nama Pengirim
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nama_pengirim" class="form-control"
                                    placeholder="Nama Lengkap" value="{{ $dropship ? $dropship->nama_pengirim : '' }}" />
                                <input type="hidden" name="id_dropship" value="{{ $dropship ? $dropship->id : '' }}" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="no_telepon">
                                    Nomor Telepon Pengirim
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="no_telp_pengirim" class="form-control"
                                    placeholder="Nomor Telepon"
                                    value="{{ $dropship ? $dropship->no_telp_pengirim : '' }}" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="no_telepon">
                                    Alamat Email Pengirim
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="email_pengirim" class="form-control"
                                    placeholder="Alamat Email"
                                    value="{{ $dropship ? $dropship->email_pengirim : '' }}" />
                            </div>

                            <span class="p-3 text-primary">
                                Alamat Penerima
                            </span>

                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="no_telepon">
                                    Nama Penerima
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="nama_penerima" class="form-control"
                                    placeholder="Nama Penerima"
                                    value="{{ $dropship ? $dropship->nama_penerima : '' }}" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="no_telepon">
                                    Nomor Telepon Penerima
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="no_telp_penerima" class="form-control"
                                    placeholder="Nomor Telepon"
                                    value="{{ $dropship ? $dropship->no_telp_penerima : '' }}" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <!-- input -->
                                <label class="form-label" for="alamat">Alamat</label>
                                <textarea rows="3" id="alamat_penerima" name="alamat" class="form-control" placeholder="Nama Lengkap">{{ $dropship ? $dropship->alamat_penerima : '' }}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <!-- input -->
                                <label class="form-label" for="provinsi">Provinsi</label>
                                <select name="provinsi" id="provinsi_penerima" class="form-select">
                                    <option value="">Pilih Provinsi</option>
                                    <option value="{{ $dropship ? $dropship->provinsi_penerima : '' }}" selected>
                                        {{ $dropship ? $dropship->province->name : '' }}</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <!-- input -->
                                <label class="form-label" for="kota">Kota</label>
                                <select name="kota" id="kota_penerima" class="form-select">
                                    <option value="">Pilih Kota</option>
                                    <option value="{{ $dropship ? $dropship->kota_penerima : '' }}" selected>
                                        {{ $dropship ? $dropship->city->name : '' }}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <!-- input -->
                                <label class="form-label" for="desa">Kecamatan</label>
                                <select name="desa" id="desa_penerima" class="form-select">
                                    <option value="">Pilih Kecamatan</option>
                                    <option value="{{ $dropship ? $dropship->desa_penerima : '' }}" selected>
                                        {{ $dropship ? $dropship->district->name : '' }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Catatan -->
    <div class="modal fade" id="modal-catatan" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Tambah Catatan Pembelian
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-catatan">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="{{ $data[0]->id }}">
                        <textarea name="catatan" id="catatan" cols="30" rows="10" class="form-control" autofocus>{{ $data[0]->catatan_pembelian }}</textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Bukti Transaksi -->
    <div class="modal fade" id="modal-bukti" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Upload Bukti Transaksi
                    </h5>
                </div>
                <form id="form-bukti" method="post" enctype="multipart/form-data">
                    <div class="modal-body">

                        <div class="alert alert-primary" role="alert">
                            <strong>Perhatian</strong><br>
                            Silakan kirimkan pembayaran ke salah satu rekening berikut.
                            <ol>
                                <li>
                                    <strong>BRI 6903 01 001436 50 7</strong> <br>
                                    An. Eko Wicaksono
                                </li>
                                <li>
                                    <strong>BCA 3920370747 </strong><br>
                                    An. Eko Wicaksono
                                </li>
                                <li>
                                    <strong>BSI 6227979170 </strong><br>
                                    An. Eko wicaksono
                                </li>
                                <li>
                                    <strong>BSM 7002044824</strong> <br>
                                    An. RIYANTO
                                </li>
                            </ol>
                        </div>

                        <div class="row g-3">
                            <div class="col-lg-12">
                                <label for="" class="form-label">Nama Rekening</label>
                                <input type="text" class="form-control" name="nama_rekening">
                            </div>
                            <div class="col-lg-12">
                                <label for="" class="form-label">Tranfer ke</label>
                                <select class="form-select" name="transfer_ke">
                                    <option value="BRI">BRI (No Rek : 6903 01 001436 50 7 A.n Eko Wicaksono)</option>
                                    <option value="BCA">BCA (No Rek : 3920370747 A.n Eko Wicaksono)</option>
                                    <option value="BSI">BSI (No Rek : 6227979170 A.n Eko Wicaksono)</option>
                                    <option value="BSM">BSM (No Rek : 7002044824 A.n Riyanto)</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label for="" class="form-label">Tanggal Transfer</label>
                                <input type="text" class="form-control" name="tgl_transfer" id="tgl_transfer">
                            </div>
                            <div class="col-lg-12">
                                <!-- input -->
                                <input type="file" class="upload-berkas-dropify" name="gambar"
                                    data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg pdf"
                                    id="berkas" data-errors-position="outside" />

                                <input type="hidden" name="id_order" id="id_order">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="btn-kembali">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(state) {

            // Modal
            if ("{{ $data[0]->user->alamat }}" == '') {
                $('#modal-edit').modal('show')
            }

            // Format Select2
            function formatState(state) {
                if (!state.id) {
                    return state.text;
                }

                var myElement = $(state.element)
                var a = parseFloat($(myElement).data('harga'))

                var $state = $(
                    '<span class="fw-bold">' + state.text + '</span><br> ' +
                    '<span style="font-size: 12px" class="text-secondary">Perkiraan Pengiriman : ' + $(
                        myElement).data('waktu') + ' Hari' +
                    '<span style="font-size: 12px" class="float-end fw-bold">Rp. ' + Intl.NumberFormat('en-DE')
                    .format($(myElement).data('harga')) + '</span></span>'
                );

                return $state;
            };

            // Init Select 2    
            $('#provinsi').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Provinsi --',
                dropdownParent: $("#modal-edit")
            });

            // Init Select 2    
            $('#desa').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Kecamatan --',
                dropdownParent: $("#modal-edit")
            });

            // Select Provinsi
            $.ajax({
                url: "{{ route('user.profile.provinsi') }}",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(response) {
                    $.each(response.data, function(index, value) {
                        $("#provinsi").append(
                            `<option value="${value['id']}">${value['name']}</option>`);
                    });
                },
            });

            // Init Select 2
            $('#kota').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Kota --',
                dropdownParent: $("#modal-edit")
            });

            // Select Kota
            $('#provinsi').on('select2:select', function(e) {
                var id = e.params.data.id;

                var link = "{{ route('user.profile.kota', ':id') }}";
                link = link.replace(':id', id);

                $.ajax({
                    url: link,
                    data: $(this).serialize(),
                    dataType: "JSON",
                    delay: 250,
                    beforeSend: function() {
                        $('#kota').attr('disabled', 'disabled');
                        $('#kota').empty().append(
                            '<option value="" selected disabled>-- Pilih Kota/Kabupaten --</option>'
                        );

                        $('#desa').attr('disabled', 'disabled');
                        $('#desa').empty().append(
                            '<option value="" selected disabled>-- Pilih Desa/Kelurahan --</option>'
                        );
                    },
                    success: function(data) {
                        $.each(data.data, function(index, value) {
                            $("#kota").append("<option value='" + value['id'] + "'>" +
                                value['name'] + "</option>");
                        });
                        $('#kota').removeAttr('disabled');
                    },
                    error: function() {
                        $('#kota').removeAttr('disabled');
                    }
                });
            })

            // Select Desa
            $('#kota').on('select2:select', function(e) {
                var id = e.params.data.id;

                var link = "{{ route('user.profile.desa', ':id') }}";
                link = link.replace(':id', id);

                $.ajax({
                    url: link,
                    data: $(this).serialize(),
                    dataType: "JSON",
                    delay: 250,
                    beforeSend: function() {
                        $('#desa').attr('disabled', 'disabled');
                        $('#desa').empty().append(
                            '<option value="" selected disabled>-- Pilih Desa/Kelurahan --</option>'
                        );
                    },
                    success: function(data) {
                        $.each(data.data, function(index, value) {
                            $("#desa").append("<option value='" + value['id'] + "'>" +
                                value['name'] + "</option>");
                        });
                        $('#desa').removeAttr('disabled');
                    },
                    error: function() {
                        $('#desa').removeAttr('disabled');
                    }
                });
            })

            // Init Select 2 Dropship  
            $('#provinsi_penerima').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Provinsi --',
                dropdownParent: $("#modal-dropship")
            });

            // Init Select 2 Dropship
            $('#desa_penerima').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Kecamatan --',
                dropdownParent: $("#modal-dropship")
            });

            // Select Provinsi Dropship
            $.ajax({
                url: "{{ route('user.profile.provinsi') }}",
                data: $(this).serialize(),
                dataType: "JSON",
                success: function(response) {
                    $.each(response.data, function(index, value) {
                        $("#provinsi_penerima").append(
                            `<option value="${value['id']}">${value['name']}</option>`);
                    });
                },
            });

            // Init Select 2 Dropship
            $('#kota_penerima').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Kota --',
                dropdownParent: $("#modal-dropship")
            });

            // Select Kota Dropship
            $('#provinsi_penerima').on('select2:select', function(e) {
                var id = e.params.data.id;

                var link = "{{ route('user.profile.kota', ':id') }}";
                link = link.replace(':id', id);

                $.ajax({
                    url: link,
                    data: $(this).serialize(),
                    dataType: "JSON",
                    delay: 250,
                    beforeSend: function() {
                        $('#kota_penerima').attr('disabled', 'disabled');
                        $('#kota_penerima').empty().append(
                            '<option value="" selected disabled>-- Pilih Kota/Kabupaten --</option>'
                        );

                        $('#desa_penerima').attr('disabled', 'disabled');
                        $('#desa_penerima').empty().append(
                            '<option value="" selected disabled>-- Pilih Desa/Kelurahan --</option>'
                        );
                    },
                    success: function(data) {
                        $.each(data.data, function(index, value) {
                            $("#kota_penerima").append("<option value='" + value['id'] +
                                "'>" +
                                value['name'] + "</option>");
                        });
                        $('#kota_penerima').removeAttr('disabled');
                    },
                    error: function() {
                        $('#kota_penerima').removeAttr('disabled');
                    }
                });
            })

            // Select Desa Dropship
            $('#kota_penerima').on('select2:select', function(e) {
                var id = e.params.data.id;

                var link = "{{ route('user.profile.desa', ':id') }}";
                link = link.replace(':id', id);

                $.ajax({
                    url: link,
                    data: $(this).serialize(),
                    dataType: "JSON",
                    delay: 250,
                    beforeSend: function() {
                        $('#desa_penerima').attr('disabled', 'disabled');
                        $('#desa_penerima').empty().append(
                            '<option value="" selected disabled>-- Pilih Desa/Kelurahan --</option>'
                        );
                    },
                    success: function(data) {
                        $.each(data.data, function(index, value) {
                            $("#desa_penerima").append("<option value='" + value['id'] +
                                "'>" +
                                value['name'] + "</option>");
                        });
                        $('#desa_penerima').removeAttr('disabled');
                    },
                    error: function() {
                        $('#desa_penerima').removeAttr('disabled');
                    }
                });
            })

            // Init Select2
            $("#pilih_paket").select2().next().hide();

            // Init Select2            
            $("#jasa_pengiriman").select2({
                theme: 'bootstrap-5',
                minimumResultsForSearch: -1,
                placeholder: 'Pilih Jasa Pengiriman',
            });

            // Get Paket Pengiriman
            $('#jasa_pengiriman').change(function(e) {
                e.preventDefault();

                var destination

                if ($('#dropship:checkbox:checked').length > 0) {
                    destination = "{{ $dropship ? $dropship->desa_penerima : 0 }}"
                } else {
                    destination = "{{ $data[0]->user->desa }}"
                }

                $.ajax({
                    type: "GET",
                    url: "{{ route('user.order.ongkir') }}",
                    data: {
                        city_destination: destination,
                        courier: $('#jasa_pengiriman').val(),
                        weight: "{{ $beratProduk }}"
                    },
                    beforeSend: function() {

                        $('#pilih_paket').empty()
                        $("#pilih_paket").append(
                            `<option value="">Pilih Paket Pengiriman</option>`);
                        $("#pilih_paket").select2().next().hide();

                        $('#pesan').attr("disabled", true)
                        $('#pesan').removeClass("btn-primary").addClass("btn-secondary")

                        $('#pesan').text('Lakukan Pemesanan')
                        $('#shipping_cost').text(0)
                        $('#grand_total').text('Rp. ' + Intl.NumberFormat('en-DE').format(
                            {{ $subTotal }}))

                        $('#loading').addClass('d-block').removeClass('d-none')
                    },
                    dataType: "JSON",
                    success: function(response) {

                        $('#loading').addClass('d-none').removeClass('d-block')

                        $("#pilih_paket").select2({
                            theme: 'bootstrap-5',
                            placeholder: 'Pilih Paket Pengiriman',
                            templateResult: formatState
                        }).next().show();

                        $.each(response.data[0].costs, function(index, value) {
                            $("#pilih_paket").append(
                                `<option data-waktu="${value['cost'][0].etd}" data-harga="${value['cost'][0].value}" value="${value['cost'][0].value}">(${value['service']}) ${value['description']}</option>`
                            );
                        });

                    }
                });
            });

            // Set Harga Pengiriman
            $("#pilih_paket").change(function(e) {
                e.preventDefault();

                $('#pesan').removeAttr("disabled")
                $('#pesan').addClass("btn-primary").removeClass("btn-secondary")

                var subTotal = parseInt({{ $subTotal }})
                var member = parseInt({{ $member_diskon }})
                var diskon_alquran = parseInt({{ $diskon_alquran }})
                var shipping = parseInt($('#pilih_paket').val())

                if ($("#id_member").val()) {
                    var TotalBiaya = Intl.NumberFormat('en-DE').format(shipping + subTotal - member -
                        diskon_alquran)
                } else {
                    var TotalBiaya = Intl.NumberFormat('en-DE').format(shipping + subTotal - diskon_alquran)
                }

                var buttonText = 'Lakukan Pemesanan - Rp. ' + TotalBiaya
                var kirim = 'Rp ' + Intl.NumberFormat('en-DE').format(shipping)
                var total = 'Rp ' + TotalBiaya


                $('#pesan').text(buttonText)
                $('#shipping_cost').text(kirim)
                $('#grand_total').text(total)
            });

            const js = {{ Js::from($data) }}

            // Pesan
            $('#pesan').click(function(e) {
                e.preventDefault();

                var dropship = 0

                if ($('#dropship:checkbox:checked').length > 0) {
                    dropship = 1
                } else {
                    dropship = 0
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.order.store_manual') }}",
                    data: {
                        user: "{{ Auth::user()->id }}",
                        courier: $('#jasa_pengiriman').val(),
                        courier_detail: $('#pilih_paket').select2('data')[0].text,
                        biaya_pengiriman: $('#pilih_paket').val(),
                        origin: "{{ config('rajaongkir.origin') }}",
                        destination: $('#subdistrict').val(),
                        catatan: $('#catatan').val(),
                        status_dropship: dropship,
                        data: js,
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');

                        $('#modal-bukti').modal('show')
                        $('#modal-bukti #id_order').val(response.data.id)
                    },
                    error: function(response) {
                        $.LoadingOverlay('hide');
                        if (response.responseJSON) {
                            Swal.fire('Gagal!', response.responseJSON.data, 'error');
                        } else {
                            Swal.fire('Gagal!', 'Periksa kembali data anda', 'error');
                        }
                    },
                });
            });

            //Flatpickr
            flatpickr("#tgl_transfer", {
                locale: "id",
                altInput: true,
                altFormat: "j F Y",
                dateFormat: "Y-m-d",
            });

            // Back
            $('#btn-kembali').click(function(e) {
                e.preventDefault();

                let a = "{{ route('user.order.detail_konfirmasi', ':id') }}"
                let b = a.replace(':id', $('#modal-bukti #id_order').val())

                location.href = b

            });

            // init Dropify
            if ($('.upload-berkas-dropify')) {
                $('.upload-berkas-dropify').dropify({
                    messages: {
                        'default': '<i class="fa-regular fa-image icon-file"></i> <br> Unggah file anda disini <br> <span>  Type: JPG | PNG | PDF (Max. 2MB) </span> <br> <button class="btn btn-yellow mt-3">Pilih File</button>',
                        'replace': 'Klik untuk mengganti file anda',
                        'remove': 'Hapus',
                        'error': 'Ooops, something wrong happended.'
                    },
                });
            }

            // Ubah Data
            $('.btn-ubah').click(function(e) {
                e.preventDefault();
                $('#modal-edit').modal('show')
            });

            // Ubah Catatan
            $('.btn-catatan').click(function(e) {
                e.preventDefault();
                $('#modal-catatan').modal('show')
            });

            // Update Data
            $('#form-catatan').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "PUT",
                    url: "{{ route('user.order.catatan') }}",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        location.reload()
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay('hide');
                    },
                });
            });

            // Update Data
            $('#form-edit').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.profile.store') }}",
                    data: $(this).serialize(),
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
                                location.reload()
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay('hide');
                        console.log(xhr);
                        switch (xhr.status) {
                            case 422:
                                $.each(xhr.responseJSON.data, function(index, value) {
                                    $('input[name="' + index + '"]').addClass(
                                        "is-invalid")
                                    $('textarea[name="' + index + '"]').addClass(
                                        "is-invalid")
                                    $('select[name="' + index + '"]').addClass(
                                        "is-invalid")
                                });
                                Swal.fire('Data Gagal Disimpan!',
                                    'Periksa Kembali data anda',
                                    'error');
                                break;
                            default:
                                Swal.fire('Data Gagal Disimpan!',
                                    'Kesalahan Server',
                                    'error');
                                break;
                        }
                    },
                });

            });

            // Dropship
            $('#dropship').change(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "GET",
                    url: "{{ route('user.order.dropship') }}",
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        if ($('#dropship:checkbox:checked').length > 0) {

                            $('#pilih_paket').empty();
                            $('#jasa_pengiriman').val('').change();

                            $('#detail_dropship').append(`
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <div class="mb-6">
                                                <h6>Alamat Penerima</h6>
                                                <p class="mb-1 lh-lg">
                                                    ${response.data.nama_penerima} <br>
                                                    ${response.data.alamat_penerima}
                                                    <br>
                                                    ${response.data.district.name}
                                                    ${response.data.city.name}
                                                    <br>
                                                    ${response.data.province.name}
                                                    Kode Pos.
                                                    ${response.data.city.postal_code}
                                                    <br />
                                                </p>
                                                <button class="btn btn-warning mt-2 btn-sm btn-dropship">Ubah
                                                    Data Dropshipper</button>
                                            </div>
                                            <input type="hidden" id="subdistrict"
                                                value="${response.data.desa}">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <div class="mb-6">
                                                <h6>Data Pengirim Dropshipper</h6>
                                                <p class="mb-1 lh-lg">
                                                    ${response.data.nama_pengirim}
                                                    <br />
                                                    ${response.data.email_pengirim}
                                                    <br />
                                                    ${response.data.no_telp_pengirim}
                                                </p>
                                            </div>
                                        </div>
                            `)
                        } else {
                            $('#detail_dropship').empty()
                        }
                    }
                });


            });

            // Ubah Dropship
            $('#detail_dropship').on('click', '.btn-dropship', function(e) {
                e.preventDefault();

                $('#modal-dropship').modal('show')
            });

            // Update Data
            $('#form-edit-dropship').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "PUT",
                    url: "{{ route('user.order.edit_dropship') }}",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                        $('#detail_dropship').empty()
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        $.ajax({
                            type: "GET",
                            url: "{{ route('user.order.dropship') }}",
                            dataType: "JSON",
                            beforeSend: function() {
                                $.LoadingOverlay('show');
                            },
                            success: function(response) {
                                $.LoadingOverlay('hide');
                                $('#modal-dropship').modal('hide')
                                $('#pilih_paket').empty();
                                $('#jasa_pengiriman').val('').change();
                                $('#detail_dropship').append(`
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <div class="mb-6">
                                                <h6>Alamat Penerima</h6>
                                                <p class="mb-1 lh-lg">
                                                    ${response.data.nama_penerima} <br>
                                                    ${response.data.alamat_penerima}
                                                    <br>
                                                    ${response.data.district.name}
                                                    ${response.data.city.name}
                                                    <br>
                                                    ${response.data.province.name}
                                                    Kode Pos.
                                                    ${response.data.city.postal_code}
                                                    <br />
                                                </p>
                                                <button class="btn btn-warning mt-2 btn-sm btn-dropship">Ubah
                                                    Data Dropshipper</button>
                                            </div>
                                            <input type="hidden" id="subdistrict"
                                                value="${response.data.desa}">
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-12">
                                            <div class="mb-6">
                                                <h6>Data Pengirim Dropshipper</h6>
                                                <p class="mb-1 lh-lg">
                                                    ${response.data.nama_pengirim}
                                                    <br />
                                                    ${response.data.email_pengirim}
                                                    <br />
                                                    ${response.data.no_telp_pengirim}
                                                </p>
                                            </div>
                                        </div>`)

                            }
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay('hide');
                        console.log(xhr);
                        switch (xhr.status) {
                            case 422:
                                $.each(xhr.responseJSON.data, function(index, value) {
                                    $('input[name="' + index + '"]').addClass(
                                        "is-invalid")
                                    $('textarea[name="' + index + '"]').addClass(
                                        "is-invalid")
                                    $('select[name="' + index + '"]').addClass(
                                        "is-invalid")
                                });
                                Swal.fire('Data Gagal Disimpan!',
                                    'Periksa Kembali data anda',
                                    'error');
                                break;
                            default:
                                Swal.fire('Data Gagal Disimpan!',
                                    'xhr.responseJSON.meta.message',
                                    'error');
                                break;
                        }
                    },
                });

            });

        });
    </script>
@endsection
