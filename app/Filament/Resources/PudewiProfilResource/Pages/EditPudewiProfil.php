<?php

namespace App\Filament\Resources\PudewiProfilResource\Pages;

use App\Filament\Resources\PudewiProfilResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPudewiProfil extends EditRecord
{
    protected static string $resource = PudewiProfilResource::class;

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
