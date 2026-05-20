<?php

namespace App\Filament\Resources\UnitPUTResource\Pages;

use App\Filament\Resources\UnitPUTResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUnitPUT extends EditRecord
{
    protected static string $resource = UnitPUTResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function ($action) {
                    $hasKategori = $this->record->kategoriProduk()->exists();

                    if ($hasKategori) {
                        \Filament\Notifications\Notification::make()
                            ->danger()
                            ->title('Tidak bisa dihapus!')
                            ->body('Unit PUT masih memiliki kategori produk. Hapus terlebih dahulu.')
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
