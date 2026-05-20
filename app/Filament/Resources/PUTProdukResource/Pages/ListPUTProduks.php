<?php

namespace App\Filament\Resources\PUTProdukResource\Pages;

use App\Filament\Resources\PUTProdukResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPUTProduks extends ListRecords
{
    protected static string $resource = PUTProdukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
