<?php

namespace App\Filament\Resources\CareProfilResource\Pages;

use App\Filament\Resources\CareProfilResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCareProfils extends ListRecords
{
    protected static string $resource = CareProfilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
