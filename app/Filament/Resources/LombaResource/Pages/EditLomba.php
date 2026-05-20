<?php

namespace App\Filament\Resources\LombaResource\Pages;

use App\Filament\Resources\LombaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditLomba extends EditRecord
{
    protected static string $resource = LombaResource::class;

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

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // hanya isi kalau masih null
        if (empty($data['users_id'])) {
            $data['users_id'] = Auth::id();
        }

        return $data;
    }
}
