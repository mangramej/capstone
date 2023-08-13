<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyIfUserIsFullyRegistered
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user()->isAccountFullyRegistered()) {
            return to_route('complete-registration');
        }

        return $next($request);
    }
}
