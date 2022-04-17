<?php

namespace App\Http\Middleware;

use App\Models\Apartment;
use Closure;
use Illuminate\Http\Request;

class CheckCreatorUser
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
        $userToken = $request->user()->id;
        $apartment = Apartment::where('id', $request->route()->parameters()['apartment'])->first();
        if ($apartment->user_id == $userToken) {
            return $next($request);
        } else {
            return response()->json('You are not allowed to modify the apartment', 400);
        }
    }
}
