<?php

namespace App\Filament\Resources\TentangRTPUResource\Pages;

use App\Filament\Resources\TentangRTPUResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateTentangRTPU extends CreateRecord
{
    protected static string $resource = TentangRTPUResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['users_id'] = Auth::id();
        return $data;
    }
}
