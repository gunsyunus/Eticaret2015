<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Models\Section;
use Sef;

class PageController extends PanelController
{
    /**
     * List of all special pages
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $pages = Page::orderBy('id_page', 'DESC')->paginate(25);
        return view('panel.module.page.index', compact('pages'));
    }

    /**
     * New special page.
     *
     * @return \Illuminate\View\View
     */
    public function getNew()
    {
        $sections = array('0'=>'Bölüm Yok')+Section::orderBy('name', 'ASC')->lists('name', 'id_section')->all();
        return view('panel.module.page.new', compact('sections'));
    }

    /**
     * Create page.
     *
     * @param  PageRequest $request
     * @return Response
     */
    public function postAdd(PageRequest $request)
    {
        $page = new Page;
        $page->title = $request->input('title');
        $page->keyword = $request->input('keyword');
        $page->description = $request->input('description');
        $page->content = $request->input('content');
        $page->status = ($request->input('status')=='1') ? '1' : '0';
        $page->sort = $request->input('sort');
        $page->section_id = $request->input('section_id');
        $page->save();

        $url = Sef::page($page->sef_url);

        if ($page->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Sayfa eklendi. 
                                       <br /><i class="fa fa-link"></i> <strong>LİNK :</strong> '.$url));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    /**
     * Edit special page.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $pages = Page::findOrFail($id);
        $sections = array('0'=>'Bölüm Yok')+Section::orderBy('name', 'ASC')->lists('name', 'id_section')->all();
        return view('panel.module.page.edit', compact('pages', 'sections'));
    }

    /**
     * Update special page.
     *
     * @param  PageRequest $request
     * @param  int         $id
     * @return Response
     */
    public function postSave(PageRequest $request, $id)
    {
        $page = Page::findOrFail($id);
        $page->title = $request->input('title');
        $page->keyword = $request->input('keyword');
        $page->description = $request->input('description');
        $page->content = $request->input('content');
        $page->status = ($request->input('status')=='1') ? '1' : '0';
        $page->sort = $request->input('sort');
        $page->section_id = $request->input('section_id');
        $page->save();

        if ($page->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Sayfa güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete special page.
     *
     * @param  int      $id
     * @return Response
     */
    public function getDelete($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();

        if (!$page->delete()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Sayfa silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }
}
