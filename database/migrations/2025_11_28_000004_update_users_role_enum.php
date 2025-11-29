<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // For MySQL/MariaDB
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('petugas', 'perawat', 'dokter', 'apoteker') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('petugas', 'perawat', 'dokter') NOT NULL");
    }
};
