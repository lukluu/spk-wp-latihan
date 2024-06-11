@extends('layouts.main')
@section('head')
<link href="{{ asset('templates/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Mahasiswa</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <a href="/admin/kelola-mahasiswa/create" class="btn btn-rounded-circle mr-2 btn-primary btn-sm">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Mahasiswa</span>
                </a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswa as $d)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>{{ $d->user->name }}</td>
                            <td>{{ $d->user->email }}</td>
                            <td class="text-center">

                                <a href="/admin/kelola-mahasiswa/{{ $d->id }}/edit" class="btn btn-rounded-circle mr-2 btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                    <span>edit</span>
                                </a>
                                <!-- detail -->
                                <a href="/admin/kelola-mahasiswa/{{ $d->id }}" class="btn btn-rounded-circle mr-2 btn-info btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                    <span>detail</span>
                                </a>
                                <!-- delete -->
                                <form id="deleteForm-mahasiswa{{ $d->id }}" action="/admin/kelola-mahasiswa/{{ $d->id }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-rounded-circle mr-2 btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal-mahasiswa{{ $d->id }}">
                                        <i class="fas fa-trash"></i>
                                        <span>hapus</span>
                                    </button>
                                </form>

                                <div class="modal fade" id="deleteModal-mahasiswa{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-mahasiswa{{ $d->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel-mahasiswa{{ $d->id }}">Ready to Delete?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <button class="btn btn-primary" type="button" onclick="event.preventDefault(); document.getElementById('deleteForm-mahasiswa{{ $d->id }}').submit();">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')


<!-- Page level plugins -->
<script src="{{ asset('templates/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('templates/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('templates/js/demo/datatables-demo.js')}}"></script>

@endsection
