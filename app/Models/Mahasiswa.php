<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
    public function jadwal_spk()
    {
        return $this->hasMany(Jadwal::class);
    }
}
