<?php

namespace QuantaQuirk\QuantaQuirkIgnition\Tests\TestClasses;

use QuantaQuirk\Ignition\Contracts\BaseSolution;
use QuantaQuirk\Ignition\Contracts\ProvidesSolution;
use QuantaQuirk\Ignition\Contracts\Solution;

class ExceptionWithSolution extends \Exception implements ProvidesSolution
{
    public function getSolution(): Solution
    {
        return BaseSolution::create('This is a solution')
            ->setSolutionDescription('With a description');
    }
}
