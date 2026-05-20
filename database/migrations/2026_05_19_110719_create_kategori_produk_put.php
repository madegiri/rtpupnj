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
        Schema::create('kategori_produk_put', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_put_id')->constrained('unit_put')->restrictOnDelete();
            $table->string('slug')->unique();
            $table->string('nama_kategori');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_produk_put');
    }
};
