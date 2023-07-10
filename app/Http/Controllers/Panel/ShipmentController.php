<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\ShipmentRequest;
use App\Models\Shipment;
use Image;
use File;

class ShipmentController extends PanelController
{
    /**
     * List shipping companies.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $shipments = Shipment::orderBy('sort', 'ASC')->paginate(25);
        return view('panel.module.shipment.index', compact('shipments'));
    }

    /**
     * New shipment company.
     *
     * @return \Illuminate\View\View
     */
    public function getNew()
    {
        return view('panel.module.shipment.new');
    }

    /**
     * Add shipment company.
     * 
     * @param  ShipmentRequest $request
     * @return Response
     */
    public function postAdd(ShipmentRequest $request)
    {
        $shipment = new Shipment;
        $shipment->name = $request->input('name');
        $shipment->status = ($request->input('status')=='1') ? '1' : '0';
        $shipment->sort = $request->input('sort');

        $name = substr(str_slug($request->input('name')), 0, 25);

        if ($request->hasFile('image')) {
            $upload = $request->file('image');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = $name.'-S'.rand(1, 99999).'.'.$extension;
            $upload->move('media/other/', $uploadname);
            Image::make('media/other/'.$uploadname)->resize(100, 75)->save();
            $shipment->image = 'media/other/'.$uploadname;
        }

        $shipment->save();

        if ($shipment->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Kargo firması eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    /**
     * Edit shipment company form.
     * 
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $shipments = Shipment::findOrFail($id);
        return view('panel.module.shipment.edit', compact('shipments'));
    }

    /**
     * Update shipment company.
     * 
     * @param  ShipmentRequest $request
     * @param  int             $id
     * @return Response
     */
    public function postSave(ShipmentRequest $request, $id)
    {
        $shipment = Shipment::findOrFail($id);
        $shipment->name = $request->input('name');
        $shipment->status = ($request->input('status')=='1') ? '1' : '0';
        $shipment->sort = $request->input('sort');

        $name = substr(str_slug($request->input('name')), 0, 25);

        if ($request->hasFile('image')) {
            File::delete($shipment->image);
            $upload = $request->file('image');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = $name.'-S'.rand(1, 99999).'.'.$extension;
            $upload->move('media/other/', $uploadname);
            Image::make('media/other/'.$uploadname)->resize(100, 75)->save();
            $shipment->image = 'media/other/'.$uploadname;
        }
        $shipment->save();

        if ($shipment->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Kargo firması bilgileri güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete shipment company.
     * 
     * @param  int $id
     * @return Response
     */
    public function getDelete($id)
    {
        $shipment = Shipment::findOrFail($id);
        File::delete($shipment->image);
        $shipment->delete();

        if (!$shipment->delete()) {
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
