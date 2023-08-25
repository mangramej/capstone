<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserTypeMiddleware
{
    public function handle(Request $request, Closure $next, string $type): Response
    {
        abort_if($request->user()->type->value !== $type, 403);

        return $next($request);
    }
}
