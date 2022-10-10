<?php

namespace dsv\m3u8Parser\Dto;

use dsv\Pattern\Dto;

/** HLS M3U extensions  */
class ExtXInfDto
{
    public function __construct(public string $directive, public string $value)
    {
    }
}
