@extends('site.template')

@section('title', ''.$page->title.'')
@section('keyword', ''.$page->keyword.'')
@section('description', ''.$page->description.'')

@section('meta')
@stop

@section('body')
@stop

@section('content')

<!-- Container -->

@if ($page->section_id == 0)

<div class="breadcrumbs">
  <div class="container">
    <div class="row">
      <ul>
        <li class="home"> <a href="{{ URL::to('/') }}">Anasayfa</a><span>&mdash;›</span></li>
        <li class="category13"><strong>{{ $page->title }}</strong></li>
      </ul>
    </div>
  </div>
</div>

<section class="main-container col2-right-layout">
  <div class="main container">
    <div class="row">
      <section class="col-main col-sm-12">
        <div class="page-title">
          <h2>{{ $page->title }}</h2>
        </div>
        <div class="static-contain">
        {!! $page->content !!}  
        </div>
      </section>
    </div>
  </div>
</section>

@else

<div class="breadcrumbs">
  <div class="container">
    <div class="row">
      <ul>
        <li class="home"> <a href="{{ URL::to('/') }}">Anasayfa</a><span>&mdash;›</span></li>
        <li class="home">{{ $section->name }}<span>&mdash;›</span></li>
        <li class="category13"><strong>{{ $page->title }}</strong></li>
      </ul>
    </div>
  </div>
</div>

<section class="main-container col2-right-layout">
  <div class="main container">
    <div class="row">
      <section class="col-main col-sm-9">
        <div class="page-title">
          <h2>{{ $page->title }}</h2>
        </div>
        <div class="static-contain">
        {!! $page->content !!}  
        </div>
      </section>
      <aside class="col-right sidebar col-sm-3">
        <div class="block block-company">
          <div class="block-title">{{ $section->name }}</div>
          <div class="block-content">
            <ol id="recently-viewed-items">
              @foreach($pageList as $list)
                <li class="item even"><a href="{{ Sef::page($list->sef_url) }}">{{ $list->title }}</a></li>              
              @endforeach              
              </ol>
            <br />
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>

@endif

<!-- Container --> 

@stop