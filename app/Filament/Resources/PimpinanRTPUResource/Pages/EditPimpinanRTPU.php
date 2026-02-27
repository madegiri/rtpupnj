<?php

namespace App\Filament\Resources\PimpinanRTPUResource\Pages;

use App\Filament\Resources\PimpinanRTPUResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPimpinanRTPU extends EditRecord
{
    protected static string $resource = PimpinanRTPUResource::class;

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
