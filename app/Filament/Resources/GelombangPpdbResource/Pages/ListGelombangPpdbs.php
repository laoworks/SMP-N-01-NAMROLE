<?php

namespace App\Filament\Resources\GelombangPpdbResource\Pages;

use App\Filament\Resources\GelombangPpdbResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGelombangPpdbs extends ListRecords
{
    protected static string $resource = GelombangPpdbResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
