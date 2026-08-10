<?php

namespace App\Filament\Resources\ProfilPekanInovasiResource\Pages;

use App\Filament\Resources\ProfilPekanInovasiResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProfilPekanInovasis extends ListRecords
{
    protected static string $resource = ProfilPekanInovasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
