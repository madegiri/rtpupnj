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
            $table->foreignId('users_id')->nullable()->constrained('users')->nullOnDelete()->after('id');
        });

        Schema::table('tentang_rtpu', function (Blueprint $table) {
            $table->foreignId('users_id')->nullable()->constrained('users')->nullOnDelete()->after('id');
        });

        Schema::table('sertifikasi', function (Blueprint $table) {
            $table->foreignId('users_id')->nullable()->constrained('users')->nullOnDelete()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('struktur_organisasi', function (Blueprint $table) {
            $table->dropForeign(['users_id']);
            $table->dropColumn('users_id');
        });

        Schema::table('tentang_rtpu', function (Blueprint $table) {
            $table->dropForeign(['users_id']);
            $table->dropColumn('users_id');
        });

        Schema::table('sertifikasi', function (Blueprint $table) {
            $table->dropForeign(['users_id']);
            $table->dropColumn('users_id');
        });
    }
};
