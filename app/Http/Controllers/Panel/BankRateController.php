<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\BankRateRequest;
use App\Models\BankRate;
use App\Models\BankRateGroup;

class BankRateController extends PanelController
{

    /*
    |--------------------------------------------------------------------------
    | rate
    |--------------------------------------------------------------------------
    */


    public function getIndex()
    {
        $rates = BankRate::with('bank')->orderBy('id_rate', 'DESC')->paginate(25);
        return view('panel.module.bankRate.index', compact('rates'));
    }

    public function getNew()
    {
        $banks = BankRateGroup::orderBy('name', 'ASC')->lists('name', 'id_group');
        return view('panel.module.bankRate.new', compact('banks'));
    }

    public function postAdd(BankRateRequest $request)
    {
        $rate = new BankRate;
        $rate->installment = $request->input('installment');
        $rate->rate = $request->input('rate');
        $rate->group_id = $request->input('group_id');
        $rate->save();

        if ($rate->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Sanal pos oranı eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    public function getEdit($id)
    {
        $rates = BankRate::findOrFail($id);
        $banks = BankRateGroup::orderBy('name', 'ASC')->lists('name', 'id_group');
        return view('panel.module.bankRate.edit', compact('rates', 'banks'));
    }

    public function postSave(BankRateRequest $request, $id)
    {
        $rate = BankRate::findOrFail($id);
        $rate->installment = $request->input('installment');
        $rate->rate = $request->input('rate');
        $rate->group_id = $request->input('group_id');
        $rate->save();

        if ($rate->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Sanal pos oranı güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    public function getDelete($id)
    {
        $rate = BankRate::findOrFail($id);
        $rate->delete();

        if (!$rate->delete()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Sanal pos oranı silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }
}
