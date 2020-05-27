<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 2020-03-28
 * Time: 05:21
 */

namespace App\Sidebar;

use Maatwebsite\Sidebar\Menu;
use App\Events\BuildingAdminSidebar;
use Maatwebsite\Sidebar\SidebarExtender;
use Illuminate\Contracts\Auth\Authenticatable as Authentication;

abstract class AbstractDashboardSidebar implements SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingAdminSidebar $sidebar)
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
