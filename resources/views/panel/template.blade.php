<!DOCTYPE html>
<html lang="tr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="pixelstrap">
    <title>{{ Lang::get('software.title') }}</title>
    {{ HTML::style('https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900') }}
    {{ HTML::style('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i') }}
       {{ HTML::style('panelv3/css/fontawesome.css') }}
       {{ HTML::style('panelv3/css/themify.css') }}
       {{ HTML::style('panelv3/css/slick.css') }}
       {{ HTML::style('panelv3/css/icofont.css') }}
       {{ HTML::style('panelv3/css/slick-theme.css') }}
       {{ HTML::style('panelv3/css/jsgrid.css') }}
       {{ HTML::style('panelv3/css/bootstrap.css') }}
       {{ HTML::style('panelv3/css/admin.css') }}
    @yield('meta')
</head>
<body>
    <style>
    .img-thumbnail{
        max-height: 70px;
    }
    </style>
<div class="page-wrapper">
<div class="page-main-header">
        <div class="main-header-right row">
            <div class="main-header-left d-lg-none">
                <div class="logo-wrapper"><a href="index.html"><img class="blur-up lazyloaded" src="{{ URL::to('assets/images/dashboard/multikart-logo.png') }}" alt=""></a></div>
            </div>
            <div class="mobile-sidebar">
                <div class="media-body text-right switch-sm">
                    <label class="switch"><a href="#"><i id="sidebar-toggle" data-feather="align-left"></i></a></label>
                </div>
            </div>
            <div class="nav-right col">
                <ul class="nav-menus">
                    <li>
                        <form class="form-inline search-form">
                            <div class="form-group">
                                <input class="form-control-plaintext" type="search" placeholder="Arama"><span class="d-sm-none mobile-search"><i data-feather="search"></i></span>
                            </div>
                        </form>
                    </li>
                    <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize-2"></i></a></li>
               
           
                    <li class="onhover-dropdown">
                        <div class="media align-items-center"><img class="align-self-center pull-right img-50 rounded-circle blur-up lazyloaded" src="{{ URL::to('assets/images/dashboard/man.png') }}" alt="header-user">
                            <div class="dotted-animation"><span class="animate-circle"></span><span class="main-circle"></span></div>
                        </div>
                        <ul class="profile-dropdown onhover-show-div p-20 profile-dropdown-hover">
                            <li><a href="{{ URL::to('Pv3/profile') }}"><i data-feather="user"></i>Profilim</a></li>
                            <li><a href="{{ URL::to('Pv3/profile') }}"><i data-feather="settings"></i> Şifre Değiştir</a></li>
                            <li><a href="{{ URL::to('Pv3/logout') }}"><i data-feather="log-out"></i> Güvenli Çıkış</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
            </div>
        </div>
    </div>

<!-- Page Body Start-->
<div class="page-body-wrapper">

