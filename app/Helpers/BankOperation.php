<?php

namespace App\Helpers;

use DB;

class BankOperation
{
    /**
     * Bank installment table.
     *
     * @param  int    $bank_id
     * @param  float  $total
     * @param  string $section
     * @return string
     */
    public static function installment($bank_id, $total, $section)
    {
        $rates = DB::table('banks_rate')->where('group_id', '=', $bank_id)->get();

        $html = '<table class="table"><tbody>';
        if ($section=='product') {
            $html .= '<tr><td>Taksit</td><td>Aylık</td><td>Toplam</td></tr>';
        } else {
            $html .= '<tr><td></td><td>Taksit</td><td>Aylık</td><td>Toplam</td></tr>';
        }

        foreach ($rates as $rate) {
            $html .= '<tr>';
            if ($section!='product') {
                $html .=  '<td><input type="radio" id="p'.$rate->id_rate.'" name="installment" 
                                value="'.$rate->id_rate.'"></td>';
            }
            $html .= '<td>'.$rate->installment.'</td>
       				   <td>'.static::monthly($total, $rate->rate, $rate->installment).'</td>       				   
       				   <td>'.static::total($total, $rate->rate).'</td>       				   
       			      </tr>';
        };
           
        $html .= '</tbody></table>';

        return $html;
    }

    /**
     * Show me the price.
     *
     * @param  float  $price
     * @return string
     */
    public static function format($price)
    {
        return number_format($price, 2, ',', '.');
    }

    /**
     * Change the phone text.
     *
     * @param  string $phone
     * @return string
     */
    public static function phone($phone)
    {
        $phone = str_replace('(', '', $phone);
        $phone = str_replace(')', '', $phone);
        return $phone;
    }

    /**
     * Calculate the total price.
     *
     * @param  float  $price
     * @param  int    $rate
     * @return string
     */
    public static function total($price, $rate)
    {
        $price = $price+($price*$rate)/100;
        return static::format($price);
    }

    /**
     * Calculate the total installment price.
     *
     * @param  float $price
     * @param  int   $rate
     * @return float
     */
    public static function calc($price, $rate)
    {
        return $price = $price+($price*$rate)/100;
    }

    /**
     * Calculate the monthly installment price.
     *
     * @param  float $price
     * @param  int   $rate
     * @param  int   $installment
     * @return string
     */
    public static function monthly($price, $rate, $installment)
    {
        $price = ($price+($price*$rate)/100)/$installment;
        return static::format($price);
    }
}
