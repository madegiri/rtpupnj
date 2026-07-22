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
        Schema::create('sub_kategori_produk_put', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_produk_put_id')->constrained('kategori_produk_put')->restrictOnDelete();
            $table->string('slug');
            $table->string('nama_sub_kategori');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_kategori_produk_put');
    }
};
