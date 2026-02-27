<?php

namespace App\Filament\Resources\TentangRTPUResource\Pages;

use App\Filament\Resources\TentangRTPUResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTentangRTPU extends EditRecord
{
    protected static string $resource = TentangRTPUResource::class;

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
