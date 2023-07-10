<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\SiteController;
use App\Http\Requests\CustomerRegisterRequest;
use App\Http\Requests\CustomerLoginRequest;
use App\Http\Requests\CustomerPasswordRequest;
use App\Http\Requests\CustomerProfileUpdateRequest;
use App\Models\Customer;
use App\Models\User;
use App\Models\City;
use Carbon\Carbon;
use Auth;
use DB;

class CustomerController extends SiteController
{
    /**
     * New membership and member login screen.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('site.customer');
    }

    /**
     * On the order confirmation screen, select the membership type.
     *
     * @return \Illuminate\View\View
     */
    public function choose()
    {
        return view('site.customerChoose');
    }

    /**
     * New membership form.
     *
     * @return \Illuminate\View\View
     */
    public function newcustomer()
    {
        $cities = array(''=>'Lütfen Seçiniz')+City::orderBy('sort', 'ASC')->lists('name', 'id_city')->all();
        return view('site.customerNew', compact('cities'));
    }

    /**
     * Register the member.
     *
     * @param  CustomerRegisterRequest $request
     * @return Response
     */
    public function register(CustomerRegisterRequest $request)
    {
        $user = new User;
        $customer = new Customer;

        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->role = 2;

        $customer->phone = $request->input('phone');
        $customer->gender = $request->input('gender');
        $customer->city_id = $request->input('city_id');
        $customer->newsletter_status = ($request->input('newsletter_status')=='1') ? '1' : '0';
        $customer->birth_at = $request->input('day').'.'.$request->input('month').'.'.$request->input('year');
        $user->save();

        if ($user->save()) {
            $customer->user_id = $user->id_user;
            $customer->save();
        }

        if ($customer->save()) {
            return back()->with(array('CONFIRM'=>'1'));
        } else {
            return back()->with(array('ERROR'=>'1'));
        }
    }

    /**
     * Forgot password form.
     *
     * @return \Illuminate\View\View
     */
    public function remember()
    {
        return view('site.customerRemember');
    }
  
    /**
     * Password reset form.
     *
     * @param  Request      $request
     * @param  string|null  $token
     * @return Response
     */
    public function passwordReset(Request $request, $token = null)
    {
        $email = $request->input('email');
        return view('site.customerPasswordReset', compact('token', 'email'));
    }

    /**
     * Login screen.
     *
     * @param  CustomerLoginRequest $request
     * @return Response
     */
    public function login(CustomerLoginRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(array('email'=>$email,'password'=>$password,'role'=>2))) {
            $id = Auth::user()->id_user;
            $customer = Customer::where('user_id', '=', $id)->first();
            $customer->login_at = Carbon::now();
            $customer->save();
            return redirect('/');
        } else {
            return back()->with(array('ERROR'=>'1'));
        }
    }

    /**
     * Logout.
     *
     * @return Response
     */
    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect('/');
    }

    /**
     * Customer (member) profile information update form.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        $id = Auth::user()->id_user;
        $customer = Customer::where('user_id', '=', $id)->first();
        $user = User::where('id_user', '=', $customer->user_id)->where('role', '=', 2)->firstOrFail();
        $cities = array(''=>'Lütfen Seçiniz')+City::orderBy('sort', 'ASC')->lists('name', 'id_city')->all();
        return view('site.customerProfile', compact('cities', 'customer', 'user'));
    }

    /**
     * Update customer (member) profile information.
     *
     * @param  CustomerProfileUpdateRequest $request
     * @return Response
     */
    public function save(CustomerProfileUpdateRequest $request)
    {
        $id = Auth::user()->id_user;
        $customer = Customer::where('user_id', '=', $id)->first();
        $user = User::where('id_user', '=', $customer->user_id)->where('role', '=', 2)->firstOrFail();

        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        
        $customer->phone = $request->input('phone');
        $customer->gender = $request->input('gender');
        $customer->city_id = $request->input('city_id');
        $customer->newsletter_status = ($request->input('newsletter_status')=='1') ? '1' : '0';
        $customer->birth_at = $request->input('day').'.'.$request->input('month').'.'.$request->input('year');

        $user->save();
        $customer->save();

        if ($customer->save()) {
            return back()->with(array('CONFIRM'=>'1'));
        } else {
            return back()->with(array('ERROR'=>'1'));
        }
    }

    /**
     * Show all order history.
     *
     * @return \Illuminate\View\View
     */
    public function order()
    {
        $id = Auth::user()->id_user;
        $customer = DB::table('customers')->where('user_id', '=', $id)->first();
        $orders = DB::table('orders')->leftJoin('orders_status', 'orders.status_id', '=', 'orders_status.id_status')
                      ->where('customer_id', '=', $customer->id_customer)
                      ->whereNotIn('status_id',[0])
                      ->orderBy('id_order', 'desc')->get();
        return view('site.customerOrder', compact('orders'));
    }

    /**
     * Customer (member) password update form.
     *
     * @return \Illuminate\View\View
     */
    public function password()
    {
        return view('site.customerPassword');
    }

    /**
     * Update the password.
     *
     * @param  CustomerPasswordRequest $request
     * @return Response
     */
    public function passwordsave(CustomerPasswordRequest $request)
    {
        $id = Auth::user()->id_user;
        $customer = Customer::where('user_id', '=', $id)->first();
        $user = User::where('id_user', '=', $customer->user_id)->where('role', '=', 2)->firstOrFail();
        $user->password = $request->input('password');
        $user->save();

        if ($user->save()) {
            return back()->with(array('CONFIRM'=>'1'));
        } else {
            return back()->with(array('ERROR'=>'1'));
        }
    }
}
