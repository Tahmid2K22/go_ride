<?php

namespace App\Filament;

use App\Filament\Resources\RiderApplicationResource;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Blade;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('admin')
            ->path('admin')
            ->login()
            ->registration(false)
            ->passwordReset()
            ->colors([
                'primary' => Color::Indigo,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->pages([
                \Filament\Pages\Dashboard::class,
            ])
            ->resources([
                RiderApplicationResource::class,
            ])
            ->widgets([
                \App\Filament\Widgets\ApplicationsOverview::class,
            ])
            ->middleware([
                'web',
                'auth',
            ])
            ->authMiddleware([
                'web',
                'auth',
            ])
            ->databaseNotifications()
            ->spa();
    }
}