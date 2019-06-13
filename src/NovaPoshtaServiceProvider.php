<?php

namespace Grafline\NovaPoshta;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;


class NovaPoshtaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/nova-poshta.php', 'nova_poshta');
        $this->publishes([__DIR__.'/../config' => base_path('config')]);
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
       //
    }
}