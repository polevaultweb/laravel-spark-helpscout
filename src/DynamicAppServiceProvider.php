<?php

namespace Polevaultweb\Laravel\Spark\HelpScout;

use Illuminate\Support\ServiceProvider;

class DynamicAppServiceProvider extends ServiceProvider
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
	    include __DIR__.'/routes.php';
	    $this->app->make('Polevaultweb\Laravel\Spark\HelpScout\DynamicAppController');
    }
}
