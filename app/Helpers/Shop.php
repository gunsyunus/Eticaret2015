<?php

namespace App\Helpers;

use DB;
use Price;
use Session;

class Shop
{
    /**
     * Products in the customer cart.
     *
     * @param  string $cart_number
     * @return array
     */
    public static function cart($cart_number)
    {
        $carts = DB::table('orders_cart')
                     ->leftJoin('products', 'orders_cart.product_id', '=', 'products.id_product')
                     ->select('orders_cart.*', 'products.image_small_1 as image', 'products.sef_url')
                     ->where('orders_cart.status', '=', '0')
                     ->where('orders_cart.cart_number', '=', $cart_number)
                     ->get();
        return $carts;
    }

    /**
     * It shows product, shipment, order total, coupon information in the customer cart.
     *
     * @param  string $cart_number
     * @return array
     */
    public static function cartDetail($cart_number)
    {
        $cartsTotal = DB::table('orders_cart')
                          ->select('status', 'cart_number', 'total')
                          ->where('status', '=', '0')
                          ->where('cart_number', '=', $cart_number)
                          ->sum('total');
        
        // Coupon

        $grandTotal = $cartsTotal;

        $coupon_code = Session::get('coupon_code');
        $coupon_discount_money = Session::get('coupon_discount_money');
        $coupon_discount_percent = Session::get('coupon_discount_percent');
        $coupon_total = Session::get('coupon_total');
        $coupon_type = Session::get('coupon_type');

        if ($coupon_code=='') {
            $couponDiscount = '0';
        } else {
            if ($cartsTotal >= $coupon_total) {
                if ($coupon_type=='money') {
                    $grandTotal = $cartsTotal-$coupon_discount_money;
                    $couponDiscount = $coupon_discount_money;
                } elseif ($coupon_type=='percent') {
                    $coupon_discount_percent = $coupon_discount_percent/100;
                    $couponDiscount = $cartsTotal*$coupon_discount_percent;
                    $grandTotal = $cartsTotal-$couponDiscount;
                }
            } else {
                $couponDiscount = '0';
            }
        }

        // Coupon

        // Shipment
        
        $cargo = DB::table('settings')->select('cargo_total', 'cargo_price', 'cargo_text')
                                      ->where('id_setting', '=', '1')->first();

        if ($cartsTotal >= $cargo->cargo_total) {
            $cargoPrice = 0;
            $cargoText = $cargo->cargo_text;
            $cargoRate = '';
        } else {
            $cargoPrice = $cargo->cargo_price;
            $cargoText = Price::format($cargo->cargo_price);
            $cargoRate = 'TL';
        }

        $grandTotal = $grandTotal+$cargoPrice;
        
        // Shipment

        $total = (object) array('cartTotal'=>$cartsTotal,
                                'cargoText'=>$cargoText,
                                'cargoRate'=>$cargoRate,
                                'cargoPrice'=>$cargoPrice,
                                'couponDiscount'=>$couponDiscount,
                                'grandTotal'=>$grandTotal);
        return $total;
    }
}
