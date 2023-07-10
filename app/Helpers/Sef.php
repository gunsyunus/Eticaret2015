<?php

namespace App\Helpers;

use URL;

class Sef
{
    /**
     * The product creates a link.
     *
     * @param  string $sef_url
     * @param  int    $id
     * @return string
     */
    public static function product($sef_url, $id)
    {
        return URL::to('u/'.$sef_url.'/'.$id);
    }

    /**
     * The brand creates a link.
     *
     * @param  string $sef_url
     * @param  int    $id
     * @return string
     */
    public static function brand($sef_url, $id)
    {
        return URL::to('m/'.$sef_url.'/'.$id);
    }

    /**
     * The category creates a link.
     *
     * @param  string $sef_url
     * @param  int    $id
     * @return string
     */
    public static function category($sef_url, $id)
    {
        return URL::to('k/'.$sef_url.'/'.$id);
    }

    /**
     * The website pages creates a link.
     *
     * @param  string $sef_url
     * @return string
     */
    public static function page($sef_url)
    {
        return URL::to('s/'.$sef_url);
    }
}
