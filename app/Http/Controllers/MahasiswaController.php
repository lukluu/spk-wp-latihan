<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa = Mahasiswa::with('dosen', 'user')->get();
        $page = 'Kelola Dosen';

        return view('admin.data-mhs.index', compact('mahasiswa', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page = 'Kelola Mahasiswa';
        return view('admin.data-mhs.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required | unique:users',
            'email' => 'required | unique:users',
            'password' => 'required',
        ]);
        $user = new User();
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role = 'mahasiswa';
        $user->save();

        return redirect('/admin/kelola-mahasiswa')->with('success', 'Data Mahasiswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa, $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $dosen = $mahasiswa->dosen;
        $page = 'Detail Data Mahasiswa';
        return view('admin.data-mhs.show', compact('dosen', 'page', 'mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa, $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $dosens = Dosen::all();
        $page = 'Edit Data Dosen';
        return view('admin.data-mhs.edit', compact('mahasiswa', 'page', 'dosens'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Temukan mahasiswa berdasarkan ID atau gagal jika tidak ditemukan
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Validasi input
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $mahasiswa->user_id,
            'email' => 'required|email|unique:users,email,' . $mahasiswa->user_id,
            'nim' => 'required',
            'dosen_id' => 'required',
            'jurusan' => 'required',
            'angkatan' => 'required',
            'smt' => 'required',
        ]);

        // Update data pengguna yang terkait dengan mahasiswa
        $mahasiswa->user->name = $request->input('name');
        $mahasiswa->user->username = $request->input('username');
        $mahasiswa->user->email = $request->input('email');

        // Update password hanya jika diberikan
        if ($request->filled('password')) {
            $mahasiswa->user->password = bcrypt($request->input('password'));
        }

        // Simpan data pengguna
        $mahasiswa->user->save();

        // Update data mahasiswa
        $mahasiswa->nim = $request->input('nim');
        $mahasiswa->dosen_id = $request->input('dosen_id');
        $mahasiswa->jurusan = $request->input('jurusan');
        $mahasiswa->angkatan = $request->input('angkatan');
        $mahasiswa->smt = $request->input('smt');
        $mahasiswa->save();

        return redirect('/admin/kelola-mahasiswa')->with('success', 'Data Mahasiswa berhasil diubah');
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa, $id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->delete();
        return redirect('/admin/kelola-mahasiswa')->with('success', 'Data Mahasiswa berhasil di hapus');
    }
}
