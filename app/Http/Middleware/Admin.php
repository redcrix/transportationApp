<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

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
      /*  if (Auth::check() && Auth::user()->role == 1) {
            return redirect()->route('admin');
        }
        elseif (Auth::check() && Auth::user()->role == 2) {
            return redirect()->route('driver');
        }
        elseif (Auth::check() && Auth::user()->role == 3) {
            return $next($request);
        }
        else {
            return redirect()->route('login');
        }
    }
}*/
if(auth()->user()->is_admin == 1){
 return $next($request);
 }
 return redirect(‘home’)->with(‘error’,’You don't have admin access’);
 }
}