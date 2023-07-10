<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\SiteController;
use App\Models\Order;
use App\Models\Address;
use Session;
use DB;

class PageController extends SiteController
{
    /**
     * Show special pages.
     *
     * The pages consist of 2 types, left section and wide page.
     *
     * @param  string $sef_url
     * @return \Illuminate\View\View
     */
    public function index($sef_url)
    {
        $page = DB::table('pages')->where('sef_url', '=', $sef_url)->first();

        if (!$page) {
            abort(404);
        }

        if ($page->section_id!=0) {
            $section = DB::table('pages_section')->where('id_section', '=', $page->section_id)->first();
            $pageList = DB::table('pages')->where('section_id', '=', $page->section_id)->orderBy('sort', 'asc')->get();
        }
        return view('site.page', compact('page', 'section', 'pageList'));
    }

    /**
     * Shipment tracking page.
     *
     * @return \Illuminate\View\View
     */
    public function shipment()
    {
        return view('site.shipment');
    }

    /**
     * Order agreement page.
     *
     * @return \Illuminate\View\View
     */
    public function agreement()
    {
        $settings = DB::table('settings')
                        ->select('agreement_order_title', 'agreement_order_content')
                        ->where('id_setting', '=', '1')
                        ->first();

        $title = $settings->agreement_order_title;

        $order = Order::find(Session::get('id_order'));

        $userVariable = ['[[ad]]',
                         '[[soyad]]',
                         '[[eposta]]',
                         '[[telefon]]',
                         '[[teslimatadres]]',
                         '[[faturaadres]]'];

        if (empty($order)) {
            $content = str_replace($userVariable, '-', $settings->agreement_order_content);
        } else {
            $shipping_address = Address::with('city', 'county')->find($order->shipping_address_id);
            $billing_address = Address::with('city', 'county')->find($order->billing_address_id);

            $orderVariable = [$order->name,
                              $order->surname,
                              $order->email,
                              $order->phone,
                              $shipping_address->address_1.' '.$shipping_address->city->name.' - 
                              '.$shipping_address->county->name,
                              $billing_address->address_1.' '.$billing_address->city->name.' - 
                              '.$billing_address->county->name];

            $content = str_replace($userVariable, $orderVariable, $settings->agreement_order_content);
        }

        return view('site.agreement', compact('title', 'content'));
    }
}
