@extends('layouts.main')
@section('head')
@endsection

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
                <a class="nav-link" href="/admin/kelola-perhitungan/normalisasi">Nilai Normalisasi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/kelola-perhitungan/vektor-s">Nilai Vektor S</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/admin/kelola-perhitungan/hasil">Hasil</a>
            </li>
        </ul>
    </div>

    <!-- KEMBALI halaman sebelumnya pakai anak panah -->
    <div class="mb-2">
        <a class="btn btn-primary btn-sm" href="/admin/kelola-perhitungan">
            <i class="fas fa-arrow-left"></i>
            KEMBALI
        </a>
    </div>

    <!-- header -->
    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary mb-1">Hasil</h6>
        </div>
        <div class="card-body">
            <form method="GET" action="/admin/kelola-perhitungan/hasil">
                <!-- Filter dosen -->
                <div class="form-group">
                    <label for="dosen_id">Pilih Dosen:</label>
                    <select class="form-control" name="dosen_id" id="dosen_id">
                        <option value="">Pilih Dosen</option>
                        @foreach ($dosens as $dosen)
                        <option value="{{ $dosen->id }}" {{ isset($selectedDosenId) && $selectedDosenId == $dosen->id ? 'selected' : '' }}>
                            {{ $dosen->user->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-sm">Filter</button>
            </form>

            @if($hasils->isNotEmpty())

            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Peringkat</th>
                        <th>Alternatif</th>
                        <th>Nilai Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hasils as $index => $hasil)
                    <tr @if($index==0) style="background-color: #d4edda;" @endif>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($hasil->jadwal_spk->tanggal)->format('l, d M Y') }} - {{ $hasil->jadwal_spk->jenis }} (Pukul {{ $hasil->jadwal_spk->jam }})</td>
                        <td>{{ $hasil->nilai_akhir }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-info mt-3">
                Tidak ada hasil yang tersedia.
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection
