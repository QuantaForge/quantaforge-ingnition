<?php

namespace QuantaQuirk\QuantaQuirkIgnition\FlareMiddleware;

use Closure;
use QuantaQuirk\FlareClient\FlareMiddleware\FlareMiddleware;
use QuantaQuirk\FlareClient\Report;

class AddEnvironmentInformation implements FlareMiddleware
{
    public function handle(Report $report, Closure $next)
    {
        $report->frameworkVersion(app()->version());

        $report->group('env', [
            'quantaquirk_version' => app()->version(),
            'quantaquirk_locale' => app()->getLocale(),
            'quantaquirk_config_cached' => app()->configurationIsCached(),
            'app_debug' => config('app.debug'),
            'app_env' => config('app.env'),
            'php_version' => phpversion(),
        ]);

        return $next($report);
    }
}
