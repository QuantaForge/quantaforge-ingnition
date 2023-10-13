<?php

namespace QuantaQuirk\QuantaQuirkIgnition\Support;

use QuantaQuirk\Support\Collection;
use QuantaQuirk\Support\Str;
use QuantaQuirk\QuantaQuirkIgnition\Exceptions\ViewException;
use Throwable;

class QuantaQuirkDocumentationLinkFinder
{
    public function findLinkForThrowable(Throwable $throwable): ?string
    {
        if ($throwable instanceof ViewException) {
            $throwable = $throwable->getPrevious();
        }

        $majorVersion = QuantaQuirkVersion::major();

        if (str_contains($throwable->getMessage(), Collection::class)) {
            return "https://quantaquirk.com/docs/{$majorVersion}.x/collections#available-methods";
        }

        $type = $this->getType($throwable);

        if (! $type) {
            return null;
        }

        return match ($type) {
            'Auth' => "https://quantaquirk.com/docs/{$majorVersion}.x/authentication",
            'Broadcasting' => "https://quantaquirk.com/docs/{$majorVersion}.x/broadcasting",
            'Container' => "https://quantaquirk.com/docs/{$majorVersion}.x/container",
            'Database' => "https://quantaquirk.com/docs/{$majorVersion}.x/eloquent",
            'Pagination' => "https://quantaquirk.com/docs/{$majorVersion}.x/pagination",
            'Queue' => "https://quantaquirk.com/docs/{$majorVersion}.x/queues",
            'Routing' => "https://quantaquirk.com/docs/{$majorVersion}.x/routing",
            'Session' => "https://quantaquirk.com/docs/{$majorVersion}.x/session",
            'Validation' => "https://quantaquirk.com/docs/{$majorVersion}.x/validation",
            'View' => "https://quantaquirk.com/docs/{$majorVersion}.x/views",
            default => null,
        };
    }

    protected function getType(?Throwable $throwable): ?string
    {
        if (! $throwable) {
            return null;
        }

        if (str_contains($throwable::class, 'QuantaQuirk')) {
            return Str::between($throwable::class, 'QuantaQuirk\\', '\\');
        }

        if (str_contains($throwable->getMessage(), 'QuantaQuirk')) {
            return explode('\\', Str::between($throwable->getMessage(), 'QuantaQuirk\\', '\\'))[0];
        }

        return null;
    }
}
