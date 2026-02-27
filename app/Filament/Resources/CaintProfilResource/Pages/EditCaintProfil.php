<?php

namespace App\Filament\Resources\CaintProfilResource\Pages;

use App\Filament\Resources\CaintProfilResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCaintProfil extends EditRecord
{
    protected static string $resource = CaintProfilResource::class;

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
