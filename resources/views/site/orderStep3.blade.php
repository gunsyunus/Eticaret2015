@extends('site.template')

@section('title', 'Ödeme - '.$settings->title.'')
@section('keyword', ''.$settings->keyword.'')
@section('description', ''.$settings->description.'')

@section('meta')
@stop

@section('body')
@stop

@section('content') 
	
	<div style="text-align:center; margin:100px;">
	<h1 style="color:#00b20d;">SİPARİŞİNİZ ONAYLANDI</h1>
	<br /><br />
	Sayın, <b>{{ $ref->name }} {{ $ref->surname }}</b><br />
	Siparişiniz başarıyla onaylandı, kargoya verildikten sonra aşağıdaki numaradan takip edebilirsiniz.<br /><br />
	<b>SİPARİŞ NO :</b> {{ $ref->number }}<br />
	</div>

	{!! $settings->tracing_order_code !!}
	
@stop