<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@medicare.com',
            'password' => Hash::make('password'), // Default password
            'role' => 'super_admin',
            'nip' => '000000',
            'spesialis' => '-',
            'phone' => '081234567890',
            'alamat' => 'Kantor Pusat',
        ]);
    }
}
