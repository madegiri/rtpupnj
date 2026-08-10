<?php

namespace App\Filament\Resources\ProdukPekanInovasiResource\Pages;

use App\Filament\Resources\ProdukPekanInovasiResource;
use App\Models\KategoriProdukPekanInovasi;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Auth;

class EditProdukPekanInovasi extends EditRecord
{
    protected static string $resource = ProdukPekanInovasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {

        $kategori = KategoriProdukPekanInovasi::find($data['kategori_produk_pekan_inovasi_id'] ?? null);
        $data['profil_pekan_inovasi_id'] = $kategori?->profil_pekan_inovasi_id;
        return $data;

    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        unset($data['profil_pekan_inovasi_id']);

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
