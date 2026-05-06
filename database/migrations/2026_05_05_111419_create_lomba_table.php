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
        Schema::create('lomba', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('kategori_lomba_id')->constrained('kategori_lomba')->restrictOnDelete();
            $table->string('nama_lomba');
            $table->string('slug')->unique();
            $table->string('gambar');
            $table->string('penyelenggara');
            $table->json('kategori_peserta');
            $table->enum('jenis_pelaksanaan', ['online', 'offline', 'hybrid']);
            $table->text('deskripsi');
            $table->string('link_pendaftaran');
            $table->date('tanggal_mulai_pendaftaran');
            $table->date('tanggal_selesai_pendaftaran');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lomba');
    }
};
