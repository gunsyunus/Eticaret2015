@extends('panel.template')

@section('content')

@include('panel.module.category.menu')
<div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>KATEGORİ LİSTESİ <span class="badge">{{ $categories->total() }}</span></h5>
                            </div>
                            <div class="card-body">
                            <div class="btn-popup pull-left">
                            @if (isset($searchText) != '')
                            <span class="search-info"><i class="fa fa-search-plus"></i> "{{ $searchText }}" - Arama Sonuçları</span> <a href="{{ URL::to('Pv3/category') }}"><i class="fa fa-times-circle"></i></a>
                          @endif
                          {{ Form::open(['url'=>'Pv3/category/search','role'=>'form','class'=>'form-inline search-page','method'=>'get']) }}

                            <div class="input-group">
                              <input type="text" name="q" placeholder="Kategori Adı" class="form-control" />
                                <div class="input-group-btn">
                                  <button style="border-radius: 0 5px 5px 0;" class="btn btn-default"><span class="glyphicon glyphicon-search"></span>Ara</button>
                                </div>
                            </div>
                          {{ Form::close() }}                                    
                                </div>
                                <div class="btn-popup pull-right">
                                    <button type="button" class="btn btn-primary" > <a style="color:white;" href="{{ URL::to('Pv3/category/new') }}"> Kategori Ekle</a></button>
                                    
                                </div>
                                <div class="table-responsive">
                                <table class="table table-striped">
                                  <thead>
                                    <tr>
                                      <th>ID</th>
                                      <th>Kategori Adı</th>
                                      <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($categories as $category)
                                    <tr>
                                      <th>{{ $category->id_category }}</th>
                                      <td>{{ $category->name }}</td>
                                      <td class="text-right">            
                                      <div class="btn-group jsgrid">
                                      <a href="{{ URL::to('Pv3/category/edit/'.$category->id_category.'') }}" class="jsgrid-button jsgrid-edit-button"></a>
                                      
                                      <a href="{{ URL::to('Pv3/category/delete/'.$category->id_category.'') }}"class="jsgrid-button jsgrid-delete-button"></a>
                                      
                                      </div>
                                      </td>
                                    </tr> 
                                  @endforeach      
                                  </tbody>
                                </table>
                                <div class="pagination"> {{ $categories->appends(Request::only('q'))->links() }} </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@stop