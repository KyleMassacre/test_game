<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 2020-03-28
 * Time: 06:45
 */

namespace App\Composers;


use App\Sidebar\PublicSidebar;
use Maatwebsite\Sidebar\Presentation\SidebarRenderer;

class PublicSideBarViewCreator
{
    /**
     * @var PublicSidebar
     */
    protected $publicSidebar;

    /**
     * @var SidebarRenderer
     */
    protected $renderer;

    /**
     * @param PublicSidebar $publicSidebar
     * @param SidebarRenderer $renderer
     */
    public function __construct(PublicSidebar $publicSidebar, SidebarRenderer $renderer)
    {
        $this->publicSidebar = $publicSidebar;
        $this->renderer = $renderer;
    }

    public function create($view)
    {
        $view->publicSidebar = $this->renderer->render($this->publicSidebar);
    }
}
