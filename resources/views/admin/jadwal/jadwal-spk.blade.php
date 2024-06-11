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
    <div class="d-flex align-items-center justify-content-center vh-80">
        <h6 class="m-0 font-weight-bold text-primary">
            <a href="#" class="btn btn-rounded-circle mr-2 btn-primary" data-toggle="modal" data-target="#addJadwalModal">
                <i class="fas fa-plus"></i>
                <span>Tambah Jadwal</span>
            </a>
        </h6>
    </div>

    <div class="modal fade" id="addJadwalModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary d-inline">Masukkan Data Kriteria</h6>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="card-body">
                        <form action="/admin/kelola-jadwal" method="POST">
                            @csrf
                            <!-- Input Hari/Tanggal -->
                            <div class="form-group">
                                <label for="tanggal">Hari/Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal">Jenis Waktu</label>
                                <select name="jenis" id="jenis" class="form-control" required>
                                    <option value="Pagi">Pagi</option>
                                    <option value="Siang">Siang</option>
                                    <option value="Sore">Sore</option>
                                </select>
                            </div>
                            <!-- Input Jam Pagi -->
                            <div class="form-group row">
                                <div class="col-6">
                                    <label for="jam_mulai">Mulai</label>
                                    <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" required>
                                </div>
                                <div class="col-6">
                                    <label for="jam_selesai">Akhir</label>
                                    <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" required>
                                </div>
                            </div>
                            <hr>
                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        @foreach ($jadwal as $j)
        <div class="col-12 mt-3">
            <div class=" shadow animated--grow-in">
                <div class="dropdown-item d-flex align-items-center py-3 d-lg-flex justify-content-between">
                    <div>
                        <span class="font-weight-bold">{{ \Carbon\Carbon::parse($j->tanggal)->isoFormat('dddd, D MMMM YYYY') }}</span>
                    </div>
                    <div>
                        <div class="small text-gray-500">{{ $j->jenis }}</div>
                        <span class="font-weight-bold">{{ $j->jam}}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <form id="delete-form-{{ $j->id }}" action="/admin/kelola-jadwal/{{ $j->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-circle mr-2 btn-danger" data-toggle="modal" data-target="#deleteModal-{{ $j->id }}">
                                <i class="fas fa-trash text-white"></i>
                            </button>
                        </form>
                        <div class="modal fade" id="deleteModal-{{ $j->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel-{{ $j->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel-{{ $j->id }}">Ready to Delete?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        <button class="btn btn-primary" type="button" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $j->id }}').submit();">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="btn btn-circle mr-2 btn-primary edit-btn-jadwal" data-id="{{ $j->id }}" data-tanggal="{{ $j->tanggal }}" data-jenis="{{ $j->jenis }}" data-mulai="{{ $j->jam_mulai }}" data-selesai="{{ $j->jam_selesai }}" data-toggle="modal" data-target="#editJadwalModal">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

<div class="modal fade" id="editJadwalModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary d-inline">Edit Data Jadwal</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="card-body">
                    <form action="/admin/kelola-jadwal/update" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" id="id">
                        <!-- Input Hari/Tanggal -->
                        <div class="form-group">
                            <label for="tanggal">Hari/Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis Waktu</label>
                            <select name="jenis" id="jenis" class="form-control" required>
                                <option value="Pagi">Pagi</option>
                                <option value="Siang">Siang</option>
                                <option value="Sore">Sore</option>
                            </select>
                        </div>
                        <!-- Input Jam Pagi -->
                        <div class="form-group row">
                            <div class="col-6">
                                <label for="jam_mulai">Mulai</label>
                                <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <label for="jam_selesai">Akhir</label>
                                <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" required>
                            </div>
                        </div>
                        <hr>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.edit-btn-jadwal').on('click', function() {
            var id = $(this).data('id');
            var jenis = $(this).data('jenis');
            var tanggal = $(this).data('tanggal');
            var mulai = $(this).data('mulai');
            var selesai = $(this).data('selesai');
            $('#editJadwalModal #id').val(id); // Menambahkan ID ke input hidden
            $('#editJadwalModal #jenis').val(jenis);
            $('#editJadwalModal #tanggal').val(tanggal);
            $('#editJadwalModal #jam_mulai').val(mulai);
            $('#editJadwalModal #jam_selesai').val(selesai);
            $('#editJadwalModal form').attr('action', '/admin/kelola-jadwal/' + id);
        });
    });
</script>

@endsection
