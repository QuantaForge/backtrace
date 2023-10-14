<?php

namespace QuantaForge\Backtrace\Arguments;

use QuantaForge\Backtrace\Arguments\Reducers\ArgumentReducer;
use QuantaForge\Backtrace\Arguments\Reducers\ArrayArgumentReducer;
use QuantaForge\Backtrace\Arguments\Reducers\BaseTypeArgumentReducer;
use QuantaForge\Backtrace\Arguments\Reducers\ClosureArgumentReducer;
use QuantaForge\Backtrace\Arguments\Reducers\DateTimeArgumentReducer;
use QuantaForge\Backtrace\Arguments\Reducers\DateTimeZoneArgumentReducer;
use QuantaForge\Backtrace\Arguments\Reducers\EnumArgumentReducer;
use QuantaForge\Backtrace\Arguments\Reducers\MinimalArrayArgumentReducer;
use QuantaForge\Backtrace\Arguments\Reducers\SensitiveParameterArrayReducer;
use QuantaForge\Backtrace\Arguments\Reducers\StdClassArgumentReducer;
use QuantaForge\Backtrace\Arguments\Reducers\StringableArgumentReducer;
use QuantaForge\Backtrace\Arguments\Reducers\SymphonyRequestArgumentReducer;

class ArgumentReducers
{
    /** @var array<int, ArgumentReducer> */
    public $argumentReducers = [];

    /**
     * @param array<ArgumentReducer|class-string<ArgumentReducer>> $argumentReducers
     */
    public static function create(array $argumentReducers): self
    {
        return new self(array_map(
            function ($argumentReducer) {
                /** @var $argumentReducer ArgumentReducer|class-string<ArgumentReducer> */
                return $argumentReducer instanceof ArgumentReducer ? $argumentReducer : new $argumentReducer();
            },
            $argumentReducers
        ));
    }

    public static function default(array $extra = []): self
    {
        return new self(static::defaultReducers($extra));
    }

    public static function minimal(array $extra = []): self
    {
        return new self(static::minimalReducers($extra));
    }

    /**
     * @param array<int, ArgumentReducer> $argumentReducers
     */
    protected function __construct(array $argumentReducers)
    {
        $this->argumentReducers = $argumentReducers;
    }

    protected static function defaultReducers(array $extra = []): array
    {
        return array_merge($extra, [
            new BaseTypeArgumentReducer(),
            new ArrayArgumentReducer(),
            new StdClassArgumentReducer(),
            new EnumArgumentReducer(),
            new ClosureArgumentReducer(),
            new SensitiveParameterArrayReducer(),
            new DateTimeArgumentReducer(),
            new DateTimeZoneArgumentReducer(),
            new SymphonyRequestArgumentReducer(),
            new StringableArgumentReducer(),
        ]);
    }

    protected static function minimalReducers(array $extra = []): array
    {
        return array_merge($extra, [
            new BaseTypeArgumentReducer(),
            new MinimalArrayArgumentReducer(),
            new EnumArgumentReducer(),
            new ClosureArgumentReducer(),
            new SensitiveParameterArrayReducer(),
        ]);
    }
}
