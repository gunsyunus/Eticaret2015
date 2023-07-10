<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\SiteController;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\OrderCompleteRequest;
use App\Http\Requests\OrderInquiryRequest;
use App\Jobs\SendOrderEmail;
use App\Models\City;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Bank;
use Carbon\Carbon;
use Redirect;
use Cookie;
use Shop;
use Mail;
use Auth;
use DB;
use Session;
use BankPayment;
use BankOperation;
use Price;
use URL;

class OrderController extends SiteController
{
    /**
     * List the products on the customer cart and show prices.
     *
     * @return \Illuminate\View\View
     */
    public function cart()
    {
        $cartDisplay = false;

        if (Cookie::has('cart')) {
            $cart_number = Cookie::get('cart');
            $carts = Shop::cart($cart_number);
            $total = Shop::cartDetail($cart_number);
        }

        return view('site.cart', compact('carts', 'cartDisplay', 'total'));
    }

    /**
     * Order inquiry.
     *
     * @param  OrderInquiryRequest $request
     * @return \Illuminate\View\View
     */
     public function inquiry(OrderInquiryRequest $request)
     {
         $ref_number = $request->input('n');

         $order = DB::table('orders')
                      ->leftJoin('shipments', 'orders.shipment_id', '=', 'shipments.id_shipment')
                      ->select('orders.*',
                               'shipments.provider_service_url',
                               'shipments.provider_name',
                               'shipments.name as shipmentName')
                      ->where('ref_number', '=', $ref_number)
                      ->first();

         if (!$order) {
             return back()->with(array('NO_RECORD'=>'1'));
         }
                      
         return view('site.orderInquiry', compact('order'));
     }

    /**
     * Order form for non-member (guest) customers.
     *
     * @return \Illuminate\View\View
     */
    public function detail()
    {

        // Order Method

        if (Auth::guest() or Auth::user()->role != 2) {
            $settings = DB::table('settings')->select('order_method')->where('id_setting', '=', '1')->first();

            if ($settings->order_method == 1) {
                return Redirect::action('Site\CustomerController@index');
            }
        } else {
            return Redirect::action('Site\OrderController@detailMember');
        }

        // Order Method End

        $cartDisplay = false;

        if (Cookie::has('cart')) {
            $cart_number = Cookie::get('cart');
            $total = Shop::cartDetail($cart_number);
        }

        $cities = array(''=>'Lütfen Seçiniz')+City::orderBy('sort', 'ASC')->lists('name', 'id_city')->all();

        return view('site.orderStep1', compact('cartDisplay', 'total', 'cities'));
    }

    /**
     * If the member has logged in, show the address and view the order form.
     *
     * @return \Illuminate\View\View
     */
    public function detailMember()
    {
        $cartDisplay = false;

        if (Cookie::has('cart')) {
            $cart_number = Cookie::get('cart');
            $total = Shop::cartDetail($cart_number);
        }

        $id = Auth::user()->id_user;
        $myaddress = DB::table('customers_address')->where('user_id', '=', $id)->get();
        $payments = DB::table('orders_payment')->where('status', '=', '1')->orderBy('sort', 'ASC')->get();

        return view('site.orderStep1Member', compact('cartDisplay', 'total', 'payments', 'myaddress'));
    }

