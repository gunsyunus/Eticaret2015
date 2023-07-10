@extends('panel.template')

@section('content')
 
@include('panel.module.product.menu')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>ÜRÜN LİSTESİ <span class="badge">{{ $products->total() }}</span></h5>
                </div>
                <div class="card-body">
                <div class="btn-popup pull-left">
              @if (isset($searchText) != '' and isset($categoryText) == '')
                <span class="search-info"><i class="fa fa-search-plus"></i> "{{ $searchText }}" - Arama Sonuçları</span> <a href="{{ URL::to('Pv3/product') }}"><i class="fa fa-times-circle"></i></a>
              @endif
              @if (isset($categoryText) != '')
                <span class="search-info"><i class="fa fa-search-plus"></i> "{{ $categoryText }}" - Arama Sonuçları</span> <a href="{{ URL::to('Pv3/product') }}"><i class="fa fa-times-circle"></i></a>
              @endif
              {{ Form::open(['url'=>'Pv3/product/search','role'=>'form','class'=>'form-inline search-page','method'=>'get']) }}
              
              <div class="input-group">
                  <input type="text" name="q" placeholder="Kategori Adı" class="form-control" />
                    <div class="input-group-btn">
                      <button style="border-radius: 0 5px 5px 0;" class="btn btn-default"><span class="glyphicon glyphicon-search"></span>Ara</button>
                    </div>
                </div>
              {{ Form::close() }}                                    
                    </div>
                    <div class="btn-popup pull-right">
                        <button type="button" class="btn btn-primary" > <a style="color:white;" href="{{ URL::to('Pv3/product/new') }}"> Ürün Ekle</a></button>
                        
                    </div>
                    <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>ID</th>
                        <th>Resim</th> 
                        <th>Ürün Adı</th>
                        <th>Stok Kodu</th>
                        <th>Stok Adeti</th>
                        <th>Durum</th>
                        <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($products as $product)
                        <tr>
                        <th>{{ $product->id_product }}</th>
                        <td><img src="{{ empty($product->image_small_1) ? URL::to('media/default/no-image.jpg') : URL::to($product->image_small_1) }}" class="product img-thumbnail img-responsive" /></td>
                          <td>{{ $product->name }}</td>
                          <td>{{ $product->code }}</td>
                          <td>{!! $product->stock > '0' ? '<span class="label label-success">'.$product->stock.'</span>' : '<span class="label label-danger">'.$product->stock.'</span>' !!}</td>
                          <td>{!! $product->status=='1' ? '<span class="label label-success">AKTİF</span>' : '<span class="label label-danger">PASİF</span>' !!}</td>
                          <td class="text-right">            
                          <div class="btn-group jsgrid">
                          <a href="{{ URL::to('Pv3/product/edit/'.$product->id_product.'') }}" class="jsgrid-button jsgrid-edit-button"></a>
                          
                          <a href="{{ URL::to('Pv3/product/delete/'.$product->id_product.'') }}"class="jsgrid-button jsgrid-delete-button"></a>
                          
                          </div>
                          </td>
                        </tr> 
                      @endforeach      
                      </tbody>
                    </table>
                    <div class="pagination"> {{ $products->appends(Request::only('q'))->links() }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop