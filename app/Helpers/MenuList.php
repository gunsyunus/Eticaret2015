<?php

namespace App\Helpers;

class MenuList
{
    /**
     * Website menu list JSON decode
     *
     * @param  string $json
     * @return string
     */
    public static function dropdown($json)
    {
        $list = json_decode($json, true);
        return $list['menu'];
    }
}
