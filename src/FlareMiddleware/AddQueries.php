<?php

namespace QuantaForge\QuantaForgeIgnition\FlareMiddleware;

use QuantaForge\FlareClient\Report;
use QuantaForge\QuantaForgeIgnition\Recorders\QueryRecorder\QueryRecorder;

class AddQueries
{
    protected QueryRecorder $queryRecorder;

    public function __construct()
    {
        $this->queryRecorder = app(QueryRecorder::class);
    }

    public function handle(Report $report, $next)
    {
        $report->group('queries', $this->queryRecorder->getQueries());

        return $next($report);
    }
}
