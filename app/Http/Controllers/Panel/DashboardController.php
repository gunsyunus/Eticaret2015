<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Models\User;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;

class DashboardController extends PanelController
{
    /**
     * E-Commerce Dashboard
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $customerTodayCount = User::where('role', '=', '2')->whereDate('created_at', '=', date('Y-m-d'))->count();
        $orderNew = Order::where('status_id', '=', '1')->count();
        $orderTodaySum = Order::whereDate('created_at', '=', date('Y-m-d'))->sum('total_amount');

        $statistics = (object) array('customerTodayCount' => $customerTodayCount,
                                     'orderNew' => $orderNew,
                                     'orderTodaySum' => $orderTodaySum);

        $customers = Customer::with('user')->orderBy('id_customer', 'DESC')->take(10)->get();
        
        $orders = Order::with('status')->whereNotIn('status_id',[0])->orderBy('id_order', 'DESC')->take(10)->get();

        $carts = Order::orderBy('id_order', 'DESC')->take(5)->get(['name','total_amount']);

        $products = Product::orderBy('stock_order', 'DESC')->take(5)->get();

        return view('panel.dashboard', compact('customers', 'statistics', 'orders', 'carts', 'products'));
    }
}
