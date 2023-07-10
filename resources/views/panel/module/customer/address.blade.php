@extends('panel.template')

@section('content')

@include('panel.module.customer.menu')


<div class="page-body">

<!-- Container-fluid starts-->
<div class="container-fluid">
    <div class="card tab2-card">
        <div class="card-header">
            <h5>Yeni Adres</h5>
        </div>


        <div class="text-right"><a class="btn btn-warning" href="{{ URL::to('Pv3/customer/edit/'.$customers->id_customer.'') }}"><i class="fa fa-chevron-circle-left"></i> Üyeye Geri Dön</a></div><br />
        
        {!! Form::open(['url'=>'Pv3/address/add','role'=>'form','class'=>'form-horizontal']) !!}
        {!! Form::hidden('user_id', $users->id_user ) !!}

         <div class="form-group row">
        {!! Form::label('title', 'Adres Başlığı', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::text('title',null,['class'=>'form-control']) !!}
        </div>
        </div>

        <div class="form-group row">
        {!! Form::label('phone', 'Telefon', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::text('phone',null,['class'=>'form-control phoneformat']) !!}       
        </div>
        </div>          

        <div class="form-group row">
        {!! Form::label('address_1', 'Adres', array('class'=>'col-md-2 control-label')) !!}
        <div class="col-md-10">
        {!! Form::text('address_1',null,['class'=>'form-control']) !!}       
        </div>
        </div>  

        <div class="form-group row">
        {!! Form::label('city_id', 'Şehir', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::select('city_id',$cities,'-',['class'=>'form-control']) !!}
        </div>
        </div>
       
        <div class="form-group row">
        {!! Form::label('county_id', 'İlçe', array('class'=>'col-md-2 control-label')); !!}
        <div class="col-md-10">
        {!! Form::select('county_id', array('-'=>'Lütfen Seçiniz'),'-',['class'=>'form-control']) !!}
        </div>
        </div>

        <div class="form-group">
          <div class="offset-md-2 col-md-10">
          <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> KAYDET</button>
        </div>
        </div>
        
        {!! Form::close() !!}

    </div>
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>ADRES LİSTESİ </h5>
                </div>
                <div class="card-body">
         
      
                    <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>Adres Başlığı</th>
                        <th>Telefon</th>
                        <th>Adres</th>        
                        <th>Şehir / İlçe</th>
                        <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($myaddress as $address)
                        <tr>
                          <td>
                          {!! Form::open(['url'=>'Pv3/address/save/'.$address->id_address.'','role'=>'form','class'=>'form-horizontal']) !!}
                          {!! Form::text('title',$address->title,['class'=>'form-control']) !!}
                          </td>
                          <td>{!! Form::text('phone',$address->phone,['class'=>'form-control phoneformat']) !!}</td>
                          <td>{!! Form::text('address_1',$address->address_1,['class'=>'form-control']) !!}</td>
                          <td>{{ $address->city->name }} / {{ $address->county->name }}</td>
                          <td><button type="submit" class="btn btn-success"><i class="fa fa fa-floppy-o"></i></button> {!! Form::close() !!}
                          <a href="{{ URL::to('Pv3/address/delete/'.$address->id_address.'') }}" class="btn btn-danger btn-left"><i class="fa fa-times"></i></a>
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
    </div>
</div>
@stop