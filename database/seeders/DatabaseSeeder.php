<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Jadwal;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Admin',
            'username' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);


        // Membuat pengguna
        User::create([
            'name' => 'Muhammad',
            'username' => 'muhammad',
            'email' => 'mhs@example.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
        ]);

        User::create([
            'name' => 'La Ode',
            'username' => 'laode',
            'email' => 'mhs2@example.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
        ]);

        User::create([
            'name' => 'Andi',
            'username' => 'andi',
            'email' => 'mhs3@example.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
        ]);
        User::create([
            'name' => 'Pak Ibnu',
            'username' => 'ibnu',
            'email' => 'dosen3@example.com',
            'password' => Hash::make('password'),
            'role' => 'dosen',
        ]);

        User::create([
            'name' => 'Pak Maman',
            'username' => 'Dosen',
            'email' => 'dosen@example.com',
            'password' => Hash::make('password'),
            'role' => 'dosen',
        ]);
        User::create([
            'name' => 'Ibu Herman',
            'username' => 'Dosen2',
            'email' => 'dosen2@example.com',
            'password' => Hash::make('password'),
            'role' => 'dosen',
        ]);
    }
}
