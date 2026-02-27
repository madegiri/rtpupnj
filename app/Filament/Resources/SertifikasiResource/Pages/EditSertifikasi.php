<?php

namespace App\Filament\Resources\SertifikasiResource\Pages;

use App\Filament\Resources\SertifikasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSertifikasi extends EditRecord
{
    protected static string $resource = SertifikasiResource::class;

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
