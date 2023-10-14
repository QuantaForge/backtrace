<?php

namespace QuantaForge\Backtrace\Arguments\Reducers;

use QuantaForge\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;
use QuantaForge\Backtrace\Arguments\ReducedArgument\UnReducedArgument;
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
