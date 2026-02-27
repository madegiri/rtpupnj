<?php

namespace App\Filament\Resources\PudewiProfilResource\Pages;

use App\Filament\Resources\PudewiProfilResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePudewiProfil extends CreateRecord
{
    protected static string $resource = PudewiProfilResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
