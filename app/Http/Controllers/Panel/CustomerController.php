<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\PanelController;
use App\Http\Requests\CustomerCreateRequest;
use App\Http\Requests\CustomerPasswordRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use App\Models\City;
use App\Models\Address;
use App\Models\User;
use DB;

class CustomerController extends PanelController
{
    /**
     * Lists all customers.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $customers = Customer::with('user')->orderBy('id_customer', 'DESC')->paginate(25);
        return view('panel.module.customer.index', compact('customers'));
    }

    /**
     * Search by customer information: name, surname, email, phone.
     *
     * @param  Request $request
     * @return \Illuminate\View\View
     */
    public function getSearch(Request $request)
    {
        $searchText = $request->input('q');

        $customers = Customer::whereHas('user', function ($q) use ($searchText) {
            $q->where(DB::raw('CONCAT(name," ",surname)'), 'LIKE', '%'.$searchText.'%');
        })
        ->orWhereHas('user', function ($q) use ($searchText) {
            $q->where('email', 'LIKE', '%'.$searchText.'%');
        })
        ->orWhere('phone', 'LIKE', '%'.$searchText.'%')
        ->orderBy('id_customer', 'DESC')->paginate(25);

        return view('panel.module.customer.index', compact('customers', 'searchText'));
    }

    /**
     * List customer addresses.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getAddress($id)
    {
        $users = User::where('id_user', '=', $id)->where('role', '=', 2)->firstOrFail();
        $customers = Customer::where('user_id', '=', $id)->firstOrFail();
        $cities = array('0'=>'Lütfen Seçiniz')+City::orderBy('name', 'ASC')->lists('name', 'id_city')->all();
        $myaddress = Address::with('city', 'county')->where('user_id', '=', $id)->orderBy('id_address', 'DESC')->get();
        return view('panel.module.customer.address', compact('myaddress', 'cities', 'users', 'customers'));
    }

    /**
     * New customer.
     *
     * @return \Illuminate\View\View
     */
    public function getNew()
    {
        $cities = array('0'=>'Lütfen Seçiniz')+City::orderBy('name', 'ASC')->lists('name', 'id_city')->all();
        return view('panel.module.customer.new', compact('cities'));
    }

    /**
     * Customer add.
     *
     * @param  CustomerCreateRequest $request
     * @return Response
     */
    public function postAdd(CustomerCreateRequest $request)
    {
        $user = new User;
        $customer = new Customer;

        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->role = 2;

        $customer->phone = $request->input('phone');
        $customer->phone_other = $request->input('phone_other');
        $customer->gender = $request->input('gender');
        $customer->newsletter_status = ($request->input('newsletter_status')=='1') ? '1' : '0';
        $customer->stock_order = $request->input('stock_order');
        $customer->birth_at = $request->input('birth_at');
        $customer->city_id = $request->input('city_id');
        $customer->register_device = $request->input('register_device');

        $user->save();

        if ($user->save()) {
            $customer->user_id = $user->id_user;
            $customer->save();
        }

        if ($customer->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Yeni üye eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    /**
     * Customer edit form.
     *
     * @param  int $id
     * @return Response
     */
    public function getEdit($id)
    {
        $customers = Customer::findOrFail($id);
        $users = User::where('id_user', '=', $customers->user_id)->where('role', '=', 2)->firstOrFail();
        $cities = array('0'=>'Lütfen Seçiniz')+City::orderBy('name', 'ASC')->lists('name', 'id_city')->all();
        return view('panel.module.customer.edit', compact('customers', 'cities', 'users'));
    }

    /**
     * Customer password edit form.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getPassword($id)
    {
        $users = User::where('id_user', '=', $id)->where('role', '=', 2)->firstOrFail();
        return view('panel.module.customer.password', compact('users'));
    }

    /**
     * Update customer data.
     *
     * @param  CustomerUpdateRequest $request
     * @param  int                   $id
     * @return Response
     */
    public function postSave(CustomerUpdateRequest $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $user = User::where('id_user', '=', $customer->user_id)->where('role', '=', 2)->firstOrFail();

        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->email = $request->input('email');
        
        $customer->phone = $request->input('phone');
        $customer->phone_other = $request->input('phone_other');
        $customer->gender = $request->input('gender');
        $customer->newsletter_status = ($request->input('newsletter_status')=='1') ? '1' : '0';
        $customer->stock_order = $request->input('stock_order');
        $customer->birth_at = $request->input('birth_at');
        $customer->city_id = $request->input('city_id');
        $customer->register_device = $request->input('register_device');

        $user->save();
        $customer->save();

        if ($customer->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Üye bilgileri güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Customer password data update.
     *
     * @param  CustomerPasswordRequest $request
     * @param  int                     $id
     * @return Response
     */
    public function postPasswordsave(CustomerPasswordRequest $request, $id)
    {
        $user = User::where('id_user', '=', $id)->where('role', '=', 2)->firstOrFail();
        $user->password = $request->input('password');
        $user->save();

        if ($user->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Üye şifresi başarıyla güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete the member in a way that is impossible to return.
     *
     * @param  int $id
     * @return Response
     */
    public function getDelete($id)
    {
        $customer = Customer::findOrFail($id);
        $user = User::where('id_user', '=', $customer->user_id)->where('role', '=', 2)->firstOrFail();
        $user->delete();
        $customer->delete();

        if (!$customer->delete()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Üye başarıyla silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }
}
