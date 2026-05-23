<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Pendaftar;
use App\Models\BeritaPengumuman;
use App\Models\PesanKontak;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $pendaftarBaru = Pendaftar::where('status_verifikasi', 'pending')->count();
        $totalBerita = BeritaPengumuman::count();
        $pesanBaru = PesanKontak::where('is_read', false)->count();

        return [
            Stat::make('Pendaftar Baru', $pendaftarBaru)
                ->description('Menunggu verifikasi')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('warning')
                ->url('/admin/pendaftars'),

            Stat::make('Total Berita', $totalBerita)
                ->description('Terbit')
                ->descriptionIcon('heroicon-m-newspaper')
                ->color('success')
                ->url('/admin/berita-pengumumans'),

            Stat::make('Pesan Masuk', $pesanBaru)
                ->description('Belum dibaca')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('info')
                ->url('/admin/pesan-kontaks'),
        ];
    }
}
