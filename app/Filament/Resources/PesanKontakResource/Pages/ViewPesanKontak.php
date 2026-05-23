<?php

namespace App\Filament\Resources\PesanKontakResource\Pages;

use App\Filament\Resources\PesanKontakResource;
use Filament\Resources\Pages\ViewRecord;

class ViewPesanKontak extends ViewRecord
{
    protected static string $resource = PesanKontakResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\EditAction::make(),
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
