<?php

namespace dsv\m3u8Parser\Dto;

use dsv\Pattern\DtoTrait;

class M3uItem
{
    use DtoTrait;

    /** @var ExtXInfDto[] */
    public array $extXInfs = [];

    public ?string $id;
    public ?string $name;
    public ?string $groupName;
    public ?string $logo;
    public ?string $country;
    public ?string $language;
    public ?string $url;
    public ?string $userAgent;
    public ?int $runtime;

    public function toM3uPart(): string
    {
        $string = '#EXTINF:' . $this->runtime;
        if (!empty ($this->logo)) {
            $string .= ' logo="' . $this->logo . '"';
        }

        $string .= ',' . $this->name . PHP_EOL;
        foreach ($this->extXInfs as $extXInfDto) {
            $string .= $extXInfDto->directive . ':' . $extXInfDto->value . PHP_EOL;
        }
        $string .= $this->url . PHP_EOL;
        return $string;
    }

}
