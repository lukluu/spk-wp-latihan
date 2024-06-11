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

    <!-- header -->
    <div class="card shadow ">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Pilih Dosen</h6>
        </div>

        @foreach ($dosens as $dosen)
        <div class="border-bottom">
            <a class="shadow animated--grow-in m-0" href="/admin/kelola-perhitungan/{{ $dosen->id }}">
                <div class="dropdown-item d-flex align-items-center py-3 d-lg-flex">
                    <div>
                        <span class="font-weight-bold">{{ $dosen->user->name }}</span>
                    </div>
                    <!-- button arrow left -->
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
