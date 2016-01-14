<?php

namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Usuarios\MedicosRepositorioMySQL;

class MedicosRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Usuarios\UsuariosRepositorioInterface', function() {
            return new MedicosRepositorioMySQL();
        });
    }
}
