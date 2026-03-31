<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\EditProfile as BaseEditProfile;
class EditProfile extends BaseEditProfile
{
    protected function getRedirectUrl(): string
    {
        return route('filament.admin.pages.dashboard');
    }
}
