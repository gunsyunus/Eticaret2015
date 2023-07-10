<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;

class CouponController extends PanelController
{
    /**
     * List of coupons.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $coupons = Coupon::orderBy('id_coupon', 'DESC')->paginate(25);
        return view('panel.module.coupon.index', compact('coupons'));
    }

    /**
     * Create a percentage or currency based coupon to use cart.
     *
     * @return \Illuminate\View\View
     */
    public function getNew()
    {
        return view('panel.module.coupon.new');
    }

    /**
     * Create a new coupon.
     *
     * @param  CouponRequest $request
     * @return Response
     */
    public function postAdd(CouponRequest $request)
    {
        $coupon = new Coupon;
        $coupon->code = $request->input('code');
        $coupon->total = $request->input('total');
        $coupon->discount_money = $request->input('discount_money');
        $coupon->discount_percent = $request->input('discount_percent');
        $coupon->stock = $request->input('stock');
        $coupon->type = $request->input('type');
        $coupon->save();

        if ($coupon->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Kupon eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    /**
     * Edit the coupon.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $coupons = Coupon::findOrFail($id);
        return view('panel.module.coupon.edit', compact('coupons'));
    }

    /**
     * Update coupon information.
     *
     * @param  CouponRequest $request
     * @param  int           $id
     * @return Response
     */
    public function postSave(CouponRequest $request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->code = $request->input('code');
        $coupon->total = $request->input('total');
        $coupon->discount_money = $request->input('discount_money');
        $coupon->discount_percent = $request->input('discount_percent');
        $coupon->stock = $request->input('stock');
        $coupon->type = $request->input('type');
        $coupon->save();

        if ($coupon->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Kupon bilgileri güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete coupon.
     *
     * @param  int $id
     * @return Response
     */
    public function getDelete($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();

        if (!$coupon->delete()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Kupon silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }
}
