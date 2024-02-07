@extends('layouts.dashboard.main')

@section('content')
    <main class="main-content-wrapper">
        <div class="container">
            <div class="row mb-8">
                <div class="col-md-12">
                    <!-- page header -->
                    <div class="d-md-flex justify-content-between align-items-center">
                        <div>
                            <h2>Backup Database</h2>
                            <!-- breacrumb -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" class="text-inherit">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Backup Database</li>
                                </ol>
                            </nav>
                        </div>
                        <!-- button -->
                        <div>
                            <a href="{{ route('admin.backupdb.backup') }}" class="btn btn-primary">Tambah Backup Database</a>
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

                            @if (Session::has('success'))
                                <div class="alert alert-success alert-dismissible fade show mx-5 mt-5" role="alert">
                                    <i class="fas fa-check-circle me-1"></i>
                                    {{ Session::get('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="table-responsive p-5">
                                <table id="table-fakultas" class="table w-100">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>File Name</th>
                                            <th>Size</th>
                                            <th>Time Created</th>
                                            <th>Download</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($backupFiles as $key => $file)
                                            <tr class="align-middle">
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td>{{ $file->getFilename() }}</td>
                                                <td class="text-center">{{ formatSize($file->getSize()) }}</td>
                                                <td class="text-center">{{ date('Y-m-d H:i:s', $file->getMTime()) }}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-success btn-sm" href="{{ route('admin.backupdb.download', $file->getFilename()) }}" role="button"
                                                        title="Download file {{ $file->getFilename() }}"><i class="fas fa-file-download"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>

                </div>

            </div>
        </div>
    </main>
@endsection