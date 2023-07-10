<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\CountyRequest;
use App\Models\County;
use App\Models\City;

class CountyController extends PanelController
{
    /**
     * The counties are listed along with the city.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $counties = County::with('city')->orderBy('id_county', 'DESC')->paginate(25);
        return view('panel.module.county.index', compact('counties'));
    }

    /**
     * New county adding form.
     *
     * @return \Illuminate\View\View
     */
    public function getNew()
    {
        $cities = City::orderBy('name', 'ASC')->lists('name', 'id_city');
        return view('panel.module.county.new', compact('cities'));
    }

    /**
     * Add county.
     *
     * @param  CountyRequest $request
     * @return Response
     */
    public function postAdd(CountyRequest $request)
    {
        $county = new county;
        $county->name = $request->input('name');
        $county->city_id = $request->input('city_id');
        $county->save();

        if ($county->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'İlçe eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    /**
     * County update form.
     *
     * @param  int $id
     * @return Response
     */
    public function getEdit($id)
    {
        $counties = County::findOrFail($id);
        $cities = City::orderBy('name', 'ASC')->lists('name', 'id_city');
        return view('panel.module.county.edit', compact('counties', 'cities'));
    }

    /**
     * Update county.
     *
     * @param  CountyRequest $request
     * @param  int           $id
     * @return Response
     */
    public function postSave(CountyRequest $request, $id)
    {
        $county = County::findOrFail($id);
        $county->name = $request->input('name');
        $county->city_id = $request->input('city_id');
        $county->save();

        if ($county->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'İlçe güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete the county.
     *
     * @param  int $id
     * @return Response
     */
    public function getDelete($id)
    {
        $county = County::findOrFail($id);
        $county->delete();

        if (!$county->delete()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'İlçe silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }
}
