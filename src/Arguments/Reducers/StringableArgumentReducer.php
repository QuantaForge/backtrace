<?php

namespace QuantaForge\Backtrace\Arguments\Reducers;

use QuantaForge\Backtrace\Arguments\ReducedArgument\ReducedArgument;
use QuantaForge\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;
use QuantaForge\Backtrace\Arguments\ReducedArgument\UnReducedArgument;
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
