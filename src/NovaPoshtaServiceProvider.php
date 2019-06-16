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
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'nova_poshta');

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/nova-poshta.php', 'nova-poshta');

        $this->publishes([__DIR__ . '/../config/nova-poshta.php' => config_path('nova-poshta.php')], 'config');
        $this->publishes([__DIR__ . '/../resources/views' => resource_path('views/nova_poshta/')], 'views');
        $this->publishes([__DIR__ . '/../public/js/nova_poshta.js' => public_path('js/nova_poshta.js')], 'js');
        $this->publishes([__DIR__ . '/../public/css/nova_poshta.css' => public_path('css/nova_poshta.css')], 'css');

        $this->app->singleton('nova_poshta', function (){
            return new NovaPoshta();
        });
    }
}