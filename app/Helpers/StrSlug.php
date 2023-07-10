<?php

use Illuminate\Support\Str;

if (! function_exists('str_slug')) {
    /**
     * The Turkish character (ü->ue, ö->oe) problem has been fixed.
     *
     * @param  string $title
     * @param  string $separator
     * @return string
     */
    function str_slug($title, $separator = '-')
    {
        $title = str_replace(['ü', 'Ü', 'ö', 'Ö'], ['u', 'u', 'o', 'o'], $title);
        return Str::slug($title, $separator);
    }
}
