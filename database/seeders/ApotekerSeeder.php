<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ApotekerSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin Apotek',
            'email' => 'apotek@rs.com',
            'password' => Hash::make('password'),
            'role' => 'apoteker',
        ]);
    }
}
