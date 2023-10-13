<?php

namespace QuantaQuirk\QuantaQuirkIgnition\ArgumentReducers;

use QuantaQuirk\Database\Eloquent\Model;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\ReducedArgument;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\UnReducedArgument;
use QuantaQuirk\Backtrace\Arguments\Reducers\ArgumentReducer;

class ModelArgumentReducer implements ArgumentReducer
{
    public function execute(mixed $argument): ReducedArgumentContract
    {
        if (! $argument instanceof Model) {
            return UnReducedArgument::create();
        }

        return new ReducedArgument(
            "{$argument->getKeyName()}:{$argument->getKey()}",
            get_class($argument)
        );
    }
}
