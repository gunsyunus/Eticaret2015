<!DOCTYPE html>
<html lang="tr">
<head>
<meta charset="utf-8">
<title>@yield('title')</title>
<meta name="keywords" content="@yield('keyword')" />
<meta name="description" content="@yield('description')" />
<meta name="author" content="{{ Lang::get('software.copyright') }}">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
<link rel="shortcut icon" type="image/png" href="{{ URL::to($designs->favicon_logo) }}" />
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,300,700,800,400,600" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ URL::to('assets/css/style.min.css') }} " media="all" />
@yield('meta')
{!! $settings->tracing_head_code !!}
</head>
<body class="cms-index-index cms-home-page">
{!! $settings->tracing_body_after_code !!}

<!-- Header -->
<header>
  <div class="header-container">
    <div class="header-top">
      <div class="container">
        <div class="row">
          <div class="col-sm-4 col-xs-6">            
            <div class="welcome-msg hidden-xs">{{ $settings->welcome_msg }}</div>
          </div>
          <div class="col-sm-8 col-xs-6">
            <div class="toplinks">
               <div class="links">                
               <!-- Links -->          
               @if (!$authControl)
                <div class="myaccount"><a href="{{ URL::to('uye/yeni') }}"><span class="hidden-xs">Yeni Üyelik</span></a></div>
                <div class="login"><a href="{{ URL::to('uye') }}"><span class="hidden-xs">Üye Girişi</span></a></div>
                <div class="check hidden-xs"><a title="" href="{{ URL::to('uye/sifremi-unuttum') }}"><span class="hidden-xs">Şifremi Unuttum</span></a></div>             
               @else            
                <div class="myaccount"><a href="{{ URL::to('uye/hesabim') }}"><span class="hidden-xs"><b>Merhaba, {{ $authName }}</b></span></a></div>
                <div class="login"><a href="{{ URL::to('uye/hesabim') }}" class="hidden-xs"><span class="hidden-xs">Hesabım</span></a></div>
                <div class="login"><a title="" href="{{ URL::to('uye/cikis') }}"><span class="hidden-xs">Çıkış Yap</span></a></div>                            
               @endif
               <!-- Links -->
               </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-sm-6 col-xs-6"> 
          <!-- Logo -->
          <div class="logo"><a href="{{ URL::to('/') }}"><img alt="{{ $settings->title }}" src="{{ URL::to($designs->logo) }}" border="0" /></a></div>
          <!-- Logo --> 
        </div>
        <div class="col-lg-4 col-sm-6 col-xs-6"> 
          <!-- Search -->
          <div class="search-box pull-right">
            <form action="{{ URL::to('ara') }}" method="get" id="search_mini_form" name="categories">
            <div id="search-box-fast">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Ürün Ara" id="searchbox" name="k" />
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="submit">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </div>
             </form>
          </div>
          <!-- Search --> 
        </div>
      </div>
    </div>
  </div>
</header>
<!-- Header --> 

