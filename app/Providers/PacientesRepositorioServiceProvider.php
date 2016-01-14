<?php

namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;
use Siacme\Pacientes\PacientesRepositorioMySQL;

class PacientesRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Pacientes\PacientesRepositorioInterface', function() {
            return new PacientesRepositorioMySQL();
        });
    }
}
