<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\CityRequest;
use App\Models\City;

class CityController extends PanelController
{
    /**
     * List all cities.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $cities = City::orderBy('id_city', 'DESC')->paginate(25);
        return view('panel.module.city.index', compact('cities'));
    }

    /**
     * New city form.
     *
     * @return \Illuminate\View\View
     */
    public function getNew()
    {
        return view('panel.module.city.new');
    }

    /**
     * Add city.
     *
     * @param  CityRequest $request
     * @return Response
     */
    public function postAdd(CityRequest $request)
    {
        $city = new City;
        $city->name = $request->input('name');
        $city->sort = $request->input('sort');
        $city->save();

        if ($city->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Şehir eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    /**
     * Show city information.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $cities = City::findOrFail($id);
        return view('panel.module.city.edit', compact('cities'));
    }

    /**
     * Update city information.
     *
     * @param  CityRequest $request
     * @param  int         $id
     * @return Response
     */
    public function postSave(CityRequest $request, $id)
    {
        $city = City::findOrFail($id);
        $city->name = $request->input('name');
        $city->sort = $request->input('sort');
        $city->save();

        if ($city->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Şehir güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete the city.
     *
     * @param  int $id
     * @return Response
     */
    public function getDelete($id)
    {
        $city = City::findOrFail($id);
        $city->delete();

        if (!$city->delete()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Şehir silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }
}
