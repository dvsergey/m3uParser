<?php

namespace dsv\m3u8Parser\Dto;

use dsv\Pattern\Dto;

class M3uItem extends Dto
{
    public $id;
    public $name;
    public $groupName;
    public $logo;
    public $country;
    public $language;
    public $url;
    public $userAgent;

}