<!-- Navbar -->
<nav>
  <div class="container">
    <div class="row">
      <div class="nav-inner">

        <!-- Mobile Menu -->
        <div class="hidden-desktop" id="mobile-menu">
          <ul class="navmenu">
            <li>
              <div class="menutop">
                <div class="toggle"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span></div>
                <h2>Menu</h2>
              </div>
              <ul style="display:none;" class="submenu">
                <li>
                  <ul class="topnav">
                  @foreach($menus as $menu)

                    @if ($menu->type == 'single')
                      <li class="level0 nav-8 level-top"><a href="{{ URL::to($menu->url) }}" class="level-top"><span>{{ $menu->name }}</span></a></li>

                    @elseif ($menu->type == 'dropdown')
                    <li class="level0 nav-11 level-top parent"> <a class="level-top" href="{{ URL::to($menu->url) }}"> <span>{{ $menu->name }}</span> </a>
                      <ul class="level0">
                      @foreach(MenuList::dropdown($menu->tree) as $sub)
                        <li class="level1 nav-10-1"><a href="{{ URL::to($sub['url']) }}"><span>{{ $sub['name'] }}</span></a></li>
                      @endforeach
                      </ul>
                    </li>

                    @elseif ($menu->type == 'three')
                    <li class="level0 nav-9 level-top "> <a class="level-top" href="{{ URL::to($menu->url) }}"> <span>{{ $menu->name }}</span> </a>
                      <ul class="level0">
                        @foreach(MenuList::dropdown($menu->tree) as $sub)
                        <li class="level1 nav-9-1 first"> <a href="{{ URL::to($sub['url']) }}"> <span>{{ $sub['name'] }}</span> </a>
                          <ul class="level1">
                          @foreach($sub['child'] as $child)
                            <li class="level2 nav-9-1-1"><a href="{{ URL::to($child['url']) }}"><span>{{ $child['name'] }}</span></a></li>
                          @endforeach
                          </ul>
                        </li>
                       @endforeach
                      </ul>
                    </li>
                   
                    @elseif ($menu->type == 'four')
                    <li class="level0 nav-8 level-top parent"> <a class="level-top" href="{{ URL::to($menu->url) }}"> <span>{{ $menu->name }}</span> </a>
                      <ul class="level0">
                        @foreach(MenuList::dropdown($menu->tree) as $sub)
                        <li class="level1 nav-9-1 first"> <a href="{{ URL::to($sub['url']) }}"> <span>{{ $sub['name'] }}</span> </a>
                          <ul class="level1">
                          @foreach($sub['child'] as $child)
                            <li class="level2 nav-9-1-1"><a href="{{ URL::to($child['url']) }}"><span>{{ $child['name'] }}</span></a></li>
                          @endforeach
                          </ul>
                        </li>
                       @endforeach
                      </ul>
                    </li>

                    @elseif ($menu->type == 'five')
                    <li class="level0 nav-7 level-top parent"> <a class="level-top" href="{{ URL::to($menu->url) }}"> <span>{{ $menu->name }}</span> </a>
                      <ul class="level0">
                        @foreach(MenuList::dropdown($menu->tree) as $sub)
                        <li class="level1 nav-9-1 first"> <a href="{{ URL::to($sub['url']) }}"> <span>{{ $sub['name'] }}</span> </a>
                          <ul class="level1">
                          @foreach($sub['child'] as $child)
                            <li class="level2 nav-9-1-1"><a href="{{ URL::to($child['url']) }}"><span>{{ $child['name'] }}</span></a></li>
                          @endforeach
                          </ul>
                        </li>
                       @endforeach
                      </ul>
                    </li>

                    @endif
                  @endforeach
                  </ul>
                </li>
              </ul>              
            </li>
          </ul>
        </div>        
        <!-- End Mobile Menu -->

        <ul id="nav" class="hidden-xs">
         @foreach($menus as $menu)
            
            @if ($menu->type == 'single')
              <li class="level0 nav-8 level-top"><a href="{{ URL::to($menu->url) }}" class="level-top"><span>{{ $menu->name }}</span></a></li>

            @elseif ($menu->type == 'dropdown')
              <li class="level0 parent drop-menu"><a href="{{ URL::to($menu->url) }}"><span>{{ $menu->name }}</span> </a> 
              <ul class="level1">
                @foreach(MenuList::dropdown($menu->tree) as $sub)
                <li class="level1 nav-10-1"><a href="{{ URL::to($sub['url']) }}"><span>{{ $sub['name'] }}</span></a></li>
                @endforeach
              </ul>
              </li>

            @elseif ($menu->type == 'image')
            <li class="nav-custom-link level0 level-top parent"> <a class="level-top" href="{{ URL::to($menu->url) }}"><span>{{ $menu->name }}</span></a>
              <div class="level0-wrapper custom-menu">
              <div class="header-nav-dropdown-wrapper clearer">
                @foreach(MenuList::dropdown($menu->tree) as $sub)
                <div class="grid12-5">
                  <div class="custom_img"> <a href="{{ URL::to($sub['url']) }}"><img src="{{ URL::to($sub['image']) }}" alt="{{ $sub['name'] }}"></a></div>
                  <p>{{ $sub['name'] }}</p>
                </div>
                @endforeach
              </div>
              </div>
            </li>

            @elseif ($menu->type == 'three')
            <li class="level0 nav-7 level-top parent"> <a class="level-top" href="{{ URL::to($menu->url) }}"> <span>{{ $menu->name }}</span> </a>
              <div class="level0-wrapper dropdown-6col">
              <div class="level0-wrapper2">
                <div class="nav-block nav-block-center grid12-8 itemgrid itemgrid-4col">
                  <ul class="level0">
                    @foreach(MenuList::dropdown($menu->tree) as $sub)                
                    <li class="level1 nav-7-1 first parent item"> <a href="{{ URL::to($sub['url']) }}"> <span>{{ $sub['name'] }}</span> </a> 
                      <ul class="level1">
                      @foreach($sub['child'] as $child)
                      <li class="level2 nav-7-1"><a href="{{ URL::to($child['url']) }}"><span>{{ $child['name'] }}</span></a></li>
                      @endforeach
                      </ul>
                    </li>
                    @endforeach
                  </ul>
                </div>
                <div class="nav-block nav-block-right std grid12-4"><a href="{{ URL::to($menu->url) }}"><img src="{{ URL::to($menu->image) }}" class="fade-on-hover" alt="{{ $menu->name }}" /></a> </div>
              </div>
              </div>
            </li>    

            @elseif ($menu->type == 'four')
            <li class="level0 nav-6 level-top parent"> <a href="{{ URL::to($menu->url) }}" class="level-top"> <span>{{ $menu->name }}</span> </a>
            <div class="level0-wrapper dropdown-6col">
              <div class="level0-wrapper2">
                <div class="nav-block nav-block-center grid13-8 itemgrid itemgrid-4col">
                  <ul class="level0">
                    @foreach(MenuList::dropdown($menu->tree) as $sub)                
                    <li class="level1 nav-7-1 first parent item"> <a href="{{ URL::to($sub['url']) }}"> <span>{{ $sub['name'] }}</span> </a> 
                      <ul class="level1">
                      @foreach($sub['child'] as $child)
                      <li class="level2 nav-7-1"><a href="{{ URL::to($child['url']) }}"><span>{{ $child['name'] }}</span></a></li>
                      @endforeach
                      </ul>
                    </li>
                    @endforeach
                  </ul>
                </div>
                <div class="nav-block nav-block-right std grid12-3"> <a class="product-image" title="" href="{{ URL::to($menu->url) }}"> <img alt="{{ $menu->name }}" src="{{ URL::to($menu->image) }}" width="200"></a>
                </div>
              </div>
            </div>
            </li>            

            @elseif ($menu->type == 'five')
            <li class="level0 nav-7 level-top parent"><a href="{{ URL::to($menu->url) }}" class="level-top"><span>{{ $menu->name }}</span></a>
            <div class="level0-wrapper dropdown-6col">
              <div class="level0-wrapper2">
                <div class="nav-block nav-block-center">
                  <ul class="level0">
                    @foreach(MenuList::dropdown($menu->tree) as $sub)
                    <li class="level1 nav-6-1 parent item">
                      <div class="cat-img"><img alt="{{ $sub['name'] }}" src="{{ URL::to($sub['image']) }}"></div>
                      <a href="{{ URL::to($sub['url']) }}"><span>{{ $sub['name'] }}</span></a> 
                      <ul class="level1">
                        @foreach($sub['child'] as $child)
                        <li class="level2 nav-7-1"><a href="{{ URL::to($child['url']) }}"><span>{{ $child['name'] }}</span></a></li>
                        @endforeach
                      </ul>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
            </li>            

            @endif        

         @endforeach
        </ul>

        <div class="top-cart-contain pull-right"> 
          @if ($cartDisplay)
          <!-- Cart -->
          <div class="mini-cart">
            <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle"><a href="#"> <i class="glyphicon glyphicon-shopping-cart"></i>
              <div class="cart-box"><span class="title">SEPET</span><span id="cart-total">@if (isset($carts)) {{ count($carts) }} @else 0 @endif Ürün </span></div>
              </a></div>
            <div>
              <div class="top-cart-content arrow_box">
               
                @if (isset($carts) and count($carts)>=1)

                <div class="block-subtitle">Son eklenen ürünler</div>
                <ul id="cart-sidebar" class="mini-products-list">
                  @foreach($carts as $cart)
                  <li class="item last odd"> <a class="product-image" href="{{ Sef::product($cart->sef_url,$cart->product_id) }}" title=""><img src="{{ URL::to($cart->image) }}" width="80"></a>
                    <div class="detail-item">
                      <div class="product-details"> <a href="{{ URL::to('sepet/sil/'.$cart->id_cart) }}" title="Sil" class="glyphicon glyphicon-remove">&nbsp;</a>
                        <p class="product-name"> <a href="{{ Sef::product($cart->sef_url,$cart->product_id) }}" title="{{ $cart->name }}">{{ $cart->name }}</a> </p>
                      </div>
                      <div class="product-details-bottom"> <span class="price">{{ Price::format($cart->total) }} TL</span> <span class="title-desc">Adet:</span> <strong>{{ $cart->stock }}</strong> </div>
                    </div>
                  </li>
                @endforeach
                </ul>
                <div class="actions">
                  <a href="{{ URL::to('sepet') }}"><button class="btn-checkout" type="button"><span>SEPETİM</span></button></a>
                </div>

                @else

                <center><br />Sepetiniz boş, hemen alışverişe başlayın.<br /><br /></center>

                @endif

              </div>
            </div>
          </div>
          <!-- End Cart -->
          @endif
        </div>
      </div>
    </div>
  </div>
