<?php

namespace App\Filament\Resources\AkSENProfilResource\Pages;

use App\Filament\Resources\AkSENProfilResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAkSENProfil extends CreateRecord
{
    protected static string $resource = AkSENProfilResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
