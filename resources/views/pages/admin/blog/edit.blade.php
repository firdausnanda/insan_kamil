@extends('layouts.dashboard.main')

@section('content')
    <main class="main-content-wrapper">
        <div class="container">
            <div class="row mb-8">
                <div class="col-md-12">
                    <!-- page header -->
                    <div class="d-md-flex justify-content-between align-items-center">
                        <div>
                            <h2>Blog</h2>
                            <!-- breacrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"
                                            class="text-inherit">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.blog.index') }}"
                                            class="text-inherit">Blog</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Ubah Blog</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
            <div class="row ">
                <div class="col-xl-12 col-12 mb-5">
                    <!-- card -->
                    <div class="card h-100 card-lg">

                        <!-- card body -->
                        <div class="card-body">

                            <h4 class="mb-4 h5">Informasi Blog</h4>

                            <form id="form-store">
                                <div class="row">
                                    <!-- input -->
                                    <div class="mb-3 col-lg-12">
                                        <label class="form-label">Judul</label>
                                        <input type="text" name="judul" id="judul" class="form-control"
                                            placeholder="Judul Blog" value="{{ $b->judul }}" required />
                                        <input type="hidden" name="id" value="{{ $b->id }}">
                                    </div>
                                    <div>
                                        <div class="mb-3 col-lg-12 mt-5">
                                            <!-- heading -->
                                            <h4 class="mb-3 h5">Gambar</h4>

                                            <!-- input -->
                                            <input type="file" class="upload-berkas-dropify" name="gambar"
                                                data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg"
                                                id="berkas" data-errors-position="outside"
                                                @if ($b->gambar) data-default-file="{{ asset('storage/blog/' . $b->gambar) }}" @endif />
                                        </div>
                                    </div>
                                    <!-- input -->
                                    <div class="mb-3 col-lg-12 mt-5">
                                        <h4 class="mb-3 h5">Deskripsi</h4>
                                        <div class="py-8" id="editor">{!! $b->isi !!}</div>
                                    </div>

                                    <div class="mb-3 col-lg-12">
                                        <button class="btn btn-primary float-end">Simpan</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </main>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            // init Dropify
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

            // Form Store
            $('#form-store').submit(function(e) {
                e.preventDefault();

                var editor_content = quill.container.firstChild.innerHTML

                var formData = new FormData(this);
                formData.append('deskripsi', editor_content);

                $.ajax({
                    url: "{{ route('admin.blog.update') }}",
                    type: "POST",
                    data: formData,
                    dataType: "JSON",
                    cache: false,
                    contentType: false,
                    processData: false,
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
                                location.href = "{{ route('admin.blog.index') }}";
                            });
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Data Gagal Disimpan!',
                            'Kesalahan Server',
                            'error');
                    },
                });
            });

        });
    </script>
@endsection
