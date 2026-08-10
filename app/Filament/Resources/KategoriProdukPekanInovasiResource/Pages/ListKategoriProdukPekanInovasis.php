<?php

namespace App\Filament\Resources\KategoriProdukPekanInovasiResource\Pages;

use App\Filament\Resources\KategoriProdukPekanInovasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriProdukPekanInovasis extends ListRecords
{
    protected static string $resource = KategoriProdukPekanInovasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
