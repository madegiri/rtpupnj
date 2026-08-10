<?php

namespace App\Filament\Resources\ProdukPekanInovasiResource\Pages;

use App\Filament\Resources\ProdukPekanInovasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProdukPekanInovasis extends ListRecords
{
    protected static string $resource = ProdukPekanInovasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
