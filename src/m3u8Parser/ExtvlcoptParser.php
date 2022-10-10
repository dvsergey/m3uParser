<?php

namespace dsv\m3u8Parser;

class ExtvlcoptParser
{
    private const REG_FILTER = '/.+?=(.*)/';

    public static function parse(string $extvlcopt): ?string
    {
        $userAgent = null;
        if ($extvlcopt) {
            preg_match_all(self::REG_FILTER, $extvlcopt, $matches);
            if (!empty($matches[1])) {
                $userAgent = $matches[1][0];
            }
        }
        return $userAgent;
    }
}
