<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\SiteController;
use App\Http\Requests\AddressCustomerRequest;
use App\Http\Requests\AddressUpdateRequest;
use App\Models\City;
use App\Models\County;
use App\Models\Address;
use Auth;
use DB;

class AddressController extends SiteController
{
    /**
     * List the addresses belonging to the customer.
     *
     * @return \Illuminate\View\View
     */
    public function Index()
    {
        $id = Auth::user()->id_user;
        $myaddress = DB::table('customers_address')
                     ->leftJoin('cities', 'customers_address.city_id', '=', 'cities.id_city')
                     ->where('user_id', '=', $id)->get();
        return view('site.customerAddress', compact('myaddress'));
    }

    /**
     * The customer adds a new address to himself.
     *
     * @return \Illuminate\View\View
     */
    public function Newaddress()
    {
        $cities = array(''=>'Lütfen Seçiniz')+City::orderBy('sort', 'ASC')->lists('name', 'id_city')->all();
        return view('site.customerAddressNew', compact('cities'));
    }

    /**
     * Customer updates his / her address information.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function Edit($id)
    {
        $user_id = Auth::user()->id_user;
        $address = Address::where('user_id', '=', $user_id)->findOrFail($id);
        $city = DB::table('cities')->where('id_city', '=', $address->city_id)->first();
        $counties = array(''=>'Lütfen Seçiniz')+County::where('city_id', '=', $address->city_id)
                                                        ->orderBy('name', 'ASC')
                                                        ->lists('name', 'id_county')->all();
        return view('site.customerAddressEdit', compact('counties', 'address', 'city'));
    }

    /**
     * Add customer address.
     *
     * @param AddressCustomerRequest $request
     * @return Response
     */
    public function Add(AddressCustomerRequest $request)
    {
        $address = new Address;
        $address->title = $request->input('title');
        $address->phone = $request->input('phone');
        $address->address_1 = $request->input('address_1');
        $address->city_id = $request->input('city_id');
        $address->county_id = $request->input('county_id');
        $address->user_id = Auth::user()->id_user;
        $address->save();

        if ($address->save()) {
            return back()->with(array('CONFIRM'=>'1'));
        } else {
            return back()->with(array('ERROR'=>'1'));
        }
    }

    /**
     * Update customer address.
     *
     * @param AddressUpdateRequest $request
     * @param int                  $id
     * @return Response
     */
    public function Save(AddressUpdateRequest $request, $id)
    {
        $user_id = Auth::user()->id_user;
        $address = Address::where('user_id', '=', $user_id)->findOrFail($id);
        $address->title = $request->input('title');
        $address->phone = $request->input('phone');
        $address->address_1 = $request->input('address_1');
        $address->county_id = $request->input('county_id');
        $address->save();

        if ($address->save()) {
            return back()->with(array('CONFIRM'=>'1'));
        } else {
            return back()->with(array('ERROR'=>'1'));
        }
    }
   
    /**
     * The customer deletes the address.
     *
     * @param int $id
     * @return Response
     */
    public function Delete($id)
    {
        $user_id = Auth::user()->id_user;
        $address = Address::where('user_id', '=', $user_id)->findOrFail($id);
        $address->delete();

        if (!$address->delete()) {
            return back()->with(array('CONFIRM'=>'1'));
        } else {
            return back()->with(array('ERROR'=>'1'));
        }
    }
}
