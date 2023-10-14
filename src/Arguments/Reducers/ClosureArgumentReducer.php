<?php

namespace QuantaForge\Backtrace\Arguments\Reducers;

use Closure;
use ReflectionFunction;
use QuantaForge\Backtrace\Arguments\ReducedArgument\ReducedArgument;
use QuantaForge\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;
use QuantaForge\Backtrace\Arguments\ReducedArgument\UnReducedArgument;

class ClosureArgumentReducer implements ArgumentReducer
{
    public function execute($argument): ReducedArgumentContract
    {
        if (! $argument instanceof Closure) {
            return UnReducedArgument::create();
        }

        $reflection = new ReflectionFunction($argument);

        if ($reflection->getFileName() && $reflection->getStartLine() && $reflection->getEndLine()) {
            return new ReducedArgument(
                "{$reflection->getFileName()}:{$reflection->getStartLine()}-{$reflection->getEndLine()}",
                'Closure'
            );
        }

        return new ReducedArgument("{$reflection->getFileName()}", 'Closure');
    }
}
