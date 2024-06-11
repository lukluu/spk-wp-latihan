<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriteria = Kriteria::all();
        $page = 'Kriteria';
        return view('admin.kriteria.index', compact('kriteria', 'page'));
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
        $valiation = $request->validate([
            'kode' => 'required',
            'nama_kriteria' => 'required',
            'bobot' => 'required',
        ]);
        if (Kriteria::where('kode', $request->kode)->exists() || Kriteria::where('nama_kriteria', $request->nama_kriteria)->exists()) {
            return back()->with('error', 'GAGAL !, Kriteria ' . $request->kode . ' Sudah Ada');
        }

        Kriteria::create($valiation);
        return back()->with('success', 'Kriteria ' . $request->nama_kriteria . ' Berhasil Di Tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kriteria $kriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kriteria $kriteria)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kode' => 'required',
            'nama_kriteria' => 'required',
            'bobot' => 'required',
        ]);
        $kriteria = Kriteria::findOrFail($id);
        $dataToUpdate = [];
        if ($request->kode != $kriteria->kode) {
            $dataToUpdate['kode'] = $request->kode;
        }

        if ($request->nama_kriteria != $kriteria->nama_kriteria) {
            $dataToUpdate['nama_kriteria'] = $request->nama_kriteria;
        }

        if ($request->bobot != $kriteria->bobot) {
            $dataToUpdate['bobot'] = $request->bobot;
        }
        $kriteria->update($dataToUpdate);
        return back()->with('success', 'Kriteria ' . $request->nama_kriteria . ' Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kriteria = Kriteria::find($id);
        $kriteria->delete();
        return back()->with('success', 'Kriteria ' . $kriteria->nama_kriteria . ' Berhasil Di Hapus');
    }
}
