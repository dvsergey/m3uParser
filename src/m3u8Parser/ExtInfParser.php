<?php

namespace dsv\m3u8Parser;

use dsv\m3u8Parser\Dto\ExtInfDto;

class ExtInfParser
{
    private const REG_FILTER_ADDITIONAL_PROPERTIES = '/([a-zA-Z0-9\-_]+?)="([^"]*)"/';
    private const REG_RUNTIME = '/#EXTINF:([0-9]+)/';

    public static function parse(string $extInf): ?ExtInfDto
    {
        $extInfDto = null;
        if ($extInf) {
            preg_match_all(self::REG_FILTER_ADDITIONAL_PROPERTIES, $extInf, $matches);
            if (!empty($matches)) {
                $array = [];
                foreach ($matches[1] as $i => $name) {
                    $array[$name] = $matches[2][$i];
                }
                $extInfDto = new ExtInfDto($array);

                preg_match(self::REG_RUNTIME, $extInf, $matches2);
                if (!empty($matches2[1])) {
                    $extInfDto->runtime = $matches2[1];
                }

                if (!$extInfDto->name) {
                    $extInfDto->name = self::getName($extInf);
                }
            }
        }
        return $extInfDto;
    }

    private static function getName(string $extInf): string
    {
        $data = explode(',', $extInf);
        return count($data) > 1 ? end($data) : '';
    }
}
