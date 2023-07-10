<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\TaxRequest;
use App\Models\Tax;

class TaxController extends PanelController
{
    /**
     * Tax name and rate list.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $taxs = Tax::orderBy('id_tax', 'DESC')->paginate(25);
        return view('panel.module.tax.index', compact('taxs'));
    }

    /**
     * New tax form.
     *
     * @return \Illuminate\View\View
     */
    public function getNew()
    {
        return view('panel.module.tax.new');
    }

    /**
     * Add tax.
     *
     * @param  TaxRequest $request
     * @return Response
     */
    public function postAdd(TaxRequest $request)
    {
        $tax = new Tax;
        $tax->name = $request->input('name');
        $tax->save();

        if ($tax->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'KDV yüzdesi eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    /**
     * Tax change form.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $taxs = Tax::findOrFail($id);
        return view('panel.module.tax.edit', compact('taxs'));
    }

    /**
     * Update tax.
     * 
     * @param  TaxRequest $request
     * @param  int        $id
     * @return Response
     */
    public function postSave(TaxRequest $request, $id)
    {
        $tax = Tax::findOrFail($id);
        $tax->name = $request->input('name');
        $tax->save();

        if ($tax->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'KDV yüzdesi güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete tax.
     * 
     * @param  int $id
     * @return Response
     */
    public function getDelete($id)
    {
        $tax = Tax::findOrFail($id);
        $tax->delete();

        if (!$tax->delete()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success','alertMessage'=>'KDV yüzdesi silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }
}
