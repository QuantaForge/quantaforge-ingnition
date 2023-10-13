<?php

namespace QuantaQuirk\QuantaQuirkIgnition\FlareMiddleware;

use QuantaQuirk\FlareClient\FlareMiddleware\FlareMiddleware;
use QuantaQuirk\FlareClient\Report;

class AddNotifierName implements FlareMiddleware
{
    public const NOTIFIER_NAME = 'QuantaQuirk Client';

    public function handle(Report $report, $next)
    {
        $report->notifierName(static::NOTIFIER_NAME);

        return $next($report);
    }
}
