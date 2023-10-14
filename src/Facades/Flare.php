<?php

namespace QuantaForge\QuantaForgeIgnition\Facades;

use QuantaForge\Support\Facades\Facade;
use QuantaForge\QuantaForgeIgnition\Support\SentReports;

/**
 * @method static void glow(string $name, string $messageLevel = \QuantaForge\FlareClient\Enums\MessageLevels::INFO, array $metaData = [])
 * @method static void context($key, $value)
 * @method static void group(string $groupName, array $properties)
 *
 * @see \QuantaForge\FlareClient\Flare
 */
class Flare extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \QuantaForge\FlareClient\Flare::class;
    }

    public static function sentReports(): SentReports
    {
        return app(SentReports::class);
    }
}
