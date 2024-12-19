@extends('layouts.dashboard.main')

@section('content')
    <main class="main-content-wrapper">
        <div class="container">
            <div class="row mb-8">
                <div class="col-md-12">
                    <!-- page header -->
                    <div class="d-md-flex justify-content-between align-items-center">
                        <div>
                            <h2>Subscription</h2>
                            <!-- breacrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"
                                            class="text-inherit">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Subscription</li>
                                </ol>
                            </nav>
                        </div>
                        <button class="btn btn-primary mb-3" id="btn-kirim-pesan">
                            Kirim Pesan
                        </button>
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
                                <table class="table table-striped" id="subscription">
                                    <thead>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nomor WhatsApp</th>
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

    <!-- Modal Body -->
    <div class="modal fade" id="modal-edit" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
        aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Ubah Data Subscription
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-edit">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <input type="hidden" name="id" id="id">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Nomor WhatsApp</label>
                                <input name="no_hp" id="no_hp" class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batalkan
                        </button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Kirim Pesan -->
    <div class="modal fade" id="modal-pesan" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">
                        Kirim Pesan WhatsApp
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-kirim-pesan">
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <label for="colFormLabel" class="col-sm-4 col-form-label">Pesan</label>
                                <textarea name="pesan" id="pesan" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batalkan
                        </button>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            // Init Datatable
            var table = $('#subscription').DataTable({
                ajax: {
                    url: "{{ route('admin.subscription.index') }}",
                    type: "GET"
                },
                lengthChange: false,
                ordering: false,
                processing: true,
                destroy: true,
                buttons: [{
                    text: 'Kirim Pesan',
                    name: 'kirim',
                    className: 'btn btn-primary btn-sm btn-kirim',
                    action: function(e, dt, node, config) {
                        getSelect()
                    }
                }],
                columnDefs: [{
                        targets: 0,
                        width: '10%',
                        className: 'select-checkbox align-middle checkbox-select',
                        data: 'id',
                        render: function(data, type, row, meta) {
                            return '<input type="text" name="' + data + '" value="' +
                                data +
                                '" hidden>';
                        }
                    },
                    {
                        targets: 1,
                        className: 'align-middle',
                        data: 'no_hp',
                        render: function(data, type, row, meta) {
                            return `${row.no_hp} <br> <span class="badge bg-success">Aktif</span>`
                        }
                    },
                    {
                        targets: 2,
                        className: 'align-middle',
                        render: function(data, type, row, meta) {
                            return `<div class="dropdown">
                                        <a href="#" class="text-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="feather-icon icon-more-vertical fs-5"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <button class="dropdown-item btn-edit" type="button">
                                                    <i class="bi bi-pencil-square me-3"></i>
                                                    Edit
                                                </button>
                                            </li>
                                            <li>
                                                <button class="dropdown-item btn-hapus" type="button">
                                                    <i class="bi bi-trash me-3"></i>
                                                    Hapus
                                                </button>
                                            </li>
                                        </ul>
                                    </div>`;
                        }
                    },
                ],
                select: {
                    style: 'multi',
                    selector: 'td:first-child',
                    blurable: false,
                },
                initComplete: function() {
                    $('#subscription').DataTable().buttons().container().appendTo(
                        '#subscription_wrapper .col-md-6:eq(0)');
                    $('.btn-kirim').removeClass("btn-secondary");
                },
            });

            // Get Selected Row
            function getSelect() {
                var data = table.rows({
                    selected: true
                }).data();

                if (data.length < 1) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Pilih minimal 1 data!',
                    });
                } else {
                    $('#modal-pesan').modal('show');
                    $('#pesan').trumbowyg({
                        lang: 'id',
                        btns: [
                            ['viewHTML'],
                            ['undo', 'redo'],
                            ['formatting'],
                            ['strong', 'em', 'del'],
                            ['link'],
                            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                            ['unorderedList', 'orderedList'],
                            ['horizontalRule'],
                            ['removeformat']
                        ]
                    });
                }
            };

            // Modal Edit
            $('#subscription tbody').on('click', '.btn-edit', function(event) {
                event.preventDefault();

                var data = table.row($(this).parents('tr')).data();

                var id = data.id;
                var no_hp = data.no_hp;

                $('#id').val(id);
                $('#no_hp').val(no_hp);

                $('#modal-edit').modal('show')
            });

            // Submit Edit
            $("#form-edit").submit(function(e) {
                e.preventDefault();

                $.ajax({
                    type: "PUT",
                    url: "{{ route('admin.subscription.update') }}",
                    data: $(this).serialize(),
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        if (response.meta.status == "success") {
                            $('#modal-edit').modal('hide');
                            table.ajax.reload();
                            Swal.fire('Sukses!', response.meta.message, 'success');
                        }
                    },
                    error: function(response) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Gagal!', 'Periksa kembali data anda.', 'error');
                        console.log(response.responseJSON.message);
                    },
                });
            });

            // Hapus
            $('#subscription tbody').on('click', '.btn-hapus', function(event) {
                event.preventDefault()

                var data = table.row($(this).parents('tr')).data();

                Swal.fire({
                    title: "Data akan dihapus?",
                    text: "Data yang sudah dihapus tidak bisa dikembalikan lagi!",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#889397",
                    confirmButtonText: "Lanjutkan",
                    cancelButtonText: "Batalkan",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('admin.subscription.destroy') }}",
                            data: {
                                id: data.id
                            },
                            dataType: "JSON",
                            beforeSend: function() {
                                $.LoadingOverlay('show');
                            },
                            success: function(response) {
                                $.LoadingOverlay('hide');
                                if (response.meta.status == "success") {
                                    table.ajax.reload();
                                    Swal.fire('Sukses!', response.meta.message,
                                        'success');
                                }
                            },
                            error: function(response) {
                                $.LoadingOverlay('hide');
                                Swal.fire('Gagal!', 'Periksa kembali data anda.',
                                    'error');
                                console.log(response.responseJSON.message);
                            },
                        });
                    }
                });
            });

            // Format Pesan
            function htmlToFormat(html) {
                // Cek jika html kosong
                if (!html) return '';

                // Buat element div temporary untuk parsing HTML
                let div = document.createElement('div');
                div.innerHTML = html;

                // Fungsi rekursif untuk memproses node
                function processNode(node) {
                    let result = '';
                    
                    // Proses child nodes
                    for (let child of node.childNodes) {
                        if (child.nodeType === 3) { // Text node
                            result += child.textContent;
                        } else if (child.nodeType === 1) { // Element node
                            let content = processNode(child);
                            
                            // Tambahkan format sesuai tag
                            switch(child.tagName.toUpperCase()) {
                                case 'H1':
                                    result += `#${content}#`;
                                    break;
                                case 'H2':
                                    result += `##${content}##`;
                                    break;
                                case 'H3':
                                    result += `###${content}###`;
                                    break;
                                case 'BR':
                                    result += `\n`;
                                    break;
                                case 'P':
                                    result += `${content}\n`;
                                    break;
                                case 'B':
                                case 'STRONG':
                                    result += `*${content}*`;
                                    break;
                                case 'I':
                                case 'EM': 
                                    result += `_${content}_`;
                                    break;
                                case 'STRIKE':
                                case 'DEL':
                                    result += `~${content}~`;
                                    break;
                                default:
                                    result += content;
                            }
                        }
                    }
                    return result;
                }

                return processNode(div);
            }

            // Kirim Pesan
            $('#form-kirim-pesan').submit(function(e) {
                e.preventDefault();

                var pesan = htmlToFormat($('#pesan').val());


                // Get Selected Row
                var data = table.rows({
                    selected: true
                }).data();

                var dataNoHp = [];
                for (var i = 0; i < data.length; i++) {
                    dataNoHp.push(data[i].no_hp);
                }

                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.subscription.kirim_pesan') }}",
                    data: {
                        data_no_hp: dataNoHp,
                        pesan: pesan
                    },
                    dataType: "JSON",
                    beforeSend: function() {
                        $.LoadingOverlay('show');
                    },
                    success: function(response) {
                        $.LoadingOverlay('hide');
                        if (response.meta.status == "success") {
                            $('#modal-pesan').modal('hide');
                            table.ajax.reload();
                            Swal.fire('Sukses!', response.meta.message, 'success');
                        }
                    },
                    error: function(response) {
                        $.LoadingOverlay('hide');
                        Swal.fire('Gagal!', 'Periksa kembali data anda.', 'error');
                        console.log(response.responseJSON.message);
                    },
                });
            });

        });
    </script>
@endsection
