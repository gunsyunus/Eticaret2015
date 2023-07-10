@extends('panel.template')

@section('content')

@include('panel.module.newsletter.menu')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>ABONE LİSTESİ<span class="badge">{{ $newsletters->total() }}</span></h5>
                </div>
                <div class="card-body">
 
                    <div class="btn-popup pull-right">
                        <button type="button" class="btn btn-primary" > <a style="color:white;" href="{{ URL::to('Pv3/newsletter/new') }}">Abonelik Ekle</a></button>
                        
                    </div>
                    <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>E-Posta</th>
                        <th>Durum</th>
                        <th>Kayıt Tarihi</th>
                        <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($newsletters as $newsletter)
                        <tr>
                          <td>{{ $newsletter->email }}</td>
                          <td>{!! $newsletter->status=='1' ? '<span class="label label-success">AKTİF</span>' : '<span class="label label-danger">PASİF</span>' !!}</td>
                          <td>{{ $newsletter->created_at->format('d.m.Y H:i') }}</td>   
                          <td class="text-right">            
                          <div class="btn-group jsgrid">
                          <a href="{{ URL::to('Pv3/newsletter/edit/'.$newsletter->id_subscriber.'') }}" class="jsgrid-button jsgrid-edit-button"></a>
                          
                          <a href="{{ URL::to('Pv3/newsletter/delete/'.$newsletter->id_subscriber.'') }}"class="jsgrid-button jsgrid-delete-button"></a>
                          
                          </div>
                          </td>
                        </tr> 
                      @endforeach      
                      </tbody>
                    </table>
                    <div class="pagination"> {{ $newsletters->links() }} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop