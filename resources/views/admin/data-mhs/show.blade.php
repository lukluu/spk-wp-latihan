@extends('layouts.main')
@section('head')

@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Mahasiswa</h1>
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
                    <h6 class="text-primary font-weight-bold">Name : {{ $mahasiswa->user->name }}</h6>
                    <h6 class="text-primary font-weight-bold">Username : {{ $mahasiswa->user->username }}</h6>
                    <h6 class="text-primary font-weight-bold">NIDN : {{ $mahasiswa->NIM }}</h6>
                    <h6 class="text-primary font-weight-bold">Email : {{ $mahasiswa->user->email }}</h6>
                    <h6 class="text-primary font-weight-bold">Jurusan : {{ $mahasiswa->jurusan }}</h6>
                    <h6 class="text-primary font-weight-bold">Angkatan : {{ $mahasiswa->angkatan }}</h6>
                    <h6 class="text-primary font-weight-bold">Semester : {{ $mahasiswa->smt }}</h6>
                    <h6 class="text-primary font-weight-bold">Dosen Pembimbing : {{ $mahasiswa->dosen->user->name }}</h6>
                    <h6 class="text-primary font-weight-bold">Role : {{ $mahasiswa->user->role }}</h6>
                    <h6 class="text-primary font-weight-bold">Created At : {{ $mahasiswa->created_at->diffForHumans() }}</h6>
                    <h6 class="text-primary font-weight-bold">Updated At : {{ $mahasiswa->updated_at->diffForHumans() }}</h6>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
