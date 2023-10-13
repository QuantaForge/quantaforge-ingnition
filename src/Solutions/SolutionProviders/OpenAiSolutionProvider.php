<?php

namespace QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionProviders;

use QuantaQuirk\Support\Str;
use OpenAI\Client;
use QuantaQuirk\Ignition\Contracts\HasSolutionsForThrowable;
use QuantaQuirk\Ignition\Solutions\OpenAi\OpenAiSolutionProvider as BaseOpenAiSolutionProvider;
use Throwable;

class OpenAiSolutionProvider implements HasSolutionsForThrowable
{
    public function canSolve(Throwable $throwable): bool
    {
        if (! class_exists(Client::class)) {
            return false;
        }

        if (config('ignition.open_ai_key') === null) {
            return false;
        }

        return true;
    }

    public function getSolutions(Throwable $throwable): array
    {
        $solutionProvider = new BaseOpenAiSolutionProvider(
            openAiKey: config('ignition.open_ai_key'),
            cache: cache()->store(config('cache.default')),
            cacheTtlInSeconds: 60,
            applicationType: 'QuantaQuirk ' . Str::before(app()->version(), '.'),
            applicationPath: base_path(),
        );

        return $solutionProvider->getSolutions($throwable);
    }
}
