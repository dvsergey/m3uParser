<?php

namespace dsv\m3u8Parser;

class ExtgrpParser
{
    private static string $regAttributes = '/.+?:(.*)/';

    public static function parse(string $extgrp): ?string
    {
        $groupName = null;
        if ($extgrp) {
            preg_match_all(self::$regAttributes, $extgrp, $matches);
            if (!empty($matches[1])) {
                $groupName = $matches[1][0];
            }
        }
        return $groupName;
    }
}