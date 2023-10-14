<?php

namespace QuantaForge\QuantaForgeIgnition\Solutions\SolutionProviders;

use QuantaForge\Database\LazyLoadingViolationException;
use QuantaForge\Ignition\Contracts\BaseSolution;
use QuantaForge\Ignition\Contracts\HasSolutionsForThrowable;
use QuantaForge\QuantaForgeIgnition\Support\QuantaForgeVersion;
use Throwable;

class LazyLoadingViolationSolutionProvider implements HasSolutionsForThrowable
{
    public function canSolve(Throwable $throwable): bool
    {
        if ($throwable instanceof LazyLoadingViolationException) {
            return true;
        }

        if (! $previous = $throwable->getPrevious()) {
            return false;
        }

        return $previous instanceof LazyLoadingViolationException;
    }

    public function getSolutions(Throwable $throwable): array
    {
        $majorVersion = QuantaForgeVersion::major();

        return [BaseSolution::create(
            'Lazy loading was disabled to detect N+1 problems'
        )
            ->setSolutionDescription(
                'Either avoid lazy loading the relation or allow lazy loading.'
            )
            ->setDocumentationLinks([
                'Read the docs on preventing lazy loading' => "https://quantaforge.com/docs/{$majorVersion}.x/eloquent-relationships#preventing-lazy-loading",
                'Watch a video on how to deal with the N+1 problem' => 'https://www.youtube.com/watch?v=ZE7KBeraVpc',
            ]),];
    }
}
