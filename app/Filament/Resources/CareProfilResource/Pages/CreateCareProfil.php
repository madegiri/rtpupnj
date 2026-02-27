<?php

namespace App\Filament\Resources\CareProfilResource\Pages;

use App\Filament\Resources\CareProfilResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCareProfil extends CreateRecord
{
    protected static string $resource = CareProfilResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
