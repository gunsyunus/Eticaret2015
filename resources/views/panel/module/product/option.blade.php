@extends('panel.template')

@section('content')

@include('panel.module.product.menu')

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title panel-modul"><b>{{ $product->name }}</b> / SEÇENEKLER</h3>
  </div>
  <div class="panel-body">
    <div class="row">
    <div class="col-md-12">
    <div class="text-right"><a class="btn btn-warning" href="{!! URL::to('Pv3/product/edit/'.$product->id_product.'') !!}"><i class="fa fa-chevron-circle-left"></i> Ürüne Geri Dön</a><div>  
    <table class="table">
      <thead>
        <tr>
          <th>Seçenek</th>
          <th>Fiyat {!! Tooltip::standard('0 TL ise, ürünün ('.$product->name.' - '.$product->price.') TL olan fiyatını alır. Farklı bir fiyat girilirse, sadece o seçenek için fiyat değişir ve sitede gözükür.') !!}</th>
          <th>Stok Adeti</th>
          <th>Stok Kodu</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
          {!! Form::open(['url'=>'Pv3/option/add','role'=>'form','class'=>'form-horizontal','files'=>true]) !!}
          {!! Form::text('name',null,['class'=>'form-control']) !!}
          {!! Form::hidden('product_id', $product->id_product ) !!}
          </td>
          <td>{!! Form::text('price','0.00',['class'=>'form-control moneyformat']) !!}</td>
          <td>{!! Form::text('stock',null,['class'=>'form-control']) !!}</td>         
          <td>{!! Form::text('code',null,['class'=>'form-control']) !!}</td>         
          <td><button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i></button> {!! Form::close() !!}</td>
          </td>
        </tr>
        @foreach($options as $option)
        <tr>
          <td>
          {!! Form::open(['url'=>'Pv3/option/save/'.$option->id_option.'','role'=>'form','class'=>'form-horizontal','files'=>'true']) !!}
          {!! Form::text('name',$option->name,['class'=>'form-control']) !!}
          </td>
          <td>{!! Form::text('price',$option->price,['class'=>'form-control moneyformat']) !!}</td>
          <td>{!! Form::text('stock',$option->stock,['class'=>'form-control']) !!}</td>
          <td>{!! Form::text('code',$option->code,['class'=>'form-control']) !!}</td>          
          <td><button type="submit" class="btn btn-success"><i class="fa fa fa-floppy-o"></i></button> {!! Form::close() !!}
          <a href="{!! URL::to('Pv3/option/delete/'.$option->id_option.'') !!}" class="btn btn-danger btn-left"><i class="fa fa-times"></i></a>
          </td>
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