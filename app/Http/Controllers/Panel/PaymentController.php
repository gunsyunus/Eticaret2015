<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\PaymentRequest;
use App\Models\Payment;

class PaymentController extends PanelController
{
    /**
     * List payment methods.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $payments = Payment::orderBy('sort', 'ASC')->paginate(25);
        return view('panel.module.payment.index', compact('payments'));
    }

    /**
     * Form of payment type active / passive.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $payments = Payment::findOrFail($id);
        return view('panel.module.payment.edit', compact('payments'));
    }

    /**
     * Update payment methods.
     *
     * @param  PaymentRequest $request
     * @param  int            $id
     * @return Response
     */
    public function postSave(PaymentRequest $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->sort = $request->input('sort');
        $payment->status = ($request->input('status')=='1') ? '1' : '0';
        $payment->save();

        if ($payment->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Ödeme tipi güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }
}