    /**
     * Save the order entry in step one.
     *
     * @param  OrderRequest $request
     * @return Response
     */
    public function save(OrderRequest $request)
    {
        $cartDisplay = false;

        if (Auth::guest() or Auth::user()->role != 2) {

        // Guest Begin

        // Address Control and Insert Record

            $controlAddress = ($request->input('choose')=='1') ? '1' : '0';

            $address_1 = $request->input('address_1');
            $city_id = $request->input('city_id');
            $county_id = $request->input('county_id');

            if ($controlAddress == 1) {
                $shippingID = DB::table('customers_address')->insertGetId(array('address_1' => $address_1,
                                                                                'city_id' => $city_id,
                                                                                'county_id' => $county_id));
                $shipping_address_id = $shippingID;
                $billing_address_id = $shippingID;
            } else {
                $billing_address = $request->input('billing_address');
                $billing_city = $request->input('billing_city');
                $billing_county = $request->input('billing_county');
                $shippingID = DB::table('customers_address')->insertGetId(array('address_1' => $address_1,
                                                                                'city_id' => $city_id,
                                                                                'county_id' => $county_id));
                $billingID = DB::table('customers_address')->insertGetId(array('address_1' => $billing_address,
                                                                               'city_id' => $billing_city,
                                                                               'county_id' => $billing_county));
                $shipping_address_id = $shippingID;
                $billing_address_id = $billingID;
            }

        // Address End

            $name = $request->input('name');
            $surname = $request->input('surname');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $gender = $request->input('gender');
            $customer_group = 0;
            $customer_id = 0;

        // Guest End
        } else {

        // Registered Begin

        // Address Control and Insert Record

            $controlAddress = ($request->input('choose')=='1') ? '1' : '0';
            $shipping_address_id = $request->input('shipping_address_id');

            $id = Auth::user()->id_user;
            $shipping = DB::table('customers_address')->where('id_address', '=', $shipping_address_id)
                                                      ->where('user_id', '=', $id)->first();

            $customer = DB::table('customers')->where('user_id', '=', $id)->first();

            if ($controlAddress == 1) {
                $billing_address_id = $shipping_address_id;
            } else {
                $billing_address_id = $request->input('billing_address_id');
            }

            $city_id = $shipping->city_id;
            $county_id = $shipping->county_id;

        // Address End

            $name = Auth::user()->name;
            $surname = Auth::user()->surname;
            $email = Auth::user()->email;
            $phone = $customer->phone;
            $gender = $customer->gender;
            $customer_group = 1;
            $customer_id = $customer->id_customer;

        // Registered End
        }

        $order = new Order;
        $order->name = $name;
        $order->surname = $surname;
        $order->email = $email;
        $order->phone = $phone;
        $order->gender = $gender;
        $order->message = $request->input('message');
        $order->ref_number = 'REF'.rand(100000000, 999999999);
        $order->cart_number = Cookie::get('cart');
        $order->status_id = '0';
        $order->shipping_address_id = $shipping_address_id;
        $order->billing_address_id = $billing_address_id;
        $order->customer_group = $customer_group;
        $order->customer_id = $customer_id;
        $order->city_id = $city_id;
        $order->county_id = $county_id;
        $order->save();

        if ($order->save()) {
            Session::put('id_order', $order->id_order);
            return Redirect::action('Site\OrderController@payment');
        } else {
            return Redirect::back()->with(array('ORDER_CONTROL'=>'1'));
        }
    }

    /**
     * Payment screen for member and non-member customers.
     *
     * @return \Illuminate\View\View
     */
    public function payment()
    {
        $cartDisplay = false;

        $idOrder = Session::get('id_order');

        if (!$idOrder) {
            return Redirect::action('Site\OrderController@cart');
        }

        if (Cookie::has('cart')) {
            $cart_number = Cookie::get('cart');
            $total = Shop::cartDetail($cart_number);
        }

        $payments = DB::table('orders_payment')->where('status', '=', '1')->orderBy('sort', 'ASC')->get();
        $banks = DB::table('banks_rate_group')->where('status', '=', '1')->orderBy('sort', 'ASC')->get();

        return view('site.orderStep2', compact('cartDisplay', 'total', 'payments', 'banks'));
    }

