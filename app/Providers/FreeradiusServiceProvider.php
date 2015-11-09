<?php

namespace freeradius\Providers;

use Illuminate\Support\ServiceProvider;
use freeradius\Freeradius;

class FreeradiusServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(Freeradius::class);
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
