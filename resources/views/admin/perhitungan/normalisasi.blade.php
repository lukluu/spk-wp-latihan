@extends('layouts.main')

@section('content')
<div class="container-fluid">

    <!-- tabs -->
    <div class="card shadow mb-4">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" href="/admin/kelola-perhitungan">Input Nilai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/kelola-perhitungan/nilai-alternatif">Nilai Alternatif</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/admin/kelola-perhitungan/normalisasi">Nilai Normalisasi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/kelola-perhitungan/vektor-s">Nilai Vektor S</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/kelola-perhitungan/hasil">Hasil</a>
            </li>
        </ul>
    </div>

    <div class="mb-2">
        <a class="btn btn-primary btn-sm" href="/admin/kelola-perhitungan">
            <i class="fas fa-arrow-left"></i>
            KEMBALI
        </a>
    </div>

    <!-- header -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary mb-1">Nilai {{$page}}</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="/admin/kelola-perhitungan/normalisasi">
                <div class="form-group">
                    <label for="dosen_id">Pilih Dosen:</label>
                    <select class="form-control" name="dosen_id" id="dosen_id" required>
                        <option value="">Pilih Dosen</option>
                        @foreach ($dosens as $dosen)
                        <option value="{{ $dosen->id }}" {{ $selectedDosen && $selectedDosen->id == $dosen->id ? 'selected' : '' }}>
                            {{ $dosen->user->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Lanjut</button>
            </form>
            @if ($selectedDosen)

            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot Normalisasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($normalizedWeights as $normalizedWeight)
                    <tr>
                        <td>{{ $normalizedWeight['kriteria']->kode }}</td>
                        <td>{{ $normalizedWeight['kriteria']->nama_kriteria }}</td>
                        <td>{{ $normalizedWeight['bobot_normalisasi'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection
