<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\SiteController;
use App\Helpers\Sorting;
use App\Models\Category;
use Redirect;
use DB;

class CatalogController extends SiteController
{
    /**
     * Show the product.
     *
     * @param  string $sef_url
     * @param  int    $id
     * @return \Illuminate\View\View
     */
    public function product($sef_url, $id)
    {
        $designs = DB::table('designs')->where('id_design', '=', '1')->first();

        $product = DB::table('products')
                   ->join('rates', 'products.rate_id', '=', 'rates.id_rate')
                   ->select('products.*', 'rates.amount as ratePrice')
                   ->where('id_product', '=', $id)
                   ->where('status', '=', '1')
                   ->whereNull('products.deleted_at')
                   ->first();

        if (!$product) {
            abort(404);
        }

        if ($product->sef_url!=$sef_url) {
            return Redirect::action('Site\CatalogController@product', array('sef_url' => $product->sef_url,
                                                                            'id' => $product->id_product));
        };

        $galleries = DB::table('products_gallery')->where('product_id', '=', $product->id_product)->get();

        if ($product->option_status == 1) {
            $options = DB::table('products_option')->where('product_id', '=', $product->id_product)
                           ->where('stock', '>', 0)
                           ->whereNull('deleted_at')
                           ->get();
        }

        $nextProduct = DB::table('products')
                       ->select('sef_url', 'id_product')
                       ->where('id_product', '>', $product->id_product)
                       ->where('status', '=', '1')
                       ->whereNull('products.deleted_at')
                       ->first();

        $prevProduct = DB::table('products')
                       ->select('sef_url', 'id_product')
                       ->where('id_product', '<', $product->id_product)
                       ->where('status', '=', '1')
                       ->whereNull('products.deleted_at')
                       ->first();
                       
        if ($designs->similar_product_section == 1) {
            $similarProducts = DB::table('products')
                    ->join('rates', 'products.rate_id', '=', 'rates.id_rate')
                    ->select('products.*', 'rates.amount as ratePrice')
                    ->where('status', '=', '1')
                    ->whereNull('products.deleted_at')
                    ->take(5)
                    ->orderBy(DB::raw('RAND()'))
                    ->get();
        }

        return view('site.product', compact('product', 'similarProducts', 'galleries',
                                            'options', 'nextProduct', 'prevProduct'));
    }

    /**
     * Show products belonging to category.
     *
     * @param  string $sef_url
     * @param  int    $id
     * @return \Illuminate\View\View
     */
    public function category(Request $request, $sef_url, $id)
    {
        $designs = DB::table('designs')->where('id_design', '=', '1')->first();
        
        $category = DB::table('categories')->where('id_category', '=', $id)->whereNull('deleted_at')->first();

        if (!$category) {
            abort(404);
        }

        $sort = $request->input('sort');
        $sortSelect = Sorting::selection($sort);

        if ($category->sef_url!=$sef_url) {
            return Redirect::action('Site\CatalogController@category', array('sef_url' => $category->sef_url,
                                                                             'id' => $category->id_category));
        };

        $bannerSlider = DB::table('banners')->where('status', '=', '1')->where('category_id', '=', $id)
                            ->where('type', '=', 'category')
                            ->orderBy('sort', 'asc')
                            ->get();

        $products = DB::table('products')
                    ->join('rates', 'products.rate_id', '=', 'rates.id_rate')
                    ->select('products.*', 'rates.amount as ratePrice')
                    ->where('status', '=', '1')
                    ->where('category_id', '=', $id)
                    ->whereNull('products.deleted_at')
                    ->when($sort, function ($query) use ($sort, $sortSelect) {
                        return $query->orderBy($sortSelect->column, $sortSelect->type);
                    })
                    ->when(!$sort, function ($query) use ($sort) {
                        return $query->orderBy('category_sort', 'asc')->orderBy('id_product', 'desc');
                    })
                    ->get();

        if ($designs->outlet_section == 1) {
            $outletProducts = DB::table('products')
                    ->join('rates', 'products.rate_id', '=', 'rates.id_rate')
                    ->select('products.*', 'rates.amount as ratePrice')
                    ->where('status', '=', '1')
                    ->whereNull('products.deleted_at')
                    ->where('outlet_status', '=', '1')
                    ->get();
        }

        $categories = Category::get(['id_category','name','sef_url','sort','parent_id','lft','rgt','depth'])
                                ->toHierarchy();
        
        return view('site.category', compact('products', 'category', 'categories',
                                             'outletProducts', 'bannerSlider', 'sortSelect'));
    }

