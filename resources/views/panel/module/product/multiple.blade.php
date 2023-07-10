@extends('panel.template')

@section('content')

@include('panel.module.product.menu')

<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>TOPLU FİYAT GÜNCELLEME</h5>
        </div>
        {!! Form::open(['url'=>'Pv3/product/multiplecategorysave','role'=>'form','class'=>'form-horizontal']) !!}

        <div class="card-body">
        <div class="form-group row">
        <div class="col-md-2">
            {!! Form::label('category_id', 'Kategori', array('class'=>'control-label')); !!}
            {!! Tooltip::standard('Üst kategori seçildiğinde tüm alt kategorilere uygular.') !!}
        </div>
        <div class="col-md-10">
          <select name="category_id" class="form-control">
            @foreach($categories as $category)      
              {!! NodeList::getSelect($category) !!}
            @endforeach
          </select>
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('percent', 'Yüzde Değeri', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">         
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">%</span>
            {!! Form::text('percent',null,['class'=>'form-control','aria-describedby'=>'basic-addon1']) !!}      
          </div>         
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('type', 'İşlem Tipi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::select('type',array('plus'=>'Fiyatı Artır','minus'=>'Fiyatı Düşür'),'plus',['class'=>'form-control']) !!}
        </div>
        </div>        

        <div class="form-group">
          <div class="offset-md-2 col-md-10">
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> GÜNCELLE</button>
        </div>
        </div>
        
        {!! Form::close() !!}    

        <!-- 1 -->                

        </div>
        
    </div>
        
    </div>
  </div>
</div>
</div>

@stop