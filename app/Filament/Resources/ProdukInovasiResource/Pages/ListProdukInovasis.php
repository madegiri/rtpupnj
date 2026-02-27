<?php

namespace App\Filament\Resources\ProdukInovasiResource\Pages;

use App\Filament\Resources\ProdukInovasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProdukInovasis extends ListRecords
{
    protected static string $resource = ProdukInovasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
