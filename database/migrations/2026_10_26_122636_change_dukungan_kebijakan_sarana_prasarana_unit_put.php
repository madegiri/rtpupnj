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
            $table->dropColumn(['dukungan_kebijakan', 'sarana_prasarana']);
        });

        Schema::table('unit_put', function (Blueprint $table) {
            $table->string('dukungan_kebijakan')->nullable()->after('visi_misi'); // path PDF
            $table->json('sarana_prasarana')->nullable()->after('sdm');           // [{judul, foto: [...]}]
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('unit_put', function (Blueprint $table) {
            $table->dropColumn(['dukungan_kebijakan', 'sarana_prasarana']);
        });

        Schema::table('unit_put', function (Blueprint $table) {
            $table->text('dukungan_kebijakan')->nullable()->after('visi_misi');
            $table->text('sarana_prasarana')->nullable()->after('sdm');
        });
    }
};
