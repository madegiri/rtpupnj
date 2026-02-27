<?php

namespace App\Filament\Resources\ProdukInovasiResource\Pages;

use App\Filament\Resources\ProdukInovasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProdukInovasi extends EditRecord
{
    protected static string $resource = ProdukInovasiResource::class;

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
