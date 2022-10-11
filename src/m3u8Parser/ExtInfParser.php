<?php

namespace dsv\m3u8Parser;

use dsv\m3u8Parser\Dto\ExtInfDto;

class ExtInfParser
{
    private const REG_FILTER_ADDITIONAL_PROPERTIES = '/([a-zA-Z0-9\-_]+?)="([^"]*)"/';
    private const REG_RUNTIME = '/#EXTINF:([0-9]+)/';

    public static function parse(string $extInf): ?ExtInfDto
    {
        if (empty($extInf)) {
            return null;
        }
        preg_match_all(self::REG_FILTER_ADDITIONAL_PROPERTIES, $extInf, $matches);

        if (empty($matches)) {
            return null;
        }
        $array = [];
        foreach ($matches[1] as $i => $name) {
            $array[$name] = $matches[2][$i];
        }

        preg_match(self::REG_RUNTIME, $extInf, $runtimeMatch);
        if (!empty($runtimeMatch[1])) {
            $array['runtime'] = $runtimeMatch[1];
        }

        $array['name'] = self::getName($extInf);

        return ExtInfDto::fromArray($array);
    }

    private static function getName(string $extInf): string
    {
        $data = explode(',', $extInf);
        return count($data) > 1 ? end($data) : '';
    }
}
