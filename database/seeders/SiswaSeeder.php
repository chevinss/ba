<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'username' => 'siswa_14',
            'email' => 'siswa@tetra.com',
            'password' => bcrypt('123'),
            'role' => 'siswa',
        ]);

        Student::create([
            'user_id' => $user->id,
            'nama' => 'Siswa XX',
            'nisn' => '3202116021',
            'kelas' => 'X',
            'jurusan' => 'ipa',
        ]);
    }
}
