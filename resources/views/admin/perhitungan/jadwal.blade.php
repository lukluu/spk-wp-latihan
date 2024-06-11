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
        <a class="btn btn-primary btn-sm" href="/admin/kelola-perhitungan">
            <i class="fas fa-arrow-left "></i>
            KEMBALI
        </a>
    </div>

    <!-- header -->
    <div class="card shadow ">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Pilih Jadwal Dosen {{ $dosen->user->name }}</h6>
        </div>
        @foreach ($jadwal as $j)
        <div class="border-bottom">
            <a class="shadow animated--grow-in m-0" href="/admin/kelola-perhitungan/{{ $dosen->id }}/input/{{ $j->id }}">
                <div class="dropdown-item d-flex align-items-center py-3">
                    <div class="mr-5">
                        <span class="font-weight-bold">{{ \Carbon\Carbon::parse($j->tanggal)->isoFormat('dddd, D MMMM YYYY') }}</span>
                    </div>
                    <div>
                        <div class="small text-gray-500">Jam {{ $j->jenis }}</div>
                        <span class="font-weight-bold">{{ $j->jam }}</span>
                    </div>
                    <div class="ml-auto"></div>
                    <i class="fas fa-arrow-right"></i>
                </div>
            </a>
        </div>

        @endforeach
    </div>

</div>

@endsection

@section('script')

@endsection
