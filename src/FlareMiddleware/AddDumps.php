<?php

namespace QuantaQuirk\QuantaQuirkIgnition\FlareMiddleware;

use Closure;
use QuantaQuirk\FlareClient\FlareMiddleware\FlareMiddleware;
use QuantaQuirk\FlareClient\Report;
use QuantaQuirk\QuantaQuirkIgnition\Recorders\DumpRecorder\DumpRecorder;

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
