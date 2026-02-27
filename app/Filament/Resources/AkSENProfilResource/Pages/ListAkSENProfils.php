<?php

namespace App\Filament\Resources\AkSENProfilResource\Pages;

use App\Filament\Resources\AkSENProfilResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAkSENProfils extends ListRecords
{
    protected static string $resource = AkSENProfilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
