<?php

namespace QuantaForge\Backtrace\Arguments\Reducers;

use QuantaForge\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;

interface ArgumentReducer
{
    /**
     * @param mixed $argument
     */
    public function execute($argument): ReducedArgumentContract;
}
