<?php

namespace QuantaForge\Backtrace\Arguments\Reducers;

use QuantaForge\Backtrace\Arguments\ReducedArgument\ReducedArgument;
use QuantaForge\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;
use QuantaForge\Backtrace\Arguments\ReducedArgument\UnReducedArgument;
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
