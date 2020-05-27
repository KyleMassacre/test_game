<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Maatwebsite\Sidebar\SidebarManager;

class LastAction
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param SidebarManager $manager
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->check())
        {
            \Event::dispatch('core.ingame', true);
            $user = User::find(auth()->id());
            $user->last_action = Carbon::now();
            $user->save();
            return $next($request);
        }
        else
        {
            return redirect('login');
        }

    }
}
