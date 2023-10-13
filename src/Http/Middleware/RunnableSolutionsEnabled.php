<?php

namespace QuantaQuirk\QuantaQuirkIgnition\Http\Middleware;

use Closure;
use QuantaQuirk\QuantaQuirkIgnition\Support\RunnableSolutionsGuard;

class RunnableSolutionsEnabled
{
    public function handle($request, Closure $next)
    {
        if (! RunnableSolutionsGuard::check()) {
            abort(404);
        }

        return $next($request);
    }
}
