<?php

namespace App\Filament\Resources\PUTProdukResource\Pages;

use App\Filament\Resources\PUTProdukResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePUTProduk extends CreateRecord
{
    protected static string $resource = PUTProdukResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        unset($data['unit_put_id']);
        $data['users_id'] = Auth::id();
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
