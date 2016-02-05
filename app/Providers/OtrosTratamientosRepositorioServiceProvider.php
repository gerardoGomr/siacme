<?php

namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Infraestructura\Consultas\OtrosTratamientosRepositorioLaravelMySQL;

class OtrosTratamientosRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Infraestructura\Consultas\OtrosTratamientosRepositorioInterface', function($app){
            return new OtrosTratamientosRepositorioLaravelMySQL();
        });
    }
}
