<?php

namespace App\Http\Middleware;

use App\Composers\DashboardSideBarViewCreator;
use App\Composers\GameSideBarViewCreator;
use App\Composers\PublicSideBarViewCreator;
use App\Sidebar\DashboardSidebar;
use App\Sidebar\GameSidebar;
use App\Sidebar\PublicSidebar;
use Closure;
use Maatwebsite\Sidebar\SidebarManager;

class ResolveSidebars
{
    /**
     * @var SidebarManager
     */
    protected $manager;

    /**
     * @param SidebarManager $manager
     */
    public function __construct(SidebarManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $this->manager->resolve();

        $this->manager->register(GameSidebar::class);
        \View::creator('partials.sidebar.ingame', GameSideBarViewCreator::class);

        $this->manager->register(DashboardSidebar::class);
        \View::creator('partials.sidebar.dashboard', DashboardSideBarViewCreator::class);

        $this->manager->register(PublicSidebar::class);
        \View::creator('partials.sidebar.public', PublicSideBarViewCreator::class);



        return $next($request);
    }
}
