<?php

namespace App\Filament\Resources\ArtikelInovasiResource\Pages;

use App\Filament\Resources\ArtikelInovasiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateArtikelInovasi extends CreateRecord
{
    protected static string $resource = ArtikelInovasiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
