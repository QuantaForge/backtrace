<?php

namespace QuantaQuirk\Backtrace\Arguments\Reducers;

use QuantaQuirk\Backtrace\Arguments\ReducedArgument\ReducedArgument;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\UnReducedArgument;
use UnitEnum;

class EnumArgumentReducer implements ArgumentReducer
{
    public function execute($argument): ReducedArgumentContract
    {
        if (! $argument instanceof UnitEnum) {
            return UnReducedArgument::create();
        }

        return new ReducedArgument(
            get_class($argument).'::'.$argument->name,
            get_class($argument),
        );
    }
}
