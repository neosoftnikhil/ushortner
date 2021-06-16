<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

/**
 * Class RepositoryFacadeProvider
 *
 * @package App\Providers
 */
class RepositoryFacadeProvider extends ServiceProvider
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
        $this->app->singleton('user', 'App\Http\Facades\Repository\UserFacadeClass');
	    $this->app->singleton('cancer_type', 'App\Http\Facades\Repository\CancerTypeFacadeClass');
        $this->app->singleton('enquiry', 'App\Http\Facades\Repository\EnquiryFacadeClass');
    }
}
