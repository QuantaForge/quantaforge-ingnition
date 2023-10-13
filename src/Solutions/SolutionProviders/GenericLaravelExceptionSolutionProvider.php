<?php

namespace QuantaQuirk\QuantaQuirkIgnition\Solutions\SolutionProviders;

use QuantaQuirk\Broadcasting\BroadcastException;
use QuantaQuirk\Ignition\Contracts\BaseSolution;
use QuantaQuirk\Ignition\Contracts\HasSolutionsForThrowable;
use QuantaQuirk\QuantaQuirkIgnition\Support\QuantaQuirkVersion;
use Throwable;

class GenericQuantaQuirkExceptionSolutionProvider implements HasSolutionsForThrowable
{
    public function canSolve(Throwable $throwable): bool
    {
        return ! is_null($this->getSolutionTexts($throwable));
    }

    public function getSolutions(Throwable $throwable): array
    {
        if (! $texts = $this->getSolutionTexts($throwable)) {
            return [];
        }

        $solution = BaseSolution::create($texts['title'])
            ->setSolutionDescription($texts['description'])
            ->setDocumentationLinks($texts['links']);

        return ([$solution]);
    }

    /**
     * @param \Throwable $throwable
     *
     * @return array<string, mixed>|null
     */
    protected function getSolutionTexts(Throwable $throwable) : ?array
    {
        foreach ($this->getSupportedExceptions() as $supportedClass => $texts) {
            if ($throwable instanceof $supportedClass) {
                return $texts;
            }
        }

        return null;
    }

    /** @return array<string, mixed> */
    protected function getSupportedExceptions(): array
    {
        $majorVersion = QuantaQuirkVersion::major();

        return
        [
            BroadcastException::class => [
                'title' => 'Here are some links that might help solve this problem',
                'description' => '',
                'links' => [
                    'QuantaQuirk docs on authentication' => "https://quantaquirk.com/docs/{$majorVersion}.x/authentication",
                ],
            ],
        ];
    }
}
