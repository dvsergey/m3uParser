<?php

namespace dsv\m3u8Parser;

use dsv\m3u8Parser\Dto\ExtInfDto;
use dsv\m3u8Parser\Dto\ExtXInfDto;

class ExtXInfParser
{
    private const EXT_X_REGEX = '/(#EXT-X-[a-zA-Z0-9\-_]+?):([^"]*)/';

    public static function parse(string $extInf): ?ExtXInfDto
    {
        if ($extInf) {
            preg_match_all(self::EXT_X_REGEX, $extInf, $matches);
            if (!empty($matches)) {
                return new ExtXInfDto($matches[1][0], $matches[2][0]);
            }
        }
        return null;
    }
}
