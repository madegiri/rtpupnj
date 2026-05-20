<?php

namespace App\Filament\Resources\KategoriKontenResource\Pages;

use App\Filament\Resources\KategoriKontenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriKonten extends EditRecord
{
    protected static string $resource = KategoriKontenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function ($action) {
                    if ($this->record->konten()->exists()) {
                        \Filament\Notifications\Notification::make()
                            ->danger()
                            ->title('Tidak bisa dihapus!')
                            ->body('Kategori masih memiliki konten. Hapus semua konten terlebih dahulu.')
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
