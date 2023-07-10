<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\PanelController;
use App\Http\Requests\OrderPanelRequest;
use App\Jobs\SendOrderShipmentEmail;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Status;
use App\Models\Shipment;
use App\Models\Cart;
use App\Models\Address;
use App\Models\Setting;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Option;
use Carbon\Carbon;
use Mail;
use DB;
use Auth;
use Excel;

class OrderController extends PanelController
{
    /**
     * List by order status.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getList($id)
    {
        $statusType = Status::findOrFail($id);
        $statuses = Status::orderBy('sort', 'ASC')->get();
        $orders = Order::where('status_id', '=', $id)->orderBy('id_order', 'DESC')->paginate(25);
        return view('panel.module.order.list', compact('statusType', 'statuses', 'orders'));
    }

    /**
     * Search by order name, surname, phone, email, reference number.
     *
     * @param  Request $request
     * @return \Illuminate\View\View
     */
    public function getSearch(Request $request)
    {
        $searchText = $request->input('q');
        $statuses = Status::orderBy('sort', 'ASC')->get();
        $orders = Order::with('status')
                         ->where(DB::raw('CONCAT(name," ",surname)'), 'LIKE', '%'.$searchText.'%')
                         ->orWhere('phone', 'LIKE', '%'.$searchText.'%')
                         ->orWhere('email', 'LIKE', '%'.$searchText.'%')
                         ->orWhere('ref_number', '=', $searchText)
                         ->orderBy('id_order', 'DESC')->paginate(25);
        return view('panel.module.order.search', compact('orders', 'statuses', 'searchText'));
    }

    /**
     * Order details.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getDetail($id)
    {
        $order = Order::findOrFail($id);
        $payment = Payment::find($order->payment_id);
        $statuses = Status::orderBy('sort', 'ASC')->lists('name', 'id_status');
        $shipments = array('0'=>'Lütfen Seçiniz')+Shipment::orderBy('sort', 'ASC')
                     ->lists('name', 'id_shipment')->all();
        $carts = Cart::with('product')->where('cart_number', '=', $order->cart_number)->get();
        $shipping_address = Address::with('city', 'county')->find($order->shipping_address_id);
        $billing_address = Address::with('city', 'county')->find($order->billing_address_id);
        
        return view('panel.module.order.detail', compact('order', 'carts', 'payment',
                                                         'statuses', 'shipments',
                                                         'shipping_address', 'billing_address'));
    }

    /**
     * Update order information.
     *
     * @param  OrderPanelRequest $request
     * @param  int               $id
     * @return Response
     */
    public function postSave(OrderPanelRequest $request, $id)
    {
        $order = Order::findOrFail($id);

        $statusControl = $order->status_id;
        $order->name = $request->input('name');
        $order->surname = $request->input('surname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->gender = $request->input('gender');
        $order->message = $request->input('message');
        $order->admin_message = $request->input('admin_message');
        if ($order->status_id!=4 and $order->status_id!=5) {
            $order->status_id = $request->input('status_id');
        }
        $order->shipment_id = $request->input('shipment_id');
        $order->last_name_update = Auth::user()->email;
        $order->shipping_tracking_number = $request->input('shipping_tracking_number');
        $order->save();

        if ($order->save()) {

            // Mail Send Begin - Shipment
            if ($order->status_id==3) {
                $payment = Payment::find($order->payment_id);
                $settings = Setting::findOrFail(1);
                $this->dispatch(new SendOrderShipmentEmail($order, $payment, $settings));
            }
            // Mail End - Shipment

            // Order Controller = Site + Panel Collaboration

            if ($statusControl!=4 and $statusControl!=5) {
                if ($order->status_id == 4) {
                    if ($order->customer_group==1) {
                        Customer::where('id_customer', '=', $order->customer_id)->increment('stock_order');
                    }

                    $carts = Cart::where('cart_number', '=', $order->cart_number)->get();

                    foreach ($carts as $cart) {
                        Product::where('id_product', '=', $cart->product_id)->increment('stock_order', $cart->stock);
                    }
                } elseif ($order->status_id == 5) {
                    $carts = Cart::where('cart_number', '=', $order->cart_number)->get();

                    foreach ($carts as $cart) {
                        if ($cart->product_option_id == 0) {
                            Product::where('id_product', '=', $cart->product_id)->increment('stock', $cart->stock);
                        } else {
                            Product::where('id_product', '=', $cart->product_id)->increment('stock', $cart->stock);
                            Option::where('id_option', '=', $cart->product_option_id)->increment('stock', $cart->stock);
                        }
                    }
                }
            }

            // Order Controller = Site + Panel Collaboration End

            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Sipariş bilgileri güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Export orders in shipment status.
     *
     * @return Response
     */
    public function getExport()
    {
        Excel::create('Kargo-Listesi-'.Carbon::now()->format('d-m-Y-H-i'), function ($excel) {
            $excel->sheet('Siparişler', function ($sheet) {
                $orders = Order::with('address')
                                 ->with('address.city')
                                 ->with('address.county')
                                 ->with('payment')
                                 ->where('status_id', '=', '3')
                                 ->orderBy('id_order', 'DESC')
                                 ->get();
                $sheet->loadView('panel.module.order.export', compact('orders'));
            });
        })->export('xls');
    }
}
