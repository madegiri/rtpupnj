<?php

namespace App\Filament\Resources\KategoriProdukPUTResource\Pages;

use App\Filament\Resources\KategoriProdukPUTResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriProdukPUTS extends ListRecords
{
    protected static string $resource = KategoriProdukPUTResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
