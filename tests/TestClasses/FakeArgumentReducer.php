<?php

namespace QuantaForge\Backtrace\Tests\TestClasses;

use QuantaForge\Backtrace\Arguments\ReducedArgument\ReducedArgument;
use QuantaForge\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;
use QuantaForge\Backtrace\Arguments\Reducers\ArgumentReducer;

class FakeArgumentReducer implements ArgumentReducer
{
    public function execute($argument): ReducedArgumentContract
    {
        return new ReducedArgument('FAKE', gettype($argument));
    }
}
