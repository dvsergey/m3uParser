<?php

namespace dsv\m3u8Parser;

use dsv\m3u8Parser\Dto\ExtInfDto;

class ExtInfParser
{
    private static string $regAttributes = '/([a-zA-Z0-9\-\_]+?)="([^"]*)"/';

    public static function parse(string $extInf): ?ExtInfDto
    {
        $extInfDto = null;
        preg_match_all(self::$regAttributes, $extInf, $matches);
        if (!empty($matches)) {
            $array = [];
            foreach ($matches[1] as $i => $name) {
                $array[$name] = $matches[2][$i];
            }
            $extInfDto = new ExtInfDto($array);
            if (!$extInfDto->name) {
                $extInfDto->name = self::getName($extInf);
            }
        }
        return $extInfDto;
    }

    private static function getName(string $extInf): string
    {
        $data = explode(',', $extInf);
        return isset($data[1]) ? $data[1] : '';
    }
}