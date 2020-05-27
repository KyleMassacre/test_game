<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 2020-03-28
 * Time: 06:45
 */

namespace App\Composers;


use App\Sidebar\DashboardSidebar;
use Maatwebsite\Sidebar\Presentation\SidebarRenderer;

class DashboardSideBarViewCreator
{
    /**
     * @var DashboardSidebar dashBoardSidebar
     */
    protected $dashBoardSidebar;

    /**
     * @var SidebarRenderer renderer
     */
    protected $renderer;

    /**
     * @param DashboardSidebar $dashBoardSidebar
     * @param SidebarRenderer $renderer
     */
    public function __construct(DashboardSidebar $dashBoardSidebar, SidebarRenderer $renderer)
    {
        $this->dashBoardSidebar = $dashBoardSidebar;
        $this->renderer = $renderer;
    }

    public function create($view)
    {
        $view->dashBoardSidebar = $this->renderer->render($this->dashBoardSidebar);
    }
}
