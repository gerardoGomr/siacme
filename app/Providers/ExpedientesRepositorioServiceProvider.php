<?php

namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Infraestructura\Expedientes\ExpedientesRepositorioLaravelMySQL;

class ExpedientesRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Infraestructura\Expedientes\ExpedientesRepositorioInterface', function() {
            return new ExpedientesRepositorioLaravelMySQL();
        });
    }
}
