<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;

class BrandController extends PanelController
{
    /**
     * List product brands.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $brands = Brand::orderBy('id_brand', 'DESC')->paginate(25);
        return view('panel.module.brand.index', compact('brands'));
    }

    /**
     * A brand new.
     *
     * @return \Illuminate\View\View
     */
    public function getNew()
    {
        return view('panel.module.brand.new');
    }

    /**
     * Add a new brand.
     *
     * @param  BrandRequest $request
     * @return Response
     */
    public function postAdd(BrandRequest $request)
    {
        $brand = new Brand;
        $brand->bname = $request->input('bname');
        $brand->title = $request->input('title');
        $brand->keyword = $request->input('keyword');
        $brand->description = $request->input('description');
        $brand->save();

        if ($brand->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Marka eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }
    
    /**
     * Edit brand information.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $brands = Brand::findOrFail($id);
        return view('panel.module.brand.edit', compact('brands'));
    }

    /**
     * Update brand.
     *
     * @param  BrandRequest $request
     * @param  int          $id
     * @return Response
     */
    public function postSave(BrandRequest $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->bname = $request->input('bname');
        $brand->title = $request->input('title');
        $brand->keyword = $request->input('keyword');
        $brand->description = $request->input('description');
        $brand->save();

        if ($brand->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Marka bilgileri güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete the brand.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getDelete($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        if (!$brand->delete()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Marka silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }
}
