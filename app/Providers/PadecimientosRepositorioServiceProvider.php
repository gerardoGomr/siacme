<?php

namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Infraestructura\Pacientes\PadecimientoOdontopediatriaRepositorioLaravelMySQL;

class PadecimientosRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Infraestructura\Pacientes\PadecimientoRepositorioInterface', function() {
            return new PadecimientoOdontopediatriaRepositorioLaravelMySQL();
        });
    }
}
