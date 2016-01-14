<?php

namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Usuarios\EspecialidadesRepositorioMySQL;

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
        $this->app->bind('Siacme\Usuarios\EspecialidadesRepositorioInterface', function() {
            return new EspecialidadesRepositorioMySQL();
        });
    }
}
