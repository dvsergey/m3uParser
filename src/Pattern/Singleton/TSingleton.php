<?php

namespace dsv\Pattern\Singleton;

trait TSingleton
{
    protected static $obj = null;

    public static function init(): self
    {
        if (static::$obj === null) {
            static::$obj = new static();
        }
        return static::$obj;
    }

    private function __constructor(): void
    {
    }

}
