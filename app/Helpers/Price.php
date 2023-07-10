<?php

namespace App\Helpers;

class Price
{
    /**
     * It shows the price of the product in Turkish format.
     *
     * @param  float  $price
     * @return string
     */
    public static function format($price)
    {
        return number_format($price, 2, ',', '.');
    }
    
    /**
     * The price of the product is calculated in tax included.
     *
     * @param  float  $price
     * @param  int    $tax
     * @param  int    $rate
     * @param  float  $ratePrice
     * @param  string $format
     * @return float
     */
    public static function product($price, $tax, $rate, $ratePrice, $format)
    {
        if ($rate!=1) {
            $price = $price*$ratePrice;
        }

        $taxPrice = $price+($price*$tax)/100;
        if ($format=='F') {
            $taxPrice = static::format($taxPrice);
        }

        return $taxPrice;
    }

    /**
     * Multiply the price of the product by the stock and calculate the total price.
     *
     * @param  float $price
     * @param  int   $stock
     * @return float
     */
    public static function cart($price, $stock)
    {
        $price = $price*$stock;
        return static::format($price);
    }

    /**
     * Change the price to bank format.
     *
     * @param  float  $price
     * @return $float
     */
    public static function bank($price)
    {
        return number_format($price, 2, '', '');
    }

    /**
     * Change the price to EST bank format.
     *
     * @param  float  $price
     * @return $float
     */
    public static function estbank($price)
    {
        return number_format($price, 2, '.', '');
    }

    /**
     * Change the price to Kuveytturk Bank.
     *
     * @param  float  $price
     * @return $float
     */
    public static function otherbank($price)
    {
        return number_format($price, 2, '.', '.');
    }
}
