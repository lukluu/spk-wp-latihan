<?php

use App\Models\Kriteria;
use App\Models\Mahasiswa;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\HitungController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\JadwalSpkController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\KelolaDosenController;
use App\Http\Controllers\KelolaMahasiswaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (auth()->check()) {
        // Redirect pengguna terautentikasi ke dashboard sesuai peran mereka
        $role = auth()->user()->role;
        if ($role == 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($role == 'mahasiswa') {
            return redirect()->route('user.dashboard');
        } elseif ($role == 'manager') {
            return redirect()->route('manager.dashboard');
        }
    }
    return redirect()->route('login');
});

// Halaman login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Proses login
Route::post('/login', [HomeController::class, 'authenticate']);
Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Menangani proses registrasi
Route::post('/register', [RegisterController::class, 'register']);
// Rute yang membutuhkan autentikasi
Route::middleware(['auth'])->group(function () {
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin', [HomeController::class, 'adminDashboard'])->name('admin.dashboard');
        Route::resource('/admin/kelola-dosen', DosenController::class);
        Route::resource('/admin/kelola-kriteria', KriteriaController::class);
        Route::resource('/admin/kelola-mahasiswa', MahasiswaController::class);
        Route::resource('/admin/kelola-jadwal', JadwalSpkController::class);
        Route::get('/admin/kelola-perhitungan', [HitungController::class, 'index']);
        Route::get('//admin/kelola-perhitungan/nilai-alternatif', [HitungController::class, 'alternatif']);
        Route::get('//admin/kelola-perhitungan/nilai-alternatif/show/{dosen_id}', [HitungController::class, 'showAlternatif']);
        Route::get('//admin/kelola-perhitungan/normalisasi', [HitungController::class, 'normalisasi']);
        Route::get('//admin/kelola-perhitungan/vektor-s', [HitungController::class, 'vektor']);
        Route::get('//admin/kelola-perhitungan/hasil', [HitungController::class, 'hasil']);
        Route::get('/admin/kelola-perhitungan/{dosen_id}', [HitungController::class, 'jadwal']);
        Route::get('/admin/kelola-perhitungan/{dosen_id}/input/{jadwal_spk_id}', [HitungController::class, 'input']);
        Route::post('/admin/kelola-perhitungan/{dosen_id}/input/{jadwal_spk_id}/proses', [HitungController::class, 'prosesInput']);
        Route::delete('/admin/kelola-perhitungan/{id_dosen}/input/{id_jadwal}/hapus', [HitungController::class, 'hapus']);
        Route::post('/admin/kelola-perhitungan/save-hasil', [HitungController::class, 'saveHasil'])->name('save.hasil');
    });

    Route::middleware(['role:mahasiswa'])->group(function () {
        Route::get('/user', [HomeController::class, 'userDashboard'])->name('user.dashboard');
    });

    Route::middleware(['role:manager'])->group(function () {
        Route::get('/dosen', [HomeController::class, 'managerDashboard'])->name('manager.dashboard');
    });
});
