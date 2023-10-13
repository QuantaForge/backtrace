<?php

namespace QuantaQuirk\Backtrace\Arguments\Reducers;

use QuantaQuirk\Backtrace\Arguments\ReducedArgument\ReducedArgument;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\UnReducedArgument;
use Symfony\Component\HttpFoundation\Request;

class SymphonyRequestArgumentReducer implements ArgumentReducer
{
    public function execute($argument): ReducedArgumentContract
    {
        if(! $argument instanceof Request) {
            return UnReducedArgument::create();
        }

        return new ReducedArgument(
            "{$argument->getMethod()} {$argument->getUri()}",
            get_class($argument),
        );
    }
}
