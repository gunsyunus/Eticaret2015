<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\AddressPanelRequest;
use App\Models\Address;
use App\Models\County;
use Response;

class AddressController extends PanelController
{
    /**
     * The address the customer will use when creating the order.
     *
     * @param  AddressPanelRequest $request
     * @return Response
     */
    public function postAdd(AddressPanelRequest $request)
    {
        $address = new Address;
        $address->title = $request->input('title');
        $address->phone = $request->input('phone');
        $address->address_1 = $request->input('address_1');
        $address->city_id = $request->input('city_id');
        $address->county_id = $request->input('county_id');
        $address->user_id = $request->input('user_id');
        $address->save();

        if ($address->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Üye adresi eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    /**
     * Add a new address to the customer.
     *
     * @param  AddressPanelRequest $request
     * @param  int                 $id
     * @return Response
     */
    public function postSave(AddressPanelRequest $request, $id)
    {
        $address = Address::findOrFail($id);
        $address->title = $request->input('title');
        $address->phone = $request->input('phone');
        $address->address_1 = $request->input('address_1');
        $address->save();

        if ($address->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Üye adresi güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete customer address.
     *
     * @param  int $id
     * @return Response
     */
    public function getDelete($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();

        if (!$address->delete()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Üye adresi silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }

    /**
     * When the city is selected, the list of cities.
     *
     * @param  int $id
     * @return Response
     */
    public function getCountylist($id)
    {
        $counties = County::where('city_id', '=', $id)->orderBy('name', 'ASC')->get(['id_county','name']);
        return Response::json($counties);
    }
}
