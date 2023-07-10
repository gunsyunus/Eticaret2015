<?php

namespace App\Helpers;

class DateFormat
{
    /**
     * It shows the date of birth in Turkish format.
     *
     * @param  string $value
     * @return string
     */
    public static function birthday($value)
    {
        $date = explode('-', $value);
        return $date[2].'.'.$date[1].'.'.$date[0];
    }
}
