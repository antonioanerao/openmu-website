<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyCharacterOnline
{
    /**
     * Abort the request if a player tries to add points or reset while he has
     * an online character
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()) {
            if(auth()->user()->isOnline()) {
                return redirect(route('character.index'))
                    ->with('alert-danger', 'You must logout your character before adding points or reset');
            }
        }

        return $next($request);
    }
}
