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
        if ( ! env('HELPSCOUT_APP_ENDPOINT_SECRET' ) ) {
            return;
        }

        if ( ! env('HELPSCOUT_APP_TOKEN' ) ) {
            return;
        }

        include __DIR__ . '/routes.php';
        $this->app->make('Polevaultweb\Laravel\Spark\HelpScout\DynamicAppController');
    }
}
