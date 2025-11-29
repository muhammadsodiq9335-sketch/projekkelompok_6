<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create role-based test users with known passwords
        // Password for all test users: `password`
        User::factory()->create([
            'name' => 'Admin Dokter',
            'email' => 'dokter@example.com',
            'role' => 'dokter',
            'password' => 'password',
        ]);

        User::factory()->create([
            'name' => 'User Perawat',
            'email' => 'perawat@example.com',
            'role' => 'perawat',
            'password' => 'password',
        ]);

        User::factory()->create([
            'name' => 'User Petugas',
            'email' => 'petugas@example.com',
            'role' => 'petugas',
            'password' => 'password',
        ]);

    }
}
