<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Carbon;

class CanAccessStaffPanel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(auth()->check())
        {
            $user = auth()->user();
            if($user->hasAnyRole(config('core.staff_roles')))
            {
                return $next($request);
            }
            else
            {
                return redirect()->back();
            }

        }
        else
        {
            return redirect('login');
        }
    }
}
