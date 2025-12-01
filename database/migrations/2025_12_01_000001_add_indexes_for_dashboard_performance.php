<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->index('tanggal_kunjungan');
            $table->index('status');
        });

        Schema::table('pemeriksaan', function (Blueprint $table) {
            $table->index('diagnosis_utama');
        });
    }

    public function down(): void
    {
        Schema::table('pendaftaran', function (Blueprint $table) {
            $table->dropIndex(['tanggal_kunjungan']);
            $table->dropIndex(['status']);
        });

        Schema::table('pemeriksaan', function (Blueprint $table) {
            $table->dropIndex(['diagnosis_utama']);
        });
    }
};
