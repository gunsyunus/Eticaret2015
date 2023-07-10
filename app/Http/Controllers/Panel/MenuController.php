<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\PanelController;
use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Image;
use File;

class MenuController extends PanelController
{
    /**
     * Menu management and list for website.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $menus = Menu::where('parent_id', '=', '0')->orderBy('sort', 'ASC')->paginate(25);
        return view('panel.module.menu.index', compact('menus'));
    }

    /**
     * The menu lists the sub-links.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getSub($id)
    {
        $parentMenu = Menu::findOrFail($id);
        $menus = Menu::where('parent_id', '=', $id)->orderBy('sort', 'ASC')->paginate(25);
        return view('panel.module.menu.sub', compact('menus', 'parentMenu'));
    }

    /**
     * New menu form.
     *
     * @return \Illuminate\View\View
     */
    public function getNew()
    {
        return view('panel.module.menu.new');
    }

    /**
     * Create new menu.
     *
     * @param  MenuRequest $request
     * @return Response
     */
    public function postAdd(MenuRequest $request)
    {
        $menu = new Menu;
        $menu->name = $request->input('name');
        $menu->status = ($request->input('status')=='1') ? '1' : '0';
        $menu->url = $request->input('url');
        $menu->sort = $request->input('sort');
        $menu->type = $request->input('type');
        if ($menu->type != 'single') {
            $menu->tree = '{"menu":[]}';
        }
        $menu->save();

        $id_menu = $menu->id_menu;

        switch ($menu->type) {
            case 'three':
                    $menus = [
                             ['name'=>'Kategori - 1','url'=>'#','sort'=>'1','status'=>'1','parent_id'=>$id_menu],
                             ['name'=>'Kategori - 2','url'=>'#','sort'=>'2','status'=>'1','parent_id'=>$id_menu],
                             ['name'=>'Kategori - 3','url'=>'#','sort'=>'3','status'=>'1','parent_id'=>$id_menu],
                    ];
                    Menu::insert($menus);
            break;
            case 'four':
                    $menus =  [
                              ['name'=>'Kategori - 1','url'=>'#','sort'=>'1','status'=>'1','parent_id'=>$id_menu],
                              ['name'=>'Kategori - 2','url'=>'#','sort'=>'2','status'=>'1','parent_id'=>$id_menu],
                              ['name'=>'Kategori - 3','url'=>'#','sort'=>'3','status'=>'1','parent_id'=>$id_menu],
                              ['name'=>'Kategori - 4','url'=>'#','sort'=>'4','status'=>'1','parent_id'=>$id_menu],
                    ];
                    Menu::insert($menus);
            break;
            case 'five':
                    $menus =  [
                              ['name'=>'Kategori - 1','url'=>'#','sort'=>'1','status'=>'1','parent_id'=>$id_menu],
                              ['name'=>'Kategori - 2','url'=>'#','sort'=>'2','status'=>'1','parent_id'=>$id_menu],
                              ['name'=>'Kategori - 3','url'=>'#','sort'=>'3','status'=>'1','parent_id'=>$id_menu],
                              ['name'=>'Kategori - 4','url'=>'#','sort'=>'4','status'=>'1','parent_id'=>$id_menu],
                              ['name'=>'Kategori - 5','url'=>'#','sort'=>'5','status'=>'1','parent_id'=>$id_menu],
                    ];
                    Menu::insert($menus);
            break;
        }

        if ($menu->save()) {
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
     * Create new submenu.
     *
     * @param  MenuRequest $request
     * @return Response
     */
    public function postSubadd(MenuRequest $request)
    {
        $menu = new Menu;
        $menu->name = $request->input('name');
        $menu->status = ($request->input('status')=='1') ? '1' : '0';
        $menu->url = $request->input('url');
        $menu->sort = $request->input('sort');
        $menu->parent_id = $request->input('parent_id');
        
        $name = substr(str_slug($request->input('name')), 0, 25);

        if ($request->hasFile('image')) {
            $upload = $request->file('image');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = $name.'-B'.rand(1, 99999).'.'.$extension;
            $upload->move('media/menu/', $uploadname);
            Image::make('media/menu/'.$uploadname)->resize(268, 130)->save();
            $menu->image = 'media/menu/'.$uploadname;
        }

        $menu->save();

        if ($menu->save()) {
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
     * Edit the menu.
     *
     * @param  int $id
     * @return Response
     */
    public function getEdit($id)
    {
        $menus = Menu::findOrFail($id);

        if ($menus->type=='single') {
            return view('panel.module.menu.single', compact('menus'));
        } elseif ($menus->type=='image') {
            $dropdownMenus = Menu::where('parent_id', '=', $id)->orderBy('sort', 'ASC')->get();
            return view('panel.module.menu.image', compact('menus', 'dropdownMenus'));
        } elseif ($menus->type=='dropdown') {
            $dropdownMenus = Menu::where('parent_id', '=', $id)->orderBy('sort', 'ASC')->get();
            return view('panel.module.menu.dropdown', compact('menus', 'dropdownMenus'));
        } elseif ($menus->type=='three') {
            $threeMenus = Menu::where('parent_id', '=', $id)->orderBy('sort', 'ASC')->get();
            return view('panel.module.menu.three', compact('menus', 'threeMenus'));
        } elseif ($menus->type=='four') {
            $fourMenus = Menu::where('parent_id', '=', $id)->orderBy('sort', 'ASC')->get();
            return view('panel.module.menu.four', compact('menus', 'fourMenus'));
        } elseif ($menus->type=='five') {
            $fiveMenus = Menu::where('parent_id', '=', $id)->orderBy('sort', 'ASC')->get();
            return view('panel.module.menu.five', compact('menus', 'fiveMenus'));
        }
    }

    /**
     * Update the menu.
     *
     * @param  MenuRequest $request
     * @param  int         $id
     * @return Response
     */
    public function postSave(MenuRequest $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->name = $request->input('name');
        $menu->status = ($request->input('status')=='1') ? '1' : '0';
        $menu->url = $request->input('url');
        $menu->sort = $request->input('sort');

        $name = substr(str_slug($request->input('name')), 0, 25);

        if ($request->hasFile('image')) {
            File::delete($menu->image);
            $upload = $request->file('image');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = $name.'-B'.rand(1, 99999).'.'.$extension;
            $upload->move('media/menu/', $uploadname);
            switch ($request->input('imageType')) {
                case '268':
                    Image::make('media/menu/'.$uploadname)->resize(268, 130)->save();
                break;
                case '400':
                    Image::make('media/menu/'.$uploadname)->resize(400, 200)->save();
                break;
                case '200':
                    Image::make('media/menu/'.$uploadname)->resize(200, 200)->save();
                break;
                case '100':
                    Image::make('media/menu/'.$uploadname)->resize(200, 100)->save();
                break;
            }
            $menu->image = 'media/menu/'.$uploadname;
        }

        $menu->save();
            
        if ($menu->type == 'dropdown') {
            $dropdown = Menu::where('parent_id', '=', $menu->id_menu)
                              ->orderBy('sort', 'ASC')
                              ->select('id_menu', 'name', 'url')->get();
            $menu->tree = json_encode(array('menu'=>$dropdown));
            $menu->save();
        } elseif ($menu->type == 'image') {
            $dropdown = Menu::where('parent_id', '=', $menu->id_menu)
                              ->orderBy('sort', 'ASC')
                              ->select('id_menu', 'name', 'url', 'image')->get();
            $menu->tree = json_encode(array('menu'=>$dropdown));
            $menu->save();
        } elseif ($menu->type == 'three' or $menu->type == 'four' or $menu->type == 'five') {
            $dropdown = Menu::where('parent_id', '=', $menu->id_menu)
                              ->orderBy('sort', 'ASC')
                              ->select('id_menu', 'name', 'url', 'image')->get();
            foreach ($dropdown as $key => $value) {
                $json['id_menu'] = (int) $value['id_menu'];
                $json['name'] = $value['name'];
                $json['url'] = $value['url'];
                $json['image'] = $value['image'];
                $json['child'] = Menu::where('parent_id', '=', $value->id_menu)
                                       ->orderBy('sort', 'ASC')
                                       ->select('id_menu', 'name', 'url')->get();
                $data[] = $json;
                unset($json);
            }
            $menu->tree = json_encode(array('menu'=>$data));
            $menu->save();
        }

        if ($menu->save()) {
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
     * Delete the menu.
     *
     * @param  int $id
     * @return Response
     */
    public function getDelete($id)
    {
        $menu = Menu::findOrFail($id);
        File::delete($menu->image);
        $menu->delete();

        if (!$menu->delete()) {
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
