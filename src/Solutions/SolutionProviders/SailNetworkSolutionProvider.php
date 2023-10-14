<?php

namespace QuantaForge\QuantaForgeIgnition\Solutions\SolutionProviders;

use QuantaForge\Ignition\Contracts\BaseSolution;
use QuantaForge\Ignition\Contracts\HasSolutionsForThrowable;
use Throwable;

class SailNetworkSolutionProvider implements HasSolutionsForThrowable
{
    public function canSolve(Throwable $throwable): bool
    {
        return app()->runningInConsole()
            && str_contains($throwable->getMessage(), 'php_network_getaddresses')
            && file_exists(base_path('vendor/bin/sail'))
            && file_exists(base_path('docker-compose.yml'))
            && env('QUANTAQUIRK_SAIL') === null;
    }

    public function getSolutions(Throwable $throwable): array
    {
        return [
            BaseSolution::create('Network address not found')
                ->setSolutionDescription('Did you mean to use `sail artisan`?')
                ->setDocumentationLinks([
                    'Sail: Executing Artisan Commands' => 'https://quantaforge.com/docs/sail#executing-artisan-commands',
                ]),
        ];
    }
}
