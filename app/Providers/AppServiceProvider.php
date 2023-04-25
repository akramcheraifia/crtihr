<?php

namespace App\Providers;

use App\Filament\Resources\UserResource\Pages\CreateUser;
use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Filament::serving(function () {
            // Using Vite
            Filament::registerViteTheme('resources/css/filament.css');
            Filament::registerUserMenuItems([
                'Account' => UserMenuItem::make()->url(route('filament.resources.users.index'))->label('Mon compte')->icon('heroicon-o-user-circle'),
            ]);
        });
        Filament::registerNavigationGroups([
            'Gestion des fonctionnaires',
            'Structure',
            'Settings',
        ]);
    }
}
