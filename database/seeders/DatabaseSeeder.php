<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'     => 'Admin PSIK',
            'nim'      => '000000000000',
            'email'    => 'admin@filkom.ub.ac.id',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
        ]);

        // Pengaju contoh
        User::create([
            'name'     => 'Dinda Rahma',
            'nim'      => '215150200111001',
            'email'    => 'dinda@student.ub.ac.id',
            'password' => Hash::make('password123'),
            'role'     => 'user',
        ]);
    }
}