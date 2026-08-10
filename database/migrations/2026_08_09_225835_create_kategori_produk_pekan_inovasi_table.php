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
        Schema::create('kategori_produk_pekan_inovasi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profil_pekan_inovasi_id')->constrained('profil_pekan_inovasi')->restrictOnDelete();
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
        Schema::dropIfExists('kategori_produk_pekan_inovasi');
    }
};
