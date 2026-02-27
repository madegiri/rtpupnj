<?php

namespace App\Filament\Widgets;

use App\Models\ArtikelInovasi;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\ProdukInovasi;
use App\Models\ProdukUnggulan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //
            Stat::make('Artikel Inovasi', ArtikelInovasi::count())
                ->description('Total artikel')
                ->icon('heroicon-o-newspaper')
                ->color('success'),

            Stat::make('Berita', Berita::count())
                ->description('Total berita')
                ->icon('heroicon-o-megaphone')
                ->color('info'),

            Stat::make('Pengumuman', Pengumuman::count())
                ->description('Total pengumuman')
                ->icon('heroicon-o-bell-alert')
                ->color('warning'),

            Stat::make('Produk Inovasi', ProdukInovasi::count())
                ->description('Total produk inovasi')
                ->icon('heroicon-o-light-bulb')
                ->color('primary'),

            Stat::make('Produk Unggulan', ProdukUnggulan::count())
                ->description('Total produk unggulan')
                ->icon('heroicon-o-star')
                ->color('danger'),
            
            Stat::make('Sertifikasi', \App\Models\Sertifikasi::count())
                ->description('Total sertifikasi')
                ->icon('heroicon-o-document-check')
                ->color('secondary'),
        ];
    }
}
