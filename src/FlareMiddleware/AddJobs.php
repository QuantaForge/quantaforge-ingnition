<?php

namespace QuantaForge\QuantaForgeIgnition\FlareMiddleware;

use QuantaForge\FlareClient\FlareMiddleware\FlareMiddleware;
use QuantaForge\FlareClient\Report;
use QuantaForge\QuantaForgeIgnition\Recorders\JobRecorder\JobRecorder;

class AddJobs implements FlareMiddleware
{
    protected JobRecorder $jobRecorder;

    public function __construct()
    {
        $this->jobRecorder = app(JobRecorder::class);
    }

    public function handle(Report $report, $next)
    {
        if ($job = $this->jobRecorder->getJob()) {
            $report->group('job', $job);
        }

        return $next($report);
    }
}
