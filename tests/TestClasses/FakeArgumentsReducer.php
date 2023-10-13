<?php

namespace QuantaQuirk\QuantaQuirkIgnition\Tests\TestClasses;

use QuantaQuirk\Backtrace\Arguments\ReducedArgument\ReducedArgument;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;
use QuantaQuirk\Backtrace\Arguments\Reducers\ArgumentReducer;

class FakeArgumentsReducer implements ArgumentReducer
{
    public function execute($argument): ReducedArgumentContract
    {
        return new ReducedArgument('FAKE', gettype($argument));
    }
}
