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
        Schema::create('put_produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('kategori_produk_put_id')->constrained('kategori_produk_put')->restrictOnDelete();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('thumbnail');
            $table->string('poster');
            $table->json('galeri');
            $table->longText('isi');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('put_produk');
    }
};
