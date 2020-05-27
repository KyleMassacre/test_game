<?php

namespace App\Providers;

use App\Http\Middleware\LastAction;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

abstract class AbstractRouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        app('router')->pushMiddlewareToGroup('auth', LastAction::class);

        parent::boot();
    }

    protected function map()
    {

    }

    abstract protected function mapApiRoutes();

    abstract protected function mapGameRoutes();

    abstract protected function mapAdminRoutes();

    abstract protected function mapPublicRoutes();
}
