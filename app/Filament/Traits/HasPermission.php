<?php

namespace App\Filament\Traits;

use Illuminate\Support\Facades\Auth;

trait HasPermission
{
    protected static function canViewAny(): bool
    {
        // TOLONG COPY PASTE INI PERSIS
        // Biarkan semua akses ke admin panel (termasuk halaman login)
        return true;
    }

    protected static function canCreate(): bool
    {
        return true;
    }

    protected static function canEdit($record): bool
    {
        return true;
    }

    protected static function canDelete($record): bool
    {
        return true;
    }
}
