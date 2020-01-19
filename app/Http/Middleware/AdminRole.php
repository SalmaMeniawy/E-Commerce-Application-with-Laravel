<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class AdminRole
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
        
       $user = Auth::user();
        if($user->role != 'admin'){
            return redirect()->route('home')->withMessage('Access Denied');
        }
       
        return $next($request);
    }
}
