<?php

namespace App\Filament\Resources\PudewiProfilResource\Pages;

use App\Filament\Resources\PudewiProfilResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPudewiProfils extends ListRecords
{
    protected static string $resource = PudewiProfilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
