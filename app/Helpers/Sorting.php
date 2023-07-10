<?php

namespace App\Helpers;

class Sorting
{
    /**
     * List products by selection.
     *
     * @param  string $sort
     * @return array
     */
    public static function selection($sort)
    {
        switch ($sort) {
            case 'price_asc':
                $column = 'price';
                $type   = 'asc';
                $name   = 'Artan Fiyat';
                break;
            case 'price_desc':
                $column = 'price';
                $type   = 'desc';
                $name   = 'Azalan Fiyat';
                break;
            case 'name_asc':
                $column = 'name';
                $type   = 'asc';
                $name   = 'A-Z Arası';
                break;
            case 'name_desc':
                $column = 'name';
                $type   = 'desc';
                $name   = 'Z-A Arası';
                break;
            default:
                $column = 'id_product';
                $type   = 'desc';
                $name   = 'Seçiniz';
                break;
        }

        $sorting = (object) array('column' => $column,
                                  'type'   => $type,
                                  'name'   => $name);

        return $sorting;
    }
}
