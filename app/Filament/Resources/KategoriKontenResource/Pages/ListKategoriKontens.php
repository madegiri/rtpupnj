<?php

namespace App\Filament\Resources\KategoriKontenResource\Pages;

use App\Filament\Resources\KategoriKontenResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKategoriKontens extends ListRecords
{
    protected static string $resource = KategoriKontenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
