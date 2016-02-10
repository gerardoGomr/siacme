<?php

namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Infraestructura\Consultas\RecetasRepositorioLaravelMySQL;

class RecetasRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Infraestructura\Consultas\RecetasRepositorioInterface', function($app) {
           return new RecetasRepositorioLaravelMySQL();
        });
    }
}
