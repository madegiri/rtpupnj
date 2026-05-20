<?php

namespace App\Filament\Resources\LombaResource\Pages;

use App\Filament\Resources\LombaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateLomba extends CreateRecord
{
    protected static string $resource = LombaResource::class;

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
