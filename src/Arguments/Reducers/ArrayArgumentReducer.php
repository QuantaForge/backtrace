<?php

namespace QuantaForge\Backtrace\Arguments\Reducers;

use QuantaForge\Backtrace\Arguments\ArgumentReducers;
use QuantaForge\Backtrace\Arguments\ReduceArgumentPayloadAction;
use QuantaForge\Backtrace\Arguments\ReducedArgument\ReducedArgument;
use QuantaForge\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;
use QuantaForge\Backtrace\Arguments\ReducedArgument\TruncatedReducedArgument;
use QuantaForge\Backtrace\Arguments\ReducedArgument\UnReducedArgument;

class ArrayArgumentReducer implements ReducedArgumentContract
{
    /** @var int */
    protected $maxArraySize = 25;

    /** @var \QuantaForge\Backtrace\Arguments\ReduceArgumentPayloadAction */
    protected $reduceArgumentPayloadAction;

    public function __construct()
    {
        $this->reduceArgumentPayloadAction = new ReduceArgumentPayloadAction(ArgumentReducers::minimal());
    }

    public function execute($argument): ReducedArgumentContract
    {
        if (! is_array($argument)) {
            return UnReducedArgument::create();
        }

        return $this->reduceArgument($argument, 'array');
    }

    protected function reduceArgument(array $argument, string $originalType): ReducedArgumentContract
    {
        foreach ($argument as $key => $value) {
            $argument[$key] = $this->reduceArgumentPayloadAction->reduce(
                $value,
                true
            )->value;
        }

        if (count($argument) > $this->maxArraySize) {
            return new TruncatedReducedArgument(
                array_slice($argument, 0, $this->maxArraySize),
                'array'
            );
        }

        return new ReducedArgument($argument, $originalType);
    }
}
