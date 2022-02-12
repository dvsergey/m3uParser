<?php

namespace dsv\Pattern;

abstract class Dto
{
    public function __construct(array $params)
    {
        foreach ($params as $param => $value) {
            $this->setParam($param, $value);
        }
    }

    private function setParam($param, $value)
    {
        if (property_exists($this, $param)) {
            $this->{$param} = $value;
        }
    }
}