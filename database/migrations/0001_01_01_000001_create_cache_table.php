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
        // Hardened cache table: renamed to `cache_items`, expiration nullable/unsigned, index added
        Schema::create('cache_items', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->unsignedInteger('expiration')->nullable()->index();
            $table->timestamps();
        });

        // Lock table for cache operations. Keep owner nullable and expiration nullable
        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner')->nullable();
            $table->unsignedInteger('expiration')->nullable()->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache_items');
        Schema::dropIfExists('cache_locks');
    }
};
