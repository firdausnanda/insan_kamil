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
                            <h2>Tambah Produk Baru</h2>
                            <!-- breacrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#" class="text-inherit">Produk</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Tambah Produk Baru</li>
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
            <form id="form-store" method="POST" enctype="multipart/form-data">
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
                                            placeholder="Judul Produk" required />
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3 col-lg-6">
                                        <label class="form-label">Kategori Produk</label>
                                        <div class="row align-items-center">
                                            <div class="col-10">
                                                <select class="form-select" name="kategori" id="kategori">
                                                    <option selected>Pilih Kategori</option>
                                                    @foreach ($kategori as $k)
                                                        <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
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
                                            placeholder="Berat" required />
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3 col-lg-6">
                                        <label class="form-label">Ukuran <i class="text-muted">(cm)</i></label>
                                        <div class="row align-items-center">
                                            <div class="col-6 pe-0">
                                                <input type="text" name="panjang" id="panjang" class="form-control"
                                                    placeholder="Panjang" required />
                                            </div>
                                            <div class="col-6">
                                                <input type="text" name="lebar" id="lebar" class="form-control"
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
                                                        <option value="{{ $p->id }}">{{ $p->nama_penerbit }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-2 ps-0">
                                                <a href="{{ route('admin.penerbit.index') }}" class="btn btn-sm btn-info"><i
                                                        class="fa-solid fa-plus"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3 col-lg-6">
                                        <label class="form-label">Bahasa</label>
                                        <select class="form-select" name="bahasa">
                                            <option selected>Pilih Bahasa</option>
                                            <option value="3">Indonesia</option>
                                            <option value="3">Inggris</option>
                                            <option value="3">Bilingual (Inggris - Indonesia)</option>
                                            <option value="3">Arab</option>
                                        </select>
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3 col-lg-6">
                                        <label class="form-label">ISBN</label>
                                        <input type="text" name="isbn" class="form-control" placeholder="ISBN"
                                            required />
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3 col-lg-6">
                                        <label class="form-label">Jenis Cover</label>
                                        <input type="text" name="jenis_cover" class="form-control"
                                            placeholder="Jenis Cover" required />
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3 col-lg-6">
                                        <label class="form-label">Jumlah Halaman</label>
                                        <input type="text" name="jumlah_halaman" class="form-control"
                                            placeholder="Jumlah Halaman" required />
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3 col-lg-6">
                                        <label class="form-label">Pengarang</label>
                                        <input type="text" name="pengarang" class="form-control"
                                            placeholder="Pengarang" required />
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
                                        <div class="py-8" id="editor"></div>
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
                                    <div class="mb-3">
                                        <label class="form-label">Kode Produk</label>
                                        <input type="text" class="form-control" name="kode_produk"
                                            placeholder="Kode Produk" />
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3">
                                        <label class="form-label">Stok Barang <i class="text-muted">(buah)</i></label>
                                        <input type="text" class="form-control" id="stok" name="stok"
                                            placeholder="Stok Barang" />
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3">
                                        <label class="form-label" id="productSKU">Status</label>
                                        <br />
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="inlineRadio1" value="3" checked />
                                            <label class="form-check-label" for="inlineRadio1">Draft</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="inlineRadio1" value="1" checked />
                                            <label class="form-check-label" for="inlineRadio1">Publish</label>
                                        </div>
                                        <!-- input -->
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="inlineRadio2" value="2" />
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
                                        placeholder="Rp. 0.00" />
                                </div>
                                <!-- input -->
                                <div class="mb-3">
                                    <label class="form-label">Harga Promo</label>
                                    <input type="text" class="form-control" name="harga_promo" id="harga_promo"
                                        placeholder="Rp. 0.00" />
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
            $('#berat').mask('0000');
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
                console.log("File removed: " + o.name)
            }), myDropzone.on("success", function(o, e) {
                console.log("File uploaded successfully:", e)
            });

            // Form Store
            $('#form-store').submit(function(e) {
                e.preventDefault();

                var harga_normal = $('#harga_normal').cleanVal();
                var harga_promo = $('#harga_promo').cleanVal();
                var editor_content = quill.container.firstChild.innerHTML

                var formData = new FormData(this);
                formData.append('harga_normal_clean', harga_normal);
                formData.append('harga_promo_clean', harga_promo);
                formData.append('deskripsi', editor_content);

                $.ajax({
                    url: "{{ route('admin.produk.store') }}",
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
                                location.reload();
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
        });
    </script>
@endsection
