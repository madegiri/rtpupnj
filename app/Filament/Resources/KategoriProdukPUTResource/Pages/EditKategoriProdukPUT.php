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
                    $adaProduk = $this->record->subKategori()
                        ->whereHas('putProduk')
                        ->exists();

                    if ($adaProduk) {
                        \Filament\Notifications\Notification::make()
                            ->danger()
                            ->title('Tidak bisa dihapus!')
                            ->body('Kategori masih memiliki produk di dalam sub kategorinya. Hapus semua produk terlebih dahulu.')
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
