<?php

namespace App\Filament\Resources\SubKategoriProdukPUTResource\Pages;

use App\Filament\Resources\SubKategoriProdukPUTResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSubKategoriProdukPUT extends CreateRecord
{
    protected static string $resource = SubKategoriProdukPUTResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
