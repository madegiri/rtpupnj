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
        //
        Schema::table('unit_put', function (Blueprint $table) {
            $table->dropColumn('dukungan_kebijakan');
        });

        Schema::table('unit_put', function (Blueprint $table) {
            $table->json('dukungan_kebijakan')->nullable()->after('visi_misi'); // [{nama, file}]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('unit_put', function (Blueprint $table) {
            $table->dropColumn('dukungan_kebijakan');
        });

        Schema::table('unit_put', function (Blueprint $table) {
            $table->string('dukungan_kebijakan')->nullable()->after('visi_misi');
        });
    }
};
