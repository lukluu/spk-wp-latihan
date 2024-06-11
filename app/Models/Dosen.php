<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class);
    }
    public function jadwal_spk()
    {
        return $this->hasMany(JadwalSpk::class);
    }
    public function Hasil()
    {
        return $this->hasMany(Hasil::class);
    }
    public function Penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }
}
