<?php

namespace QuantaForge\QuantaForgeIgnition\Support;

class QuantaForgeVersion
{
    public static function major(): string
    {
        return explode('.', app()->version())[0];
    }
}
