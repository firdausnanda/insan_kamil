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
                                                {{ $data[0]->user->city ? $data[0]->user->city->postal_code : '' }}
                                                <br />
                                            </p>
                                            <button class="btn btn-info mt-2 btn-sm btn-ubah" href="#">Ubah
                                                Data</button>
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
                                                                @if ($d->produk->gambar_produk)
                                                                    <img src="{{ asset('storage/produk/' . $d->produk->gambar_produk[0]->gambar) }}"
                                                                        alt="" class="icon-shape icon-lg" />
                                                                @else
                                                                    <img src="{{ asset('images/products/product-img-1.jpg') }}"
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
                                                        {{ rupiah($subTotal) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Modal Edit --}}
    <div class="modal fade" id="modal-edit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true">
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
                                <label class="form-label" for="desa">Kelurahan/Desa</label>
                                <select name="desa" id="desa" class="form-select">
                                    <option value="">Pilih Kelurahan/Desa</option>
                                    <option value="{{ $data[0]->user->district }}" selected>
                                        {{ $data[0]->user->district ? $data[0]->user->district->name : '' }}
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
                                <label class="form-label" for="desa">Kelurahan/Desa</label>
                                <select name="desa" id="desa_penerima" class="form-select">
                                    <option value="">Pilih Kelurahan/Desa</option>
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
                placeholder: '-- Pilih Kelurahan/Desa --',
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
                placeholder: '-- Pilih Kelurahan/Desa --',
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
                    destination = "{{ $dropship->desa_penerima }}"
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
                var shipping = parseInt($('#pilih_paket').val())
                var TotalBiaya = Intl.NumberFormat('en-DE').format(shipping + subTotal)

                var buttonText = 'Lakukan Pemesanan - Rp. ' + TotalBiaya
                var kirim = 'Rp. ' + Intl.NumberFormat('en-DE').format(shipping)
                var total = 'Rp. ' + TotalBiaya


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
                }else{
                    dropship = 0
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.order.store') }}",
                    data: {
                        user: "{{ Auth::user()->id }}",
                        courier: $('#jasa_pengiriman').val(),
                        biaya_pengiriman: $('#pilih_paket').val(),
                        origin: "{{ config('rajaongkir.origin') }}",
                        destination: $('#subdistrict').val(),
                        status_dropship: dropship,
                        data: js,
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');

                        snap.pay(response.data, {
                            onSuccess: function(result) {
                                // Success
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('user.order.pembayaran') }}",
                                    data: {
                                        id: result.order_id,
                                        status: 1
                                    },
                                    dataType: "JSON",
                                    beforeSend: function() {
                                        $.LoadingOverlay('show');
                                    },
                                    success: function(response) {
                                        $.LoadingOverlay('hide');
                                        location.href =
                                            "{{ route('user.order.konfirmasi') }}"
                                    }
                                });

                            },

                            onPending: function(result) {
                                // Pending
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('user.order.pembayaran') }}",
                                    data: {
                                        id: result.order_id,
                                        status: 2
                                    },
                                    dataType: "JSON",
                                    beforeSend: function() {
                                        $.LoadingOverlay('show');
                                    },
                                    success: function(response) {
                                        $.LoadingOverlay('hide');
                                        location.href =
                                            "{{ route('user.order.konfirmasi') }}"
                                    }
                                });
                            },

                            onError: function(result) {

                                // Error
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('user.order.pembayaran') }}",
                                    data: {
                                        id: result.order_id,
                                        status: 3
                                    },
                                    dataType: "JSON",
                                    beforeSend: function() {
                                        $.LoadingOverlay('show');
                                    },
                                    success: function(response) {
                                        $.LoadingOverlay('hide');
                                        location.reload()
                                    }
                                });
                            }

                        });

                        return false;
                    },
                    error: function(response) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Gagal!', 'Periksa kembali data anda.', 'error');
                    },
                });
            });

            // Ubah Data
            $('.btn-ubah').click(function(e) {
                e.preventDefault();
                $('#modal-edit').modal('show')
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
                                    'xhr.responseJSON.meta.message',
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
