<?php

namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Infraestructura\Pacientes\ComportamientosFranklRepositorioLaravelMySQL;

class ComportamientosFranklRepositorioServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Siacme\Infraestructura\Pacientes\ComportamientosFranklRepositorioInterface', function() {
            return new ComportamientosFranklRepositorioLaravelMySQL();
        });
    }
}
