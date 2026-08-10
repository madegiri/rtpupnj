<?php

namespace App\Filament\Resources\ProdukPekanInovasiResource\Pages;

use App\Filament\Resources\ProdukPekanInovasiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateProdukPekanInovasi extends CreateRecord
{
    protected static string $resource = ProdukPekanInovasiResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        unset($data['profil_pekan_inovasi_id']);
        $data['users_id'] = Auth::id();
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
