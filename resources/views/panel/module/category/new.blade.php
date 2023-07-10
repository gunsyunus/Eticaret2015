@extends('panel.template')

@section('content')

@include('panel.module.category.menu')


<div class="container-fluid">
                <div class="card tab2-card">
                    <div class="card-header">
                        <h5>YENİ KATEGORİ OLUŞTUR</h5>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['url'=>'Pv3/category/add','role'=>'form','class'=>'needs-validation']) !!}
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade active show" id="general" role="tabpanel" aria-labelledby="general-tab">
                           

                                    <div class="form-group row">
                                        <label for="validationCustom0" class="col-xl-3 col-md-4"><span>*</span> Kategori Adı</label>
                                        <input name="name" class="form-control col-xl-8 col-md-7" id="validationCustom0" type="text">
                                    </div>
                                    <div class="form-group row">
                                        <label for="validationCustom0" class="col-xl-3 col-md-4"><span>*</span> Sıralama</label>
                                        <input name="sort" class="form-control col-xl-8 col-md-7" id="validationCustom0" type="text">
                                    </div>
                                    <div class="form-group row">
                            <label for="validationCustom0" class="col-xl-3 col-md-4"><span>*</span> Üst Kategorisi</label>
                                        <select name="categoryMain" class="custom-select form-control col-xl-8 col-md-7" required="">
                                            <option value="0">--Seçiniz--</option>
                                            @foreach($lists as $category)      
                                            {!! NodeList::getSelect($category) !!}
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group row">
                                        <label for="validationCustom0" class="col-xl-3 col-md-4"><span>*</span> Site Başlığı {!! Tooltip::standard('Minimum 3 ve maksimum 70 karakter olmalıdır.') !!}    
</label>

                                        <input name="title" class="form-control col-xl-8 col-md-7" id="validationCustom0" type="text">
                                    </div>
                                    <div class="form-group row">
                                        <label for="validationCustom0" class="col-xl-3 col-md-4"><span>*</span> Anahtar Kelimeler        {!! Tooltip::standard('Maksimum 260 karakter olmalıdır.') !!}    
</label>
                                        <input name="keyword" class="form-control col-xl-8 col-md-7" id="validationCustom0" type="text">
                                    </div>
                                    <div class="form-group row">
                                        <label for="validationCustom0" class="col-xl-3 col-md-4"><span>*</span> Description (Açıklama)         {!! Tooltip::standard('Maksimum 160 karakter olmalıdır.') !!}    
</label>
                                        <input name="description" class="form-control col-xl-8 col-md-7" id="validationCustom0" type="text">
                                    </div>
                           
                            </div>
                        </div>   
                           
                        <div class="pull-right">
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
@stop