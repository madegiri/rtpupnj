<?php

namespace App\Filament\Resources\AkSENProfilResource\Pages;

use App\Filament\Resources\AkSENProfilResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAkSENProfil extends EditRecord
{
    protected static string $resource = AkSENProfilResource::class;

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
