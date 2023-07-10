<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\SiteController;
use DB;

class HomeController extends SiteController
{
    /**
     * E-Commerce homepage.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $designs = DB::table('designs')->where('id_design', '=', '1')->first();

        $bannerSlider = DB::table('banners')->where('status', '=', '1')
                                            ->where('type', '=', 'home_slider')
                                            ->orderBy('sort', 'asc')->get();

        if ($designs->home_section_1 == 1) {
            $bannerBox = DB::table('banners')->where('status', '=', '1')
                                             ->where('type', '=', 'home_box')
                                             ->orderBy('sort', 'asc')->get();
        }
        if ($designs->home_section_2 == 1) {
            $tabLeftUpProducts = DB::table('products')->join('rates', 'products.rate_id', '=', 'rates.id_rate')
                                                      ->select('products.*', 'rates.amount as ratePrice')
                                                      ->where('status', '=', '1')
                                                      ->where('private_status_1', '=', '1')
                                                      ->whereNull('products.deleted_at')
                                                      ->orderBy('private_sort', 'asc')->get();

            $tabRightUpProducts = DB::table('products')->join('rates', 'products.rate_id', '=', 'rates.id_rate')
                                                       ->select('products.*', 'rates.amount as ratePrice')
                                                       ->where('status', '=', '1')
                                                       ->where('private_status_2', '=', '1')
                                                       ->whereNull('products.deleted_at')
                                                       ->orderBy('private_sort', 'asc')->get();
        }

        if ($designs->home_section_3 == 1) {
            $tabLeftDownProducts = DB::table('products')->join('rates', 'products.rate_id', '=', 'rates.id_rate')
                                                        ->select('products.*', 'rates.amount as ratePrice')
                                                        ->where('status', '=', '1')
                                                        ->where('private_status_3', '=', '1')
                                                        ->whereNull('products.deleted_at')
                                                        ->orderBy('private_sort', 'asc')->get();
                                                        
            $tabRightDownProducts = DB::table('products')->join('rates', 'products.rate_id', '=', 'rates.id_rate')
                                                         ->select('products.*', 'rates.amount as ratePrice')
                                                         ->where('status', '=', '1')
                                                         ->where('private_status_4', '=', '1')
                                                         ->whereNull('products.deleted_at')
                                                         ->orderBy('private_sort', 'asc')->get();
        }

        if ($designs->home_section_4 == 1) {
            $bandProducts = DB::table('products')->join('rates', 'products.rate_id', '=', 'rates.id_rate')
                                                 ->select('products.*', 'rates.amount as ratePrice')
                                                 ->where('status', '=', '1')
                                                 ->where('private_status_5', '=', '1')
                                                 ->whereNull('products.deleted_at')
                                                 ->orderBy('private_sort', 'asc')->get();
        }

        if ($designs->home_section_5 == 1) {
            $bannerSub = DB::table('banners')->where('status', '=', '1')
                                             ->where('type', '=', 'home_sub')
                                             ->orderBy('sort', 'asc')->get();
        }

        if ($designs->home_section_6 == 1) {
            $bannerBrand = DB::table('banners')->where('status', '=', '1')
                                               ->where('type', '=', 'home_brand')
                                               ->orderBy('sort', 'asc')->get();
        }

        return view('site.home', compact('designs', 'bannerSlider', 'bannerBrand', 'bannerBox',
                                         'bannerSub', 'bandProducts', 'tabLeftUpProducts',
                                         'tabRightUpProducts', 'tabLeftDownProducts', 'tabRightDownProducts'));
    }
}
