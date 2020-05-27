<?php
/**
 * Created by PhpStorm.
 * User: kyle
 * Date: 2020-03-15
 * Time: 09:28
 */

if(!function_exists('formatMoney'))
{
    function formatMoney(\App\Stat $stat)
    {
        if(\File::exists(Theme::url('images/money.png')))
        {
            return Theme::img('images/money.png', 'money.png', null, ['height' => '10px', 'width' => '10px']) . number_format($stat->pivot->value, 0);
        }
        else
        {
            return number_format($stat->pivot->value, 0);
        }

    }
}

if(!function_exists('progressBar'))
{
    function progressBar(\App\Stat $stat)
    {
        return '
            <div class="progress position-relative">
                <div class="progress-bar" role="progressbar" style="width: '. $stat->percentage .'%" aria-valuenow="'. $stat->percentage .'" aria-valuemin="0" aria-valuemax="100"></div>
                <small class="justify-content-center d-flex position-absolute w-100">'.$stat->name . $stat->percentage .'%</small>
            </div>';
    }
}
