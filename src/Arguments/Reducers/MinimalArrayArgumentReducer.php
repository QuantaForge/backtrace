<?php

namespace QuantaQuirk\Backtrace\Arguments\Reducers;

use QuantaQuirk\Backtrace\Arguments\ReducedArgument\ReducedArgument;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\UnReducedArgument;

class MinimalArrayArgumentReducer implements ArgumentReducer
{
    public function execute($argument): ReducedArgumentContract
    {
        if(! is_array($argument)) {
            return UnReducedArgument::create();
        }

        return new ReducedArgument(
            'array (size='.count($argument).')',
            'array'
        );
    }
}
