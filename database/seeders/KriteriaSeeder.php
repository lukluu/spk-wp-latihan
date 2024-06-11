<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kriteria::create([
            'kode' => 'C1',
            'nama_kriteria' => 'Ketersediaan Waktu Dosen',
            'bobot' => 4,
        ]);

        Kriteria::create([
            'kode' => 'C2',
            'nama_kriteria' => 'Preferensi Waktu Mahasiswa',
            'bobot' => 3,
        ]);

        Kriteria::create([
            'kode' => 'C3',
            'nama_kriteria' => 'Ketersediaan Ruangan',
            'bobot' => 3,
        ]);

        Kriteria::create([
            'kode' => 'C4',
            'nama_kriteria' => 'Jarak Waktu Antara Pertemuan',
            'bobot' => 2,
        ]);

        Kriteria::create([
            'kode' => 'C5',
            'nama_kriteria' => 'Prioritas Mahasiswa',
            'bobot' => 5,
        ]);

        Kriteria::create([
            'kode' => 'C6',
            'nama_kriteria' => 'Efisiensi Penggunaan Waktu',
            'bobot' => 4,
        ]);

        Kriteria::create([
            'kode' => 'C7',
            'nama_kriteria' => 'Kepatuhan Terhadap Kebijakan Institusi',
            'bobot' => 3,
        ]);

        Kriteria::create([
            'kode' => 'C8',
            'nama_kriteria' => 'Keseimbangan Beban Kerja Dosen',
            'bobot' => 2,
        ]);
    }
}
