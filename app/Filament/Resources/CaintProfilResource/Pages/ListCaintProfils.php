<?php

namespace App\Filament\Resources\CaintProfilResource\Pages;

use App\Filament\Resources\CaintProfilResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCaintProfils extends ListRecords
{
    protected static string $resource = CaintProfilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
