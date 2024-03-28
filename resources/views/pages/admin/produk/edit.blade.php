@extends('layouts.dashboard.main')

@section('content')
    <!-- main -->
    <main class="main-content-wrapper">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row mb-8">
                <div class="col-md-12">
                    <div class="d-md-flex justify-content-between align-items-center">
                        <!-- page header -->
                        <div>
                            <h2>Edit Produk</h2>
                            <!-- breacrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"
                                            class="text-inherit">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.produk.index') }}"
                                            class="text-inherit">Produk</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Produk</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- button -->
                        <div>
                            <a href="{{ route('admin.produk.index') }}" class="btn btn-light">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
            <form id="form-edit" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-8 col-12">
                        <!-- card -->
                        <div class="card mb-6 card-lg">
                            <!-- card body -->
                            <div class="card-body p-6">
                                <h4 class="mb-4 h5">Informasi Produk</h4>
                                <div class="row">
                                    <!-- input -->
                                    <div class="mb-3 col-lg-6">
                                        <label class="form-label">Judul</label>
                                        <input type="text" name="judul" id="judul" class="form-control"
                                            placeholder="Judul Produk" value="{{ $produk->nama_produk ?? '' }}" required />
                                        <input type="hidden" name="id" value="{{ $produk->id }}">
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3 col-lg-6">
                                        <label class="form-label">Kategori Produk</label>
                                        <div class="row align-items-center">
                                            <div class="col-10">
                                                <select class="form-select" name="kategori" id="kategori">
                                                    <option selected>Pilih Kategori</option>
                                                    @foreach ($kategori as $k)
                                                        <option value="{{ $k->id }}"
                                                            {{ $k->id == $produk->id_kategori ? 'Selected' : '' }}>
                                                            {{ $k->nama_kategori }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-2 ps-0">
                                                <a href="{{ route('admin.kategori.index') }}" class="btn btn-sm btn-info"><i
                                                        class="fa-solid fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3 col-lg-6">
                                        <label class="form-label">Berat <i class="text-muted">(gram)</i></label>
                                        <input type="text" name="berat" id="berat" class="form-control"
                                            placeholder="Berat" value="{{ $produk->berat_produk ?? '' }}" required />
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3 col-lg-6">
                                        <label class="form-label">Ukuran <i class="text-muted">(cm)</i></label>
                                        <div class="row align-items-center">
                                            <div class="col-6 pe-0">
                                                <input type="text" name="panjang" id="panjang" class="form-control"
                                                    placeholder="Panjang" value="{{ $ukuran ? $ukuran[0] : '' }}"
                                                    required />
                                            </div>
                                            <div class="col-6">
                                                <input type="text" name="lebar" id="lebar"
                                                    value="{{ $ukuran ? $ukuran[1] : '' }}" class="form-control"
                                                    placeholder="Lebar" required />
                                            </div>
                                        </div>
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3 col-lg-6">
                                        <label class="form-label">Penerbit</label>
                                        <div class="row align-items-center">
                                            <div class="col-10">
                                                <select class="form-select" name="penerbit" id="penerbit">
                                                    <option selected>Pilih Penerbit</option>
                                                    @foreach ($penerbit as $p)
                                                        <option value="{{ $p->id }}"
                                                            {{ $p->id == $produk->id_penerbit ? 'Selected' : '' }}>
                                                            {{ $p->nama_penerbit }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-2 ps-0">
                                                <a href="{{ route('admin.penerbit.index') }}"
                                                    class="btn btn-sm btn-info"><i class="fa-solid fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3 col-lg-6">
                                        <label class="form-label">Bahasa</label>
                                        <div class="row align-items-center">
                                            <div class="col-10">
                                                <select class="form-select" name="bahasa" id="bahasa">
                                                    <option selected>Pilih Bahasa</option>
                                                    @foreach ($bahasa as $b)
                                                        <option value="{{ $b->id }}"
                                                            {{ $b->id == $produk->id_bahasa }} selected>
                                                            {{ $b->bahasa }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-2 ps-0">
                                                <a href="{{ route('admin.bahasa.index') }}" class="btn btn-sm btn-info"><i
                                                        class="fa-solid fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3 col-lg-6">
                                        <label class="form-label">ISBN</label>
                                        <input type="text" name="isbn" class="form-control"
                                            value="{{ $produk->isbn }}" placeholder="ISBN" required />
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3 col-lg-6">
                                        <label class="form-label">Jenis Cover</label>
                                        <input type="text" name="jenis_cover" class="form-control"
                                            value="{{ $produk->jenis_cover }}" placeholder="Jenis Cover" required />
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3 col-lg-6">
                                        <label class="form-label">Jumlah Halaman</label>
                                        <input type="text" name="jumlah_halaman" class="form-control"
                                            value="{{ $produk->halaman_produk }}" placeholder="Jumlah Halaman"
                                            required />
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3 col-lg-6">
                                        <label class="form-label">Pengarang</label>
                                        <input type="text" name="pengarang" class="form-control"
                                            value="{{ $produk->pengarang }}" placeholder="Pengarang" required />
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3 col-lg-6">
                                        <label class="form-label">Jenis Isi</label>
                                        <input type="text" value="{{ $produk->jenis_isi }}" name="jenis_isi"
                                            class="form-control" placeholder="Jenis Isi" required />
                                    </div>
                                    <div>
                                        <div class="mb-3 col-lg-12 mt-5">
                                            <!-- heading -->
                                            <h4 class="mb-3 h5">Gambar Produk</h4>

                                            <!-- input -->
                                            <div id="my-dropzone" class="dropzone mt-4 border-dashed rounded-2 min-h-0">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3 col-lg-12 mt-5">
                                        <h4 class="mb-3 h5">Deskripsi Produk</h4>
                                        <div class="py-8" id="editor">{!! $produk->keterangan !!}</div>
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3 col-lg-12 mt-5">
                                        <h4 class="mb-3 h5">Catatan Penjualan</h4>
                                        <textarea name="catatan" cols="30" rows="3" class="form-control">{{ $produk->catatan }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <!-- card -->
                        <div class="card mb-6 card-lg">
                            <!-- card body -->
                            <div class="card-body p-6">
                                <!-- input -->
                                <div class="form-check form-switch mb-4">
                                    <input class="form-check-input" type="checkbox" name="instok" role="switch"
                                        id="flexSwitchStock" checked />
                                    <label class="form-check-label" for="flexSwitchStock">In Stock</label>
                                </div>
                                <!-- input -->
                                <div>
                                    <!-- input -->
                                    <div class="mb-3">
                                        <label class="form-label">Stok Barang <i class="text-muted">(buah)</i></label>
                                        <input type="text" class="form-control" id="stok"
                                            value="{{ $produk->stok->sisa_produk }}" name="stok"
                                            placeholder="Stok Barang" />
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3">
                                        <label class="form-label" id="productSKU">Status</label>
                                        <br />
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="inlineRadio1" value="3"
                                                {{ $produk->status == 3 ? 'checked' : '' }} />
                                            <label class="form-check-label" for="inlineRadio1">Draft</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="inlineRadio1" value="1"
                                                {{ $produk->status == 1 ? 'checked' : '' }} />
                                            <label class="form-check-label" for="inlineRadio1">Publish</label>
                                        </div>
                                        <!-- input -->
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="inlineRadio2" value="2"
                                                {{ $produk->status == 2 ? 'checked' : '' }} />
                                            <label class="form-check-label" for="inlineRadio2">Non - Aktif</label>
                                        </div>
                                        <!-- input -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card -->
                        <div class="card mb-6 card-lg">
                            <!-- card body -->
                            <div class="card-body p-6">
                                <h4 class="mb-4 h5">Harga Produk</h4>
                                <!-- input -->
                                <div class="mb-3">
                                    <label class="form-label">Harga Normal</label>
                                    <input type="text" class="form-control" name="harga_normal" id="harga_normal"
                                        value="{{ $produk->harga->harga_awal }}" placeholder="Rp. 0.00" />
                                </div>
                                <!-- input -->
                                <div class="mb-3">
                                    <label class="form-label">Harga Promo <span class="text-danger">*</span><span
                                            class="text-secondary" style="font-size: 12px">jika tidak promo isi dengan
                                            nilai 0</span></label>
                                    <input type="text" class="form-control" name="harga_promo" id="harga_promo"
                                        value="{{ $produk->harga->diskon }}" placeholder="Rp. 0.00" />
                                </div>
                                <!-- input -->
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Mulai Diskon</label>
                                    <input type="date" class="form-control"
                                        value="{{ $produk->harga->mulai_diskon }}" name="tanggal_mulai_diskon"
                                        id="tanggal_mulai_diskon" />
                                </div>
                                <!-- input -->
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Selesai Diskon</label>
                                    <input type="date" class="form-control" name="tanggal_selesai_diskon"
                                        id="tanggal_selesai_diskon" value="{{ $produk->harga->selesai_diskon }}" />
                                </div>
                            </div>
                        </div>

                        <!-- button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Simpan Produk</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('script')
    <script src="{{ asset('vendor/dropzone/dist/min/dropzone.min.js') }}"></script>
    {{-- <script src="{{ asset('js/vendors/dropzone.js') }}"></script> --}}

    <script>
        Dropzone.autoDiscover = !1;
        $(document).ready(function() {

            // Masking
            $('#berat').mask('0000000000');
            $('#panjang').mask('0000');
            $('#lebar').mask('0000');
            $('#stok').mask('00000');
            $('#harga_normal').mask('000.000.000', {
                reverse: true
            });
            $('#harga_promo').mask('000.000.000', {
                reverse: true
            });

            // Init Select 2
            $('#kategori').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Kategori --',
            });

            $('#penerbit').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Kategori --',
            });

            // Upload Image
            var uploadedDocumentMap = {}
            const myDropzone = new Dropzone("#my-dropzone", {
                url: "{{ route('admin.produk.image') }}",
                maxFilesize: 4,
                thumbnailWidth: 120,
                acceptedFiles: "image/*",
                addRemoveLinks: !0,
                autoProcessQueue: !0,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(file, response) {
                    $('form').append('<input type="hidden" name="document[]" value="' + response.name +
                        '">')
                    uploadedDocumentMap[file.name] = response.name
                },
                removedfile: function(file) {
                    file.previewElement.remove()
                    var name = ''
                    if (typeof file.file_name !== 'undefined') {
                        name = file.file_name
                    } else {
                        name = uploadedDocumentMap[file.name]
                    }
                    $('form').find('input[name="document[]"][value="' + name + '"]').remove()
                },
                init: function() {
                    @if (isset($project) && $project->document)
                        var files =
                            {!! json_encode($project->document) !!}
                        for (var i in files) {
                            var file = files[i]
                            this.options.addedfile.call(this, file)
                            file.previewElement.classList.add('dz-complete')
                            $('form').append('<input type="hidden" name="document[]" value="' + file
                                .file_name + '">')
                        }
                    @endif
                }
            });
            myDropzone.on("addedfile", function(o) {
                console.log("File added: " + o.name)
            }), myDropzone.on("removedfile", function(o) {

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.produk.removeImage') }}",
                    data: {
                        id: o.id,
                        name: o.name
                    },
                    dataType: "JSON",
                    beforeSend: function(response) {
                        $.LoadingOverlay('show')
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide')
                        console.log(response);
                    }
                });

                console.log("File removed: " + o.name)
            }), myDropzone.on("success", function(o, e) {
                console.log("File uploaded successfully:", e)
            });

            var gambar_link = "{{ route('admin.produk.edit', ':id') }}"
            var gambar_url = gambar_link.replace(':id', '{{ $produk->id }}')

            $.ajax({
                type: "GET",
                url: gambar_url,
                data: "data",
                dataType: "JSON",
                success: function(response) {
                    let b = []
                    $.each(response.data, function(index, value) {
                        let a = {}
                        a.name = value.gambar
                        a.size = value.ukuran
                        a.id = value.id
                        b.push(a)
                    });

                    for (i = 0; i < b.length; i++) {
                        myDropzone.emit("addedfile", b[i]);
                        myDropzone.emit("thumbnail", b[i], `/storage/produk/${b[i].name}`);
                        myDropzone.emit("complete", b[i]);
                    }
                }
            });

            // Form Store
            $('#form-edit').submit(function(e) {
                e.preventDefault();

                var harga_normal = $('#harga_normal').cleanVal();
                var harga_promo = $('#harga_promo').cleanVal();
                var editor_content = quill.container.firstChild.innerHTML

                var formData = new FormData(this);
                formData.append('harga_normal_clean', harga_normal);
                formData.append('harga_promo_clean', harga_promo);
                formData.append('deskripsi', editor_content);

                $.ajax({
                    url: "{{ route('admin.produk.update') }}",
                    type: "POST",
                    data: formData,
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                        $('input').removeClass('is-invalid');
                        $('select').removeClass('is-invalid');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        if (response.meta.status == "success") {
                            Swal.fire({
                                icon: 'success',
                                title: "Sukses!",
                                text: response.meta.message,
                            }).then((result) => {
                                location.href = "{{ route('admin.produk.index') }}";
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay('hide');
                        switch (xhr.status) {
                            case 422:
                                $.each(xhr.responseJSON.data, function(index, value) {
                                    $('input[name="' + index + '"]').addClass(
                                        "is-invalid")
                                    $('select[name="' + index + '"]').addClass(
                                        "is-invalid")
                                    $('.tanggal').last().addClass("is-invalid")
                                    $.each(value, function(k, v) {
                                        $("span." + index + "_msg").text(v);
                                    });
                                });
                                Swal.fire('Data Gagal Disimpan!',
                                    'xhr.responseJSON.meta.message',
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

            //Flatpickr
            flatpickr("#tanggal_selesai_diskon", {
                locale: "id",
                altInput: true,
                altFormat: "j F Y, H:i",
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });

            //Flatpickr
            flatpickr("#tanggal_mulai_diskon", {
                locale: "id",
                altInput: true,
                altFormat: "j F Y, H:i",
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });

        });
    </script>
@endsection
