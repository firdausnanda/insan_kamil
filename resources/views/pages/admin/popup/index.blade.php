@extends('layouts.dashboard.main')

@section('content')
    <main class="main-content-wrapper">
        <div class="container">
            <div class="row mb-8">
                <div class="col-md-12">
                    <!-- page header -->
                    <div class="d-md-flex justify-content-between align-items-center">
                        <div>
                            <h2>Popup</h2>
                            <!-- breacrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" class="text-inherit">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Popup</li>
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
                        <div class="card-body p-5">

                            <h2>Popup Detail</h2>
                            @if ($p->status == 1)
                                <button class="btn btn-danger btn-sm btn-aktif">Non-Aktifkan</button>
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <button class="btn btn-primary btn-sm btn-aktif">Aktifkan</button>
                                <span class="badge bg-danger">Non-Aktif</span>
                            @endif

                            <form id="form-simpan" enctype="multipart/form-data">
                                <div class="row mt-5 g-3">
                                    <div class="col-8">
                                        <label for="judul" class="form-label">Judul</label>
                                        <input type="text" id="judul" name="judul" value="{{ $p->judul ?? '' }}"
                                            class="form-control">
                                        <input type="hidden" name="id" value="{{ $p->id ?? 1 }}">
                                    </div>
                                    <div class="col-8">
                                        <label for="diskon" class="form-label">Diskon (%)</label>
                                        <input type="number" id="diskon" name="diskon" value="{{ $p->diskon ?? '' }}"
                                            class="form-control">
                                    </div>
                                    <div class="col-8">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <textarea name="keterangan" id="keterangan" class="form-control" cols="30" rows="5">{{ $p->keterangan ?? '' }}</textarea>
                                    </div>
                                    <div class="col-8">
                                        <label for="gambar" class="col-sm-4 col-form-label">Gambar</label>
                                        <!-- input -->
                                        <input type="file" class="upload-gambar-dropify" name="gambar"
                                            data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg"
                                            @if ($p && $p->gambar) data-default-file="{{ asset('storage/popup/' . $p->gambar) }}" @endif
                                            id="gambar" data-errors-position="outside" />
                                    </div>
                                    <div class="col-8">
                                        <button class="btn btn-info btn-sm float-end" type="submit">Simpan</button>
                                    </div>
                            </form>

                        </div>
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
            if ($('.upload-gambar-dropify')) {
                $('.upload-gambar-dropify').dropify({
                    messages: {
                        'default': '<i class="fa-regular fa-image icon-file"></i> <br> Unggah gambar anda disini <br> <span>  Type: JPG | JPEG | PNG (Max. 2MB) </span> <br> <button class="btn btn-yellow mt-3">Pilih File</button>',
                        'replace': 'Klik untuk mengganti gambar anda',
                        'remove': 'Hapus',
                        'error': 'Ooops, something wrong happended.'
                    },
                });
            }

            // Submit Simpan
            $("#form-simpan").submit(function(e) {
                e.preventDefault();

                var formDataa = new FormData(document.getElementById("form-simpan"));

                $.ajax({
                    type: "POSt",
                    url: "{{ route('admin.popup.store') }}",
                    data: formDataa,
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
                                location.reload()
                            });
                        }
                    },
                    error: function(response) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Gagal!', 'Periksa kembali data anda.', 'error');
                        console.log(response.responseJSON.message);
                    },
                });
            });

            // Modal Aktif
            $('.btn-aktif').click(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: "Apakah anda akan merubah status popup?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#889397",
                    confirmButtonText: "Lanjutkan",
                    cancelButtonText: "Batalkan",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: "{{ route('admin.popup.aktif') }}",
                            data: {
                                id: "{{ $p->id }}",
                                status: "{{ $p->status }}",
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

            });

        });
    </script>
@endsection
