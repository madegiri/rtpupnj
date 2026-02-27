<?php

namespace App\Filament\Resources\PutoiProfilResource\Pages;

use App\Filament\Resources\PutoiProfilResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPutoiProfil extends EditRecord
{
    protected static string $resource = PutoiProfilResource::class;

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
