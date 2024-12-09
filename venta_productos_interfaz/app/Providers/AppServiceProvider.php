<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define la ruta principal para tu aplicación.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Bootstrap de las rutas del servicio.
     */
    public function boot(): void
    {
        $this->routes(function () {
            // Registrar rutas web
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            // Registrar rutas API
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));
        });
    }
}
