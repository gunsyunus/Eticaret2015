<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use DB;

class StatisticsController extends PanelController
{
    /**
     * Statistics items listing page.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('panel.module.statistics.index');
    }

    /**
     * Statistics for product, brand and category.
     *
     * @return \Illuminate\View\View
     */
    public function getCatalog()
    {
        $productsInStock = Product::where('status', '=', '1')->count('id_product');
        $productsOutStock = Product::where('status', '=', '0')->count('id_product');
        $brand = Brand::count('id_brand');
        $category = Category::count('id_category');

        $statistics = (object) array('productsInStock'=>$productsInStock,
                                    'productsOutStock'=>$productsOutStock,
                                    'brand'=>$brand,
                                    'category'=>$category
                                    );

        return view('panel.module.statistics.catalog', compact('statistics'));
    }

    /**
     * Membership distributions, male and female, order, newsletter usage rates.
     *
     * @return \Illuminate\View\View
     */
    public function getUser()
    {
        $genderFemale = Customer::where('gender', '=', 'F')->count('id_customer');
        $genderMale = Customer::where('gender', '=', 'M')->count('id_customer');

        $orderFemale = Customer::where('gender', '=', 'F')->sum('stock_order');
        $orderMale = Customer::where('gender', '=', 'M')->sum('stock_order');

        $newsletterFemale = Customer::where('gender', '=', 'F')
                                      ->where('newsletter_status', '=', '1')
                                      ->count('id_customer');

        $newsletterMale = Customer::where('gender', '=', 'M')
                                    ->where('newsletter_status', '=', '1')
                                    ->count('id_customer');

        $statistics = (object) array('genderFemale'=>$genderFemale,
                                    'genderMale'=>$genderMale,
                                    'orderFemale'=>$orderFemale,
                                    'orderMale'=>$orderMale,
                                    'newsletterFemale'=>$newsletterFemale,
                                    'newsletterMale'=>$newsletterMale);

        return view('panel.module.statistics.user', compact('statistics'));
    }

    /**
     * Top Shopping 100 Customers
     *
     * @return \Illuminate\View\View
     */
    public function getShopping()
    {
        $customers = Customer::with('user')->orderBy('stock_order', 'DESC')->take(100)->get();
        return view('panel.module.statistics.shopping', compact('customers'));
    }

    /**
     * Top 100 Products
     *
     * @return \Illuminate\View\View
     */
    public function getProduct()
    {
        $products = Product::orderBy('stock_order', 'DESC')->take(100)->get();
        return view('panel.module.statistics.product', compact('products'));
    }

    /**
     * Coupon usage statistics.
     *
     * @return \Illuminate\View\View
     */
    public function getCoupon()
    {
        $orders = Order::select('id_order', 'coupon_code', DB::raw('count(id_order) as coupon_total'))
                         ->groupBy('coupon_code')
                         ->get('coupon_total', 'coupon_code');
        return view('panel.module.statistics.coupon', compact('orders'));
    }
}
