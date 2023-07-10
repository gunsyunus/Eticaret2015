<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\ProcessController;
use App\Http\Requests\CartRequest;
use App\Models\Coupon;
use Redirect;
use Price;
use Cookie;
use Auth;
use DB;
use Session;

class CartController extends ProcessController
{
    /**
     * Add a new product to the customer cart.
     *
     * @param  CartRequest $request
     * @return Response
     */
    public function addcart(CartRequest $request)
    {
        $id = $request->input('id');
        $choose = $request->input('choose');
        $quantity = $request->input('quantity');

        if (!is_numeric($quantity) or $quantity=='0') {
            $quantity = 1;
        }

        $product = DB::table('products')->join('rates', 'products.rate_id', '=', 'rates.id_rate')
                                        ->select('products.*', 'rates.amount as ratePrice')
                                        ->where('id_product', '=', $id)
                                        ->where('status', '=', '1')
                                        ->whereNull('products.deleted_at')
                                        ->first();

        $stockControl = $product->stock;
        $price = Price::product($product->price, $product->tax, $product->rate_id, $product->ratePrice, 'B');

        if ($product->option_status == 1) {
            if ($choose=='') {
                return Redirect::back()->with(array('CONFIRM_CHOOSE'=>'1'));
            }
            $option = DB::table('products_option')->where('id_option', '=', $choose)
                                                  ->where('product_id', '=', $product->id_product)
                                                  ->whereNull('deleted_at')->first();
            $stockControl = $option->stock;
            $option_name = $option->name;
            $product_option_id = $option->id_option;
            if ($option->price>'0') {
                $price = Price::product($option->price, $product->tax, $product->rate_id, $product->ratePrice, 'B');
            }
        } else {
            $option_name = '';
            $product_option_id = '';
        }

        if (Cookie::has('cart')) {
            $cart_number = Cookie::get('cart');
        } else {
            $cart_number = date('dmy').rand(1, 999999);
            Cookie::queue('cart', $cart_number, 120);
        }

        if ($stockControl >= $quantity) {
            $total = $price*$quantity;

            $insert = DB::table('orders_cart')->insert(
                  array('name' => $product->name,
                        'option_name' => $option_name,
                        'stock' => $quantity,
                        'price' => $price,
                        'total' => $total,
                        'tax' => $product->tax,
                        'created_time' => date('h:i'),
                        'cart_number' => $cart_number,
                        'product_id' => $product->id_product,
                        'product_option_id' => $product_option_id,
                        'status' => 0));
        } else {
            return Redirect::back()->with(array('CONFIRM_STOCK'=>'1'));
        }

        if ($insert) {
            return Redirect::action('Site\OrderController@cart')->with('status', 'CONFIRM_INSERT');
        } else {
            return Redirect::action('Site\OrderController@cart')->with('status', 'ERROR');
        }
    }

    /**
     * Update the quantity of products in the cart.
     *
     * @param  CartRequest $request
     * @param  int         $id
     * @return Response
     */
    public function save(CartRequest $request, $id)
    {
        $cart_number = Cookie::get('cart');
        $quantity = $request->input('quantity');

        if (!is_numeric($quantity) or $quantity=='0') {
            $quantity = 1;
        }

        // Stock Update Begin

        $cart = DB::table('orders_cart')->where('id_cart', '=', $id)
                                        ->where('status', '=', 0)
                                        ->where('cart_number', '=', $cart_number)->first();

        if ($cart->product_option_id == 0) {
            $product = DB::table('products')
                   ->join('rates', 'products.rate_id', '=', 'rates.id_rate')
                   ->select('products.*', 'rates.amount as ratePrice')
                   ->where('id_product', '=', $cart->product_id)
                   ->where('status', '=', '1')
                   ->whereNull('products.deleted_at')
                   ->first();
            $stockControl = $product->stock;
        } else {
            $option = DB::table('products_option')
                    ->where('id_option', '=', $cart->product_option_id)
                    ->where('product_id', '=', $cart->product_id)
                    ->whereNull('deleted_at')
                    ->first();
            $stockControl = $option->stock;
        }

        if ($stockControl >= $quantity) {
            $total = $cart->price*$quantity;
            $save = DB::table('orders_cart')->where('id_cart', '=', $id)
                                            ->where('status', '=', 0)
                                            ->where('cart_number', '=', $cart_number)
                                            ->update(array('stock'=>$quantity, 'total'=>$total));
        } else {
            return Redirect::action('Site\OrderController@cart')->with('status', 'STOCK_ERROR');
        }

        // Stock Update End

        if ($save) {
            return Redirect::action('Site\OrderController@cart')->with('status', 'CONFIRM_SAVE');
        } else {
            return Redirect::action('Site\OrderController@cart')->with('status', 'ERROR');
        }
    }

    /**
     * Remove the product from the cart.
     *
     * @param  int $id
     * @return Response
     */
    public function delete($id)
    {
        $cart_number = Cookie::get('cart');
        $delete = DB::table('orders_cart')->where('id_cart', '=', $id)
                                          ->where('status', '=', 0)
                                          ->where('cart_number', '=', $cart_number)->delete();

        if ($delete) {
            return Redirect::action('Site\OrderController@cart')->with('status', 'CONFIRM_DELETE');
        } else {
            return Redirect::action('Site\OrderController@cart')->with('status', 'ERROR');
        }
    }

    /**
     * Empty the cart, delete all products.
     *
     * @return Response
     */
    public function cartEmpty()
    {
        $cart_number = Cookie::get('cart');
        $delete = DB::table('orders_cart')->where('cart_number', '=', $cart_number)
                                          ->where('status', '=', 0)->delete();

        if ($delete) {
            return Redirect::action('Site\OrderController@cart')->with('status', 'CONFIRM_EMPTY');
        } else {
            return Redirect::action('Site\OrderController@cart')->with('status', 'ERROR');
        }
    }

    /**
     * Check and confirm the campaign code.
     *
     * @param  CartRequest $request
     * @return Response
     */
    public function coupon(CartRequest $request)
    {
        $code = $request->input('code');
        $counponMessage = 0;
        $codeControl = Session::get('coupon_code');

        if (!empty($codeControl)) {
            $counponMessage = '1';
        };

        if (!empty($code)) {
            $coupons = DB::table('coupons')->where('code', '=', $code)->where('stock', '>=', 1)->first();

            if ($coupons) {
                Coupon::where('id_coupon', '=', $coupons->id_coupon)->decrement('stock', 1);
                $counponMessage = '1';
                Session::put('coupon_code', $coupons->code);
                Session::put('coupon_discount_money', $coupons->discount_money);
                Session::put('coupon_discount_percent', $coupons->discount_percent);
                Session::put('coupon_total', $coupons->total);
                Session::put('coupon_type', $coupons->type);
            } else {
                $counponMessage = '2';
            }
        }

        Session::put('coupon_message', $counponMessage);

        return Redirect::action('Site\OrderController@cart')->with('COUPON_ERROR', '1');
    }
}
