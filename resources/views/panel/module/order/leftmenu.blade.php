  <div class="list-group">
    @foreach($statuses as $status)
    <a href="{{ URL::to('Pv3/order/list/'.$status->id_status.'') }}" class="list-group-item list-group-item-{{ $status->color }} list-icon">{{ $status->name }} <span class="fa fa-angle-right"></span></a>
    @endforeach
  </div>

  	<div class="order-box">
    {{ Form::open(['url'=>'Pv3/order/search','role'=>'form','class'=>'search-page','method'=>'get']) }}
      <div class="input-group">
        <input type="text" name="q" placeholder="Ad-Tel-Mail-Ref" class="form-control" />
          <div class="input-group-btn">
          <button style="border-radius: 0 5px 5px 0;font-size: 12px;padding: 10px;" class="btn btn-default"><span class="glyphicon glyphicon-search"></span>Ara</button>
          </div>
      </div>
    {{ Form::close() }}  	
  </div> 
  