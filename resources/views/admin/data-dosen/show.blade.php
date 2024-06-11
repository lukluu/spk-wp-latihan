@extends('layouts.main')
@section('head')

@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Dosen</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <span>Detail</span>
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6 text-bold">
                    <h5 class="text-primary font-weight-bold">Name : {{ $dosen->user->name }}</h5>
                    <h5 class="text-primary font-weight-bold">Username : {{ $dosen->user->username }}</h5>
                    <h5 class="text-primary font-weight-bold">NIDN : {{ $dosen->nidn }}</h5>
                    <h5 class="text-primary font-weight-bold">Email : {{ $dosen->user->email }}</h5>
                    <h5 class="text-primary font-weight-bold">Role : {{ $dosen->user->role }}</h5>
                    <h5 class="text-primary font-weight-bold">Created At : {{ $dosen->created_at->diffForHumans() }}</h5>
                    <h5 class="text-primary font-weight-bold">Updated At : {{ $dosen->updated_at->diffForHumans() }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <span>Daftar Mahasiswa Bimbingan</span>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Jurusan</th>
                            <th>Angkatan</th>
                            <th>Semster Saat ini</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mahasiswa as $k)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>{{ $k->user->name }}</td>
                            <td>{{ $k->nim }}</td>
                            <td>{{ $k->jurusan }}</td>
                            <td>{{ $k->angkatan }}</td>
                            <td>{{ $k->smt }}</td>
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
@endsection
