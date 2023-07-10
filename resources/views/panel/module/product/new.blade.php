@extends('panel.template')

@section('content')

@include('panel.module.product.menu')

@section('meta')
@stop

@section('body')

@stop

<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>Ürün Ekleme</h5>
        </div>
        {!! Form::open(['url'=>'Pv3/product/add/','role'=>'form','class'=>'form-horizontal','files'=>true,'id'=>'myForm']) !!}

        <div class="card-body">
            <ul class="nav nav-tabs tab-coupon" id="myTab" role="tablist">
            <li class="nav-item"><a class="nav-link active show" id="general-tab" data-toggle="tab" href="#first" role="tab" aria-controls="general" aria-selected="true" data-original-title="" title="">Temel Bilgiler</a></li>
            <li class="nav-item"><a class="nav-link" id="seo-tabs" data-toggle="tab" href="#content" role="tab" aria-controls="seo" aria-selected="false" data-original-title="" title="">Açıklama</a></li>
            <li class="nav-item"><a class="nav-link" id="" data-toggle="tab" href="#display" role="tab" aria-controls="seo" aria-selected="false" data-original-title="" title="">Gösterimi</a></li>
            <li class="nav-item"><a class="nav-link" id="" data-toggle="tab" href="#seo" role="tab" aria-controls="seo" aria-selected="false" data-original-title="" title="">SEO</a></li>
            <li class="nav-item"><a class="nav-link" id="" data-toggle="tab" href="#other" role="tab" aria-controls="seo" aria-selected="false" data-original-title="" title="">Ekstra</a></li>
            <li class="nav-item"><a class="nav-link" id="" data-toggle="tab" href="#option" role="tab" aria-controls="seo" aria-selected="false" data-original-title="" title="">Seçenekler</a></li>
            <li class="nav-item"><a class="nav-link" id="" data-toggle="tab" href="#gallery" role="tab" aria-controls="seo" aria-selected="false" data-original-title="" title="">Galeri</a></li>
            </ul>
            <div class="tab-content" id="myTabContent">
        <div role="tabpanel" class="tab-pane active" id="first">

        <!-- 1 -->

       

        <!-- 1 -->                
        <div class="row product-adding">
                                    <div class="col-xl-5">
                                        <div class="add-product">
                                            <div class="row">
                                                <div class="col-xl-9 xl-50 col-sm-6 col-9">
                                                    <img src="../assets/images/pro3/1.jpg" alt="" class="img-fluid image_zoom_1 blur-up lazyloaded">
                                                </div>
                                                <div class="col-xl-3 xl-50 col-sm-6 col-3">
                                                    <ul class="file-upload-product">
                                                        <li><div class="box-input-file"><input name="image1" class="upload" type="file"><i class="fa fa-plus"></i></div></li>
                                                        <li><div class="box-input-file"><input name="image2" class="upload" type="file"><i class="fa fa-plus"></i></div></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-7">
                                        <form class="needs-validation add-product-form" novalidate="">
                                            <div class="form">
                                                <div class="form-group mb-3 row">
                                                    <label for="validationCustom01" class="col-xl-3 col-sm-4 mb-0">Ürün Adı :</label>
                                                    <input name="name" class="form-control col-xl-8 col-sm-7" id="validationCustom01" type="text" required="">
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label for="validationCustom02" class="col-xl-3 col-sm-4 mb-0">Stok Kodu :</label>
                                                    <input name="code" class="form-control col-xl-8 col-sm-7" id="validationCustom02" type="text" required="">
                                                </div>
                                                <div class="form-group mb-3 row">
                                                    <label for="validationCustomUsername" class="col-xl-3 col-sm-4 mb-0">Satış Fiyatı :</label>
                                                    <input placeholder="Satış Fiyatı" name="price"style="padding-right: 0;border-right: 0;border-radius: 0.25rem 0 0 0.25rem;margin-bottom: 1rem;" class="form-control col-xl-3 col-sm-7 moneyformat" id="validationCustomUsername" type="text" required="">
                                                    <select name="rate_id" style="padding-left: 0;padding-right: 0;border-left: 0;border-radius: 0 0.25rem 0.25rem 0;" class="form-control digits col-xl-1 col-sm-7" id="exampleFormControlSelect1">
                                                        <option value="0">TL</option>
                                                        <option value="1">USD</option>
                                                        <option value="2">EURO</option>
                                                    </select>
                                                    <select name="tax" style="" class="form-control digits col-xl-4 col-sm-7" id="exampleFormControlSelect1">
                                                        <option value="0">KDV Dahil</option>
                                                        <option value="1">Artı KDV</option>
                                                    </select>
                                                    <label for="validationCustomUsername" class="col-xl-3 col-sm-4 mb-0"></label>

                                                    <input name="price_old" style="" placeholder="İndrimli Fiyat" class="form-control col-xl-4 col-sm-7 moneyformat price-old" id="validationCustomUsername" type="text" required="">
                                                    <input name="price_tier" style="" placeholder="Alış Fiyatı" class="form-control col-xl-4 col-sm-7 moneyformat" id="validationCustomUsername" type="text" required="">
                                                </div>
                                            </div>
                                            <div class="form">
                                            <div class="form-group row">
                                                    <label class="col-xl-3 col-sm-4 mb-0">Stok Miktarı:</label>
                                                    <fieldset class="qty-box col-xl-9 col-xl-8 col-sm-7 pl-0">
                                                        <div style="justify-content: left;" class="input-group">
                                                            <input name="stock" class="touchspin" type="text" value="1">
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleFormControlSelect1" class="col-xl-3 col-sm-4 mb-0">Kategori:</label>
                                                   
                                                    <select name="category_id" class="form-control digits col-xl-8 col-sm-7" id="exampleFormControlSelect1">
                                                    @foreach($categories as $category)      
                                                        {!! NodeList::getSelect($category) !!}
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="exampleFormControlSelect1" class="col-xl-3 col-sm-4 mb-0">Marka:</label>
                                                    {!! Form::select('brand_id',$brands,'-',['class'=>'form-control digits col-xl-8 col-sm-7']) !!}
                                                </div>
                                                <div class="form-group row">
                                        <label class="col-xl-3 col-sm-4 mb-0">Kısa Tanıtım</label>
                                        <textarea name="short_content" class="col-xl-8 col-sm-7" rows="5" cols=""></textarea>
                                    </div>
                                            </div>
                                        </form>
                                    </div>
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
                                            <textarea id="editor1" name="content" cols="10" rows="4"></textarea>
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
        {!! Form::checkbox('showcase_status', '1', false, array('class'=>'checkboxes')); !!}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('outlet_status', 'Fırsat Ürünü', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::checkbox('outlet_status', '1', false, array('class'=>'checkboxes')); !!}
        </div>
        </div>        

        <div class="form-group row">
        {!! Form::label('private_status_1', 'Anasayfa Tab - 1', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::checkbox('private_status_1', '1', false, array('class'=>'checkboxes')); !!}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('private_status_2', 'Anasayfa Tab - 2', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::checkbox('private_status_2', '1', false, array('class'=>'checkboxes')); !!}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('private_status_3', 'Anasayfa Alt Tab - 1', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::checkbox('private_status_3', '1', false, array('class'=>'checkboxes')); !!}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('private_status_4', 'Anasayfa Alt Tab - 2', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::checkbox('private_status_4', '1', false, array('class'=>'checkboxes')); !!}
        </div>
        </div>                                

        <div class="form-group row">
        {!! Form::label('private_status_5', 'Anasayfa Geniş Bant', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::checkbox('private_status_5', '1', false, array('class'=>'checkboxes')); !!}
        </div>
        </div>  

        <div class="form-group row">
        {!! Form::label('showcase_sort', 'Vitrin Sırası', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('showcase_sort','9999',['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('private_sort', 'Anasayfa Sırası', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('private_sort','9999',['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('category_sort', 'Kategori Sırası', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('category_sort','9999',['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('brand_sort', 'Marka Sırası', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('brand_sort','9999',['class'=>'form-control']) !!}       
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
        {!! Form::text('title',null,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        <div class="col-md-2">
        {!! Form::label('keyword', 'Anahtar Kelimeler', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Maksimum 260 karakter olmalıdır.') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('keyword',null,['class'=>'form-control']) !!}       
        </div>
        </div>        

        <div class="form-group row">
        <div class="col-md-2">
        {!! Form::label('description', 'Description (Açıklama)', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('Maksimum 160 karakter olmalıdır.') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('description',null,['class'=>'form-control']) !!}       
        </div>
        </div>     

        <!-- 4 -->      

        </div>            
        <div role="tabpanel" class="tab-pane" id="other">
            
        <!-- 5 -->

        <div class="form-group row">
        {!! Form::label('cargo_weight', 'Desi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('cargo_weight',null,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('supply_company_name', 'Tedarikçi Firma Adı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('supply_company_name',null,['class'=>'form-control']) !!}       
        </div>
        </div>        

        <div class="form-group row">
        <div class="col-md-2">
        {!! Form::label('promotion_text', 'Promosyon Metni', array('class'=>'control-label')); !!}
        {!! Tooltip::standard('ACİL, YENİ, ÖZEL vb. küçük notlar') !!}   
        </div>
        <div class="col-md-10">
        {!! Form::text('promotion_text',null,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        <div class="col-md-2">
        {!! Form::label('shelf_code', 'Raf Kodu', array('class'=>'control-label')); !!}
        {!! Tooltip::standard('Stok takibi için deponuzdaki özel numaralar') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('shelf_code',null,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        <div class="col-md-2">
        {!! Form::label('barcode_ean', 'Barkod - EAN', array('class'=>'control-label')); !!}
        {!! Tooltip::standard('Avrupa Madde Numarası - 13 Hane') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('barcode_ean',null,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        <div class="col-md-2">
        {!! Form::label('barcode_upc', 'Barkod - UPC', array('class'=>'control-label')); !!}
        {!! Tooltip::standard('Evrensel Ürün Kodu - 12 Hane') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('barcode_upc',null,['class'=>'form-control']) !!}       
        </div>
        </div>        

        <div class="form-group row">
        <div class="col-md-2">
        {!! Form::label('barcode_jan', 'Barkod - JAN', array('class'=>'control-label')); !!}
        {!! Tooltip::standard('Japonya Madde numarası - 8/13 Hane') !!}    
        </div>
        <div class="col-md-10">
        {!! Form::text('barcode_jan',null,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('date', 'Kayıt Tarihi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        -
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('date', 'Güncelleme Tarihi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        -
        </div>
        </div>

        <!-- 5 -->  

        </div>
        <div role="tabpanel" class="tab-pane" id="option">
            
        <!-- 6 -->     

        <div class="alert alert-info" role="alert"><i class="fa fa-info-circle fa-fw"></i> Ürün eklendikten sonra, seçenekler girilebilir.</div>

        <!-- 6 -->      

        </div>
        <div role="tabpanel" class="tab-pane" id="gallery">
            
        <!-- 7 -->     

        <div class="alert alert-info" role="alert"><i class="fa fa-info-circle fa-fw"></i> Ürün eklendikten sonra, galeriye resim eklenebilir.</div>

        <!-- 7 -->      

        </div>                
    </div>
            </div>
            <div class="form-group">
          <div class="offset-md-10 col-md-2">
          <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> KAYDET</button>
        </div>
        </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>
<!-- Container-fluid Ends-->

</div>

            </div>
            <script>
function myFunction() {
  document.getElementById("myForm").submit();
}
</script>
@stop