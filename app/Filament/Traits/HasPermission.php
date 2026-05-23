<?php

namespace App\Filament\Traits;

use Illuminate\Support\Facades\Auth;

trait HasPermission
{
    protected static function canViewAny(): bool
    {
        return Auth::user()?->can('view_' . static::getPermissionBase()) ?? false;
    }

    protected static function canCreate(): bool
    {
        return auth()->user()?->can('create_' . static::getPermissionBase()) ?? false;
    }

    protected static function canEdit($record): bool
    {
        return auth()->user()?->can('edit_' . static::getPermissionBase()) ?? false;
    }

    protected static function canDelete($record): bool
    {
        return auth()->user()?->can('delete_' . static::getPermissionBase()) ?? false;
    }

    protected static function getPermissionBase(): string
    {
        // Hapus kata 'Resource' dari nama class
        $className = class_basename(static::class);
        return strtolower(str_replace('Resource', '', $className));
    }
}
