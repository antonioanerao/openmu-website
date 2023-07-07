<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyCharacterAccountOwner
{
    /**
     * Abort the request and returns an error 404 if an account try to view a
     * character that belongs to another account.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(!in_array(request()->route()->parameters()['character']['Id'], auth()->user()->characters->pluck('Id')->toArray())) {
            abort(404);
        }

        return $next($request);
    }
}
