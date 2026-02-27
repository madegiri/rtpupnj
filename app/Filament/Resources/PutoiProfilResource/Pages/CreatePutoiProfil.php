<?php

namespace App\Filament\Resources\PutoiProfilResource\Pages;

use App\Filament\Resources\PutoiProfilResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePutoiProfil extends CreateRecord
{
    protected static string $resource = PutoiProfilResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
