@extends('panel.template')

@section('content')

@include('panel.module.menu.menu')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>ÜST MENÜLER <span class="badge">{{ $menus->total() }}</span></h5>
                </div>
                <div class="card-body">
 
                    <div class="btn-popup pull-right">
                        <button type="button" class="btn btn-primary" > <a style="color:white;" href="{{ URL::to('Pv3/menu/new') }}"> Menü Ekle</a></button>
                        
                    </div>
                    <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>Sıralama</th>
                        <th>Menü Adı</th>
                        <th>Durumu</th>
                        <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($menus as $menu)
                        <tr>
                        <th>{{ $menu->sort }}</th>
                          <td>{{ $menu->name }}</td>
                          <td>{!! $menu->status=='1' ? '<span class="label label-success">AKTİF</span>' : '<span class="label label-danger">PASİF</span>' !!}</td>
                          <td class="text-right">            
                          <div class="btn-group jsgrid">
                          <a href="{{ URL::to('Pv3/menu/edit/'.$menu->id_menu.'') }}" class="jsgrid-button jsgrid-edit-button"></a>
                          
                          <a href="{{ URL::to('Pv3/menu/delete/'.$menu->id_menu.'') }}"class="jsgrid-button jsgrid-delete-button"></a>
                          
                          </div>
                          </td>
                        </tr> 
                      @endforeach      
                      </tbody>
                    </table>
                    <div class="pagination"> {{ $menus->links() }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop