<?php

namespace App\Filament\Resources\PimpinanRTPUResource\Pages;

use App\Filament\Resources\PimpinanRTPUResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePimpinanRTPU extends CreateRecord
{
    protected static string $resource = PimpinanRTPUResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
