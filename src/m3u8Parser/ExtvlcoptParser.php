<?php

namespace dsv\m3u8Parser;

class ExtvlcoptParser
{
    private static string $regAttributes = '/.+?=(.*)/';

    public static function parse(string $extvlcopt): ?string
    {
        $userAgent = null;
        if ($extvlcopt) {
            preg_match_all(self::$regAttributes, $extvlcopt, $matches);
            if (!empty($matches[1])) {
                $userAgent = $matches[1][0];
            }
        }
        return $userAgent;
    }
}