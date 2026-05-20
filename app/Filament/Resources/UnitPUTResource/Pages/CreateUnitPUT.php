<?php

namespace App\Filament\Resources\UnitPUTResource\Pages;

use App\Filament\Resources\UnitPUTResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUnitPUT extends CreateRecord
{
    protected static string $resource = UnitPUTResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
