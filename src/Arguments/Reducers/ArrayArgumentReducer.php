<?php

namespace QuantaQuirk\Backtrace\Arguments\Reducers;

use QuantaQuirk\Backtrace\Arguments\ArgumentReducers;
use QuantaQuirk\Backtrace\Arguments\ReduceArgumentPayloadAction;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\ReducedArgument;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\ReducedArgumentContract;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\TruncatedReducedArgument;
use QuantaQuirk\Backtrace\Arguments\ReducedArgument\UnReducedArgument;

class ArrayArgumentReducer implements ReducedArgumentContract
{
    /** @var int */
    protected $maxArraySize = 25;

    /** @var \QuantaQuirk\Backtrace\Arguments\ReduceArgumentPayloadAction */
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
