@extends('panel.template')

@section('content')

@include('panel.module.user.menu')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>YÖNETİCİ LİSTESİ <span class="badge">{{ $users->total() }}</span></h5>
                </div>
                <div class="card-body">
 
                    <div class="btn-popup pull-right">
                        <button type="button" class="btn btn-primary" > <a style="color:white;" href="{{ URL::to('Pv3/user/new') }}"> Yönetici Ekle</a></button>
                        
                    </div>
                    <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>Yönetici Adı Soyadı</th>
                        <th>E-Posta</th>
                        <th>Son Güncelleme</th>          
                        <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($users as $user)
                        <tr>
                          <td>{{ $user->full_name }}</td>
                          <td>{{ $user->email }}</td>
                          <td>{{ $user->updated_at->format('d.m.Y H:i') }}</td>
                          <td class="text-right">            
                          <div class="btn-group jsgrid">
                          <a href="{{ URL::to('Pv3/user/edit/'.$user->id_user.'') }}" class="jsgrid-button jsgrid-edit-button"></a>
                          
                          <a href="{{ URL::to('Pv3/user/delete/'.$user->id_user.'') }}"class="jsgrid-button jsgrid-delete-button"></a>
                          
                          </div>
                          </td>
                        </tr> 
                      @endforeach      
                      </tbody>
                    </table>
                    <div class="pagination"> {{ $users->links() }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop