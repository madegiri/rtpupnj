<?php

namespace App\Filament\Resources\KategoriKontenResource\Pages;

use App\Filament\Resources\KategoriKontenResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKategoriKonten extends CreateRecord
{
    protected static string $resource = KategoriKontenResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
