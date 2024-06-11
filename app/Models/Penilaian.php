<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jadwal_spk()
    {
        return $this->belongsTo(JadwalSpk::class);
    }

    public function Kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }

    public function Dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
