@extends('panel.template')

@section('content')

@include('panel.module.brand.menu')


<div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>MARKA LİSTESİ <span class="badge">{{ $brands->total() }}</span></h5>
                            </div>
                            <div class="card-body">
                                <div class="btn-popup pull-right">
                                    <button type="button" class="btn btn-primary" > <a style="color:white;" href="{{ URL::to('Pv3/brand/new') }}"> MArka Ekle</a></button>
                                    
                                </div>
                                <div class="table-responsive">
                                <table class="table table-striped">
                                  <thead>
                                    <tr>
                                    <th>ID</th>
                                    <th>Marka Adı</th>
                                    <th></th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($brands as $brand)
                                    <tr>
                                    <th>{{ $brand->id_brand }}</th>
                                      <td>{{ $brand->bname }}</td>
                                     
                                      <td class="text-right">            
                                      <div class="btn-group jsgrid">
                                      <a href="{{ URL::to('Pv3/brand/edit/'.$brand->id_brand.'') }}"  class="jsgrid-button jsgrid-edit-button"></a>
                                      
                                      <a href="{{ URL::to('Pv3/brand/delete/'.$brand->id_brand.'') }}"class="jsgrid-button jsgrid-delete-button"></a>
                                      
                                      </div>
                                      </td>
                                    </tr> 
                                  @endforeach      
                                  </tbody>
                                </table>
                                <div class="pagination"> {{ $brands->links() }} </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@stop