@extends('layouts.main')
@section('head')
@endsection

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Data Mahasiswa</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Isi Data</h6>
        </div>
        <div class="card-body">
            <form action="/admin/kelola-mahasiswa/{{ $mahasiswa->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" value="{{ $mahasiswa->user->name }}" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Enter name">
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" value="{{ $mahasiswa->user->username }}" class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Enter Username">
                            @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" value="{{ $mahasiswa->user->email }}" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter email">
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter password">
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" value="{{ $mahasiswa->nim }}" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" placeholder="...">
                            @error('nim')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <input type="text" value="{{ $mahasiswa->jurusan }}" class="form-control @error('jurusan') is-invalid @enderror" id="jurusan" name="jurusan" placeholder="...">
                            @error('jurusan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="angkatan">Angkatan</label>
                            <input type="text" value="{{ $mahasiswa->angkatan }}" class="form-control @error('angkatan') is-invalid @enderror" id="angkatan" name="angkatan" placeholder="...">
                            @error('angkatan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="smt">Semester</label>
                            <input type="number" value="{{ $mahasiswa->smt }}" class="form-control @error('smt') is-invalid @enderror" id="smt" name="smt" placeholder="...">
                            @error('smt')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="pa">Dosen PA</label>
                            <select name="dosen_id" id="pa" class="form-control @error('dosen_id') is-invalid @enderror">
                                @foreach ($dosens as $dosen)
                                <option value="{{ $dosen->id }}" {{ $dosen->id == $mahasiswa->dosen_id ? 'selected' : '' }}>{{ $dosen->user->name }}</option>
                                @endforeach
                            </select>
                            @error('dosen_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary float-right">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
