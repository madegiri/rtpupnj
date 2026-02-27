<?php

namespace App\Filament\Resources\CareProfilResource\Pages;

use App\Filament\Resources\CareProfilResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCareProfil extends EditRecord
{
    protected static string $resource = CareProfilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
