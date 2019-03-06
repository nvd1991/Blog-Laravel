<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
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
        //Middleware/admin.php
        if(Auth::check()){
            $user = Auth::user();
            if($user->is_active && $user->isAdmin()){
                return $next($request);
            }
        }
        //Return error handling page
        return abort(404);
    }
}
