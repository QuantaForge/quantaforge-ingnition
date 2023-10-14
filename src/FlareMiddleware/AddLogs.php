<?php

namespace QuantaForge\QuantaForgeIgnition\FlareMiddleware;

use QuantaForge\FlareClient\FlareMiddleware\FlareMiddleware;
use QuantaForge\FlareClient\Report;
use QuantaForge\QuantaForgeIgnition\Recorders\LogRecorder\LogRecorder;

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
