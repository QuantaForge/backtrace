<?php

namespace QuantaForge\Backtrace\Arguments\Reducers;

use DateTimeZone;
use QuantaForge\Backtrace\Arguments\ReducedArgument\ReducedArgument;
use QuantaForge\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;
use QuantaForge\Backtrace\Arguments\ReducedArgument\UnReducedArgument;

class DateTimeZoneArgumentReducer implements ArgumentReducer
{
    public function execute($argument): ReducedArgumentContract
    {
        if (! $argument instanceof DateTimeZone) {
            return UnReducedArgument::create();
        }

        return new ReducedArgument(
            $argument->getName(),
            get_class($argument),
        );
    }
}
