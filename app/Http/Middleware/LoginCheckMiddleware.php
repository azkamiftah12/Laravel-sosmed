<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginCheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the cookie exists
        if (!$request->hasCookie('username')) {
            return redirect('/login')->withErrors(['login' => 'Login to proceed']);
        }
        // Get the role
    $rolecookies = $request->cookies->get('nama_role');



    // Check if the user's nama_role is "admin"
    if ($rolecookies === 'admin') {
        return $next($request);
    }
            return redirect('/login')->withErrors(['login' => 'you are unauthorized']);
        // if(!Auth::guard('userlogin')->check()) {
        //     Session::flash('alert', 'error|Please login!');
        //     return redirect()->route('loginpage');
        // }
        // return $next($request);
    }
}
