<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->canAccessAdmin()) {
            abort(403, 'You are not authorised to access the administration panel.');
        }

        return $next($request);
    }
}
