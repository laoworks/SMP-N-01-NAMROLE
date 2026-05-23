<?php

namespace App\Filament\Resources\PengaturanWebsiteResource\Pages\Components;

use Filament\Forms\Components\FileUpload;

class CustomFileUpload extends FileUpload
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->afterStateUpdated(function () {
            // Trigger refresh setelah upload
            $this->dispatch('refresh-page');
        });
    }
}
