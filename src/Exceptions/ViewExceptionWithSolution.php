<?php

namespace QuantaQuirk\QuantaQuirkIgnition\Exceptions;

use QuantaQuirk\Ignition\Contracts\ProvidesSolution;
use QuantaQuirk\Ignition\Contracts\Solution;

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
