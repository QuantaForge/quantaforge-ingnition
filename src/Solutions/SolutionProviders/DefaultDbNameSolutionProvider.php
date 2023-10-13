<?php

namespace QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionProviders;

use QuantaQuirk\Database\QueryException;
use QuantaQuirk\Ignition\Contracts\HasSolutionsForThrowable;
use QuantaQuirk\QuantaQuirkIgnition\Solutions\SuggestUsingCorrectDbNameSolution;
use Throwable;

class DefaultDbNameSolutionProvider implements HasSolutionsForThrowable
{
    const MYSQL_UNKNOWN_DATABASE_CODE = 1049;

    public function canSolve(Throwable $throwable): bool
    {
        if (! $throwable instanceof QueryException) {
            return false;
        }

        if ($throwable->getCode() !== self::MYSQL_UNKNOWN_DATABASE_CODE) {
            return false;
        }

        if (! in_array(env('DB_DATABASE'), ['homestead', 'quantaquirk'])) {
            return false;
        }

        return true;
    }

    public function getSolutions(Throwable $throwable): array
    {
        return [new SuggestUsingCorrectDbNameSolution()];
    }
}
