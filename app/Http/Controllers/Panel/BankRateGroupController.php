<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\BankRateGroupRequest;
use App\Models\BankRate;
use App\Models\BankRateGroup;
use Image;
use File;

class BankRateGroupController extends PanelController
{
    /**
     * List of banks that may be installments.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $banks = BankRateGroup::orderBy('sort', 'ASC')->paginate(25);
        return view('panel.module.bankRateGroup.index', compact('banks'));
    }

    /**
     * New bank form.
     *
     * @return \Illuminate\View\View
     */
    public function getNew()
    {
        return view('panel.module.bankRateGroup.new');
    }

    /**
     * Create new bank.
     *
     * @param  BankRateGroupRequest $request
     * @return Response
     */
    public function postAdd(BankRateGroupRequest $request)
    {
        $bank = new BankRateGroup;
        $bank->name = $request->input('name');
        $bank->status = ($request->input('status')=='1') ? '1' : '0';
        $bank->sort = $request->input('sort');

        $name = substr(str_slug($request->input('name')), 0, 25);

        if ($request->hasFile('image')) {
            $upload = $request->file('image');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = $name.'-S'.rand(1, 99999).'.'.$extension;
            $upload->move('media/other/', $uploadname);
            Image::make('media/other/'.$uploadname)->resize(100, 75)->save();
            $bank->image = 'media/other/'.$uploadname;
        }

        $bank->save();

        if ($bank->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Banka eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    /**
     * Edit bank form.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $banks = BankRateGroup::findOrFail($id);
        return view('panel.module.bankRateGroup.edit', compact('banks'));
    }

    /**
     * Update the bank.
     *
     * @param  BankRateGroupRequest $request
     * @param  int                  $id
     * @return Response
     */
    public function postSave(BankRateGroupRequest $request, $id)
    {
        $bank = BankRateGroup::findOrFail($id);
        $bank->name = $request->input('name');
        $bank->status = ($request->input('status')=='1') ? '1' : '0';
        $bank->sort = $request->input('sort');

        $name = substr(str_slug($request->input('name')), 0, 25);

        if ($request->hasFile('image')) {
            File::delete($bank->image);
            $upload = $request->file('image');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = $name.'-S'.rand(1, 99999).'.'.$extension;
            $upload->move('media/other/', $uploadname);
            Image::make('media/other/'.$uploadname)->resize(100, 75)->save();
            $bank->image = 'media/other/'.$uploadname;
        }
        
        $bank->save();

        if ($bank->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Banka bilgileri güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete the bank.
     *
     * @param  int $id
     * @return Response
     */
    public function getDelete($id)
    {
        $bank = BankRateGroup::findOrFail($id);
        File::delete($bank->image);
        $bank->delete();

        if (!$bank->delete()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Kargo firması silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }
}
