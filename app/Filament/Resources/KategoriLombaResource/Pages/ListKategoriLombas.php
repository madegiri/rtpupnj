<?php

namespace App\Filament\Resources\KategoriLombaResource\Pages;

use App\Filament\Resources\KategoriLombaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriLombas extends ListRecords
{
    protected static string $resource = KategoriLombaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
