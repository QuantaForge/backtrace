<?php

namespace QuantaQuirk\Backtrace\Arguments\Reducers;

use DateTimeInterface;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\ReducedArgument;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\UnReducedArgument;

class DateTimeArgumentReducer implements ArgumentReducer
{
    public function execute($argument): ReducedArgumentContract
    {
        if (! $argument instanceof DateTimeInterface) {
            return UnReducedArgument::create();
        }

        return new ReducedArgument(
            $argument->format('d M Y H:i:s e'),
            get_class($argument),
        );
    }
}
