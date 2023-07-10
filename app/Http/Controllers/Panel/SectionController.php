<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\SectionRequest;
use App\Models\Section;

class SectionController extends PanelController
{
    /**
     * List the right part of the custom page.
     * 
     * It allows pages to be collected in one section.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $sections = Section::orderBy('id_section', 'DESC')->paginate(25);
        return view('panel.module.section.index', compact('sections'));
    }

    /**
     * New page section form.
     *
     * @return \Illuminate\View\View
     */
    public function getNew()
    {
        return view('panel.module.section.new');
    }

    /**
     * Add page section.
     *
     * @param  SectionRequest $request
     * @return Response
     */
    public function postAdd(SectionRequest $request)
    {
        $section = new Section;
        $section->name = $request->input('name');
        $section->save();

        if ($section->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Sayfa bölümü eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    /**
     * Edit page section.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $sections = Section::findOrFail($id);
        return view('panel.module.section.edit', compact('sections'));
    }

    /**
     * Update page section.
     *
     * @param  SectionRequest $request
     * @param  int            $id
     * @return Response
     */
    public function postSave(SectionRequest $request, $id)
    {
        $section = Section::findOrFail($id);
        $section->name = $request->input('name');
        $section->save();

        if ($section->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Sayfa bölümü güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete page section
     *
     * @param  int $id
     * @return Response
     */
    public function getDelete($id)
    {
        $section = Section::findOrFail($id);
        $section->delete();

        if (!$section->delete()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Sayfa bölümü silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }
}
