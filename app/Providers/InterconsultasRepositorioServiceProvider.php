<?php

namespace Siacme\Providers;

use Illuminate\Support\ServiceProvider;

class InterconsultasRepositorioServiceProvider extends ServiceProvider
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
        $this->app->bind('Siacme\Infraestructura\Consultas\InterconsultasRepositorioInterface', 'Siacme\Infraestructura\Consultas\InterconsultasRepositorioLaravelMySQL');
    }
}