<!-- Page Sidebar Start-->
<div class="page-sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper"><a href="index.html"><img class="blur-up lazyloaded" src="../assets/images/dashboard/multikart-logo.png" alt=""></a></div>
    </div>
    <div class="sidebar custom-scrollbar">
        <div class="sidebar-user text-center">
            <div><img class="img-60 rounded-circle lazyloaded blur-up" src="../assets/images/dashboard/man.png" alt="#">
            </div>
            <h6 class="mt-3 f-14">JOHN</h6>
            <p>general manager.</p>
        </div>
        <ul class="sidebar-menu">
            <li><a class="sidebar-header" href="index.html"><i data-feather="home"></i><span>Anasayfa</span></a></li>
            <li><a class="sidebar-header" href="#"><i data-feather="box"></i> <span>Ürün Yönetimi</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                   
                            <li><a href="{{ URL::to('Pv3/category') }}"><i class="fa fa-circle"></i>Kategoriler</a></li>
                            <li><a href="{{ URL::to('Pv3/product') }}"><i class="fa fa-circle"></i>Ürünler</a></li>
                            <li><a href="{{ URL::to('Pv3/brand') }}"><i class="fa fa-circle"></i>Markalar</a></li>
                            <li><a href="{{ URL::to('Pv3/tax') }}"><i class="fa fa-circle"></i>KDV Yönetimi</a></li>
                            <li><a href="{{ URL::to('Pv3/rate') }}"><i class="fa fa-circle"></i>Döviz Kurları</a></li>
                            <li><a href="{{ URL::to('Pv3/product/multiple') }}"><i class="fa fa-circle"></i>Toplu Fiyat Güncelleme</a></li>
               
                </ul>
            </li>
            <li><a class="sidebar-header" href=""><i data-feather="dollar-sign"></i><span>Siparişler</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ URL::to('Pv3/order/list/1') }}"><i class="fa fa-circle"></i>Siparişler</a></li>
                    <li><a href="{{ URL::to('Pv3/shipment') }}"><i class="fa fa-circle"></i>Kargolar</a></li>
                    <li><a href="{{ URL::to('Pv3/setting/cargo') }}"><i class="fa fa-circle"></i>Kargo Ücretlendirme</a></li>
                    <li><a href="{{ URL::to('Pv3/status') }}"><i class="fa fa-circle"></i>Sipariş Durumları</a></li>
                    <li><a href="{{ URL::to('Pv3/payment') }}"><i class="fa fa-circle"></i>Ödeme Tipleri</a></li>
                    <li><a href="{{ URL::to('Pv3/setting/order') }}"><i class="fa fa-circle"></i>Ödeme Ayarları</a></li>
                    <li><a href="{{ URL::to('Pv3/bank') }}"><i class="fa fa-circle"></i>Bankalar</a></li>
                    <li><a href="{{ URL::to('Pv3/bank-rate-group') }}"><i class="fa fa-circle"></i> Banka Pos Tanımları</a></li>
                    <li><a href="{{ URL::to('Pv3/bank-rate') }}"><i class="fa fa-circle"></i>Pos Oranlarını Yönet</a></li>

                </ul>
            </li>
            <!--
            <li><a class="sidebar-header" href=""><i data-feather="chrome"></i><span> Tasarım Yönetimi</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ URL::to('Pv3/design/color') }}"><i class="fa fa-circle"></i>Renkler</a></li>
                    <li><a href="{{ URL::to('Pv3/design/logo') }}"><i class="fa fa-circle"></i>Logo</a></li>
                    <li><a href="{{ URL::to('Pv3/design/favicon') }}"><i class="fa fa-circle"></i>Favicon</a></li>
                    <li><a href="{{ URL::to('Pv3/design/text') }}"><i class="fa fa-circle"></i>Metinler</a></li>
                    <li><a href="{{ URL::to('Pv3/design/footer') }}"><i class="fa fa-circle"></i>Footer</a></li>
                    <li><a href="{{ URL::to('Pv3/design/section') }}"><i class="fa fa-circle"></i>Blok Yerleşimi</a></li>
                    <li><a href="{{ URL::to('Pv3/design/setting') }}"><i class="fa fa-circle"></i>Ayarlar</a></li>

                </ul>
            </li>-->
            <li><a class="sidebar-header" href="#"><i data-feather="align-left"></i><span> Menü Yönetimi </span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ URL::to('Pv3/menu') }}"><i class="fa fa-circle"></i> Üst Menü Yönetimi</a></li>
                    <li><a href="{{ URL::to('Pv3/footer') }}"><i class="fa fa-circle"></i> Footer Yönetimi</a></li>
                </ul>
            </li>
            <li><a class="sidebar-header" href=""><i data-feather="camera"></i><span>Banner / Görseller</span><i class="fa fa-angle-right pull-right"></i></a>
            <ul class="sidebar-submenu">
                    <li><a href="{{ URL::to('Pv3/banner') }}"><i class="fa fa-circle"></i> Banner (Anasayfa)</a></li>
                    <li><a href="{{ URL::to('Pv3/banner-category') }}"><i class="fa fa-circle"></i> Banner (Kategoriler) </a></li>
                </ul>
        </li>

            <li><a class="sidebar-header" href=""><i data-feather="tag"></i><span>Kampanya Yönetimi</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ URL::to('Pv3/coupon') }}"><i class="fa fa-circle"></i>Kupon Kodları</a></li>
                </ul>
            </li>
            <li><a class="sidebar-header" href="#"><i data-feather="archive"></i><span> Mail Yönetimi</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ URL::to('Pv3/newsletter') }}"><i class="fa fa-circle"></i>E-Bülten Abonelik</a></li>
                    <li><a href="{{ URL::to('Pv3/newsletter/list') }}"><i class="fa fa-circle"></i> Listeyi Dışarı Aktar</a></li>
                </ul>
            </li>
            <li><a class="sidebar-header" href="#"><i data-feather="clipboard"></i><span>Sayfa Yönetimi</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ URL::to('Pv3/page') }}"><i class="fa fa-circle"></i>Sayfalar </a></li>
                    <li><a href="{{ URL::to('Pv3/section') }}"><i class="fa fa-circle"></i> Sayfa Bölümleri</a></li>
                </ul>
            </li>
            <li><a class="sidebar-header" href=""><i data-feather="users"></i><span> Üyelik İşlemleri</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ URL::to('Pv3/customer') }}"><i class="fa fa-circle"></i>Üye Listesi</a></li>
                </ul>
            </li>
            <li><a class="sidebar-header" href=""><i data-feather="user-plus"></i><span>Yönetici İşlemleri</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ URL::to('Pv3/user') }}"><i class="fa fa-circle"></i>Yöneticiler</a></li>
                </ul>
            </li>
       
            <li><a class="sidebar-header" href="{{ URL::to('Pv3/statistics') }}"><i data-feather="bar-chart"></i><span>İstatistikler</span></a></li>
            <li><a class="sidebar-header" href=""><i data-feather="settings" ></i><span> Genel Ayarlar</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ URL::to('Pv3/setting/general') }}"><i class="fa fa-circle"></i> Genel Tanımlamalar</a></li>
                    <li><a href="{{ URL::to('Pv3/setting/file') }}"><i class="fa fa-circle"></i> Dosya Yöneticisi</a></li>
                    <li><a href="{{ URL::to('Pv3/city') }}"><i class="fa fa-circle"></i> Şehir Yönetimi</a></li>
                    <li><a href="{{ URL::to('Pv3/county') }}"><i class="fa fa-circle"></i> İlçe Yönetimi</a></li>


                </ul>
            </li>
            <li><a class="sidebar-header" href="{{ URL::to('Pv3/logout') }}"><i data-feather="log-in"></i><span>&nbsp; Güvenli Çıkış</span></a>
            </li>
        </ul>
    </div>
