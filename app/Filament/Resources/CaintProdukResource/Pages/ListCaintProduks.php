<?php

namespace App\Filament\Resources\CaintProdukResource\Pages;

use App\Filament\Resources\CaintProdukResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCaintProduks extends ListRecords
{
    protected static string $resource = CaintProdukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
