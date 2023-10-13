<?php

namespace QuantaQuirk\Backtrace\Arguments\Reducers;

use QuantaQuirk\Backtrace\Arguments\ReducedArgument\ReducedArgument;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\UnReducedArgument;

class BaseTypeArgumentReducer implements ArgumentReducer
{
    public function execute($argument): ReducedArgumentContract
    {
        if (is_int($argument)
            || is_float($argument)
            || is_bool($argument)
            || is_string($argument)
            || $argument === null
        ) {
            return new ReducedArgument($argument, get_debug_type($argument));
        }

        return UnReducedArgument::create();
    }
}
