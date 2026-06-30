<?php

namespace App\Providers;

use App\Models\KategoriKonten;
use App\Models\KategoriProduk;
use App\Models\UnitPUT;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Shetabit\Visitor\Models\Visit;

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

            $view->with('visitorsByCountry', Cache::remember('visitors_by_country', now()->addHours(2), function () {
                return Visit::selectRaw("
                        JSON_UNQUOTE(JSON_EXTRACT(geo_raw, '$.country_name')) as country,
                        JSON_UNQUOTE(JSON_EXTRACT(geo_raw, '$.country_code')) as country_code,
                        COUNT(DISTINCT ip) as total
                    ")
                    ->whereNotNull('geo_raw')
                    ->whereRaw("JSON_EXTRACT(geo_raw, '$.country_code') IS NOT NULL")
                    ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(geo_raw, '$.country_code')) NOT IN ('null', '')")
                    ->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(geo_raw, '$.country_name')) NOT IN ('null', '')")
                    ->groupBy('country', 'country_code')
                    ->orderByDesc('total')
                    ->limit(10)
                    ->get();
            }));
        });
    }
}
