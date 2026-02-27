<?php

namespace App\Filament\Resources\CaintProdukResource\Pages;

use App\Filament\Resources\CaintProdukResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCaintProduk extends EditRecord
{
    protected static string $resource = CaintProdukResource::class;

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
