<?php

namespace App\Filament\Resources\PengaturanWaResource\Pages;

use App\Filament\Resources\PengaturanWaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengaturanWas extends ListRecords
{
    protected static string $resource = PengaturanWaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
