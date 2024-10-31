@extends('layouts.dashboard.main')

@section('content')
    <main class="main-content-wrapper">
        <div class="container">
            <div class="row mb-8">
                <div class="col-md-12">
                    <!-- page header -->
                    <div class="d-md-flex justify-content-between align-items-center">
                        <div>
                            <h2>Data Reedem Customer</h2>
                            <!-- breacrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"
                                            class="text-inherit">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Reedem Customer</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- button -->
                        <div>
                            <a class="btn btn-primary btn-tambah">Data Reward</a>
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
                        <div class="card-body p-0">

                            <div class="table-responsive p-5">
                                <table class="table table-striped" id="reward">
                                    <thead>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama Customer</th>
                                        <th scope="col">Tanggal Pengajuan</th>
                                        <th scope="col">Reward</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Aksi</th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </main>

    <!-- Modal Detail-->
    <div class="modal fade" id="detailReedem" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Detail Reedem
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-5">
                        <div class="col-lg-12 d-flex justify-content-center" id="avatar">
                            <img src="{{ asset('images/avatar/no-image.png') }}" alt=""
                                class="icon-shape icon-lg" />
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Nama Customer</label>
                            <input type="text" class="form-control-plaintext py-0" id="nama" readonly>
                            <input type="hidden" id="id">
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Email Customer</label>
                            <input type="text" class="form-control-plaintext py-0" id="email" readonly>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Tanggal Pengajuan</label>
                            <input type="text" class="form-control-plaintext py-0" id="tanggal" readonly>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Nama Reward</label>
                            <input type="text" class="form-control-plaintext py-0" id="nama_reward" readonly>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Poin Reward</label>
                            <input type="text" class="form-control-plaintext py-0" id="point_reward" readonly>
                        </div>
                        <div class="col-lg-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control-plaintext py-0" id="deskripsi" readonly></textarea>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">Nama Rekening</label>
                            <input type="text" class="form-control-plaintext py-0" id="nama_rekening" readonly>
                        </div>
                        <div class="col-lg-6">
                            <label class="form-label">No Rekening</label>
                            <input type="text" class="form-control-plaintext py-0" id="no_rekening" readonly>
                        </div>
                        <div class="col-lg-12 d-flex justify-content-center" id="ktp">
                            <img src="{{ asset('images/avatar/no-image.png') }}" alt=""
                                class="icon-shape icon-lg" />
                        </div>
                        <div class="col-lg-12 d-flex justify-content-center gap-2">
                            <button class="btn btn-success btn-approve">Setujui</button>
                            <button class="btn btn-danger btn-reject">Tolak</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Init Datatable
            var table = $('#reward').DataTable({
                ajax: {
                    url: "{{ route('admin.reward.index') }}",
                    type: "GET"
                },
                lengthChange: false,
                ordering: false,
                processing: true,
                columnDefs: [{
                        targets: 0,
                        width: '10%',
                        className: 'align-middle text-center',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        targets: 1,
                        className: 'align-middle',
                        data: 'user.name',
                        render: function(data, type, row, meta) {
                            return `<b>${data}</b><br><span class="text-muted">${row.user.email}</span>`
                        }
                    },
                    {
                        targets: 2,
                        className: 'align-middle',
                        data: 'created_at',
                        render: function(data, type, row, meta) {
                            return moment(data).format('DD MMMM YYYY');
                        }
                    },
                    {
                        targets: 3,
                        className: 'align-middle',
                        data: 'reward.nama',
                        render: function(data, type, row, meta) {
                            return `<span>${data}</span><br><b>${row.reward.point_total} Point</b>`
                        }
                    },
                    {
                        targets: 4,
                        className: 'align-middle text-center',
                        data: 'status',
                        render: function(data, type, row, meta) {
                            if (data == 'process')
                                return `<span class="badge bg-warning">Proses</span>`
                            if (data == 'success')
                                return `<span class="badge bg-success">Sukses</span>`
                            if (data == 'failed')
                                return `<span class="badge bg-danger">Ditolak</span>`
                        }
                    },
                    {
                        targets: 5,
                        className: 'align-middle text-center',
                        render: function(data, type, row, meta) {
                            return `<button class="btn btn-sm btn-primary btn-detail">Detail</button>`
                        }
                    }
                ]
            });

            // Modal Tambah Show
            $(".btn-tambah").click(function(e) {
                e.preventDefault();
                window.location.href = "{{ route('admin.reward.master') }}"
            });

            // Modal Detail Show
            $('#reward tbody').on('click', '.btn-detail', function(event) {
                event.preventDefault();
                var data = table.row($(this).parents('tr')).data();

                var nama = data.user.name;
                var id = data.id;
                var avatar = data.user.avatar;
                var email = data.user.email;
                var tanggal = moment(data.created_at).format('DD MMMM YYYY');
                var reward = data.reward.nama;
                var point = data.reward.point_total;
                var deskripsi = data.deskripsi;
                var nama_rekening = data.nama_pemilik;
                var no_rekening = data.no_rekening;
                var ktp = data.ktp;

                if (avatar == null) {
                    $('#avatar').html(
                        `<img src="{{ asset('images/avatar/no-image.png') }}" alt="" class="icon-shape icon-lg" />`
                        );
                } else {
                    $('#avatar').html(`<img src="${avatar}" alt="" class="icon-shape icon-lg" />`);
                }
                $('#id').val(id);
                $('#nama').val(nama);
                $('#email').val(email);
                $('#tanggal').val(tanggal);
                $('#nama_reward').val(reward);
                $('#point_reward').val(point);
                $('#deskripsi').val(deskripsi);
                $('#nama_rekening').val(nama_rekening);
                $('#no_rekening').val(no_rekening);
                if (ktp == null) {
                    $('#ktp').html(
                        `<img src="{{ asset('images/avatar/no-image.png') }}" alt="" class="icon-shape icon-lg" />`
                        );
                } else {
                    $('#ktp').html(
                        `<img src="{{ asset('storage/bukti_redeem/${ktp}') }}" alt="" class="img-thumbnail" style="width: 200px;" />`
                        );
                }

                $('#detailReedem').modal('show');
            });

            // Approve
            $('.btn-approve').click(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data akan disetujui!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.reward.approve') }}",
                            data: {
                                id: $('#id').val()
                            },
                            dataType: "json",
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Loading',
                                    text: 'Please wait...',
                                    allowOutsideClick: false,
                                });
                            },
                            success: function(response) {
                                Swal.close();
                                Swal.fire({
                                    title: 'Success',
                                    text: response.meta.message,
                                    icon: 'success',
                                })
                                $('#detailReedem').modal('hide');
                                table.ajax.reload();
                            },
                            error: function(response) {
                                Swal.close();
                                Swal.fire({
                                    title: 'Error',
                                    text: response.meta.message,
                                });
                            }
                        });
                    }
                });
            });

            // Reject
            $('.btn-reject').click(function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data akan ditolak!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.reward.reject') }}",
                            data: {
                                id: $('#id').val()
                            },
                            dataType: "json",
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Loading',
                                    text: 'Please wait...',
                                    allowOutsideClick: false,
                                });
                            },
                            success: function(response) {
                                Swal.close();
                                Swal.fire({
                                    title: 'Success',
                                    text: response.meta.message,
                                    icon: 'success',
                                }).then(() => {
                                    $('#detailReedem').modal('hide');
                                    table.ajax.reload();
                                });
                            },
                            error: function(response) {
                                Swal.close();
                                Swal.fire({
                                    title: 'Error',
                                    text: response.meta.message,
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
