<?php

namespace QuantaQuirk\QuantaQuirkIgnition\Tests\Support\Models;

class Car
{
    public $brand;
    public $color;

    public function __construct($brand, $color)
    {
        $this->brand = $brand;
        $this->color = $color;
    }
}
