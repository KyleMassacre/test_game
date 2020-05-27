<?php

namespace App\Providers;

use App\Http\Middleware\LastAction;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        app('router')->pushMiddlewareToGroup('auth', LastAction::class);

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapAdminRoutes();

        $this->mapPublicRoutes();

        $this->mapGameRoutes();

    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }

    protected function mapGameRoutes() {
        Route::middleware(['web', 'auth', 'game'])
            ->namespace($this->namespace)
            ->group(base_path('routes/game.php'));
    }

    protected function mapAdminRoutes() {
        Route::prefix('admin')
            ->namespace($this->namespace)
            ->middleware(['web', 'auth', 'is_staff'])
            ->group(base_path('routes/admin.php'));
    }


    protected function mapPublicRoutes()
    {
        Route::middleware(['web'])
            ->namespace($this->namespace)
            ->group(base_path('routes/public.php'));
    }
}
