<?php

namespace App\Filament\Traits;

use Illuminate\Support\Facades\Auth;

trait HasPermission
{
    protected static function canViewAny(): bool
    {
        return auth()->check(); // Ganti jadi ini
    }

    protected static function canCreate(): bool
    {
        return auth()->check();
    }

    protected static function canEdit($record): bool
    {
        return auth()->check();
    }

    protected static function canDelete($record): bool
    {
        return auth()->check();
    }
}
