@if(Session::has('alertTitle'))
  <div class="alert alert-{{Session::get("alertClass")}} alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>@if (Session::get("alertClass")=='success') <i class="fa fa-info-circle"></i> @elseif (Session::get("alertClass")=='danger') <i class="fa fa-times-circle"></i> @endif {{Session::get("alertTitle")}}</strong>
    {!! Session::get("alertMessage") !!}
  </div>
@endif

@if (count($errors) > 0)
  @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <strong><i class="fa fa-times-circle"></i> HATA :</strong> {{ $error }}
    </div>
  @endforeach 
@endif