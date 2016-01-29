<?php

namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Infraestructura\Consultas\DienteTratamientosRepositorioLaravelMySQL;

class DienteTratamientosRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Infraestructura\Consultas\DienteTratamientosRepositorioInterface', function($app) {
           return new DienteTratamientosRepositorioLaravelMySQL();
        });
    }
}