</nav>
<!-- end nav --> 

@yield('content')

<!-- Footer -->
<footer>  
  @if ($designs->newsletter_section=='1')
  <div class="newsletter-wrap">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <div class="newsletter">
              {!! Form::open(['id'=>'newsletter_form']) !!} 
              <div>
                <h4><span>{{ $designs->newsletter_text }}</span></h4>
                <input type="text" name="email" id="email" class="input-text" placeholder="E-Posta Adresi" />
                <button id="subscribe" class="subscribe" type="submit">Gönder</button>
                <div id="subscribe_msg"></div>
              </div>
              {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
  @endif
  <div class="footer-inner">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-sm-12 col-xs-12 col-lg-3">
          <div class="footer-column-1 pull-left">
            <div class="footer-logo"><a href="{{ URL::to('/') }}" title="{{ $settings->title }}"><img src="{{ URL::to($designs->footer_logo) }}" alt="{{ $settings->title }}" /></a></div>
            <p>{{ $designs->footer_slogan }}</p>
          </div>
        </div>
        @foreach($footers as $menu)
        <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">
          <div class="footer-column pull-left">
            <h4>{{ $menu->name }}</h4>
            <ul class="links">
                @foreach(MenuList::dropdown($menu->tree) as $sub)
                <li><a href="{{ URL::to($sub['url']) }}">{{ $sub['name'] }}</a></li>
                @endforeach
            </ul>
          </div>
        </div>
        @endforeach
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
          <div class="footer-column-last pull-left">
            <h4>{{ $designs->home_title_1 }}</h4>
            <address><i class="add-icon"></i>{{ $designs->footer_contact_1 }}</address>
            <div class="phone-footer"><i class="phone-icon"></i> {{ $designs->footer_contact_2 }}</div>
            <div class="email-footer"><i class="email-icon"></i> <a href="mailto:{{ $designs->footer_contact_3 }}">{{ $designs->footer_contact_3 }}</a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="social-section">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
          <div class="inner">
            <div class="social">
              <ul class="link">
                @if ($settings->social_facebook_url!='') <li class="fb pull-left"><a href="{{ $settings->social_facebook_url }}"></a></li> @endif
                @if ($settings->social_twitter_url!='') <li class="tw pull-left"><a href="{{ $settings->social_twitter_url }}"></a></li> @endif
                @if ($settings->social_instagram_url!='') <li class="ins pull-left"><a href="{{ $settings->social_instagram_url }}"></a></li> @endif
                @if ($settings->social_pinterest_url!='') <li class="pintrest pull-left"><a href="{{ $settings->social_pinterest_url }}"></a></li> @endif
                @if ($settings->social_google_url!='') <li class="googleplus pull-left"><a href="{{ $settings->social_google_url }}"></a></li> @endif
                @if ($settings->social_linkedin_url!='') <li class="linkedin pull-left"><a href="{{ $settings->social_linkedin_url }}"></a></li> @endif
                @if ($settings->social_youtube_url!='') <li class="youtube pull-left"><a href="{{ $settings->social_youtube_url }}"></a></li> @endif
              </ul>
            </div>
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <div class="payment-accept pull-right">
            <div>
            @if ($designs->icon_status_2=='1') <img src="{{ URL::to('assets/img/payment-2.png') }}" alt="Visa" /> @endif
            @if ($designs->icon_status_3=='1') <img src="{{ URL::to('assets/img/payment-4.png') }}" alt="Master" /> @endif
            @if ($designs->icon_status_4=='1') <img src="{{ URL::to('assets/img/payment-3.png') }}" alt="American Express" /> @endif
            @if ($designs->icon_status_1=='1') <img src="{{ URL::to('assets/img/payment-1.png') }}" alt="Paypal" /> @endif           
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-sm-5 col-xs-12 coppyright">{{ $settings->copyright }} </div>
        <div class="col-sm-7 col-xs-12 company-links">
          <ul class="links">
            <li class="last"><a title="{{ Lang::get('software.link_title') }}" href="{{ Lang::get('software.link') }}">{{ Lang::get('software.name') }}</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- End Footer --> 

<script type="text/javascript" src="{{ URL::to('assets/js/main.min.js') }}"></script> 
@yield('body')
{!! $settings->tracing_body_before_code !!}
</body>
</html>
