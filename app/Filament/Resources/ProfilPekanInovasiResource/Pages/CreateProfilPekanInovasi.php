<?php

namespace App\Filament\Resources\ProfilPekanInovasiResource\Pages;

use App\Filament\Resources\ProfilPekanInovasiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProfilPekanInovasi extends CreateRecord
{
    protected static string $resource = ProfilPekanInovasiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
