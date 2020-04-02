<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // if (Auth::guard($guard)->check()) {
        //     return redirect(RouteServiceProvider::HOME);
        // }
         
        switch ($guard) {
          case 'pharmacy':
          //dd($guard);
        if(Auth::guard($guard)->check()){
            
          return redirect('/home');
           
          }

          break;

          default:

          if (Auth::guard($guard)->check()) {
            ///  dd($guard);
          return redirect('/home');

          }

          break;

          }



          return $next($request);
    }
}
