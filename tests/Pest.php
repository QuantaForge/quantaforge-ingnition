<?php

use Dotenv\Dotenv;
use QuantaQuirk\QuantaQuirkIgnition\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

if (file_exists(__DIR__ . '/../.env')) {
    $dotEnv = Dotenv::createImmutable(__DIR__ . '/..');

    $dotEnv->load();
}

function canRunOpenAiTest(): bool
{
    if (empty(env('OPEN_API_KEY'))) {
        return false;
    }

    return true;
}
