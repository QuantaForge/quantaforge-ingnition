<?php

namespace QuantaForge\QuantaForgeIgnition\ArgumentReducers;

use QuantaForge\Support\Collection;
use QuantaForge\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;
use QuantaForge\Backtrace\Arguments\ReducedArgument\UnReducedArgument;
use QuantaForge\Backtrace\Arguments\Reducers\ArrayArgumentReducer;

class CollectionArgumentReducer extends ArrayArgumentReducer
{
    public function execute(mixed $argument): ReducedArgumentContract
    {
        if (! $argument instanceof Collection) {
            return UnReducedArgument::create();
        }

        return $this->reduceArgument($argument->toArray(), get_class($argument));
    }
}
