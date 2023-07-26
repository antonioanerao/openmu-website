<?php

namespace App\Http\Middleware;

use App\Services\AdminPanelService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyServerStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()) {
            if((new AdminPanelService())->getServerStatus()['state'] != 'Online') {
                return back()
                    ->with('alert-danger', 'You can not Reset if Server is Offline');
            };
        }

        return $next($request);
    }
}
