<?php

namespace App\Filament\Resources\UnitPUTResource\Pages;

use App\Filament\Resources\UnitPUTResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUnitPUTS extends ListRecords
{
    protected static string $resource = UnitPUTResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
