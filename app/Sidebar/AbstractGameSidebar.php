<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 2020-03-28
 * Time: 05:21
 */

namespace App\Sidebar;

use Illuminate\Routing\Route;
use Maatwebsite\Sidebar\Menu;
use App\Events\BuildingGameSidebar;
use Maatwebsite\Sidebar\SidebarExtender;
use Illuminate\Contracts\Auth\Authenticatable as Authentication;

abstract class AbstractGameSidebar implements SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    protected $route;

    public function __construct(Route $route, Authentication $auth = null)
    {
        if($auth)
        {
            $this->auth = $auth;
        }

        $this->route = $route;


    }

    public function handle(BuildingGameSidebar $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * Method used to define your sidebar menu groups and items
     * @param Menu $menu
     * @return Menu
     */
    abstract public function extendWith(Menu $menu);
}
