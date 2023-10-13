<?php

namespace QuantaQuirk\QuantaQuirkIgnition\FlareMiddleware;

use QuantaQuirk\Database\QueryException;
use QuantaQuirk\FlareClient\Contracts\ProvidesFlareContext;
use QuantaQuirk\FlareClient\FlareMiddleware\FlareMiddleware;
use QuantaQuirk\FlareClient\Report;

class AddExceptionInformation implements FlareMiddleware
{
    public function handle(Report $report, $next)
    {
        $throwable = $report->getThrowable();

        $this->addUserDefinedContext($report);

        if (! $throwable instanceof QueryException) {
            return $next($report);
        }

        $report->group('exception', [
            'raw_sql' => $throwable->getSql(),
        ]);

        return $next($report);
    }

    private function addUserDefinedContext(Report $report): void
    {
        $throwable = $report->getThrowable();

        if ($throwable === null) {
            return;
        }

        if ($throwable instanceof ProvidesFlareContext) {
            // ProvidesFlareContext writes directly to context groups and is handled in the flare-client-php package.
            return;
        }

        if (! method_exists($throwable, 'context')) {
            return;
        }

        $context = $throwable->context();

        if (! is_array($context)) {
            return;
        }

        $exceptionContextGroup = [];
        foreach ($context as $key => $value) {
            $exceptionContextGroup[$key] = $value;
        }
        $report->group('exception', $exceptionContextGroup);
    }
}
