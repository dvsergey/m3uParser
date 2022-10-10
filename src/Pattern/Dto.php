<?php

namespace dsv\Pattern;

abstract class Dto
{
    public function __construct(array $params)
    {
        $this->load($params);
    }

    public function load(array $params): void
    {
        foreach ($params as $param => $value) {
            $this->setParam($param, $value);
        }
    }

    private function setParam($param, $value): void
    {
        if (property_exists($this, $param)) {
            $this->{$param} = $value;
        }
    }
}
