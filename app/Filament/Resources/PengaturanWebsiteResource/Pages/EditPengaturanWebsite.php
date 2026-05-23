<?php

namespace App\Filament\Resources\PengaturanWebsiteResource\Pages;

use App\Filament\Resources\PengaturanWebsiteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Cache;

class EditPengaturanWebsite extends EditRecord
{
    protected static string $resource = PengaturanWebsiteResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->record]);
    }

    protected function afterSave(): void
    {
        // Clear cache setelah save
        Cache::forget('pengaturan_website');
        Cache::forget('pengaturan_website_frontend');

        // Flash message
        \Filament\Notifications\Notification::make()
            ->success()
            ->title('Berhasil disimpan')
            ->body('Pengaturan website telah diperbarui.')
            ->send();

        // Redirect ke halaman yang sama untuk refresh
        $this->redirect($this->getResource()::getUrl('edit', ['record' => $this->record]));
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
