<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Shop;
use View;
use Cookie;
use Auth;
use DB;

/**
 * General Website Controller
 *
 * Queries that work on all pages.
 */
class SiteController extends Controller
{
    /**
     * Share queries with all view files.
     *
     * @return array
     */
    public function __construct()
    {
        if (Auth::guest() or Auth::user()->role != 2) {
            $authControl = false;
        } else {
            $authControl = true;
            $authName = Auth::user()->name;
        }

        $designs = DB::table('designs')->where('id_design', '=', '1')->first();
        $settings = DB::table('settings')->where('id_setting', '=', '1')->first();
        $menus = DB::table('menus')->where('parent_id', '=', '0')
                                   ->where('status', '=', '1')
                                   ->orderBy('sort', 'asc')->get();
        $footers = DB::table('menus_footer')->where('parent_id', '=', '0')
                                            ->where('status', '=', '1')
                                            ->orderBy('sort', 'asc')->get();
        
        if (Cookie::has('cart')) {
            $cart_number = Cookie::get('cart');
            $carts = Shop::cart($cart_number);
        }

        $cartDisplay = true;

        return View::share(compact('designs', 'settings', 'menus', 'footers',
                                   'cartDisplay', 'carts', 'authControl', 'authName'));
    }
}
