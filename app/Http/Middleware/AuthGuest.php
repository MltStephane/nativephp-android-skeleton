<?php

namespace App\Http\Middleware;

use App\Services\AuthenticationService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthGuest
{
    public function handle(Request $request, Closure $next): Response
    {
        if (AuthenticationService::isLoggedIn()) {
            return redirect()->route('homepage');
        }

        return $next($request);
    }
}
