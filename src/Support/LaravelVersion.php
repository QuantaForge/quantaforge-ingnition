<?php

namespace QuantaQuirk\QuantaQuirkIgnition\Support;

class QuantaQuirkVersion
{
    public static function major(): string
    {
        return explode('.', app()->version())[0];
    }
}
