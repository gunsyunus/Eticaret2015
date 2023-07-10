<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\BankRequest;
use App\Models\Bank;

class BankController extends PanelController
{
    /**
     * Payment centers; banks and other.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $banks = Bank::orderBy('id_bank', 'ASC')->paginate(25);
        return view('panel.module.bank.index', compact('banks'));
    }

    /**
     * Make payment centers active / passive.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $banks = Bank::findOrFail($id);
        return view('panel.module.bank.edit', compact('banks'));
    }

    /**
     * Update payment centers methods.
     *
     * @param  BankRequest  $request
     * @param  int          $id
     * @return Response
     */
    public function postSave(BankRequest $request, $id)
    {
        $bank = Bank::findOrFail($id);
        $bank->customer_number = $request->input('customer_number');
        $bank->merchant_number = $request->input('merchant_number');
        $bank->username = $request->input('username');
        $bank->password = $request->input('password');
        $bank->status = ($request->input('status')=='1') ? '1' : '0';
        $bank->save();

        if ($bank->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Banka sanal pos bilgileri güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }
}
