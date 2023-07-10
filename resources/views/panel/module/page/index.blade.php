@extends('panel.template')

@section('content')

@include('panel.module.page.menu')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>SAYFA LİSTESİ <span class="badge">{{ $pages->total() }}</span></h5>
                </div>
                <div class="card-body">
 
                    <div class="btn-popup pull-right">
                        <button type="button" class="btn btn-primary" > <a style="color:white;" href="{{ URL::to('Pv3/page/new') }}"> Sayfa Ekle</a></button>
                        
                    </div>
                    <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>ID</th>
                        <th>Sayfa Adı</th>
                        <th>Sayfa Linki</th>
                        <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($pages as $page)
                        <tr>
                          <th>{{ $page->id_page }}</th>
                          <td>{{ $page->title }}</td>
                          <td>{!! Sef::page($page->sef_url) !!}</td>
                          <td class="text-right">            
                          <div class="btn-group jsgrid">
                          <a href="{{ URL::to('Pv3/page/edit/'.$page->id_page.'') }}" class="jsgrid-button jsgrid-edit-button"></a>
                          
                          <a href="{{ URL::to('Pv3/page/delete/'.$page->id_page.'') }}"class="jsgrid-button jsgrid-delete-button"></a>
                          
                          </div>
                          </td>
                        </tr> 
                      @endforeach      
                      </tbody>
                    </table>
                    <div class="pagination"> {{ $pages->links() }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop