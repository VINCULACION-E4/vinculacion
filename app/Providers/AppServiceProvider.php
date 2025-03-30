<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

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
        // View Composer para todos los views
        View::composer('*', function ($view) {
            // Detectamos si el guard es 'vinculacion' o 'usuarios_alumno'
            if (Auth::guard('vinculacion')->check()) {
                $view->with('authUser', Auth::guard('vinculacion')->user());
            } elseif (Auth::guard('usuarios_alumno')->check()) {
                $view->with('authUser', Auth::guard('usuarios_alumno')->user());
            }
        });
    }
}
