<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen = Dosen::all();
        $page = 'Jadwal';
        return view('admin.jadwal.index', compact('dosen', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal, $id)
    {
        $dosen = Dosen::find($id);
        $jadwals = Jadwal::where('dosen_id', $id)->with('mahasiswa')->get();

        // Inisialisasi array kosong untuk menyimpan daftar mahasiswa
        $daftar_mahasiswa = [];

        foreach ($jadwals as $jadwal) {
            $daftar_mahasiswa[] = $jadwal->mahasiswa;
        }

        $page = 'Jadwal';
        return view('admin.jadwal.show', compact('dosen', 'page', 'jadwal'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        //
    }
}
