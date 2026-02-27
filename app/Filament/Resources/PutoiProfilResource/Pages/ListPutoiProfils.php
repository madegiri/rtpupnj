<?php

namespace App\Filament\Resources\PutoiProfilResource\Pages;

use App\Filament\Resources\PutoiProfilResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPutoiProfils extends ListRecords
{
    protected static string $resource = PutoiProfilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
