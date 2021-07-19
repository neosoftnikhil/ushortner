<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ApiRepositoryProvider extends ServiceProvider
{

    protected $defer = false;

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
        $this->app->bind('App\Repositories\Contract\ShortnerInterface','App\Repositories\Eloquent\ShortnerRepository');
    }

    /**
     * provides the application services.
     *
     * @return [Array]
     */
    public function provides()
    {

    }
}
