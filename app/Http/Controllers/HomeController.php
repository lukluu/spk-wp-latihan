<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function authenticate(Request $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $role = Auth::user()->role;
            if ($role == 'admin') {
                return redirect()->intended('/admin');
            } elseif ($role == 'mahasiswa') {
                return redirect()->intended('/user');
            } elseif ($role == 'dosen') {
                return redirect()->intended('/dosen');
            }
        }

        return Redirect::back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function adminDashboard()
    {
        $page = 'Dashboard';
        $mahasiswa = Mahasiswa::count();
        $dosen = Dosen::count();
        return view('admin.dashboard', compact('page', 'mahasiswa', 'dosen'));
    }

    public function userDashboard()
    {
        $page = 'Dashboard';

        return view('mahasiswa.dashboard', compact('page'));
    }

    public function managerDashboard()
    {
        return view('manager.dashboard');
    }
    public function logout(Request $request)
    {
        Auth::logout(); // Lakukan logout

        $request->session()->invalidate(); // Hapus session yang ada

        $request->session()->regenerateToken(); // Regenerate token


        // Redirect ke halaman login atau halaman lain
        return redirect()->route('login');
    }
}
