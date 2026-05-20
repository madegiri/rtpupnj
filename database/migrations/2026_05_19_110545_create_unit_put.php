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
        Schema::create('unit_put', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('nama_singkat_unit_put');
            $table->string('nama_lengkap_unit_put');
            $table->json('poster')->nullable();
            $table->string('thumbnail');
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
        Schema::dropIfExists('unit_put');
    }
};
