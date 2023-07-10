@extends('panel.template')

@section('content')

@include('panel.module.tax.menu')
<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>KDV DÜZENLE</h5>
        </div>
        {!! Form::open(['url'=>'Pv3/tax/save/'.$taxs->id_tax.'','role'=>'form','class'=>'form-horizontal']) !!}

        <div class="card-body">
        <div class="form-group row">
        {!! Form::label('name', 'KDV Yüzdesi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">         
          <div style="line-height: 38px;" class="input-group">
            <span class="input-group-addon" id="basic-addon1">%</span>
            {!! Form::text('name',$taxs->name,['class'=>'form-control','aria-describedby'=>'basic-addon1']) !!}      
          </div>         
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
</div>

@stop