</div>
<!-- Page Sidebar Ends-->

<div class="page-body">

<!-- Container-fluid starts-->

<!-- Container-fluid Ends-->


@yield('content')
</div>  

    {{ HTML::script('panelv3/js/jquery-3.3.1.min.js') }}
    {{ HTML::script('panelv3/js/popper.min.js') }}    
    {{ HTML::script('panelv3/js/bootstrap.js') }}    
    {{ HTML::script('panelv3/js/icons/feather-icon/feather.min.js') }}    
    {{ HTML::script('panelv3/js/icons/feather-icon/feather-icon.js') }}  
    {{ HTML::script('panelv3/js/sidebar-menu.js') }}    
    {{ HTML::script('panelv3/js/touchspin/vendors.min.js') }}    
    {{ HTML::script('panelv3/js/touchspin/touchspin.js') }}    
    {{ HTML::script('panelv3/js/touchspin/input-groups.min.js') }}    
    {{ HTML::script('panelv3/js/dashboard/form-validation-custom.js') }}    
    {{ HTML::script('panelv3/js/jquery.elevatezoom.js') }}    
    {{ HTML::script('panelv3/js/zoom-scripts.js') }}    

    {{ HTML::script('panelv3/js/chart/chartist/chartist.js') }}    
    {{ HTML::script('panelv3/js/chart/chartjs/chart.min.js') }}    
    {{ HTML::script('panelv3/js/lazysizes.min.js') }}    
    {{ HTML::script('panelv3/js/prism/prism.min.js') }}    
    {{ HTML::script('panelv3/js/clipboard/clipboard.min.js') }}    
    {{ HTML::script('panelv3/js/custom-card/custom-card.js') }}    
    {{ HTML::script('panelv3/js/counter/jquery.waypoints.min.js') }}    
    {{ HTML::script('panelv3/js/counter/jquery.counterup.min.js') }}    
    {{ HTML::script('panelv3/js/counter/counter-custom.js') }}    
    {{ HTML::script('panelv3/js/chart/peity-chart/peity.jquery.js') }}    
    {{ HTML::script('panelv3/js/chart/sparkline/sparkline.js') }}    
    {{ HTML::script('panelv3/js/admin-customizer.js') }}    
    {{ HTML::script('panelv3/js/chat-menu.js') }}    
    {{ HTML::script('panelv3/js/height-equal.js') }}    
    {{ HTML::script('panelv3/js/lazysizes.min.js') }}    
    {{ HTML::script('panelv3/js/admin-script.js') }}    
    {{ HTML::script('panelv3/js/jsgrid/jsgrid.min.js') }}    
    {{ HTML::script('panelv3/js/jsgrid/griddata-manage-product.js') }}    
    {{ HTML::script('panelv3/js/jsgrid/jsgrid-manage-product.js') }}   
    {{ HTML::script('panelv3/js/editor/ckeditor/ckeditor.js') }} 
    {{ HTML::script('panelv3/js/editor/ckeditor/styles.js') }} 
    {{ HTML::script('panelv3/js/editor/ckeditor/adapters/jquery.js') }} 
    {{ HTML::script('panelv3/js/editor/ckeditor/ckeditor.custom.js') }} 


    @yield('body')

</body>
</html> 