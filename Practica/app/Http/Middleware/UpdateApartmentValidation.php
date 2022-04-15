<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UpdateApartmentValidation
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
            'address' => 'nullable|string|max:100',
            'city' => 'nullable|string',
            'postal_code' => 'nullable|max:5|min:5',
            'rented_price' => 'nullable|numeric|gt:0', //TODO: Revisar decimales
            'rented' => 'nullable|boolean'
        ]);
        return $next($request);
    }
}
