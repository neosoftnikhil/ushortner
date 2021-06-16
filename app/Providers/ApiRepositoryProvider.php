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
        $this->app->bind('App\Repositories\Contract\UserInterface','App\Repositories\Eloquent\UserRepository');
        $this->app->bind('App\Repositories\Contract\CancerTypeInterface','App\Repositories\Eloquent\CancerTypeRepository');
        $this->app->bind('App\Repositories\Contract\EnquiryInterface','App\Repositories\Eloquent\EnquiryRepository');
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
