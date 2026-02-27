<?php

namespace App\Filament\Resources\CaintProdukResource\Pages;

use App\Filament\Resources\CaintProdukResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCaintProduk extends CreateRecord
{
    protected static string $resource = CaintProdukResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
