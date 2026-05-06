<?php

namespace App\Filament\Resources\KategoriLombaResource\Pages;

use App\Filament\Resources\KategoriLombaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKategoriLomba extends CreateRecord
{
    protected static string $resource = KategoriLombaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
