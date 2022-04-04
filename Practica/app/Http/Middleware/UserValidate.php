<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $request->validate([
            'name' => 'required|string|alpha_num',
            'email' => 'required|string|email',
            'password' => 'required|string|min:5',
            'password_verify' => 'required|same:password'
        ]);

        return $next($request);
    }
}
