<?php

namespace QuantaForge\Backtrace\Arguments\Reducers;

use QuantaForge\Backtrace\Arguments\ReducedArgument\ReducedArgument;
use QuantaForge\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;
use QuantaForge\Backtrace\Arguments\ReducedArgument\UnReducedArgument;

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
