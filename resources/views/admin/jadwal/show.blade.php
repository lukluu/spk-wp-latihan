@extends('layouts.main')
@section('head')

@endsection

@section('content')
<div class="container-fluid">

    <div class="card mb-4 py-3 border-bottom-success">
        <a class="card-body-small mx-3 icon-circle bg-primary" style="width: 30px; height: 30px; line-height: 30px;" href="/admin/kelola-jadwal">
            <i class="fas fa-arrow-left text-white" style="font-size: 14px;"></i>
        </a>
        <div class="d-flex align-items-center justify-content-center">
            <h6 class="m-0 font-weight-bold text-primary text-center">
                @if($jadwal->dosen)
                {{ $jadwal->dosen->user->name }}
                @else
                -
                @endif
            </h6>
        </div>

    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Jadwal Mengajar</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">Hari</th>
                            <th scope="col">Mata Kuliah</th>
                            <th scope="col">Kelas</th>
                            <th scope="col">Dosen</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $jadwal->hari }}</td>
                            <td>{{ $jadwal->mata_kuliah }}</td>
                            <td>{{ $jadwal->kelas }}</td>
                            @if($jadwal->dosen)
                            <td>{{ $jadwal->dosen->user->name }}</td>
                            @endif

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection

@section('script')
@endsection