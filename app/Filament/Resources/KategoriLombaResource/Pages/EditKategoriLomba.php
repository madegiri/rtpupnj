<?php

namespace App\Filament\Resources\KategoriLombaResource\Pages;

use App\Filament\Resources\KategoriLombaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriLomba extends EditRecord
{
    protected static string $resource = KategoriLombaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function ($action) {
                    if ($this->record->lomba()->exists()) {
                        \Filament\Notifications\Notification::make()
                            ->danger()
                            ->title('Tidak bisa dihapus!')
                            ->body('Kategori masih memiliki lomba. Hapus semua lomba terlebih dahulu.')
                            ->send();
                        $action->cancel();
                    }
                }),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
