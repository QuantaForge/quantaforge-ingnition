<?php

namespace QuantaForge\QuantaForgeIgnition\FlareMiddleware;

use Closure;
use QuantaForge\FlareClient\FlareMiddleware\FlareMiddleware;
use QuantaForge\FlareClient\Report;
use QuantaForge\QuantaForgeIgnition\Recorders\DumpRecorder\DumpRecorder;

class AddDumps implements FlareMiddleware
{
    protected DumpRecorder $dumpRecorder;

    public function __construct()
    {
        $this->dumpRecorder = app(DumpRecorder::class);
    }

    public function handle(Report $report, Closure $next)
    {
        $report->group('dumps', $this->dumpRecorder->getDumps());

        return $next($report);
    }
}
