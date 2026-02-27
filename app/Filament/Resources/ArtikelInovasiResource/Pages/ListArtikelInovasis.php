<?php

namespace App\Filament\Resources\ArtikelInovasiResource\Pages;

use App\Filament\Resources\ArtikelInovasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListArtikelInovasis extends ListRecords
{
    protected static string $resource = ArtikelInovasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
