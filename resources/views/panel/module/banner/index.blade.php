@extends('panel.template')

@section('content')

@include('panel.module.banner.menu')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>BANNERLAR<span class="badge">{{ $banners->total() }}</span></h5>
                </div>
                <div class="card-body">
 
                    <div class="btn-popup pull-right">
                        <button type="button" class="btn btn-primary" > <a style="color:white;" href="{{ URL::to('Pv3/banner/new') }}"> Banner Ekle</a></button>
                        
                    </div>
                    <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>Sıralama</th>
                        <th>Banner Adı</th>
                        <th>Resim</th>
                        <th>Durumu</th>
                        <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($banners as $banner)
                        <tr>
                        <th>{{ $banner->sort }}</th>
                          <td>{{ $banner->title }}</td>
                          <td><img src="{{ URL::to($banner->image) }}" class="banner img-thumbnail img-responsive" /></td>          
                          <td>{!! $banner->status=='1' ? '<span class="label label-success">AKTİF</span>' : '<span class="label label-danger">PASİF</span>' !!}</td>
                          <td class="text-right">            
                          <div class="btn-group jsgrid">
                          <a href="{{ URL::to('Pv3/banner/edit/'.$banner->id_banner.'') }}" class="jsgrid-button jsgrid-edit-button"></a>
                          
                          <a href="{{ URL::to('Pv3/banner/delete/'.$banner->id_banner.'') }}"class="jsgrid-button jsgrid-delete-button"></a>
                          
                          </div>
                          </td>
                        </tr> 
                      @endforeach      
                      </tbody>
                    </table>
                    <div class="pagination"> {{ $banners->links() }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop