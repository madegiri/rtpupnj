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
        Schema::table('unit_put', function (Blueprint $table) {
            //
            $table->dropColumn(['roadmap', 'struktur_organisasi']);
        });

        Schema::table('unit_put', function (Blueprint $table) {
            //
            $table->string('roadmap')->nullable()->after('sarana_prasarana');
            $table->string('struktur_organisasi')->nullable()->after('roadmap');

            $table->json('penelitian')->nullable()->after('struktur_organisasi');
            $table->json('pengabdian_masyarakat')->nullable()->after('penelitian');
            $table->text('lecturer_series')->nullable()->after('pengabdian_masyarakat');
            $table->text('magang_riset')->nullable()->after('lecturer_series');
            $table->json('kegiatan_lainnya')->nullable()->after('magang_riset');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('unit_put', function (Blueprint $table) {
            //
            $table->dropColumn([
                'roadmap',
                'struktur_organisasi',
                'penelitian',
                'pengabdian_masyarakat',
                'lecturer_series',
                'magang_riset',
                'kegiatan_lainnya',
            ]);
        });

        Schema::table('unit_put', function (Blueprint $table) {
            //
            $table->json('roadmap')->nullable()->after('sarana_prasarana');
            $table->json('struktur_organisasi')->nullable()->after('roadmap');
        });
    }
};
