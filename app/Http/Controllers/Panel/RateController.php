<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\RateRequest;
use App\Models\Rate;

class RateController extends PanelController
{
    /**
     * Special exchange rates can be defined for product prices.
     * 
     * Lists the types of rate.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $rates = Rate::orderBy('id_rate', 'ASC')->paginate(25);
        return view('panel.module.rate.index', compact('rates'));
    }

    /**
     * New rate creation form.
     *
     * @return \Illuminate\View\View
     */
    public function getNew()
    {
        return view('panel.module.rate.new');
    }

    /**
     * Add rate.
     *
     * @param  RateRequest $request
     * @return Response
     */
    public function postAdd(RateRequest $request)
    {
        $rate = new Rate;
        $rate->name = $request->input('name');
        $rate->amount = $request->input('amount');
        $rate->save();

        if ($rate->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Döviz cinsi eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    /**
     * Rate edit form.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $rates = Rate::findOrFail($id);
        return view('panel.module.rate.edit', compact('rates'));
    }

    /**
     * Update rate.
     *
     * @param  RateRequest $request
     * @param  int         $id
     * @return Response
     */
    public function postSave(RateRequest $request, $id)
    {

        // Three records to update, default values
        if ($id<=3) {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Üzgünüz, bu kayıt üzerinde işlem yapılamaz !'));
        }
        
        $rate = Rate::findOrFail($id);
        $rate->name = $request->input('name');
        $rate->amount = $request->input('amount');
        $rate->save();

        if ($rate->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Döviz cinsi güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete rate.
     *
     * @param  int $id
     * @return Response
     */
    public function getDelete($id)
    {

        // Three records deleted, default values
        if ($id<=3) {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Üzgünüz, bu kayıt üzerinde işlem yapılamaz !'));
        }

        $rate = Rate::findOrFail($id);
        $rate->delete();

        if (!$rate->delete()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Döviz cinsi silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }
}
