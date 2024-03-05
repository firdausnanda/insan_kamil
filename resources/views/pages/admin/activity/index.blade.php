@extends('layouts.dashboard.main')

@section('content')
    <main class="main-content-wrapper">
        <div class="container">
            <div class="row mb-8">
                <div class="col-md-12">
                    <!-- page header -->
                    <div class="d-md-flex justify-content-between align-items-center">
                        <div>
                            <h2>Activity Logs</h2>
                            <!-- breacrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" class="text-inherit">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Activity Logs</li>
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
                        <div class="card-body p-0">

                            <form action="" id="form-filter" class="pt-5 ps-5">
                                <div class="row mb-3">
                                    <div class="col">
                                        <label class="form-label">Date From</label>
                                        <input type="date" class="form-control" name="from" required>
                                    </div>
                                    <div class="col">
                                        <label class="form-label">Date To</label>
                                        <input type="date" class="form-control" name="to" required>
                                    </div>
                                    <div class="col">
                                        <label class="form-label w-100">&nbsp;</label>
                                        <button type="submit" class="btn btn-primary w-50"><i class="fas fa-search me-2"></i>Search</button>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive p-5">
                                <table id="table-activity" class="table w-100">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Timestamp</th>
                                            <th>Subject</th>
                                            <th>User</th>
                                            <th>Event</th>
                                            <th>Description</th>
                                            <th>Details</th>
                                        </tr>
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

    {{-- Modal Detail --}}
    <div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <textarea style="width: 100%; max-width: 100%;" id="detail" rows="20" disabled></textarea>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            //Datatable
            var table = $('#table-activity').DataTable({
                ajax: {
                    url: "{{ route('admin.activity.index') }}",
                    data: function(d) {
                        d.from = $("input[name='from']").val();
                        d.to = $("input[name='to']").val();
                    },
                },
                lengthChange: false,
                ordering: false,
                columnDefs: [{
                        targets: 0,
                        width: '8%',
                        className: 'align-middle text-center',
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        targets: 1,
                        width: '15%',
                        className: 'align-middle text-center',
                        data: "created_at",
                        render: function(data, type, row, meta) {
                            return moment(data).format('DD-MM-YYYY HH:mm');
                        }
                    },
                    {
                        targets: 2,
                        width: '15%',
                        className: 'align-middle text-center',
                        data: "subject_type",

                    },
                    {
                        targets: 3,
                        width: '15%',
                        className: 'align-middle text-center',
                        render: function(data, type, row, meta) {
                            if (row.causer) {
                                return row.causer.name;
                            } else {
                                return "-"
                            }
                        }
                    },
                    {
                        targets: 4,
                        width: '10%',
                        className: 'align-middle text-center',
                        data: 'event',
                        render: function(data, type, row, meta) {
                            if (data == 'created') {
                                return '<span class="badge bg-success">created</span>';
                            } else if (data == 'updated') {
                                return '<span class="badge bg-warning">updated</span>';
                            } else if (data == 'deleted') {
                                return '<span class="badge bg-danger">deleted</span>';
                            }
                        }
                    },
                    {
                        targets: 5,
                        className: 'align-middle text-center',
                        data: 'description',
                    },
                    {
                        targets: 6,
                        width: '10%',
                        className: 'align-middle text-center',
                        render: function(data, type, row, meta) {
                            return '<button type="button" class="btn btn-info btn-sm text-white"><i class="fas fa-question-circle"></i></button>';
                        }
                    },
                ]
            });

            $("#form-filter").submit(function(e) {
                e.preventDefault();
                table.ajax.reload();
            });

            //Modal Detail
            $('#table-activity tbody').on('click', '.btn-info', function(event) {
                event.preventDefault();
                var data = table.row($(this).parents('tr')).data();
                var details = data.properties;
                var pretty = JSON.stringify(details, undefined, 4);
                $("#detail").val(pretty);
                $('#modal-detail').modal('show');
            });
        });
    </script>
@endsection
