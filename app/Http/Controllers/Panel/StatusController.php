<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\StatusRequest;
use App\Models\Status;

class StatusController extends PanelController
{
    /**
     * List custom order statuses.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $statuses = Status::orderBy('sort', 'ASC')->paginate(25);
        return view('panel.module.status.index', compact('statuses'));
    }

    /**
     * New custom order status form.
     *
     * @return \Illuminate\View\View
     */
    public function getNew()
    {
        return view('panel.module.status.new');
    }

    /**
     * Add order status.
     *
     * @param  StatusRequest $request
     * @return Response
     */
    public function postAdd(StatusRequest $request)
    {
        $status = new Status;
        $status->name = $request->input('name');
        $status->sort = $request->input('sort');
        $status->save();

        if ($status->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Sipariş durumu eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    /**
     * Custom order status update form.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $statuses = Status::findOrFail($id);
        return view('panel.module.status.edit', compact('statuses'));
    }

    /**
     * Update order custom status.
     *
     * @param  StatusRequest $request
     * @param  int           $id
     * @return Response
     */
    public function postSave(StatusRequest $request, $id)
    {

        // Five records to update, default values
        if ($id<=5) {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Üzgünüz, bu kayıt üzerinde işlem yapılamaz !'));
        }
        
        $status = Status::findOrFail($id);
        $status->name = $request->input('name');
        $status->sort = $request->input('sort');
        $status->save();

        if ($status->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Sipariş durumu güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete order custom status.
     *
     * @param  int $id
     * @return Repsonse
     */
    public function getDelete($id)
    {

        // Five records deleted, default values
        if ($id<=5) {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Üzgünüz, bu kayıt üzerinde işlem yapılamaz !'));
        }

        $status = Status::findOrFail($id);
        $status->delete();

        if (!$status->delete()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Sipariş durumu silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }
}
