@extends('site.template')

@section('title', ''.$title.'')
@section('keyword', ''.$title.'')
@section('description', ''.$title.'')

@section('meta')
@stop

@section('body')
@stop

@section('content')

<!-- Container -->

<div class="breadcrumbs">
  <div class="container">
    <div class="row">
      <ul>
        <li class="home"> <a href="{{ URL::to('/') }}">Anasayfa</a><span>&mdash;›</span></li>
        <li class="category13"><strong>{{ $title }}</strong></li>
      </ul>
    </div>
  </div>
</div>

<section class="main-container col2-right-layout">
  <div class="main container">
    <div class="row">
      <section class="col-main col-sm-12">
        <div class="page-title">
          <h2>{{ $title }}</h2>
        </div>
        <div class="static-contain">
        {!! $content !!}  
        </div>
      </section>
    </div>
  </div>
</section>

<!-- Container --> 

@stop