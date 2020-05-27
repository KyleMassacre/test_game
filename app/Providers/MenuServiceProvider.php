<?php

namespace App\Providers;

use App\Composers\DashboardSideBarViewCreator;
use App\Composers\GameSideBarViewCreator;
use App\Composers\PublicSideBarViewCreator;
use App\Events\BuildingAdminSidebar;
use App\Http\Middleware\ResolveSidebars;
use App\Sidebar\DashboardSidebar;
use App\Sidebar\GameSidebar;
use App\Sidebar\PublicSidebar;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use Maatwebsite\Sidebar\SidebarManager;
use Maatwebsite\Sidebar\SidebarServiceProvider;

class MenuServiceProvider extends ServiceProvider
{

    public $menu;
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(SidebarServiceProvider::class);

        $this->app->singleton('core.ingame', function() {
            return $this->isInGame();
        });

        $this->app->singleton('core.indashboard', function() {
            return $this->isInDashboard();
        });
    }

    /**
     * Bootstrap services.
     *
     * @param SidebarManager $manager
     * @return void
     */
    public function boot(SidebarManager $manager)
    {
        app('router')->pushMiddlewareToGroup('web', ResolveSidebars::class);


    }

    private function isInGame()
    {
        return app('auth')->check();
    }

    private function isInDashboard()
    {
        return app(Request::class)->is('admin*');
    }

}
