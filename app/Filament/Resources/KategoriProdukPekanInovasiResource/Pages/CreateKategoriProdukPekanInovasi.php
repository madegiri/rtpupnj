<?php

namespace App\Filament\Resources\KategoriProdukPekanInovasiResource\Pages;

use App\Filament\Resources\KategoriProdukPekanInovasiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKategoriProdukPekanInovasi extends CreateRecord
{
    protected static string $resource = KategoriProdukPekanInovasiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