    /**
     * Order completion screen.
     *
     * The final step for payment confirmation and banking transactions, followed by a "complete" message.
     *
     * @param  OrderRequest $request
     * @return \Illuminate\View\View
     */
    public function complete(OrderCompleteRequest $request)
    {
        $cartDisplay = false;

        if (Cookie::has('cart')) {
            $cart_number = Cookie::get('cart');
            $total = Shop::cartDetail($cart_number);
        }

        $order = Order::findOrFail(Session::get('id_order'));

        // Credit Card Payment Control Begin

        $paymentControl = $request->input('payment');

            // Bank 3D Secure Begin
            
            if (Session::get('SECURE_CONTROL') == 3) {
                $paymentControl = '3D';
            }

            // Bank 3D Secure End

        if ($paymentControl == '1') {
            $ccname = $request->input('ccname');
            $ccno = $request->input('ccno');
            $ccmonth = $request->input('ccmonth');
            $ccyear = $request->input('ccyear');
            $cvv = $request->input('cvv');
            $installment = $request->input('installment');

            if ($installment=='') {
                $installment = '0';
                $total_amount = $total->grandTotal;
            } else {
                $ratesPrivate = DB::table('banks_rate')->where('id_rate', '=', $installment)->first();
                $installment = $ratesPrivate->installment;
                $total_amount = BankOperation::calc($total->grandTotal, $ratesPrivate->rate);
                $order->installment = $installment;
                $order->installment_rate = $ratesPrivate->rate;
                $order->installment_amount = $total_amount-$total->grandTotal;
            }

            $reference = $order->ref_number;
            $email = $order->email;
            $bank = new BankPayment;
            $bank->creditCard($ccname, $ccno, $ccmonth, $ccyear, $cvv);

            $bankActive = Bank::where('status', '=', '1')->first();

            switch ($bankActive->id_bank) {
              
              case '1':
                $amount = Price::bank($total_amount);
                $bankResult = $bank->garanti($installment, $amount, $reference, $email);
                break;

              case '2':
                $amount = Price::estbank($total_amount);
                $bankResult = $bank->akbank($installment, $amount, $reference, $email);
                break;

              case '3':
                $amount = Price::otherbank($total_amount);
                echo $bank->kuveytturk($amount, $reference); die();
                break;

              case '4':
                $bankResult = $bank->payu($installment, $reference, $order->name, $order->surname,
                                          $email, BankOperation::phone($order->phone));
                break;

              default:
                $bankResult = 'error';
                break;
            }

            if ($bankResult != 'success') {
                return Redirect::back()->with(array('BANK_CONTROL'=>'1'));
            }
        }

        // Credit Card Payment Control End

        $new_cart_number = $cart_number.rand(100, 999);
        $cartUpdate = DB::table('orders_cart')
                          ->select('status', 'cart_number', 'total')
                          ->where('status', '=', '0')
                          ->where('cart_number', '=', $cart_number)
                          ->update(array('status'=>1,'cart_number'=>$new_cart_number));

        $order->day = date('N');
        $order->cart_number = $new_cart_number;
        $order->shipment_amount = $total->cargoPrice;

        $order->total_amount = $total->grandTotal;
        if ($paymentControl=='1') {
            $order->total_amount = $total_amount;
        };

        $order->ip = $_SERVER['REMOTE_ADDR'];
        $order->user_agent = $_SERVER["HTTP_USER_AGENT"];
        $order->status_id = '1';
        $order->payment_id = ($paymentControl == '3D') ? '1' : $request->input('payment');

        if (Session::get('coupon_code')=='') {
            $order->coupon_code = '-';
        } else {
            $order->coupon_code = Session::get('coupon_code');
        };

        $order->discount_amount = $total->couponDiscount;
        $order->save();

        if ($order->save()) {
            Cookie::forget('cart');
            Session::forget('coupon_code');
            Session::forget('coupon_message');
            Session::forget('id_order');

            $stocks = DB::table('orders_cart')
                              ->select('stock', 'product_id', 'product_option_id')
                              ->where('status', '=', '1')
                              ->where('cart_number', '=', $new_cart_number)
                              ->get();

            foreach ($stocks as $stock) {
                if ($stock->product_option_id == 0) {
                    DB::table('products')->where('id_product', '=', $stock->product_id)
                                         ->decrement('stock', $stock->stock);
                } else {
                    DB::table('products')->where('id_product', '=', $stock->product_id)
                                         ->decrement('stock', $stock->stock);
                    DB::table('products_option')->where('id_option', '=', $stock->product_option_id)
                                                ->decrement('stock', $stock->stock);
                }
            }

            if (!Auth::guest() and Auth::user()->role == 2) {
                $idUserOrder = Auth::user()->id_user;
                $customerOrder = Customer::where('user_id', '=', $idUserOrder)->first();
                $customerOrder->order_at = Carbon::now();
                $customerOrder->save();
            }
        } else {
            return Redirect::back()->with(array('ORDER_CONTROL'=>'1'));
        }

        $ref = (object) array('number' => $order->ref_number,
                              'name' => $order->name,
                              'surname' => $order->surname);

        // Send mail to the customer and administrator.
        $settings = DB::table('settings')->where('id_setting', '=', '1')->first();
        $this->dispatch(new SendOrderEmail($order, $settings));

        return view('site.orderStep3', compact('cartDisplay', 'ref'));
    }

