<?php

namespace QuantaForge\QuantaForgeIgnition\ArgumentReducers;

use QuantaForge\Database\Eloquent\Model;
use QuantaForge\Backtrace\Arguments\ReducedArgument\ReducedArgument;
use QuantaForge\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;
use QuantaForge\Backtrace\Arguments\ReducedArgument\UnReducedArgument;
use QuantaForge\Backtrace\Arguments\Reducers\ArgumentReducer;

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
