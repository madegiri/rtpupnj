<?php

namespace App\Filament\Resources\ProdukInovasiResource\Pages;

use App\Filament\Resources\ProdukInovasiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProdukInovasi extends CreateRecord
{
    protected static string $resource = ProdukInovasiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
