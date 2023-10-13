<?php

namespace QuantaQuirk\Backtrace\Arguments\Reducers;

use QuantaQuirk\Backtrace\Arguments\ReducedArgument\ReducedArgument;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\UnReducedArgument;
use Stringable;

class StringableArgumentReducer implements ArgumentReducer
{
    public function execute($argument): ReducedArgumentContract
    {
        if (! $argument instanceof Stringable) {
            return UnReducedArgument::create();
        }

        return new ReducedArgument(
            (string) $argument,
            get_class($argument),
        );
    }
}
