@extends('panel.template')

@section('content')

@include('panel.module.setting.menu',array('page'=>'Ödeme Ayarları'))
<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>ÖDEME AYARLARI</h5>
        </div>
        {!! Form::open(['url'=>'Pv3/setting/ordersave/','role'=>'form','class'=>'form-horizontal']) !!}

        <div class="card-body">
        <div class="form-group row">
        {!! Form::label('order_method', 'Sipariş Tamamlama', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::select('order_method', array('1'=>'Üyelik Zorunlu','2'=>'Üyelik / Üyeliksiz Satış','3'=>'Hızlı Satın Al'),$settings->order_method,['class'=>'form-control']) !!}
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