<?php

namespace App\Filament\Resources\TentangRTPUResource\Pages;

use App\Filament\Resources\TentangRTPUResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateTentangRTPU extends CreateRecord
{
    protected static string $resource = TentangRTPUResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
