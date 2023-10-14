<?php

namespace QuantaForge\QuantaForgeIgnition\Solutions\SolutionProviders;

use RuntimeException;
use QuantaForge\Ignition\Contracts\HasSolutionsForThrowable;
use QuantaForge\QuantaForgeIgnition\Solutions\GenerateAppKeySolution;
use Throwable;

class MissingAppKeySolutionProvider implements HasSolutionsForThrowable
{
    public function canSolve(Throwable $throwable): bool
    {
        if (! $throwable instanceof RuntimeException) {
            return false;
        }

        return $throwable->getMessage() === 'No application encryption key has been specified.';
    }

    public function getSolutions(Throwable $throwable): array
    {
        return [new GenerateAppKeySolution()];
    }
}
