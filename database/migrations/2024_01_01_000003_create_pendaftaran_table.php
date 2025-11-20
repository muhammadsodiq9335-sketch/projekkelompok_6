<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('no_antrian')->unique();
            $table->foreignId('pasien_id')->constrained('pasien')->onDelete('cascade');
            $table->date('tanggal_kunjungan');
            $table->time('jam_kunjungan')->nullable();
            $table->string('poliklinik');
            $table->foreignId('dokter_id')->nullable()->constrained('users');
            $table->text('keluhan')->nullable();
            $table->enum('jenis_kunjungan', ['Baru', 'Lama'])->default('Baru');
            $table->string('status')->default('Menunggu');
            $table->foreignId('petugas_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftaran');
    }
};
