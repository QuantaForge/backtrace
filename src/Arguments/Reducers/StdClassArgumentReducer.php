<?php

namespace QuantaQuirk\Backtrace\Arguments\Reducers;

use QuantaQuirk\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\UnReducedArgument;
use stdClass;

class StdClassArgumentReducer extends ArrayArgumentReducer
{
    public function execute($argument): ReducedArgumentContract
    {
        if (! $argument instanceof stdClass) {
            return UnReducedArgument::create();
        }

        return parent::reduceArgument((array) $argument, stdClass::class);
    }
}