    /**
     * 3D secure verify screen.
     *
     * @param  string $status
     * @return Response
     */
    public function secure(Request $request, $status)
    {
        if ($status=='success') {
            $bank = Bank::findOrFail(3);

            $AuthenticationResponse = $request->input('AuthenticationResponse');
            $RequestContent = urldecode($AuthenticationResponse);
            $xxml=simplexml_load_string($RequestContent);

            $MerchantOrderId = $xxml->VPosMessage->MerchantOrderId;
            $Amount = $xxml->VPosMessage->Amount;
            $MD = $xxml->MD;
        
            $APIVersion = "1.0.0";
            $Type = "Sale";
            $CurrencyCode = "0949";
            $CustomerId = $bank->customer_number;
            $MerchantId = $bank->merchant_number;
            $OkUrl = URL::to('odeme/kart/dogrulama/success');
            $FailUrl = URL::to('odeme/kart/dogrulama/error');
            $UserName = $bank->username;
            $Password = $bank->password;
            $HashedPassword = base64_encode(sha1($Password, "ISO-8859-9"));
            $HashData = base64_encode(sha1($MerchantId.$MerchantOrderId.$Amount.$UserName.$HashedPassword,
                        "ISO-8859-9"));
            $TransactionSecurity=3;

            $xml='<KuveytTurkVPosMessage xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
                  <HashData>'.$HashData.'</HashData>
                <MerchantId>'.$MerchantId.'</MerchantId>
                <CustomerId>'.$CustomerId.'</CustomerId>
                <UserName>'.$UserName.'</UserName>
                <TransactionType>Sale</TransactionType>
                <InstallmentCount>0</InstallmentCount>
                <Amount>'.$Amount.'</Amount>
                <MerchantOrderId>'.$MerchantOrderId.'</MerchantOrderId>
                <TransactionSecurity>3</TransactionSecurity>
                <KuveytTurkVPosAdditionalData>
                <AdditionalData>
                    <Key>MD</Key>
                    <Data>'.$MD.'</Data>
                </AdditionalData>
            </KuveytTurkVPosAdditionalData>
            </KuveytTurkVPosMessage>';
            // echo "\n";
        
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/xml',
              'Content-length: '. strlen($xml)));
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_URL,
              'https://boa.kuveytturk.com.tr/sanalposservice/Home/ThreeDModelProvisionGate');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            curl_close($ch);
        } catch (Exception $e) {
            // $e->getMessage();
        }
            return Redirect::action('Site\OrderController@complete')->with(array('SECURE_CONTROL'=>'3'));
        } else {
            return Redirect::action('Site\OrderController@payment')->with(array('BANK_CONTROL'=>'1'));
        }
    }
}
