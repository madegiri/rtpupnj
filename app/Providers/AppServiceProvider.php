<?php

namespace App\Providers;

use App\Models\KategoriKonten;
use App\Models\KategoriProduk;
use App\Models\UnitPUT;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        View::composer('*', function ($view) {
            $view->with('unitPuts', UnitPUT::orderBy('nama_singkat_unit_put')->get());
            $view->with('kategoriKontens', KategoriKonten::orderBy('id')->get());
            $view->with('kategoriProduks', KategoriProduk::orderBy('id')->get());
        });
    }
}
