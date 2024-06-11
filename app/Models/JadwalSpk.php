<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalSpk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $dates = ['hari'];
    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }

    public function hasil()
    {
        return $this->hasMany(Hasil::class);
    }
}
