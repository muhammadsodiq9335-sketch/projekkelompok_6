<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemeriksaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran');
            $table->text('anamnesis');
            $table->text('pemeriksaan_fisik');
            $table->string('diagnosis_utama');
            $table->text('diagnosis_tambahan')->nullable();
            $table->text('tindakan')->nullable();
            $table->text('resep_obat')->nullable();
            $table->text('catatan_dokter')->nullable();
            $table->enum('rencana_tindak_lanjut', ['Kontrol', 'Rujuk', 'Pulang', 'Rawat Inap'])->nullable();
            $table->date('tanggal_kontrol')->nullable();
            $table->foreignId('dokter_id')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemeriksaan');
    }
};