<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\FooterRequest;
use App\Models\Footer;
use App\Events\FooterMenu;

class FooterController extends PanelController
{
    /**
     * Lists the footer fields.
     * 
     * This design can have a maximum of 3 areas.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $menus = Footer::where('parent_id', '=', '0')->orderBy('sort', 'ASC')->get();
        return view('panel.module.menuFooter.index', compact('menus'));
    }

    /**
     * The selected field shows the subtitles.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getSub($id)
    {
        $parentMenu = Footer::findOrFail($id);
        $menus = Footer::where('parent_id', '=', $id)->orderBy('sort', 'ASC')->paginate(25);
        return view('panel.module.menuFooter.sub', compact('menus', 'parentMenu'));
    }

    /**
     * Create link for footer.
     *
     * @param  FooterRequest $request
     * @return Response
     */
    public function postSubadd(FooterRequest $request)
    {
        $footer = new Footer;
        $footer->name = $request->input('name');
        $footer->url = $request->input('url');
        $footer->sort = $request->input('sort');
        $footer->parent_id = $request->input('parent_id');
        $footer->save();

        if ($footer->save()) {
            event(new FooterMenu($footer));
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Menü eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    /**
     * Update link.
     *
     * @param  FooterRequest $request
     * @param  int           $id
     * @return Response
     */
    public function postSave(FooterRequest $request, $id)
    {
        $footer = Footer::findOrFail($id);
        $footer->name = $request->input('name');
        $footer->url = $request->input('url');
        $footer->sort = $request->input('sort');
        $footer->save();

        if ($footer->save()) {
            event(new FooterMenu($footer));
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Menü güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete link.
     *
     * @param  int $id
     * @return Response
     */
    public function getDelete($id)
    {
        $footer = Footer::findOrFail($id);
        $footer->delete();

        if (!$footer->delete()) {
            event(new FooterMenu($footer));
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Menü silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }
}
