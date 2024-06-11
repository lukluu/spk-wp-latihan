@extends('layouts.main')
@section('head')
<link href="{{ asset('templates/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Kriteria</h1>
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
                <a href="#" class="btn btn-rounded-circle mr-2 btn-primary btn-sm" data-toggle="modal" data-target="#addKriteriaModal">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Kriteria</span>
                </a>
            </h6>
        </div>
        <div class="modal fade" id="addKriteriaModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary d-inline">Masukkan Data Kriteria</h6>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="card-body">
                            <form id="kriteriaForm" action="/admin/kelola-kriteria" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Kode</label>
                                    <input type="text" name="kode" value="{{ old('kode') }}" class="form-control @error('kode')is-invalid @enderror" required id="kode" placeholder="Enter Kode">
                                    @error('kode')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="nama_kriteria">Nama Kriteria</label>
                                    <input type="text" name="nama_kriteria" class="form-control" id="email" placeholder="Enter Kriteria" required>
                                </div>
                                <div class="form-group">
                                    <label for="bobot">Bobot</label>
                                    <input type="number" name="bobot" class="form-control" id="bobot" placeholder="Enter bobot" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Add Kriteria</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Nama Kriteria</th>
                            <th>Bobot</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriteria as $k)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>{{ $k->kode }}</td>
                            <td>{{ $k->nama_kriteria }}</td>
                            <td>{{ $k->bobot }}</td>
                            <td class="text-center">

                                <a href="#" class="btn btn-rounded-circle mr-2 btn-primary btn-sm edit-btn" data-id="{{ $k->id }}" data-kode="{{ $k->kode }}" data-nama="{{ $k->nama_kriteria }}" data-bobot="{{ $k->bobot }}" data-toggle="modal" data-target="#editKriteriaModal">
                                    <i class="fas fa-edit"></i>
                                    <span>edit</span>
                                </a>
                                <form id="delete-form-{{ $k->id }}" action="/admin/kelola-kriteria/{{ $k->id }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-rounded-circle mr-2 btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-{{ $k->id }}">
                                        <i class="fas fa-trash"></i>
                                        <span> hapus</span>
                                    </button>
                                </form>

                                <div class="modal fade" id="deleteModal-{{ $k->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-{{ $k->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel-{{ $k->id }}">Ready to Delete?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                <button class="btn btn-primary" type="button" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $k->id }}').submit();">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
                <!-- edit -->
                <div class="modal fade" id="editKriteriaModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary d-inline">Edit Data Kriteria</h6>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="card-body">
                                    <form action="/admin/kelola-kriteria/update" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-group">
                                            <label for="name">Kode</label>
                                            <input type="text" name="kode" value="" class="form-control @error('kode')is-invalid @enderror" required id="kode" placeholder="Enter Kode">
                                            @error('kode')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror

                                        </div>
                                        <div class=" form-group">
                                            <label for="nama_kriteria">Nama Kriteria</label>
                                            <input type="text" value="" name="nama_kriteria" class="form-control" id="nama_kriteria" placeholder="Enter Kriteria" required>
                                        </div>
                                        <div class=" form-group">
                                            <label for="bobot">Bobot</label>
                                            <input type="number" value="" name="bobot" class="form-control" id="bobot" placeholder="Enter Bobot" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Kriteria</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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

<script>
    $(document).ready(function() {
        $('.edit-btn').on('click', function() {
            var id = $(this).data('id');
            var kode = $(this).data('kode');
            var nama_kriteria = $(this).data('nama');
            var bobot = $(this).data('bobot');

            $('#editKriteriaModal #kode').val(kode);
            $('#editKriteriaModal #nama_kriteria').val(nama_kriteria);
            $('#editKriteriaModal #bobot').val(bobot);
            $('#editKriteriaModal form').attr('action', '/admin/kelola-kriteria/' + id);
        });
    });
</script>

@endsection
