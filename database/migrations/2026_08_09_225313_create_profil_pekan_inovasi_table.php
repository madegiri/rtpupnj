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
        Schema::create('profil_pekan_inovasi', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('nama_pekan_inovasi');
            $table->string('thumbnail');
            $table->json('galeri_kegiatan')->nullable();
            $table->json('poster')->nullable();
            $table->text('deskripsi');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_pekan_inovasi');
    }
};
