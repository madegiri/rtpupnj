<?php

namespace App\Filament\Resources\KategoriProdukPekanInovasiResource\Pages;

use App\Filament\Resources\KategoriProdukPekanInovasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKategoriProdukPekanInovasi extends EditRecord
{
    protected static string $resource = KategoriProdukPekanInovasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function ($action) {
                    $adaProduk = $this->record->produkPekanInovasi()->exists();

                    if ($adaProduk) {
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
