<?php

namespace QuantaQuirk\QuantaQuirkIgnition\Facades;

use QuantaQuirk\Support\Facades\Facade;
use QuantaQuirk\QuantaQuirkIgnition\Support\SentReports;

/**
 * @method static void glow(string $name, string $messageLevel = \QuantaQuirk\FlareClient\Enums\MessageLevels::INFO, array $metaData = [])
 * @method static void context($key, $value)
 * @method static void group(string $groupName, array $properties)
 *
 * @see \QuantaQuirk\FlareClient\Flare
 */
class Flare extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \QuantaQuirk\FlareClient\Flare::class;
    }

    public static function sentReports(): SentReports
    {
        return app(SentReports::class);
    }
}
