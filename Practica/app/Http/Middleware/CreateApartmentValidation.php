<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CreateApartmentValidation
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
            'address' => 'required|string|max:100',
            'city' => 'required|string',
            'postal_code' => 'required|max:5|min:5',
            'rented_price' => 'nullable|numeric|gt:0', //TODO: Revisar decimales
            'rented' => 'required|boolean'
        ]);
        return $next($request);
    }
}
