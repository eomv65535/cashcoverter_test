<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckToken
{
    public function handle(Request $request, Closure $next)
    {
        //print_r(Session::all());
        if (!Session::has('token')) {
            return redirect('/login');
        }
        
        return $next($request);
    }
}
