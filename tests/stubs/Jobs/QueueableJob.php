<?php

namespace QuantaForge\QuantaForgeIgnition\Tests\stubs\Jobs;

use Carbon\CarbonImmutable;
use Exception;
use QuantaForge\Bus\Queueable;
use QuantaForge\Contracts\Queue\ShouldQueue;
use QuantaForge\Foundation\Bus\Dispatchable;
use QuantaForge\Queue\InteractsWithQueue;
use QuantaForge\Queue\SerializesModels;

class QueueableJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private array $property;

    private string $uninitializedProperty;

    public function __construct(
        array $property,
        ?CarbonImmutable $retryUntilValue = null,
        ?int $tries = null,
        ?int $maxExceptions = null,
        ?int $timeout = null
    ) {
        $this->property = $property;
        $this->retryUntilValue = $retryUntilValue;
        $this->tries = $tries;
        $this->maxExceptions = $maxExceptions;
        $this->timeout = $timeout;
    }

    public function handle(): void
    {
        throw new Exception("Die");
    }

    public function retryUntil()
    {
        return $this->retryUntilValue;
    }
}
