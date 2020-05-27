<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 2020-03-28
 * Time: 05:32
 */

namespace App\Sidebar;

use App\Events\BuildingPublicSidebar;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Sidebar;
use Maatwebsite\Sidebar\ShouldCache;
use Maatwebsite\Sidebar\Traits\CacheableTrait;
use Nwidart\Modules\Contracts\RepositoryInterface;

class PublicSidebar implements Sidebar, ShouldCache
{
    use CacheableTrait;

    /**
     * @var Menu
     */
    protected $menu;

    /**
     * @var RepositoryInterface
     */
    protected $modules;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @param CustomMenu                $menu
     * @param RepositoryInterface $modules
     * @param Container           $container
     */
    public function __construct(Menu $menu, RepositoryInterface $modules, Container $container)
    {
        $this->menu = $menu;
        $this->modules = $modules;
        $this->container = $container;
    }



    /**
     * Build your sidebar implementation here
     */
    public function build()
    {
        event($event = new BuildingPublicSidebar($this->menu));

        foreach ($this->modules->allEnabled() as $module) {
            $name = $module->getName();
            $class = 'Modules\\' . $name . '\\Sidebar\\PublicSidebarExtender';
            try {
                $this->addToSidebar($class);
            } catch (BindingResolutionException $e) {
                return;
            }
        }
    }

    /**
     * Add the given class to the sidebar collection
     * @param string $class
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function addToSidebar($class)
    {
        $extender = $this->container->make($class);

        $this->menu->add($extender->extendWith($this->menu));
    }

    /**
     * @return Menu
     */
    public function getMenu()
    {
        $this->build();
        return $this->menu;
    }
}
