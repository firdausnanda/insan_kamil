@extends('layouts.landing.main')

@section('content')
    <section class="my-lg-14 my-8">
        <!-- container -->
        <div class="container">
            <div class="row">
                <!-- col -->
                <div class="offset-lg-2 col-lg-8 col-12">

                    <div class="alert alert-primary mb-8" role="alert">
                        <strong>Perhatian</strong> <br>
                        Harap melengkapi form berikut dengan benar
                    </div>
                    
                    <div class="mb-8">
                        <!-- heading -->
                        <h1 class="h3">Profil Pengguna</h1>
                        <p>Profil pengguna harap dilengkapi</p>
                    </div>
                    
                    <!-- form -->
                    <form id="profile" class="row">
                        <!-- input -->
                        <div class="col-md-12 mb-3">
                            <!-- input -->
                            <label class="form-label" for="nama">
                                Nama Lengkap
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="nama" name="nama" value="{{ $user->name ?? '' }}"
                                class="form-control" placeholder="Nama Lengkap" required />
                            <input type="hidden" name="id_user" value="{{ $user->id }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="no_telepon">
                                Nomor Telepon
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="no_telepon" name="no_telepon" value="{{ $user->no_telp ?? '' }}"
                                class="form-control" placeholder="Nomor Telepon" required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <!-- input -->
                            <label class="form-label" for="email">Email</label>
                            <input type="text" id="email" name="email" value="{{ $user->email ?? '' }}"
                                class="form-control" placeholder="Email" required />
                        </div>
                        <div class="col-md-12 mb-3">
                            <!-- input -->
                            <label class="form-label" for="alamat">Alamat</label>
                            <textarea rows="3" id="alamat" name="alamat" class="form-control" placeholder="Nama Lengkap" required>{{ $user->alamat ?? '' }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <!-- input -->
                            <label class="form-label" for="provinsi">Provinsi</label>
                            <select name="provinsi" id="provinsi" class="form-select">
                                <option value="">Pilih Provinsi</option>
                                <option value="{{ $user->provinsi }}" selected>
                                    {{ $user->province ? $user->province->name : '' }}</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <!-- input -->
                            <label class="form-label" for="kota">Kota</label>
                            <select name="kota" id="kota" class="form-select">
                                <option value="">Pilih Kota</option>
                                <option value="{{ $user->kota }}" selected>{{ $user->city ? $user->city->name : '' }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <!-- input -->
                            <label class="form-label" for="desa">Kecamatan</label>
                            <select name="desa" id="desa" class="form-select">
                                <option value="">Pilih Kecamatan</option>
                                <option value="{{ $user->district ? $user->district->id : '' }}" selected>
                                    {{ $user->district ? $user->district->name : '' }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <!-- input -->
                            <label class="form-label" for="kode_pos">Kode Pos</label>
                            <input type="text" id="kode_pos" name="kode_pos" value="{{ $user->kode_pos ?? '' }}"
                                class="form-control" placeholder="Kode Pos" required />
                        </div>
                        <div class="col-md-12">
                            <!-- btn -->
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <hr class="my-10" />

        @if ($user->google_id == null)
            <div class="container">
                <div class="row mt-5">
                    <div class="offset-lg-2 col-lg-8 col-12">
                        <div class="mb-8">
                            <!-- heading -->
                            <h1 class="h3">Ubah Password</h1>
                        </div>
                        <!-- form -->
                        <form id="password" class="row needs-validation" novalidate>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="password_baru">
                                    Password Baru
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" id="password_baru" name="password_baru" class="form-control"
                                    placeholder="*******" required />
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="password_ulangi">
                                    Ulangi Password Baru
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" id="password_ulangi" name="password_ulangi" class="form-control"
                                    placeholder="*******" required />
                            </div>
                            <div class="col-md-12">
                                <!-- btn -->
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endif
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

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

            // Form Submit
            $("#profile").submit(function(e) {
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
                                location.href = "{{ route('user.profile.edit') }}"
                            });
                        }
                    },
                    error: function(response) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Gagal!', 'Periksa kembali data anda.', 'error');
                    },
                });
            });

            // Form Submit Password
            $("#password").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "POST",
                    url: "{{ route('user.profile.password') }}",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        if (response.meta.status == "success") {
                            Swal.fire('Sukses!', response.meta.message, 'success');
                            location.reload()
                        }
                    },
                    error: function(response) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Gagal!', 'Periksa kembali data anda.', 'error');
                    },
                });
            });

            // Init Select 2    
            $('#desa').select2({
                theme: 'bootstrap-5',
                placeholder: '-- Pilih Kecamatan --'
            });

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
        });
    </script>
@endsection
