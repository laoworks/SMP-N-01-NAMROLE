<?php

namespace App\Filament\Resources\GelombangPpdbResource\Pages;

use App\Filament\Resources\GelombangPpdbResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGelombangPpdb extends EditRecord
{
    protected static string $resource = GelombangPpdbResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
