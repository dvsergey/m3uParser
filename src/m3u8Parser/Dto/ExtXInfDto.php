<?php

namespace dsv\m3u8Parser\Dto;

use dsv\Pattern\DtoTrait;

/** HLS M3U extensions  */
class ExtXInfDto
{
    use DtoTrait;
    public function __construct(public string $directive, public string $value)
    {
    }
}
