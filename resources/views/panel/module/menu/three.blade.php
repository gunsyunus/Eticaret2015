@extends('panel.template')

@section('content')

@include('panel.module.menu.menu')
<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>MENÜ DÜZENLE</h5>
        </div>
        {!! Form::open(['url'=>'Pv3/menu/save/'.$menus->id_menu.'','role'=>'form','class'=>'form-horizontal','files'=>'true']) !!}

        <div class="card-body">
        {!! Form::hidden('imageType','400') !!}

        <div class="form-group row">
        {!! Form::label('name', 'Menü Adı', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::text('name',$menus->name,['class'=>'form-control']) !!}
        </div>
        </div>

        <div class="form-group row">
        <div class="col-md-2">     
        {!! Form::label('image', 'Resim Seçiniz', array('class'=>'control-label')) !!}     
        {!! Tooltip::standard('400 x 200 ölçülerinde ve JPG,PNG,GIF olmalıdır.') !!}    
        </div>
        <div class="col-md-10">   
        <img src="{!! empty($menus->image) ? URL::to('media/default/no-image.jpg') : URL::to($menus->image) !!}" class="product img-thumbnail img-responsive" />                    
        {!! Form::file('image'); !!}        
        </div>
        </div>            

        <div class="form-group row">
        {!! Form::label('status', 'Durumu', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::checkbox('status', '1', $menus->status, array('class'=>'checkboxes')); !!}
        </div>
        </div>            

        <div class="form-group row">
        {!! Form::label('url', 'Linki', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::text('url',$menus->url,['class'=>'form-control']) !!}       
        </div>
        </div>  

        <div class="form-group row">
        {!! Form::label('sort', 'Sıralama', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::text('sort',$menus->sort,['class'=>'form-control']) !!}       
        </div>
        </div>
       
        <div class="form-group">
          <div class="offset-md-2 col-md-10">
          <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> KAYDET</button>
        </div>
        </div>
        
        {!! Form::close() !!}

    </div>
  </div>
</div>
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>AÇILIR MENÜLER {!! Tooltip::standard('Menünün üstüne gelindiğinde aşağıdaki menüler gözükür.') !!}</h5>
        </div>

        <div class="card-body">
    <div class="row">
    <div class="col-md-12">
    <table class="table">
      <thead>
        <tr>
          <th>Sıralama</th>
          <th>Menü Adı</th>
          <th>Link</th>        
          <th>Durumu</th>
          <th></th>
        </tr>
      </thead>
      <tbody>       
        @foreach($threeMenus as $menu)
        <tr>
          <td>
          {!! Form::open(['url'=>'Pv3/menu/save/'.$menu->id_menu.'','role'=>'form','class'=>'form-horizontal','files'=>'true']) !!}
          {!! Form::text('sort',$menu->sort,['class'=>'form-control']) !!}
          </td>
          <td>{!! Form::text('name',$menu->name,['class'=>'form-control']) !!}</td>
          <td>{!! Form::text('url',$menu->url,['class'=>'form-control']) !!}</td>
          <td><div class="mini-checkbox">{!! Form::checkbox('status', '1',$menu->status, array('class'=>'')); !!}</div></td>
          <td><button type="submit" class="btn btn-success"><i class="fa fa fa-floppy-o"></i></button> {!! Form::close() !!}
          <a href="{!! URL::to('Pv3/menu/sub/'.$menu->id_menu.'') !!}" class="btn btn-warning btn-left">Alt Linkleri</a>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
    </div>
    </div>
  </div>
</div>

@stop