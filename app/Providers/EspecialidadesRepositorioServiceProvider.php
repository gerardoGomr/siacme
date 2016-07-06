<?php

namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Infraestructura\Usuarios\EspecialidadesRepositorioLaravelMySQL;

class EspecialidadesRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Infraestructura\Usuarios\EspecialidadesRepositorioInterface', function() {
            return new EspecialidadesRepositorioLaravelMySQL();
        });
    }
}
