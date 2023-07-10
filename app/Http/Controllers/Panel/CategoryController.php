<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\PanelController;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;

class CategoryController extends PanelController
{
    /**
     * List product categories.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $categories = Category::orderBy('id_category', 'DESC')->paginate(25);
        $selects = Category::get(['id_category','name','sef_url','sort','parent_id','lft','rgt','depth'])
                             ->toHierarchy();
        return view('panel.module.category.index', compact('categories', 'selects'));
    }

    /**
     * Search the categories. (By name or id field)
     *
     * @param  Request $request
     * @return \Illuminate\View\View
     */
    public function getSearch(Request $request)
    {
        $searchText = $request->input('q');
        $categoryID = $request->input('c');

        if ($categoryID=='0') {
            $categories = Category::where('name', 'LIKE', '%'.$searchText.'%')->orderBy('id_category', 'DESC')
                                                                              ->paginate(25);
        } else {
            $categories = Category::where('id_category', '=', $categoryID)->orderBy('id_category', 'DESC')
                                                                          ->paginate(25);
            $searchText = $categories[0]->name;
        }

        $selects = Category::get(['id_category','name','sef_url','sort','parent_id','lft','rgt','depth'])
                             ->toHierarchy();
        return view('panel.module.category.index', compact('categories', 'searchText', 'selects'));
    }

    /**
     * New category form.
     *
     * @return \Illuminate\View\View
     */
    public function getNew()
    {
        $lists = Category::get(['id_category','name','sef_url','sort','parent_id','lft','rgt','depth'])
                           ->toHierarchy();
        return view('panel.module.category.new', compact('lists'));
    }

    /**
     * Add category.
     *
     * @param  CategoryRequest $request
     * @return Response
     */
    public function postAdd(CategoryRequest $request)
    {
        $category = new Category;
        $category->name = $request->input('name');
        $category->title = $request->input('title');
        $category->keyword = $request->input('keyword');
        $category->description = $request->input('description');
        $sort = $request->input('sort');
        $category->sort = empty($sort) ? 9999 : $sort ;
        $category->save();

        $categoryMain = $request->input('categoryMain');
        if ($categoryMain!=0) {
            $category->makeChildOf($categoryMain);
            $category->save();
        }

        if ($category->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Yeni kategori eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    /**
     * Category edit form.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $categories = Category::findOrFail($id);
        $categoryMain = Category::where('id_category', '=', $categories->parent_id)->first();
        $lists = Category::get(['id_category','name','sef_url','sort','parent_id','lft','rgt','depth'])
                           ->toHierarchy();
        return view('panel.module.category.edit', compact('categories', 'lists', 'categoryMain'));
    }

    /**
     * Update category
     *
     * @param  CategoryRequest $request
     * @param  int             $id
     * @return Response
     */
    public function postSave(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->input('name');
        $category->title = $request->input('title');
        $category->keyword = $request->input('keyword');
        $category->description = $request->input('description');
        $sort = $request->input('sort');
        $category->sort = empty($sort) ? 9999 : $sort ;
        $category->save();

        $categoryMainUpdate = $request->input('categoryMain');
        if ($categoryMainUpdate!=0) {
            $category->makeChildOf($categoryMainUpdate);
            $category->save();
        }

        if ($category->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Kategori güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete category.
     *
     * @param  int $id
     * @return Response
     */
    public function getDelete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        if (!$category->delete()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Kategori silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }
}
