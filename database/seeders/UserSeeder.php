<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'username' => 'admin',
            'email' => 'email@tetra.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);
        // Kepsek
        User::create([
            'username' => 'kepsek_tetra',
            'email' => 'kepsek@tetra.com',
            'password' => bcrypt('kepsek'),
            'role' => 'kepsek',
        ]);
    }
}
