<?php

namespace App\Filament\Resources\SertifikasiResource\Pages;

use App\Filament\Resources\SertifikasiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateSertifikasi extends CreateRecord
{
    protected static string $resource = SertifikasiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTitle(): string
    {
        return 'Create Pelatihan'; 
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['users_id'] = Auth::id();
        return $data;
    }
}
