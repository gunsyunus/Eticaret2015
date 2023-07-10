@extends('panel.template')

@section('content')

@include('panel.module.customer.menu')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>ÜYE LİSTESİ <span class="badge">{{ $customers->total() }}</span></h5>
                </div>
                <div class="card-body">
                <div class="btn-popup pull-left">
                @if (isset($searchText) != '')
                  <span class="search-info"><i class="fa fa-search-plus"></i> "{{ $searchText }}" - Arama Sonuçları</span> <a href="{{ URL::to('Pv3/customer') }}"><i class="fa fa-times-circle"></i></a>
                @endif
                {{ Form::open(['url'=>'Pv3/customer/search','role'=>'form','class'=>'search-page','method'=>'get']) }}
              
              <div class="input-group">
                  <input type="text" name="q" placeholder="Üye Ara" class="form-control" />
                    <div class="input-group-btn">
                      <button style="border-radius: 0 5px 5px 0;" class="btn btn-default"><span class="glyphicon glyphicon-search"></span>Ara</button>
                    </div>
                </div>
              {{ Form::close() }}                                    
                    </div>
                    <div class="btn-popup pull-right">
                        <button type="button" class="btn btn-primary" > <a style="color:white;" href="{{ URL::to('Pv3/customer/new') }}"> Üye Ekle</a></button>
                        
                    </div>
                    <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>Kayıt Tarihi</th>        
                        <th>Adı Soyadı</th>
                        <th>E-Posta</th>
                        <th>Cinsiyet</th>
                        <th>Telefon</th>
                        <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($customers as $customer)
                        <tr>
                          <td>{{ $customer->user->created_at->format('d.m.Y H:i') }}</td>
                          <td>{{ $customer->user->full_name }}</td>
                          <td>{{ $customer->user->email }}</td>
                          <td>
                          @if ($customer->gender === 'F') Kadın
                          @elseif ($customer->gender === 'M') Erkek
                          @else - @endif
                          </td>
                          <td>{{ $customer->phone }}</td>
                          <td class="text-right">            
                          <div class="btn-group jsgrid">
                          <a href="{{ URL::to('Pv3/customer/edit/'.$customer->id_customer.'') }}" class="jsgrid-button jsgrid-edit-button"></a>
                          
                          <a href="{{ URL::to('Pv3/customer/delete/'.$customer->id_customer.'') }}"class="jsgrid-button jsgrid-delete-button"></a>
                          
                          </div>
                          </td>
                        </tr> 
                      @endforeach      
                      </tbody>
                    </table>
                    <div class="pagination"> {{ $customers->appends(Request::only('q'))->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop