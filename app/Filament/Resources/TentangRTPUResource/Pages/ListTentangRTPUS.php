<?php

namespace App\Filament\Resources\TentangRTPUResource\Pages;

use App\Filament\Resources\TentangRTPUResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTentangRTPUS extends ListRecords
{
    protected static string $resource = TentangRTPUResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
