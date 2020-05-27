<?php

namespace App\Providers;

use App\Stat;
use App\Observers\StatObserver;
use Esemve\Hook\Facades\Hook;
use Esemve\Hook\HookServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{


    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->register(MenuServiceProvider::class);

        $this->app->register(HookServiceProvider::class);

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();

        $loader->alias('Hook', Hook::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Stat::observe(StatObserver::class);

    }
}
