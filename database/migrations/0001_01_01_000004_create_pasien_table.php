<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pasien', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('no_rm')->unique();
            $table->string('no_ktp')->unique();
            $table->string('nama_lengkap');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->text('alamat');
            $table->string('no_telepon');
            $table->string('email')->nullable();
            $table->enum('jenis_pasien', ['Umum', 'BPJS']);
            $table->string('no_bpjs')->nullable();
            $table->string('golongan_darah')->nullable();
            $table->text('riwayat_alergi')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};