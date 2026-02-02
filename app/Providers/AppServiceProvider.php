<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        // Super-Admin bypass: el rol administrador pasa todas las verificaciones
        // Esto permite que un usuario con rol 'administrador' automáticamente
        // tenga acceso a todas las acciones sin necesidad de verificar permisos
        Gate::before(function ($user, $ability) {
            if ($user->hasRole('administrador')) {
                return true;
            }
            // Retornar null permite que continúe la verificación normal de permisos
            return null;
        });
    }
}
