<?php

namespace App\Filament\Resources\CaintProfilResource\Pages;

use App\Filament\Resources\CaintProfilResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCaintProfil extends CreateRecord
{
    protected static string $resource = CaintProfilResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
