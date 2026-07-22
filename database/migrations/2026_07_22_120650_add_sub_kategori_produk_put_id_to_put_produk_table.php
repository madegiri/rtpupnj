<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('put_produk', function (Blueprint $table) {
            //
            $table->foreignId('sub_kategori_produk_put_id')->nullable()->after('users_id')->constrained('sub_kategori_produk_put')->nullOnDelete();
        });

        // 2. Migrasi data: buatkan sub kategori default untuk tiap kategori lama,
        //    lalu arahkan produk lama ke sub kategori default itu
        DB::table('kategori_produk_put')->orderBy('id')->each(function ($kategori) {
            $subKategoriId = DB::table('sub_kategori_produk_put')->insertGetId([
                'kategori_produk_put_id' => $kategori->id,
                'slug' => $kategori->slug . '-umum',
                'nama_sub_kategori' => 'Umum',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('put_produk')
                ->where('kategori_produk_put_id', $kategori->id)
                ->update(['sub_kategori_produk_put_id' => $subKategoriId]);
        });

        // 3. Baru hapus kolom & FK lama
        Schema::table('put_produk', function (Blueprint $table) {
            $table->dropForeign(['kategori_produk_put_id']);
            $table->dropColumn('kategori_produk_put_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('put_produk', function (Blueprint $table) {
            //
            $table->foreignId('kategori_produk_put_id')
                ->nullable()
                ->after('users_id')
                ->constrained('kategori_produk_put')
                ->nullOnDelete();
        });

        Schema::table('put_produk', function (Blueprint $table) {
            $table->dropForeign(['sub_kategori_produk_put_id']);
            $table->dropColumn('sub_kategori_produk_put_id');
        });
    }
};
