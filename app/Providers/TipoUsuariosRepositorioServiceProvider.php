<?php

namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Infraestructura\Usuarios\TipoUsuariosRepositorioLaravelMySQL;

class TipoUsuariosRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Infraestructura\Usuarios\TipoUsuariosRepositorio', function() {
            return new TipoUsuariosRepositorioLaravelMySQL();
        });
    }
}
