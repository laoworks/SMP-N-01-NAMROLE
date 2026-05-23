<?php

namespace App\Filament\Traits;

use Illuminate\Support\Facades\Auth;

trait HasPermission
{
    protected static function canViewAny(): bool
    {
        // Biarkan akses ke halaman login
        if (request()->routeIs('filament.admin.auth.login')) {
            return true;
        }

        // Untuk halaman lain, harus login
        return Auth::check();
    }

    protected static function canCreate(): bool
    {
        return Auth::check();
    }

    protected static function canEdit($record): bool
    {
        return Auth::check();
    }

    protected static function canDelete($record): bool
    {
        return Auth::check();
    }
}