    /**
     * Show products with brand id.
     *
     * @param  string $sef_url
     * @param  int    $id
     * @return \Illuminate\View\View
     */
    public function brand(Request $request, $sef_url, $id)
    {
        $designs = DB::table('designs')->where('id_design', '=', '1')->first();
        
        $brand = DB::table('brands')->where('id_brand', '=', $id)->whereNull('deleted_at')->first();

        if (!$brand) {
            abort(404);
        }

        $sort = $request->input('sort');
        $sortSelect = Sorting::selection($sort);

        if ($brand->sef_url!=$sef_url) {
            return Redirect::action('Site\CatalogController@brand', array('sef_url' => $brand->sef_url,
                                                                          'id' => $brand->id_brand));
        };

        $products = DB::table('products')
                    ->join('rates', 'products.rate_id', '=', 'rates.id_rate')
                    ->select('products.*', 'rates.amount as ratePrice')
                    ->where('status', '=', '1')
                    ->where('brand_id', '=', $id)
                    ->whereNull('products.deleted_at')
                    ->when($sort, function ($query) use ($sort, $sortSelect) {
                        return $query->orderBy($sortSelect->column, $sortSelect->type);
                    })
                    ->when(!$sort, function ($query) use ($sort) {
                        return $query->orderBy('brand_sort', 'asc')->orderBy('id_product', 'desc');
                    })
                    ->get();

        if ($designs->outlet_section == 1) {
            $outletProducts = DB::table('products')
                    ->join('rates', 'products.rate_id', '=', 'rates.id_rate')
                    ->select('products.*', 'rates.amount as ratePrice')
                    ->where('status', '=', '1')
                    ->whereNull('products.deleted_at')
                    ->where('outlet_status', '=', '1')
                    ->get();
        }

        $categories = Category::get(['id_category','name','sef_url','sort','parent_id','lft','rgt','depth'])
                                ->toHierarchy();
        
        return view('site.brand', compact('products', 'brand', 'categories', 'outletProducts', 'sortSelect'));
    }

    /**
     * Search the products.
     *
     * @param  Request $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        $designs = DB::table('designs')->where('id_design', '=', '1')->first();

        $searchText = $request->input('k');
        $sort = $request->input('sort');
        $sortSelect = Sorting::selection($sort);

        if (empty($searchText)) {
            $products = [];
        } else {
            $products = DB::table('products')
                    ->join('rates', 'products.rate_id', '=', 'rates.id_rate')
                    ->select('products.*', 'rates.amount as ratePrice')
                    ->where('status', '=', '1')
                    ->whereNull('products.deleted_at')
                    ->where('products.name', 'LIKE', '%'.$searchText.'%')
                    ->when($sort, function ($query) use ($sort, $sortSelect) {
                        return $query->orderBy($sortSelect->column, $sortSelect->type);
                    })
                    ->get();
        }

        if ($designs->outlet_section == 1) {
            $outletProducts = DB::table('products')
                    ->join('rates', 'products.rate_id', '=', 'rates.id_rate')
                    ->select('products.*', 'rates.amount as ratePrice')
                    ->where('status', '=', '1')
                    ->whereNull('products.deleted_at')
                    ->where('outlet_status', '=', '1')
                    ->get();
        }

        $categories = Category::get(['id_category','name','sef_url','sort','parent_id','lft','rgt','depth'])
                                ->toHierarchy();

        return view('site.search', compact('products', 'categories', 'outletProducts', 'searchText', 'sortSelect'));
    }

    /**
     * Showcase products.
     *
     * @return \Illuminate\View\View
     */
    public function showcase()
    {
        $designs = DB::table('designs')->where('id_design', '=', '1')->first();
        
        $products = DB::table('products')
                    ->join('rates', 'products.rate_id', '=', 'rates.id_rate')
                    ->select('products.*', 'rates.amount as ratePrice')
                    ->where('status', '=', '1')
                    ->where('showcase_status', '=', '1')
                    ->whereNull('products.deleted_at')
                    ->orderBy('showcase_sort', 'asc')
                    ->get();

        if ($designs->outlet_section == 1) {
            $outletProducts = DB::table('products')
                    ->join('rates', 'products.rate_id', '=', 'rates.id_rate')
                    ->select('products.*', 'rates.amount as ratePrice')
                    ->where('status', '=', '1')
                    ->where('outlet_status', '=', '1')
                    ->whereNull('products.deleted_at')
                    ->get();
        }

        $categories = Category::get(['id_category','name','sef_url','sort','parent_id','lft','rgt','depth'])
                                ->toHierarchy();
        
        return view('site.showcase', compact('products', 'categories', 'outletProducts'));
    }
}
