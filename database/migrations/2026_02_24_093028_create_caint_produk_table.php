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
        Schema::create('caint_produk', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('thumbnail');
            $table->json('galeri');
            $table->longText('isi');
            $table->enum('kategori', [
                'Smart Campus',
                'Green Energy',
                'Industrial Automation',
                'Agriculture & Environment',
                'Healthcare',
            ]);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('caint_produk');
    }
};
