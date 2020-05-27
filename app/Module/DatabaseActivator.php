<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 2020-03-14
 * Time: 07:01
 */

namespace App\Module;


use Nwidart\Modules\Contracts\ActivatorInterface;
use Nwidart\Modules\Module as NwidartModule;

class DatabaseActivator implements ActivatorInterface
{

    /**
     * Enables a module
     *
     * @param NwidartModule $module
     */
    public function enable(NwidartModule $module): void
    {
        // TODO: Implement enable() method.
    }

    /**
     * Disables a module
     *
     * @param NwidartModule $module
     */
    public function disable(NwidartModule $module): void
    {
        // TODO: Implement disable() method.
    }

    /**
     * Determine whether the given status same with a module status.
     *
     * @param NwidartModule $module
     * @param bool $status
     *
     * @return bool
     */
    public function hasStatus(NwidartModule $module, bool $status): bool
    {
        // TODO: Implement hasStatus() method.
    }

    /**
     * Set active state for a module.
     *
     * @param NwidartModule $module
     * @param bool $active
     */
    public function setActive(NwidartModule $module, bool $active): void
    {
        // TODO: Implement setActive() method.
    }

    /**
     * Sets a module status by its name
     *
     * @param  string $name
     * @param  bool $active
     */
    public function setActiveByName(string $name, bool $active): void
    {
        // TODO: Implement setActiveByName() method.
    }

    /**
     * Deletes a module activation status
     *
     * @param  NwidartModule $module
     */
    public function delete(NwidartModule $module): void
    {
        // TODO: Implement delete() method.
    }

    /**
     * Deletes any module activation statuses created by this class.
     */
    public function reset(): void
    {
        // TODO: Implement reset() method.
    }
}
