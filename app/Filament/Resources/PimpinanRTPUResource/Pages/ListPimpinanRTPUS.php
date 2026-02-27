<?php

namespace App\Filament\Resources\PimpinanRTPUResource\Pages;

use App\Filament\Resources\PimpinanRTPUResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPimpinanRTPUS extends ListRecords
{
    protected static string $resource = PimpinanRTPUResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
