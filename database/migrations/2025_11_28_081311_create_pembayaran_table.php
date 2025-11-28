<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pendaftaran_id')->constrained('pendaftaran')->onDelete('cascade');
            $table->decimal('total_tindakan', 10, 2)->default(0);
            $table->decimal('total_obat', 10, 2)->default(0);
            $table->decimal('total_bayar', 10, 2);
            $table->decimal('jumlah_bayar', 10, 2);
            $table->decimal('kembalian', 10, 2);
            $table->string('metode_pembayaran')->default('tunai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
