<?php

namespace QuantaForge\QuantaForgeIgnition\Exceptions;

use QuantaForge\Ignition\Contracts\ProvidesSolution;
use QuantaForge\Ignition\Contracts\Solution;

class ViewExceptionWithSolution extends ViewException implements ProvidesSolution
{
    protected Solution $solution;

    public function setSolution(Solution $solution): void
    {
        $this->solution = $solution;
    }

    public function getSolution(): Solution
    {
        return $this->solution;
    }
}
