<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use App\Http\Controllers\PanelController;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Rate;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Tax;
use App\Models\Option;
use App\Models\Gallery;
use App\Models\Setting;
use Image;
use File;
use DB;

class ProductController extends PanelController
{
    /**
     * List of products.
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        $products = Product::orderBy('id_product', 'DESC')->paginate(25);
        return view('panel.module.product.index', compact('products'));
    }

    /**
     * Search by product name and code.
     *
     * @param  Request $request
     * @return \Illuminate\View\View
     */
    public function getSearch(Request $request)
    {
        $searchText = $request->input('q');
        $products = Product::where('name', 'LIKE', '%'.$searchText.'%')->orWhere('code', 'LIKE', '%'.$searchText.'%')
                                                                       ->orderBy('id_product', 'DESC')
                                                                       ->paginate(25);
        return view('panel.module.product.index', compact('products', 'searchText'));
    }

    /**
     * New product creation form.
     *
     * @return \Illuminate\View\View
     */
    public function getNew()
    {
        $settings = Setting::findOrFail(1);
        $brands = array('0'=>'Markasız')+Brand::orderBy('bname', 'ASC')->lists('bname', 'id_brand')->all();
        $categories = Category::get(['id_category','name','sef_url','sort','parent_id','lft','rgt','depth'])
                                ->toHierarchy();
        $taxs = array('0'=>'KDV Dahil')+Tax::orderBy('name', 'ASC')->lists('name', 'name')->all();
        $rates = Rate::orderBy('id_rate', 'ASC')->lists('name', 'id_rate');
        return view('panel.module.product.new', compact('brands', 'categories', 'taxs', 'rates', 'settings'));
    }

    /**
     * Search by category name.
     *
     * @return \Illuminate\View\View
     */
    public function getDetail()
    {
        $brands = array('0'=>'Marka Seçiniz')+Brand::orderBy('bname', 'ASC')->lists('bname', 'id_brand')->all();
        $categories = Category::get(['id_category','name','sef_url','sort','parent_id','lft','rgt','depth'])
                                ->toHierarchy();
        return view('panel.module.product.detail', compact('brands', 'categories'));
    }

    /**
     * List all products belonging to the category.
     *
     * @param  Request $request
     * @return \Illuminate\View\View
     */
    public function getDetailsearch(Request $request)
    {
        $searchText = $request->input('q');
        if ($searchText==0) {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Lütfen kategori seçiniz !'));
        }
        $category = Category::findOrFail($searchText);
        $categoryText = $category->name;
        $products = Product::where('category_id', '=', $searchText)->orderBy('id_product', 'DESC')->paginate(25);
        return view('panel.module.product.index', compact('products', 'searchText', 'categoryText'));
    }

