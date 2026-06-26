<?php

namespace App\Filament\Widgets;

use App\Models\KategoriProduk;
use Filament\Widgets\ChartWidget;

class ProdukChart extends ChartWidget
{
    // protected static ?string $heading = 'Chart';

    protected static ?string $heading = 'Jumlah Produk Unggulan & Produk Inovasi';

    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $kategori = KategoriProduk::withCount('produk')->get();

        return [
            //
            'datasets' => [
                [
                    'label' => 'Jumlah Produk',
                    'data' => $kategori->pluck('produk_count')->toArray(),
                    'backgroundColor' => [
                        '#f59e0b',
                        '#3b82f6',
                        '#10b981',
                        '#ef4444',
                        '#8b5cf6',
                        '#ec4899',
                    ],
                ],
            ],
            'labels' => $kategori->pluck('nama_kategori_produk')->toArray(),
        ];
    }

    protected function getOptions(): array
    {
        return [
            'maintainAspectRatio' => false,
            'scales' => [
                'y' => ['display' => false],
                'x' => ['display' => false],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
