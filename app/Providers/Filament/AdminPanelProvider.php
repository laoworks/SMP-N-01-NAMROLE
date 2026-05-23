<?php

namespace App\Providers\Filament;

use App\Models\PengaturanWebsite;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        /*
        |--------------------------------------------------------------------------
        | Cache Website Settings
        |--------------------------------------------------------------------------
        */
        $settings = Cache::remember(
            'website_settings',
            now()->addHours(12),
            fn() => PengaturanWebsite::first()
        );

        /*
        |--------------------------------------------------------------------------
        | Default Values
        |--------------------------------------------------------------------------
        */
        $namaWebsite = $settings?->nama_website
            ?? 'SMP Negeri 1 Namrole';

        $warnaPrimary = $settings?->primary_color
            ?? '#4361ee';

        /*
        |--------------------------------------------------------------------------
        | Logo & Favicon
        |--------------------------------------------------------------------------
        | Menggunakan Storage::url()
        | Tambahkan versi tetap untuk browser cache
        |--------------------------------------------------------------------------
        */
        $logo = null;

        if (!empty($settings?->logo)) {
            $logo = Storage::url($settings->logo) . '?v=1';
        }

        $favicon = null;

        if (!empty($settings?->favicon)) {
            $favicon = Storage::url($settings->favicon) . '?v=1';
        }

        return $panel
            ->default()

            ->id('admin')

            ->path('admin')

            ->login()

            ->colors([
                'primary' => Color::hex($warnaPrimary),
            ])

            /*
            |--------------------------------------------------------------------------
            | Branding
            |--------------------------------------------------------------------------
            */
            ->brandName($namaWebsite)

            ->brandLogo($logo)

            ->brandLogoHeight('3rem')

            ->favicon($favicon)

            /*
            |--------------------------------------------------------------------------
            | Resources
            |--------------------------------------------------------------------------
            */
            ->discoverResources(
                in: app_path('Filament/Resources'),
                for: 'App\\Filament\\Resources'
            )

            /*
            |--------------------------------------------------------------------------
            | Pages
            |--------------------------------------------------------------------------
            */
            ->discoverPages(
                in: app_path('Filament/Pages'),
                for: 'App\\Filament\\Pages'
            )

            ->pages([
                Pages\Dashboard::class,
            ])

            /*
            |--------------------------------------------------------------------------
            | Widgets
            |--------------------------------------------------------------------------
            */
            ->discoverWidgets(
                in: app_path('Filament/Widgets'),
                for: 'App\\Filament\\Widgets'
            )

            ->widgets([
                Widgets\AccountWidget::class,
            ])

            /*
            |--------------------------------------------------------------------------
            | Middleware
            |--------------------------------------------------------------------------
            */
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])

            ->authMiddleware([
                Authenticate::class,
            ])

            /*
            |--------------------------------------------------------------------------
            | Sidebar
            |--------------------------------------------------------------------------
            */
            ->sidebarCollapsibleOnDesktop();
    }
}
