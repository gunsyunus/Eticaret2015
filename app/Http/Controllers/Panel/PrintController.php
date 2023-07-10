<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Status;
use App\Models\Shipment;
use App\Models\Cart;
use App\Models\Address;

class PrintController extends PanelController
{
    /**
     * Print the order.
     *
     * It's just for information (It is not an invoice)
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function Order($id)
    {
        $order = Order::findOrFail($id);
        $payment = Payment::find($order->payment_id);
        $shipments = array('0'=>'Lütfen Seçiniz')+Shipment::orderBy('sort', 'ASC')
                     ->lists('name', 'id_shipment')->all();
        $carts = Cart::with('product')->where('cart_number', '=', $order->cart_number)->get();
        $shipping_address = Address::with('city', 'county')->find($order->shipping_address_id);
        $billing_address = Address::with('city', 'county')->find($order->billing_address_id);

        return view('panel.module.order.print', compact('order', 'carts', 'payment',
                                                        'shipments', 'shipping_address', 'billing_address'));
    }
}
