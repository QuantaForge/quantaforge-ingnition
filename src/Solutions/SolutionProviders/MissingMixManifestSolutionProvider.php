<?php


namespace QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionProviders;

use QuantaQuirk\Support\Str;
use QuantaQuirk\Ignition\Contracts\BaseSolution;
use QuantaQuirk\Ignition\Contracts\HasSolutionsForThrowable;
use Throwable;

class MissingMixManifestSolutionProvider implements HasSolutionsForThrowable
{
    public function canSolve(Throwable $throwable): bool
    {
        return Str::startsWith($throwable->getMessage(), 'Mix manifest not found');
    }

    public function getSolutions(Throwable $throwable): array
    {
        return [
            BaseSolution::create('Missing Mix Manifest File')
                ->setSolutionDescription('Did you forget to run `npm install && npm run dev`?'),
        ];
    }
}
