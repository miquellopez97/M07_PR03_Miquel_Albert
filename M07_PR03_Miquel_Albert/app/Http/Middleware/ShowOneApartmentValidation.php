<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Apartment;

class ShowOneApartmentValidation
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
        $validator = Validator::make($request->route()->parameters(), ['apartment' => 'required|numeric']);
        if ($validator->fails()) {
            $apartments = Apartment::where('city', $request->route()->parameters()['apartment'])->get();
            if (count($apartments) > 0) {
                return $next($request);
            } else {
                return response()->json('Error introduce un numero o una ciudad valida', 400);
            }
        } else {
            return $next($request);
        }
    }
}
