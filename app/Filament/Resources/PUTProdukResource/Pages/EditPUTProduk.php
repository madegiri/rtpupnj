<?php

namespace App\Filament\Resources\PUTProdukResource\Pages;

use App\Filament\Resources\PUTProdukResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditPUTProduk extends EditRecord
{
    protected static string $resource = PUTProdukResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    // Saat edit, isi unit_put_id dari relasi supaya dropdown tidak kosong
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['unit_put_id'] = $this->record->kategoriProduk->unit_put_id ?? null;
        return $data;
    }

    // Buang unit_put_id sebelum save, karena bukan kolom di db
    protected function mutateFormDataBeforeSave(array $data): array
    {
        unset($data['unit_put_id']);

        // hanya isi kalau masih null
        if (empty($data['users_id'])) {
            $data['users_id'] = Auth::id();
        }
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