    /**
     * Add product.
     *
     * @param  ProductRequest $request
     * @return Response
     */
    public function postAdd(ProductRequest $request)
    {
        $newProduct = new Product;
        $newProduct->name = $request->input('name');
        $newProduct->code = $request->input('code');
        $newProduct->title = $request->input('title');
        $newProduct->keyword = $request->input('keyword');
        $newProduct->description = $request->input('description');
        $newProduct->price = $request->input('price');
        $newProduct->price_old = $request->input('price_old');
        $newProduct->price_tier = $request->input('price_tier');
        $newProduct->tax = $request->input('tax');
        $newProduct->cargo_weight = $request->input('cargo_weight');
        $newProduct->supply_company_name = $request->input('supply_company_name');
        $newProduct->promotion_text = $request->input('promotion_text');
        $newProduct->content = $request->input('content');
        $newProduct->short_content = $request->input('short_content');
        $newProduct->stock = $request->input('stock');
        $newProduct->status = ($request->input('status')=='1') ? '1' : '0';
        $newProduct->option_status = ($request->input('option_status')=='1') ? '1' : '0';
        $newProduct->showcase_status = ($request->input('showcase_status')=='1') ? '1' : '0';
        $newProduct->private_status_1 = ($request->input('private_status_1')=='1') ? '1' : '0';
        $newProduct->private_status_2 = ($request->input('private_status_2')=='1') ? '1' : '0';
        $newProduct->private_status_3 = ($request->input('private_status_3')=='1') ? '1' : '0';
        $newProduct->private_status_4 = ($request->input('private_status_4')=='1') ? '1' : '0';
        $newProduct->private_status_5 = ($request->input('private_status_5')=='1') ? '1' : '0';
        $newProduct->outlet_status = ($request->input('outlet_status')=='1') ? '1' : '0';
        $newProduct->showcase_sort = $request->input('showcase_sort');
        $newProduct->private_sort = $request->input('private_sort');
        $newProduct->category_sort = $request->input('category_sort');
        $newProduct->brand_sort = $request->input('brand_sort');
        $newProduct->barcode_ean = $request->input('barcode_ean');
        $newProduct->barcode_upc = $request->input('barcode_upc');
        $newProduct->barcode_jan = $request->input('barcode_jan');
        $newProduct->shelf_code = $request->input('shelf_code');
        $newProduct->rate_id = $request->input('rate_id');
        $newProduct->brand_id = $request->input('brand_id');
        $newProduct->category_id = $request->input('category_id');

        $title = substr(str_slug($request->input('name')), 0, 25);

        $setting = Setting::findOrFail(1);

        if ($request->hasFile('image1')) {
            $upload = $request->file('image1');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = $title.'-B'.rand(1, 99999).'.'.$extension;
            $uploadnameSmall = $title.'-S'.rand(1, 99999).'.'.$extension;
            $upload->move('media/product/', $uploadname);
            Image::make('media/product/'.$uploadname)
                   ->resize($setting->product_big_width, $setting->product_big_height)
                   ->save();
            Image::make('media/product/'.$uploadname)
                   ->resize($setting->product_small_width, $setting->product_small_height)
                   ->save('media/product/small/'.$uploadnameSmall);
            $newProduct->image_small_1 = 'media/product/small/'.$uploadnameSmall;
            $newProduct->image_big_1 = 'media/product/'.$uploadname;
        }

        if ($request->hasFile('image2')) {
            $upload = $request->file('image2');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = $title.'-B'.rand(1, 99999).'.'.$extension;
            $uploadnameSmall = $title.'-S'.rand(1, 99999).'.'.$extension;
            $upload->move('media/product/', $uploadname);
            Image::make('media/product/'.$uploadname)
                   ->resize($setting->product_big_width, $setting->product_big_height)
                   ->save();
            Image::make('media/product/'.$uploadname)
                   ->resize($setting->product_small_width, $setting->product_small_height)
                   ->save('media/product/small/'.$uploadnameSmall);
            $newProduct->image_small_2 = 'media/product/small/'.$uploadnameSmall;
            $newProduct->image_big_2 = 'media/product/'.$uploadname;
        }

        $newProduct->save();

        if ($newProduct->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                     'alertClass'=>'success',
                                     'alertMessage'=>'Ürün eklendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt eklerken hata oluştu !'));
        }
    }

    /**
     * Product edit form.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getEdit($id)
    {
        $settings = Setting::findOrFail(1);
        $products = Product::findOrFail($id);
        $brands = array('0'=>'Markasız')+Brand::orderBy('bname', 'ASC')->lists('bname', 'id_brand')->all();
        $categories = Category::get(['id_category','name','sef_url','sort','parent_id','lft','rgt','depth'])
                                ->toHierarchy();
        $categoryMain = Category::where('id_category', '=', $products->category_id)->first();
        $taxs = array('0'=>'KDV Dahil')+Tax::orderBy('name', 'ASC')->lists('name', 'name')->all();
        $rates = Rate::orderBy('id_rate', 'ASC')->lists('name', 'id_rate');
        return view('panel.module.product.edit', compact('products', 'brands', 'categories',
                                                         'taxs', 'rates', 'categoryMain', 'settings'));
    }

    /**
     * Update product.
     *
     * @param  ProductRequest $request
     * @param  int            $id
     * @return Response
     */
    public function postSave(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->input('name');
        $product->code = $request->input('code');
        $product->title = $request->input('title');
        $product->keyword = $request->input('keyword');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->price_old = $request->input('price_old');
        $product->price_tier = $request->input('price_tier');
        $product->tax = $request->input('tax');
        $product->cargo_weight = $request->input('cargo_weight');
        $product->supply_company_name = $request->input('supply_company_name');
        $product->promotion_text = $request->input('promotion_text');
        $product->content = $request->input('content');
        $product->short_content = $request->input('short_content');
        $product->stock = $request->input('stock');
        $product->status = ($request->input('status')=='1') ? '1' : '0';
        $product->option_status = ($request->input('option_status')=='1') ? '1' : '0';
        $product->showcase_status = ($request->input('showcase_status')=='1') ? '1' : '0';
        $product->private_status_1 = ($request->input('private_status_1')=='1') ? '1' : '0';
        $product->private_status_2 = ($request->input('private_status_2')=='1') ? '1' : '0';
        $product->private_status_3 = ($request->input('private_status_3')=='1') ? '1' : '0';
        $product->private_status_4 = ($request->input('private_status_4')=='1') ? '1' : '0';
        $product->private_status_5 = ($request->input('private_status_5')=='1') ? '1' : '0';
        $product->outlet_status = ($request->input('outlet_status')=='1') ? '1' : '0';
        $product->showcase_sort = $request->input('showcase_sort');
        $product->private_sort = $request->input('private_sort');
        $product->category_sort = $request->input('category_sort');
        $product->brand_sort = $request->input('brand_sort');
        $product->barcode_ean = $request->input('barcode_ean');
        $product->barcode_upc = $request->input('barcode_upc');
        $product->barcode_jan = $request->input('barcode_jan');
        $product->shelf_code = $request->input('shelf_code');
        $product->rate_id = $request->input('rate_id');
        $product->brand_id = $request->input('brand_id');
        $product->category_id = $request->input('category_id');

        $title = substr(str_slug($request->input('name')), 0, 25);

        $setting = Setting::findOrFail(1);

        if ($request->hasFile('image1')) {
            File::delete($product->image_small_1);
            File::delete($product->image_big_1);
            $upload = $request->file('image1');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = $title.'-B'.rand(1, 99999).'.'.$extension;
            $uploadnameSmall = $title.'-S'.rand(1, 99999).'.'.$extension;
            $upload->move('media/product/', $uploadname);
            Image::make('media/product/'.$uploadname)
                   ->resize($setting->product_big_width, $setting->product_big_height)
                   ->save();
            Image::make('media/product/'.$uploadname)
                   ->resize($setting->product_small_width, $setting->product_small_height)
                   ->save('media/product/small/'.$uploadnameSmall);
            $product->image_small_1 = 'media/product/small/'.$uploadnameSmall;
            $product->image_big_1 = 'media/product/'.$uploadname;
        }

        if ($request->hasFile('image2')) {
            File::delete($product->image_small_2);
            File::delete($product->image_big_2);
            $upload = $request->file('image2');
            $filename = $upload->getClientOriginalName();
            $extension = $upload->getClientOriginalExtension();
            $uploadname = $title.'-B'.rand(1, 99999).'.'.$extension;
            $uploadnameSmall = $title.'-S'.rand(1, 99999).'.'.$extension;
            $upload->move('media/product/', $uploadname);
            Image::make('media/product/'.$uploadname)
                   ->resize($setting->product_big_width, $setting->product_big_height)
                   ->save();
            Image::make('media/product/'.$uploadname)
                   ->resize($setting->product_small_width, $setting->product_small_height)
                   ->save('media/product/small/'.$uploadnameSmall);
            $product->image_small_2 = 'media/product/small/'.$uploadnameSmall;
            $product->image_big_2 = 'media/product/'.$uploadname;
        }

        $product->save();

        if ($product->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Ürün güncellendi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt güncellerken hata oluştu !'));
        }
    }

    /**
     * Delete product.
     *
     * @param  int $id
     * @return Response
     */
    public function getDelete($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image_small_1) {
            File::copy($product->image_small_1, str_replace('media/product/small/', 'media/temp/small/',
            $product->image_small_1));
        }

        if ($product->image_small_2) {
            File::copy($product->image_small_2, str_replace('media/product/small/', 'media/temp/small/',
            $product->image_small_2));
        }

        if ($product->image_big_1) {
            File::copy($product->image_big_1, str_replace('media/product/', 'media/temp/big/',
            $product->image_big_1));
        }

        if ($product->image_big_2) {
            File::copy($product->image_big_2, str_replace('media/product/', 'media/temp/big/',
            $product->image_big_2));
        }

        File::delete($product->image_small_1);
        File::delete($product->image_small_2);
        File::delete($product->image_big_1);
        File::delete($product->image_big_2);
        $product->delete();

        if (!$product->delete()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Ürün silindi.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Kayıt silinirken hata oluştu !'));
        }
    }

    /**
     * Copy product to speed up product creation.
     *
     * @param  int $id
     * @return Response
     */
    public function getCopy($id)
    {
        $product = Product::findOrFail($id)->replicate();
        $product->name = $product->name.' - Kopya';
        $product->save();

        if ($product->save()) {
            return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                      'alertClass'=>'success',
                                      'alertMessage'=>'Ürün başarıyla kopyalandı.'));
        } else {
            return back()->with(array('alertTitle'=>'HATA : ',
                                      'alertClass'=>'danger',
                                      'alertMessage'=>'Ürün kopyalarken hata oluştu !'));
        }
    }

    /**
     * List product options.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getOption($id)
    {
        $product = Product::findOrFail($id);
        $options = Option::where('product_id', '=', $product->id_product)->get();
        return view('panel.module.product.option', compact('product', 'options'));
    }

    /**
     * List product gallery images.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function getGallery($id)
    {
        $settings = Setting::findOrFail(1);
        $product = Product::findOrFail($id);
        $galleries = Gallery::where('product_id', '=', $product->id_product)->get();
        return view('panel.module.product.gallery', compact('product', 'galleries', 'settings'));
    }

    /**
     * Bulk product price update.
     *
     * @return \Illuminate\View\View
     */
    public function getMultiple()
    {
        $categories = Category::get(['id_category','name','sef_url','sort','parent_id','lft','rgt','depth'])
                                ->toHierarchy();
        $brands = array('0'=>'Markasız')+Brand::orderBy('bname', 'ASC')->lists('bname', 'id_brand')->all();
        return view('panel.module.product.multiple', compact('categories', 'brands'));
    }


    /**
     * Update prices of selected products in the category.
     *
     * Attention : It also updates all subcategories belonging to the category.
     *
     * @param  Request $request
     * @return Response
     */
    public function postMultiplecategorysave(Request $request)
    {
        $category_id = $request->input('category_id');
        $percent = '0.'.$request->input('percent');
        $type = $request->input('type');

        $categories = Category::where('id_category', '=', $category_id)->first()
                                                                       ->getDescendantsAndSelf()
                                                                       ->toArray();

        $lists = '';

        foreach ($categories as $key => $list) {
            if ($type=='plus') {
                $update = Product::where('category_id', '=', $list['id_category'])
                                   ->update(['price'=>DB::raw('price+price*'.$percent)]);
            } elseif ($type=='minus') {
                $update = Product::where('category_id', '=', $list['id_category'])
                                   ->update(['price'=>DB::raw('price-price*'.$percent)]);
            }
            $lists = $list['name'].','.$lists;
        }

        return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                  'alertClass'=>'success',
                                  'alertMessage'=>'Kategorilerdeki ürünler güncellendi : '.$lists));
    }

    /**
     * Update all the product prices in the brand.
     *
     * @param  Request $request
     * @return Response
     */
    public function postMultiplebrandsave(Request $request)
    {
        $brand_id = $request->input('brand_id');
        $percent = '0.'.$request->input('percent');
        $type = $request->input('type');

        $brand = Brand::findOrFail($brand_id);

        $lists = $brand->bname;

        if ($type=='plus') {
            $update = Product::where('brand_id', '=', $brand->id_brand)
                               ->update(['price'=>DB::raw('price+price*'.$percent)]);
        } elseif ($type=='minus') {
            $update = Product::where('brand_id', '=', $brand->id_brand)
                               ->update(['price'=>DB::raw('price-price*'.$percent)]);
        }

        return back()->with(array('alertTitle'=>'BAŞARILI : ',
                                  'alertClass'=>'success',
                                  'alertMessage'=>'Markadaki ürünler güncellendi : '.$lists));
    }
}
