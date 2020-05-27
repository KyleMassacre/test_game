<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 2020-03-10
 * Time: 03:57
 */

namespace App\Observers;


use App\Stat;
use App\User;
use Illuminate\Support\Carbon;

class StatObserver
{
    public function created(Stat $stat)
    {
        $users = User::all();

        foreach ($users as $user)
        {
            $user->stats()->save($stat, ['value' => $stat->default, 'max_value' => $stat->default_max_value, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        }
    }
}
