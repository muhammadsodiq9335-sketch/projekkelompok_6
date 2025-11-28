<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('obat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_obat');
            $table->string('kode_obat')->unique();
            $table->string('jenis'); // Tablet, Sirup, Kapsul, dll
            $table->integer('stok')->default(0);
            $table->decimal('harga', 10, 2);
            $table->string('satuan'); // pcs, strip, botol
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('obat');
    }
};
