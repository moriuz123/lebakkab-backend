<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Navigation\NavigationItem;


class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $panel
            ->default()
            ->id('admin')
            ->brandName('Lebakkab.go.id')
            ->navigationItems([
                NavigationItem::make('Lihat Website')
                    // ->url(url('/')) ganti sementara oleh:
                    ->url(url('http://localhost:5173/'))
                    ->icon('heroicon-o-eye')
                    ->openUrlInNewTab()
                    ->group(null) // biar tampil di top bar, bukan sidebar
                    ->sort(-1), // tampil di sebelah kanan logo
            ])
            ->path('admin')
            ->login()
            ->navigationGroups([
                'Data Master',
                'Kelola Konten',
                'Manajemen Situs',
            ])
            ->colors([
                'primary' => [
                    50 => '#e8f0fb',
                    100 => '#d1e1f7',
                    200 => '#a3c4f0',
                    300 => '#75a6e8',
                    400 => '#4789e1',
                    500 => '#1e5ca8', // SPBE Blue
                    600 => '#184a86',
                    700 => '#123765',
                    800 => '#0a2463', // SPBE Navy
                    900 => '#071840',
                    950 => '#040c20',
                ],
                'secondary' => [
                    50 => '#fffbeb',
                    100 => '#fef3c7',
                    200 => '#fde68a',
                    300 => '#fcd34d',
                    400 => '#fbbf24',
                    500 => '#e8a020', // SPBE Gold
                    600 => '#d99015',
                    700 => '#b45309',
                    800 => '#92400e',
                    900 => '#78350f',
                    950 => '#451a03',
                ],
                'danger' => Color::Rose,
                'gray' => Color::Slate,
                'info' => Color::Blue,
                'success' => Color::Emerald,
                'warning' => [
                    50 => '#fffbeb',
                    100 => '#fef3c7',
                    200 => '#fde68a',
                    300 => '#fcd34d',
                    400 => '#fbbf24',
                    500 => '#e8a020',
                    600 => '#d99015',
                    700 => '#b45309',
                    800 => '#92400e',
                    900 => '#78350f',
                    950 => '#451a03',
                ],
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                \App\Filament\Pages\Dashboard::class,

            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                // Widgets\AccountWidget::class,
                // Widgets\FilamentInfoWidget::class,

            ])


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
            ->plugins([
                FilamentShieldPlugin::make(),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);

        // Fetch dynamic logo and favicon from database
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $setting = \App\Models\Setting::first();
                if ($setting) {
                    if ($setting->logo) {
                        $panel->brandLogo(\Illuminate\Support\Facades\Storage::disk('s3')->url($setting->logo));
                        $panel->brandLogoHeight('3rem');
                    }
                    if ($setting->favicon) {
                        $panel->favicon(\Illuminate\Support\Facades\Storage::disk('s3')->url($setting->favicon));
                    }
                    if ($setting->site_name) {
                        $panel->brandName($setting->site_name);
                    }
                    if ($setting->login_background) {
                        $bgUrl = \Illuminate\Support\Facades\Storage::disk('s3')->url($setting->login_background);
                        $panel->renderHook(
                            \Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE,
                            fn (): string => '<style>
                                body.fi-body {
                                    background-image: url("' . $bgUrl . '") !important;
                                    background-size: cover !important;
                                    background-position: center !important;
                                    background-repeat: no-repeat !important;
                                }
                                .fi-simple-main-ctn {
                                    background: rgba(255, 255, 255, 0.9) !important;
                                    backdrop-filter: blur(8px) !important;
                                    border-radius: 1rem !important;
                                }
                                .dark .fi-simple-main-ctn {
                                    background: rgba(24, 24, 27, 0.9) !important;
                                }
                            </style>'
                        );
                    }
                }
            }
        } catch (\Exception $e) {
            // Ignore during migrations or when DB is unavailable
        }

        return $panel;
    }
}
