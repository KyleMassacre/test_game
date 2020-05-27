<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 2020-03-28
 * Time: 06:45
 */

namespace App\Composers;


use App\Sidebar\GameSidebar;
use Maatwebsite\Sidebar\Presentation\SidebarRenderer;

class GameSideBarViewCreator
{
    /**
     * @var GameSidebar
     */
    protected $gameSidebar;

    /**
     * @var SidebarRenderer
     */
    protected $renderer;

    /**
     * @param GameSidebar $gameSidebar
     * @param SidebarRenderer $renderer
     */
    public function __construct(GameSidebar $gameSidebar, SidebarRenderer $renderer)
    {
        $this->gameSidebar = $gameSidebar;
        $this->renderer = $renderer;
    }

    public function create($view)
    {
        $view->gameSidebar = $this->renderer->render($this->gameSidebar);
    }
}
