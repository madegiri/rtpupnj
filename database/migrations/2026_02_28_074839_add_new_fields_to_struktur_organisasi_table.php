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
        Schema::table('struktur_organisasi', function (Blueprint $table) {
            //
            $table->string('nama')->after('gambar');
            $table->string('slug')->unique()->after('nama');
            $table->string('jabatan')->after('slug');
            $table->text('deskripsi')->after('jabatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('struktur_organisasi', function (Blueprint $table) {
            //
            $table->dropColumn(['nama', 'slug', 'jabatan', 'deskripsi']);
        });
    }
};
