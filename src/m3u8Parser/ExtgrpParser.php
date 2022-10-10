<?php

namespace dsv\m3u8Parser;

class ExtgrpParser
{
    private const REG_FILTER = '/.+?:(.*)/';

    public static function parse(string $extgrp): ?string
    {
        preg_match_all(self::REG_FILTER, $extgrp, $matches);
        if (!empty($matches[1])) {
            return $matches[1][0];
        }
        return null;
    }
}
