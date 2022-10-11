<?php

namespace dsv\Pattern;

trait DtoTrait
{
    public static function fromArray(array $params): static
    {
        $classname = static::class;
        $object = new $classname();
        foreach ($params as $param => $value) {
            $object->setParam($param, $value);
        }

        return $object;
    }

    protected function setParam(string $param, $value): void
    {
        if (property_exists($this, $param)) {
            $this->{$param} = $value;
        }
    }
}
