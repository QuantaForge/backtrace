<?php

namespace QuantaQuirk\Backtrace\Arguments\Reducers;

use DateTimeZone;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\ReducedArgument;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\UnReducedArgument;

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
