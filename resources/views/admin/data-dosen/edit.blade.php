@extends('layouts.main')
@section('head')

@endsection

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Dosen</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <span>Isi Data</span>
            </h6>
        </div>
        <div class="card-body">
            <form action="/admin/kelola-dosen/{{ $dosen->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" value="{{ $dosen->user->name }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter name">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" value="{{ $dosen->user->username }}" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Enter Username">
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="nidn">NIDN</label>
                            <input type="text" value="{{ $dosen->nidn }}" class="form-control @error('nidn') is-invalid @enderror" id="nidn" name="nidn" placeholder="...">
                            @error('nidn')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" value="{{ $dosen->user->email }}" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" value="{{$dosen->user->password}}" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>

        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
