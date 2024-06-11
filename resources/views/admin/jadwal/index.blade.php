@extends('layouts.main')
@section('head')

@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->

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

    <div class="card-header">
        <h6 class="m-0 font-weight-bold text-primary">
            <a href="#" class="m-0 btn btn-rounded-circle mr-2 btn-primary btn-sm" data-toggle="modal" data-target="#addjadwalaModal">
                <i class="fas fa-plus"></i>
                <span>Tambah Jadwal</span>
            </a>
        </h6>
    </div>
    @foreach ($dosen as $d)
    <div class="col-8 mt-3">
        <div class=" shadow animated--grow-in">
            <a class="dropdown-item d-flex align-items-center py-3 d-lg-flex justify-content-between" href="/admin/kelola-jadwal/{{ $d->id }}">
                <div>
                    <div class="small text-gray-500">Dosen</div>
                    <span class="font-weight-bold">{{ $d->user->name }}</span>
                </div>
                <div class="">
                    <div class="icon-circle bg-primary">
                        <i class="fas fa-arrow-alt-circle-right text-white"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
    @endforeach
</div>
@endsection

@section('script')
@endsection