<?php

namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Infraestructura\Expedientes\PlanTratamientoRepositorioLaravelMySQL;

class PlanTratamientoRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Infraestructura\Expedientes\PlanTratamientoRepositorioInterface', function() {
            return new PlanTratamientoRepositorioLaravelMySQL();
        });
    }
}
