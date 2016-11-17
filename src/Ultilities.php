<?php

namespace SanTran\SmartLogs;

class Ultilities
{

    /**
     * Json encode without encode japan character
     * @param string $string
     * @return string
     */
    public static function jsonJapan($string)
    {
        return json_encode($string, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

}
