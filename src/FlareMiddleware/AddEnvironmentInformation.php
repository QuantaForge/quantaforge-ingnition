<?php

namespace QuantaForge\QuantaForgeIgnition\FlareMiddleware;

use Closure;
use QuantaForge\FlareClient\FlareMiddleware\FlareMiddleware;
use QuantaForge\FlareClient\Report;

class AddEnvironmentInformation implements FlareMiddleware
{
    public function handle(Report $report, Closure $next)
    {
        $report->frameworkVersion(app()->version());

        $report->group('env', [
            'quantaforge_version' => app()->version(),
            'quantaforge_locale' => app()->getLocale(),
            'quantaforge_config_cached' => app()->configurationIsCached(),
            'app_debug' => config('app.debug'),
            'app_env' => config('app.env'),
            'php_version' => phpversion(),
        ]);

        return $next($report);
    }
}
