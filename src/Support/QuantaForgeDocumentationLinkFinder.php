<?php

namespace QuantaForge\QuantaForgeIgnition\Support;

use QuantaForge\Support\Collection;
use QuantaForge\Support\Str;
use QuantaForge\QuantaForgeIgnition\Exceptions\ViewException;
use Throwable;

class QuantaForgeDocumentationLinkFinder
{
    public function findLinkForThrowable(Throwable $throwable): ?string
    {
        if ($throwable instanceof ViewException) {
            $throwable = $throwable->getPrevious();
        }

        $majorVersion = QuantaForgeVersion::major();

        if (str_contains($throwable->getMessage(), Collection::class)) {
            return "https://quantaforge.com/docs/{$majorVersion}.x/collections#available-methods";
        }

        $type = $this->getType($throwable);

        if (! $type) {
            return null;
        }

        return match ($type) {
            'Auth' => "https://quantaforge.com/docs/{$majorVersion}.x/authentication",
            'Broadcasting' => "https://quantaforge.com/docs/{$majorVersion}.x/broadcasting",
            'Container' => "https://quantaforge.com/docs/{$majorVersion}.x/container",
            'Database' => "https://quantaforge.com/docs/{$majorVersion}.x/eloquent",
            'Pagination' => "https://quantaforge.com/docs/{$majorVersion}.x/pagination",
            'Queue' => "https://quantaforge.com/docs/{$majorVersion}.x/queues",
            'Routing' => "https://quantaforge.com/docs/{$majorVersion}.x/routing",
            'Session' => "https://quantaforge.com/docs/{$majorVersion}.x/session",
            'Validation' => "https://quantaforge.com/docs/{$majorVersion}.x/validation",
            'View' => "https://quantaforge.com/docs/{$majorVersion}.x/views",
            default => null,
        };
    }

    protected function getType(?Throwable $throwable): ?string
    {
        if (! $throwable) {
            return null;
        }

        if (str_contains($throwable::class, 'QuantaForge')) {
            return Str::between($throwable::class, 'QuantaForge\\', '\\');
        }

        if (str_contains($throwable->getMessage(), 'QuantaForge')) {
            return explode('\\', Str::between($throwable->getMessage(), 'QuantaForge\\', '\\'))[0];
        }

        return null;
    }
}
