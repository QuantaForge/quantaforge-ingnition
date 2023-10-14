<?php

namespace QuantaForge\QuantaForgeIgnition\Tests\TestClasses;

use QuantaForge\Ignition\Contracts\BaseSolution;
use QuantaForge\Ignition\Contracts\ProvidesSolution;
use QuantaForge\Ignition\Contracts\Solution;

class ExceptionWithSolution extends \Exception implements ProvidesSolution
{
    public function getSolution(): Solution
    {
        return BaseSolution::create('This is a solution')
            ->setSolutionDescription('With a description');
    }
}
