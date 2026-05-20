<?php

namespace App\Filament\Widgets;

use App\Models\ArtikelInovasi;
use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\ProdukInovasi;
use App\Models\ProdukUnggulan;
use App\Models\Sertifikasi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Shetabit\Visitor\Models\Visit;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            //
            // Stat::make('Artikel Inovasi', ArtikelInovasi::count())
            //     ->description('Total artikel')
            //     ->icon('heroicon-o-newspaper')
            //     ->color('success'),

            // Stat::make('Berita', Berita::count())
            //     ->description('Total berita')
            //     ->icon('heroicon-o-megaphone')
            //     ->color('info'),

            // Stat::make('Pengumuman', Pengumuman::count())
            //     ->description('Total pengumuman')
            //     ->icon('heroicon-o-bell-alert')
            //     ->color('warning'),

            // Stat::make('Produk Inovasi', ProdukInovasi::count())
            //     ->description('Total produk inovasi')
            //     ->icon('heroicon-o-light-bulb')
            //     ->color('primary'),

            // Stat::make('Produk Unggulan', ProdukUnggulan::count())
            //     ->description('Total produk unggulan')
            //     ->icon('heroicon-o-star')
            //     ->color('danger'),
            
            // Stat::make('Pelatihan', Sertifikasi::count())
            //     ->description('Total pelatihan')
            //     ->icon('heroicon-o-document-check')
            //     ->color('secondary'),

            Stat::make('Pengunjung Hari Ini',
                Visit::whereDate('created_at', today())->distinct('ip')->count('ip'))
                ->icon('heroicon-o-user-group')
                ->color('success'),

            Stat::make('Page Views Hari Ini',
                Visit::whereDate('created_at', today())->count())
                ->icon('heroicon-o-eye')
                ->color('warning'),

            Stat::make('Total Pengunjung',
                Visit::distinct('ip')->count('ip'))
                ->icon('heroicon-o-globe-alt')
                ->color('info'),
            
            Stat::make('Total Page Views', Visit::count())
                ->icon('heroicon-o-chart-bar')
                ->color('primary'),
        ];
    }
}
