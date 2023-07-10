@extends('panel.template')

@section('content')

@include('panel.module.coupon.menu')
<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>KUPON KODUNU DÜZENLE</h5>
        </div>
        {!! Form::open(['url'=>'Pv3/coupon/save/'.$coupons->id_coupon.'','role'=>'form','class'=>'form-horizontal']) !!}

        <div class="card-body">
        <div class="form-group row">
        {!! Form::label('code', 'Kupon Kodu', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('code',$coupons->code,['class'=>'form-control']) !!}       
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('total', 'Toplam Tutar XX Olduğunda', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('total',$coupons->total,['class'=>'form-control moneyformat']) !!}       
        </div>
        </div>        

        <div class="form-group row">
        {!! Form::label('discount_money', 'İndirim Tutarı', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('discount_money',$coupons->discount_money,['class'=>'form-control moneyformat']) !!}       
        </div>
        </div>           

        <div class="form-group row">
        {!! Form::label('discount_percent', 'İndirim Yüzdesi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">         
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">%</span>
            {!! Form::text('discount_percent',$coupons->discount_percent,['class'=>'form-control','aria-describedby'=>'basic-addon1']) !!}      
          </div>         
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('type', 'İndirim Tipi', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::select('type', array('money'=>'Nakit Para','percent'=>'Yüzde Bazlı'),$coupons->type,['class'=>'form-control']) !!}       
        </div>
        </div>         

        <div class="form-group row">
        <div class="col-md-2">
        {!! Form::label('stock', 'Adet', array('class'=>'control-label')); !!}
        {!! Tooltip::standard('1 yazıldığında tek kişi kullanır, çoklu kullanım için 10,100,500 vb. rakam yazılabilir.') !!}
        </div>
        <div class="col-md-10">
        {!! Form::text('stock',$coupons->stock,['class'=>'form-control']) !!}       
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