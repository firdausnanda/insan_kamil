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
                                <div class="row">
                                    <!-- address -->
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="mb-6">
                                            <h6>Alamat Pengiriman</h6>
                                            <p class="mb-1 lh-lg">
                                                {{ $data[0]->user->alamat }}
                                                <br>
                                                {{ $data[0]->user->city ? $data[0]->user->city->name : '' }},
                                                {{ $data[0]->user->province ? $data[0]->user->province->name : '' }}
                                                <br>
                                                Kode Pos.
                                                {{ $data[0]->user->city ? $data[0]->user->city->postal_code : '' }}
                                                <br />
                                            </p>
                                            <button class="btn btn-info mt-2 btn-sm btn-ubah" href="#">Ubah
                                                Data</button>
                                        </div>
                                    </div>
                                    <!-- address -->
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
                                    <!-- address -->
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
                                <input type="hidden" name="id_user"value="{{ $data[0]->user->id }}" />
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="no_telepon">
                                    Nomor Telepon
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="hidden" value="{{ $data[0]->user->no_telp }}">
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

                $.ajax({
                    type: "GET",
                    url: "{{ route('user.order.ongkir') }}",
                    data: {
                        city_destination: "{{ $data[0]->user->kota }}",
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

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.order.store') }}",
                    data: {
                        user: "{{ Auth::user()->id }}",
                        courier: $('#jasa_pengiriman').val(),
                        biaya_pengiriman: $('#pilih_paket').val(),
                        origin: $('#pilih_paket').val(),
                        destination: $('#pilih_paket').val(),
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
                                console.log(result);
                                console.log('1');
                                // location.reload();
                            },

                            onPending: function(result) {
                                console.log(result);
                                console.log('2');
                                // location.reload();
                            },

                            onError: function(result) {
                                console.log(result);
                                console.log('3');
                                // location.reload();
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

        });
    </script>
@endsection
