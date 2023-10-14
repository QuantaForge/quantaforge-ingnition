<?php

namespace QuantaForge\QuantaForgeIgnition\Http\Middleware;

use Closure;
use QuantaForge\QuantaForgeIgnition\Support\RunnableSolutionsGuard;

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
