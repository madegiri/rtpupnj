<?php

namespace App\Filament\Resources\ArtikelInovasiResource\Pages;

use App\Filament\Resources\ArtikelInovasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditArtikelInovasi extends EditRecord
{
    protected static string $resource = ArtikelInovasiResource::class;

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
