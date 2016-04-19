<?php

namespace Polevaultweb\LaravelSparkHelpScout;

use Illuminate\Support\ServiceProvider;

class HelpScoutServiceProvider extends ServiceProvider
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
	    $this->app->make('Polevaultweb\LaravelSparkHelpScout\HelpScoutController');
    }
}
