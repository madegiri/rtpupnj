<?php

namespace App\Filament\Resources\SubKategoriProdukPUTResource\Pages;

use App\Filament\Resources\SubKategoriProdukPUTResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubKategoriProdukPUTS extends ListRecords
{
    protected static string $resource = SubKategoriProdukPUTResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
