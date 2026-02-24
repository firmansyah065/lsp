<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat Akun Admin
        User::create([
            'username' => 'admin',
            'password' => Hash::make('password123'), // Password admin
            'nama_lengkap' => 'Administrator',
            'role' => 'admin'
        ]);

        // Buat Akun Siswa
        User::create([
            'username' => 'siswa',
            'password' => Hash::make('password123'), // Password siswa
            'nis' => '12345678',
            'nama_lengkap' => 'Siswa Teladan',
            'kelas' => 'XII',
            'jurusan' => 'RPL',
            'role' => 'siswa'
        ]);
    }
}