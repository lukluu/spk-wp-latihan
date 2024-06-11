@extends('layouts.main')
@section('head')
@endsection

@section('content')
<div class="container-fluid">

    <!-- tabs -->
    <div class="card shadow mb-4">
        <ul class="nav nav-tabs">
            <li class="nav-item ">
                <a class="nav-link active" aria-current="page" href="/admin/kelola-perhitungan">Input Nilai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/kelola-perhitungan/nilai-alternatif">Nilai Alternatif</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/kelola-perhitungan/normalisasi">Nilai Normalisasi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/kelola-perhitungan/vektor-s">Nilai Vekor S</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/kelola-perhitungan/hasil">Hasil</a>
            </li>
        </ul>
    </div>

    <!-- KEMBALI halaman sebelumnya pakai anak panah -->
    <div class="mb-2">
        <a class="btn btn-primary btn-sm" href="/admin/kelola-perhitungan/{{$id_dosen}}">
            <i class="fas fa-arrow-left"></i>
            KEMBALI
        </a>
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

    <!-- header -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary mb-3">Input Nilai Alternatif</h6>
            <span>Dosen : {{ $dosen ? $dosen->user->name : 'N/A' }}</span>
            <h6>Jadwal : {{ $jadwal ? $jadwal->jenis . ' - (' . $jadwal->jam . ')' : 'N/A' }}</h6>
        </div>

        <div class="card-body">
            <form action="/admin/kelola-perhitungan/{{$id_dosen}}/input/{{ $id_jadwal }}/proses" method="POST">
                @csrf
                <div class="form-row">
                    @foreach ($kriteria as $k)
                    <div class="form-group col-4">
                        <label for="kriteria_{{$k->id}}">{{ $k->nama_kriteria }}</label>
                        <select name="kriteria_{{$k->id}}" id="kriteria_{{$k->id}}" class="form-control" required>
                            <option value="5" {{ old('kriteria_' . $k->id, $k->penilaian->first() ? $k->penilaian->first()->nilai : '') == 5 ? 'selected' : '' }}>Sangat Baik</option>
                            <option value="4" {{ old('kriteria_' . $k->id, $k->penilaian->first() ? $k->penilaian->first()->nilai : '') == 4 ? 'selected' : '' }}>Baik</option>
                            <option value="3" {{ old('kriteria_' . $k->id, $k->penilaian->first() ? $k->penilaian->first()->nilai : '') == 3 ? 'selected' : '' }}>Cukup</option>
                            <option value="2" {{ old('kriteria_' . $k->id, $k->penilaian->first() ? $k->penilaian->first()->nilai : '') == 2 ? 'selected' : '' }}>Kurang</option>
                            <option value="1" {{ old('kriteria_' . $k->id, $k->penilaian->first() ? $k->penilaian->first()->nilai : '') == 1 ? 'selected' : '' }}>Sangat Kurang</option>
                        </select>
                    </div>
                    @endforeach
                </div>

                <br>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </form>
            <form action="/admin/kelola-perhitungan/{{$id_dosen}}/input/{{ $id_jadwal }}/hapus" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-redo-alt"></i> Reset
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
