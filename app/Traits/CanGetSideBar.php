<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 2020-03-19
 * Time: 03:37
 */

namespace App\Traits;


trait CanGetSideBar
{
    public function getSideBar($class)
    {
        if (class_exists($class))
        {
            return $class;
        }
        else
        {
            return false;
        }
    }
}
