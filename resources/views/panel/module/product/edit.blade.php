@extends('panel.template')

@section('content')

@include('panel.module.product.menu')

@section('meta')
{{ HTML::style('panelv3/css/editor.min.css') }}
@stop

@section('body')
{{ HTML::script('panelv3/js/jquery.editor.min.js') }}
{{ HTML::script('panelv3/js/jquery.editor.tr.min.js') }}
@stop

<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>Ürün Düzenle</h5>
        </div>
        {!! Form::open(['url'=>'Pv3/product/save/'.$products->id_product.'','role'=>'form','class'=>'form-horizontal','files'=>true,'id'=>'myForm']) !!}

        <div class="card-body">
            <ul class="nav nav-tabs tab-coupon" id="myTab" role="tablist">
            <li class="nav-item"><a class="nav-link active show" id="general-tab" data-toggle="tab" href="#first" role="tab" aria-controls="general" aria-selected="true" data-original-title="" title="">Temel Bilgiler</a></li>
            <li class="nav-item"><a class="nav-link" id="seo-tabs" data-toggle="tab" href="#content" role="tab" aria-controls="seo" aria-selected="false" data-original-title="" title="">Açıklama</a></li>
            <li class="nav-item"><a class="nav-link" id="" data-toggle="tab" href="#display" role="tab" aria-controls="seo" aria-selected="false" data-original-title="" title="">Gösterimi</a></li>
            <li class="nav-item"><a class="nav-link" id="" data-toggle="tab" href="#seo" role="tab" aria-controls="seo" aria-selected="false" data-original-title="" title="">SEO</a></li>
            <li class="nav-item"><a class="nav-link" id="" data-toggle="tab" href="#other" role="tab" aria-controls="seo" aria-selected="false" data-original-title="" title="">Ekstra</a></li>
            <li class="nav-item"><a href="{!! URL::to('Pv3/product/option/'.$products->id_product.'') !!}" class="nav-link" id=""  role="tab" aria-controls="seo" aria-selected="false" data-original-title="" title="">Seçenekler</a></li>
            <li class="nav-item"><a href="{!! URL::to('Pv3/product/gallery/'.$products->id_product.'') !!}" class="nav-link" id=""  role="tab" aria-controls="seo" aria-selected="false" data-original-title="" title="">Galeri</a></li>
            </ul>
            <div class="tab-content" id="myTabContent">
        <div role="tabpanel" class="tab-pane active" id="first">

        <!-- 1 -->
        <div class="row product-adding">
                                    <div class="col-xl-5">
                                        <div class="add-product">
                                            <div class="row">
                                                <div class="col-xl-9 xl-50 col-sm-6 col-9">
                                                    <img src="{!! empty($products->image_small_1) ? URL::to('media/default/no-image.jpg') : URL::to($products->image_small_1) !!}" alt="" class="img-fluid image_zoom_1 blur-up lazyloaded">
                                                </div>
                                                <div class="col-xl-3 xl-50 col-sm-6 col-3">
                                                    <ul class="file-upload-product">
                                                        <li><div style="background-image: url('{!! empty($products->image_small_1) ? URL::to('media/default/no-image.jpg') : URL::to($products->image_small_1) !!}');background-repeat: round;" class="box-input-file"><input name="image1" class="upload" type="file"><i class="fa fa-plus"></i></div></li>
                                                        <li><div style="background-image: url('{!! empty($products->image_small_2) ? URL::to('media/default/no-image.jpg') : URL::to($products->image_small_2) !!}');background-repeat: round;" class="box-input-file"><input name="image2" class="upload" type="file"><i class="fa fa-plus"></i></div></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-7">
        <div class="form-group row">
        {!! Form::label('name', 'Ürün Adı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('name',$products->name,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('code', 'Stok Kodu', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('code',$products->code,['class'=>'form-control']) !!}       
        </div>
        </div>     

        <div class="form-group row">
        {!! Form::label('status', 'Satış Durumu', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::checkbox('status', '1', $products->status, array('class'=>'checkboxes')); !!}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('price', 'Satış Fiyatı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-2">      
        {!! Form::text('price',$products->price,['class'=>'form-control moneyformat']) !!} 
        </div>        
        <div class="col-md-2">            
        {!! Form::select('rate_id',$rates,$products->rate_id,['class'=>'form-control']) !!}
         </div>    
        <div class="col-md-2">            
        {!! Form::select('tax',$taxs,$products->tax,['class'=>'form-control']) !!}
         </div>
        <div class="col-md-2">      
        {!! Form::text('price_tier',$products->price_tier,['class'=>'form-control moneyformat','placeholder'=>'Alış Fiyatı']) !!} 
        </div>           
        <div class="col-md-2">      
        {!! Form::text('price_old',$products->price_old,['class'=>'form-control price-old moneyformat','placeholder'=>'İndirimli Fiyat']) !!} 
        </div>           
        </div>     

        <div class="form-group row">
        {!! Form::label('stock', 'Stok Miktarı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('stock',$products->stock,['class'=>'form-control']) !!}       
        </div>
        </div>         

        <div class="form-group row">
        <div class="col-md-2">
        {!! Form::label('option_status', 'Seçenekler', array('class'=>'control-label')) !!}
        {!! Tooltip::standard('Elbise, ayakkabı vb. ürünler için XL-X-L beden veya 36-37-38 numaraları gibi ek seçeneklerin gösterilmesi') !!}
        </div>
        <div class="col-md-10">
        {!! Form::checkbox('option_status', '1', $products->option_status, array('class'=>'checkboxes')); !!}
        </div>
        </div>

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('image', 'Resim', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard($settings->product_big_width .' x '.$settings->product_big_height. ' ölçülerinde ve JPG,PNG,GIF olmalıdır.') !!}    
        </div>
        <div class="col-md-5">
        <img src="{!! empty($products->image_small_1) ? URL::to('media/default/no-image.jpg') : URL::to($products->image_small_1) !!}" class="product img-thumbnail img-responsive" />          
        {!! Form::file('image1'); !!}
        </div>
        <div class="col-md-5">
        <img src="{!! empty($products->image_small_2) ? URL::to('media/default/no-image.jpg') : URL::to($products->image_small_2) !!}" class="product img-thumbnail img-responsive" />   
        {!! Form::file('image2'); !!}
        </div>
        </div>
        
        <div class="form-group row">
        {!! Form::label('category_id', 'Kategori', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
          <select name="category_id" class="form-control">
            <optgroup label="Seçili Kategori">
               <option value="@if(!empty($products->category_id)){{$products->category_id}}@endif" selected="selected">@if (!empty($categoryMain->name)) {{ $categoryMain->name }} @endif</option> 
            </optgroup>
            <optgroup label="Yeni Kategori">
            @foreach($categories as $category)
              {!! NodeList::getSelect($category) !!}
            @endforeach
            </optgroup>
          </select>
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('brand_id', 'Marka', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::select('brand_id',$brands,$products->brand_id,['class'=>'form-control']) !!}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('Kısa Tanıtım', '', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::textarea('short_content',$products->short_content,['class'=>'form-control','rows'=>'2']) !!}
        </div>
        </div>        
                                    </div>
        <!-- 1 -->                
        </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="content">
            
        <!-- 2 -->     
        <div class="card">
            <div class="card-header">
                <h5>Tanıtım</h5>
            </div>
            <div class="card-body">
                <div class="digital-add needs-validation">
                    <div class="form-group mb-0">
                        <div class="description-sm">
                            <textarea id="editor1" name="content" cols="10" rows="4">{{$products->content}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
 

        <!-- 2 -->      

        </div>
        <div role="tabpanel" class="tab-pane" id="display">
            
        <!-- 3 -->     

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('showcase_status', 'Vitrinde Göster', array('class'=>'control-label')) !!}
        {!! Tooltip::standard('Kategoriler anasayfasında listeler') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::checkbox('showcase_status', '1', $products->showcase_status, array('class'=>'checkboxes')); !!}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('outlet_status', 'Fırsat Ürünü', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::checkbox('outlet_status', '1', $products->outlet_status, array('class'=>'checkboxes')); !!}
        </div>
        </div>    

        <div class="form-group row">
        {!! Form::label('private_status_1', 'Anasayfa Tab - 1', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::checkbox('private_status_1', '1', $products->private_status_1, array('class'=>'checkboxes')); !!}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('private_status_2', 'Anasayfa Tab - 2', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::checkbox('private_status_2', '1', $products->private_status_2, array('class'=>'checkboxes')); !!}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('private_status_3', 'Anasayfa Alt Tab - 1', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::checkbox('private_status_3', '1', $products->private_status_3, array('class'=>'checkboxes')); !!}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('private_status_4', 'Anasayfa Alt Tab - 2', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::checkbox('private_status_4', '1', $products->private_status_4, array('class'=>'checkboxes')); !!}
        </div>
        </div>                                

        <div class="form-group row">
        {!! Form::label('private_status_5', 'Anasayfa Geniş Bant', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::checkbox('private_status_5', '1', $products->private_status_5, array('class'=>'checkboxes')); !!}
        </div>
        </div>  

        <div class="form-group row">
        {!! Form::label('showcase_sort', 'Vitrin Sırası', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('showcase_sort',$products->showcase_sort,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('private_sort', 'Anasayfa Sırası', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('private_sort',$products->private_sort,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('category_sort', 'Kategori Sırası', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('category_sort',$products->category_sort,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('brand_sort', 'Marka Sırası', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('brand_sort',$products->brand_sort,['class'=>'form-control']) !!}       
        </div>
        </div>                        

        <!-- 3 -->      

        </div>        
        <div role="tabpanel" class="tab-pane" id="seo">
            
        <!-- 4 -->

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('title', 'Site Başlığı', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Minimum 3 ve maksimum 70 karakter olmalıdır.') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('title',$products->title,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('keyword', 'Anahtar Kelimeler', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Maksimum 260 karakter olmalıdır.') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('keyword',$products->keyword,['class'=>'form-control']) !!}       
        </div>
        </div>        

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('description', 'Description (Açıklama)', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Maksimum 160 karakter olmalıdır.') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('description',$products->description,['class'=>'form-control']) !!}       
        </div>
        </div>     

        <!-- 4 -->      

        </div>            
        <div role="tabpanel" class="tab-pane" id="other">
            
        <!-- 5 -->

        <div class="form-group row">
        {!! Form::label('cargo_weight', 'Desi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('cargo_weight',$products->cargo_weight,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('supply_company_name', 'Tedarikçi Firma Adı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('supply_company_name',$products->supply_company_name,['class'=>'form-control']) !!}       
        </div>
        </div>        

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('promotion_text', 'Promosyon Metni', array('class'=>'control-label')); !!}
        {!! Tooltip::standard('ACİL, YENİ, ÖZEL vb. küçük notlar') !!}   
        </div>
        <div class="col-md-10">
        {!! Form::text('promotion_text',$products->promotion_text,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('shelf_code', 'Raf Kodu', array('class'=>'control-label')); !!}
        {!! Tooltip::standard('Stok takibi için deponuzdaki özel numaralar') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('shelf_code',$products->shelf_code,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('barcode_ean', 'Barkod - EAN', array('class'=>'control-label')); !!}
        {!! Tooltip::standard('Avrupa Madde Numarası - 13 Hane') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('barcode_ean',$products->barcode_ean,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('barcode_upc', 'Barkod - UPC', array('class'=>'control-label')); !!}
        {!! Tooltip::standard('Evrensel Ürün Kodu - 12 Hane') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('barcode_upc',$products->barcode_upc,['class'=>'form-control']) !!}       
        </div>
        </div>        

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('barcode_jan', 'Barkod - JAN', array('class'=>'control-label')); !!}
        {!! Tooltip::standard('Japonya Madde numarası - 8/13 Hane') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('barcode_jan',$products->barcode_jan,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('created_at', 'Kayıt Tarihi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! $products->created_at->format('d.m.Y H:i') !!}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('updated_at', 'Güncelleme Tarihi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! $products->updated_at->format('d.m.Y H:i') !!}
        </div>
        </div>

        <!-- 5 -->  

        </div>

    </div>
          
    <div class="form-group row">
          <div class="col-md-offset-2 col-md-10">
          <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> KAYDET</button>
        </div>
        </div>
        
        {!! Form::close() !!}

    </div>
  </div>
</div>
</div>


@stop