<?php

namespace App\Filament\Widgets;

use App\Models\UnitPUT;
use Filament\Widgets\ChartWidget;

class ProdukPUTChart extends ChartWidget
{
    // protected static ?string $heading = 'Chart';

    protected static ?string $heading = 'Jumlah Produk per Unit PUT';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected static ?string $maxHeight = '350px';

    protected function getData(): array
    {
        $units = UnitPUT::with(['kategoriProduk' => function ($query) {
            $query->withCount('putProduk');
        }])->get();

        $colors = [
            '#f59e0b',
            '#3b82f6',
            '#10b981',
            '#ef4444',
            '#8b5cf6',
            '#ec4899',
            '#14b8a6',
            '#f97316',
            '#6366f1',
            '#84cc16',
        ];

        $labels = [];
        $data = [];
        $backgroundColors = [];

        foreach ($units as $index => $unit) {
            $labels[] = $unit->nama_singkat_unit_put;
            $data[] = $unit->kategoriProduk->sum('put_produk_count');
            $backgroundColors[] = $colors[$index % count($colors)];
        }

        return [
            //
            'datasets' => [
                [
                    'label' => 'Jumlah Produk',
                    'data' => $data,
                    'backgroundColor' => $backgroundColors,
                    'borderColor' => $backgroundColors,
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getOptions(): array
    {
        return [
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'y' => [
                    'display' => true,
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                    'title' => [
                        'display' => true,
                        'text' => 'Jumlah Produk',
                    ],
                ],
                'x' => [
                    'display' => true,
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
