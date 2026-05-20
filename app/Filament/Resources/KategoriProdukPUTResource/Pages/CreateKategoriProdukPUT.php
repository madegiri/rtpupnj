<?php

namespace App\Filament\Resources\KategoriProdukPUTResource\Pages;

use App\Filament\Resources\KategoriProdukPUTResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKategoriProdukPUT extends CreateRecord
{
    protected static string $resource = KategoriProdukPUTResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
