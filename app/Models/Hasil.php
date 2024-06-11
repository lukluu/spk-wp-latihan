<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jadwal_spk()
    {
        return $this->belongsTo(JadwalSpk::class);
    }

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}
