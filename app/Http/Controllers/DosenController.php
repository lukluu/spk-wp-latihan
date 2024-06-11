<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen = Dosen::with('mahasiswa', 'user')->get();
        $page = 'Kelola Dosen';

        return view('admin.data-dosen.keloladosen', compact('dosen', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page = 'Kelola Dosen';
        return view('admin.data-dosen.create', compact('page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = new User();
        $user->name = $request->input('name');
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role = 'dosen';
        $user->save();

        return redirect('/admin/kelola-dosen')->with('success', 'Data dosen berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen, $id)
    {
        $dosen = Dosen::find($id);
        $mahasiswa = Mahasiswa::where('dosen_id', $dosen->id)->get();
        $page = 'Detail Data Dosen';
        return view('admin.data-dosen.show', compact('dosen', 'page', 'mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen, $id)
    {
        $dosen = Dosen::find($id);
        $page = 'Edit Data Dosen';
        return view('admin.data-dosen.edit', compact('dosen', 'page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, Dosen $dosen)
    {
        // Validasi input
        $dosen = Dosen::find($id);
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . ($dosen->user ? $dosen->user->id : ''),
            'email' => 'required|email|unique:users,email,' . ($dosen->user ? $dosen->user->id : ''),
            'nidn' => 'required',
            'password' => 'required',
        ]);

        // Memperbarui data pengguna yang terkait dengan dosen
        if ($dosen->user) {
            $dosen->user->name = $request->input('name');
            $dosen->user->username = $request->input('username');
            $dosen->user->email = $request->input('email');
            $dosen->user->password = bcrypt($request->input('password'));
            $dosen->nidn = $request->input('nidn');

            $dosen->user->save();
            $dosen->save();
        }

        return redirect('/admin/kelola-dosen')->with('success', 'Data dosen berhasil diubah');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dosen $dosen, $id)
    {
        $dosen = Dosen::find($id);
        $dosen->delete();
        return redirect('/admin/kelola-dosen')->with('success', 'Data dosen berhasil di hapus');
    }
}
