<?php

namespace dsv\m3u8Parser\Dto;

use dsv\Pattern\DtoTrait;

class ExtInfDto
{
    use DtoTrait;
    
    public $id;
    public $name;
    public $groupName;
    public $logo;
    public $country;
    public $language;
    public $userAgent;
    public int $runtime;
}
