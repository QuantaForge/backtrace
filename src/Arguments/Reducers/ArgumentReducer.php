<?php

namespace QuantaQuirk\Backtrace\Arguments\Reducers;

use QuantaQuirk\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;

interface ArgumentReducer
{
    /**
     * @param mixed $argument
     */
    public function execute($argument): ReducedArgumentContract;
}
