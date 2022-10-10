<?php

namespace dsv\m3u8Parser\Dto;

use dsv\Pattern\Dto;

class M3uItem extends Dto
{
    /** @var ExtXInfDto[] */
    public array $extInfs = [];

    public ?string $id;
    public ?string $name;
    public ?string $groupName;
    public ?string $logo;
    public ?string $country;
    public ?string $language;
    public ?string $url;
    public ?string $userAgent;
}
