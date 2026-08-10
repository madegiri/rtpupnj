<?php

namespace App\Filament\Resources\ProfilPekanInovasiResource\Pages;

use App\Filament\Resources\ProfilPekanInovasiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProfilPekanInovasi extends EditRecord
{
    protected static string $resource = ProfilPekanInovasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function ($action) {
                    $hasKategori = $this->record->kategoriProdukPekanInovasi()->exists();

                    if ($hasKategori) {
                        \Filament\Notifications\Notification::make()
                            ->danger()
                            ->title('Tidak bisa dihapus!')
                            ->body('Pekan inovasi masih memiliki kategori produk. Hapus terlebih dahulu.')
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
