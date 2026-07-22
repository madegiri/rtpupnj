<?php

namespace App\Filament\Resources\SubKategoriProdukPUTResource\Pages;

use App\Filament\Resources\SubKategoriProdukPUTResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubKategoriProdukPUT extends EditRecord
{
    protected static string $resource = SubKategoriProdukPUTResource::class;

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

    // isi unit_put_id (virtual) dari relasi supaya dropdown tidak kosong saat edit
    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['unit_put_id'] = $this->record->kategoriProdukPut->unit_put_id ?? null;
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
