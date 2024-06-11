<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Jadwal;
use App\Models\JadwalSpk;
use Illuminate\Http\Request;

class JadwalSpkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = 'Jadwal SPK';
        $jadwal = JadwalSpk::all();
        return view('admin.jadwal.jadwal-spk', compact('page', 'jadwal'));
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
        $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);
        if (JadwalSpk::where('tanggal', $request->tanggal)->exists() && JadwalSpk::where('jam', $request->jam_mulai . ' - ' . $request->jam_selesai)->exists()) {
            return redirect()->back()->with('error', 'GAGAL !, Jadwal ' . $request->tanggal . ' Sudah Ada');
        }
        $jam = $request->jam_mulai . ' - ' . $request->jam_selesai;
        // Menyimpan data ke dalam database
        JadwalSpk::create([
            'tanggal' => $request->tanggal,
            'jenis' => $request->jenis,
            'jam' => $jam
        ]);

        return redirect()->back()->with('success', 'Jadwal berhasil disimpan');
    }


    /**
     * Display the specified resource.
     */
    public function show(JadwalSpk $jadwalSpk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JadwalSpk $jadwalSpk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        $jadwal = JadwalSpk::findOrFail($id);
        $dataToUpdate = [];
        if ($request->jam_mulai != $jadwal->jam_mulai || $request->jam_selesai != $jadwal->jam_selesai) {
            $dataToUpdate['jam'] = $request->jam_mulai . ' - ' . $request->jam_selesai;
        }

        if ($request->tanggal != $jadwal->tanggal) {
            $dataToUpdate['tanggal'] = $request->tanggal;
        }

        if ($request->jenis != $jadwal->jenis) {
            $dataToUpdate['jenis'] = $request->jenis;
        }

        $jadwal->update($dataToUpdate);
        return redirect()->back()->with('success', 'Jadwal Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jadwal = JadwalSpk::find($id);
        $jadwal->delete();
        return back()->with('success', 'Jadwal Berhasil Di Hapus');
    }
}
