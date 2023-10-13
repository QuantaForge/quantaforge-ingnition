<?php

namespace QuantaQuirk\QuantaQuirkIgnition\FlareMiddleware;

use QuantaQuirk\FlareClient\FlareMiddleware\FlareMiddleware;
use QuantaQuirk\FlareClient\Report;
use QuantaQuirk\QuantaQuirkIgnition\Recorders\LogRecorder\LogRecorder;

class AddLogs implements FlareMiddleware
{
    protected LogRecorder $logRecorder;

    public function __construct()
    {
        $this->logRecorder = app(LogRecorder::class);
    }

    public function handle(Report $report, $next)
    {
        $report->group('logs', $this->logRecorder->getLogMessages());

        return $next($report);
    }
}
