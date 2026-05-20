<?php

namespace App\Filament\Resources\KategoriProdukPUTResource\Pages;

use App\Filament\Resources\KategoriProdukPUTResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriProdukPUT extends EditRecord
{
    protected static string $resource = KategoriProdukPUTResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function ($action) {
                    if ($this->record->putProduk()->exists()) {
                        \Filament\Notifications\Notification::make()
                            ->danger()
                            ->title('Tidak bisa dihapus!')
                            ->body('Kategori masih memiliki produk. Hapus semua produk terlebih dahulu.')
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
