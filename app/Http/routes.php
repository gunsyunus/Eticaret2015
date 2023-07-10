<?php

/*
|--------------------------------------------------------------------------
| Home Page
|--------------------------------------------------------------------------
*/

Route::get('/', 'Site\HomeController@index');

/*
|--------------------------------------------------------------------------
| Site - Turkish language structure was used !
|--------------------------------------------------------------------------
*/

// Search

Route::get('ara', 'Site\CatalogController@search');

// Catalog

Route::get('urunler', 'Site\CatalogController@showcase');
Route::get('u/{sef_url}/{id}', 'Site\CatalogController@product');
Route::get('k/{sef_url}/{id}', 'Site\CatalogController@category');
Route::get('m/{sef_url}/{id}', 'Site\CatalogController@brand');

// Customer

Route::get('uye', 'Site\CustomerController@index');
Route::get('uye/devam', 'Site\CustomerController@choose');
Route::get('uye/yeni', 'Site\CustomerController@newcustomer');
Route::post('uye/kayit', 'Site\CustomerController@register');
Route::post('uye/giris', 'Site\CustomerController@login');
Route::get('uye/sifremi-unuttum', 'Site\CustomerController@remember');
Route::post('uye/sifre/gonder', 'Site\PasswordController@sendResetLinkEmail');
Route::get('uye/sifre/yeni/{token?}', 'Site\CustomerController@passwordReset');
Route::post('uye/sifre/yeni', 'Site\PasswordController@reset');

// Customer Auth

Route::group(['middleware' => ['auth','customer']], function () {
Route::get('uye/cikis', 'Site\CustomerController@logout');
Route::get('uye/hesabim', 'Site\CustomerController@profile');
Route::post('uye/kaydet', 'Site\CustomerController@save');
Route::get('uye/siparisler', 'Site\CustomerController@order');
Route::get('uye/guvenlik', 'Site\CustomerController@password');
Route::post('uye/guncelle', 'Site\CustomerController@passwordsave');
Route::get('uye/adres', 'Site\AddressController@index');
Route::get('uye/adres/sil/{id}', 'Site\AddressController@delete');
Route::get('uye/adres/yeni', 'Site\AddressController@newaddress');
Route::post('uye/adres/ekle', 'Site\AddressController@add');
Route::get('uye/adres/duzenle/{id}', 'Site\AddressController@edit');
Route::post('uye/adres/kaydet/{id}', 'Site\AddressController@save');
Route::get('odeme/detay', 'Site\OrderController@detailMember');
});

// Customer Social Account

Route::get('connect/facebook', 'Site\SocialAccountController@connect');
Route::get('callback/facebook', 'Site\SocialAccountController@callback');

// Cart and Order

Route::post('sepet/ekle', 'Site\CartController@addcart');
Route::post('sepet/guncelle/{id}', 'Site\CartController@save');
Route::get('sepet/sil/{id}', 'Site\CartController@delete');
Route::get('sepet/temizle', 'Site\CartController@cartEmpty');
Route::post('sepet/kupon', 'Site\CartController@coupon');
Route::get('sepet', 'Site\OrderController@cart');
Route::get('odeme', 'Site\OrderController@detail');
Route::post('odeme/bilgi', 'Site\OrderController@save');
Route::get('odeme/tip', 'Site\OrderController@payment');
Route::post('odeme/kart/dogrulama/{status}', 'Site\OrderController@secure');
Route::post('odeme/onay', 'Site\OrderController@complete');
Route::get('odeme/banka/onay', 'Site\OrderController@complete');

// Page

Route::get('s/{sef_url}', 'Site\PageController@index');
Route::get('satis-sozlesmesi', 'Site\PageController@agreement');

// Shipment

Route::get('kargo-takip', 'Site\PageController@shipment');
Route::get('kargo-sorgula', 'Site\OrderController@inquiry');

// Service

Route::get('county/{id}', 'Site\ServiceController@county');
Route::post('newsletter', 'Site\ServiceController@newsletter');

/*
|--------------------------------------------------------------------------
| Panel - Login
|--------------------------------------------------------------------------
*/

Route::get('Pv3', 'Panel\LoginController@index');
Route::post('Pv3/login', 'Panel\LoginController@login');
Route::get('Pv3/logout', 'Panel\LoginController@logout');

/*
|--------------------------------------------------------------------------
| Panel - Administrator Tools
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['auth','administrator']], function () {
Route::get('Pv3/Dashboard', 'Panel\DashboardController@index');
Route::get('print/{id}', 'Panel\PrintController@order');
Route::controller('Pv3/category', 'Panel\CategoryController');
Route::controller('Pv3/product', 'Panel\ProductController');
Route::controller('Pv3/option', 'Panel\OptionController');
Route::controller('Pv3/gallery', 'Panel\GalleryController');
Route::controller('Pv3/setting', 'Panel\SettingController');
Route::controller('Pv3/design', 'Panel\DesignController');
Route::controller('Pv3/menu', 'Panel\MenuController');
Route::controller('Pv3/footer', 'Panel\FooterController');
Route::controller('Pv3/page', 'Panel\PageController');
Route::controller('Pv3/section', 'Panel\SectionController');
Route::controller('Pv3/user', 'Panel\UserController');
Route::controller('Pv3/customer', 'Panel\CustomerController');
Route::controller('Pv3/address', 'Panel\AddressController');
Route::controller('Pv3/profile', 'Panel\ProfileController');
Route::controller('Pv3/brand', 'Panel\BrandController');
Route::controller('Pv3/city', 'Panel\CityController');
Route::controller('Pv3/county', 'Panel\CountyController');
Route::controller('Pv3/shipment', 'Panel\ShipmentController');
Route::controller('Pv3/rate', 'Panel\RateController');
Route::controller('Pv3/status', 'Panel\StatusController');
Route::controller('Pv3/tax', 'Panel\TaxController');
Route::controller('Pv3/payment', 'Panel\PaymentController');
Route::controller('Pv3/bank', 'Panel\BankController');
Route::controller('Pv3/bank-rate-group', 'Panel\BankRateGroupController');
Route::controller('Pv3/bank-rate', 'Panel\BankRateController');
Route::controller('Pv3/banner', 'Panel\BannerController');
Route::controller('Pv3/banner-category', 'Panel\BannerCategoryController');
Route::controller('Pv3/banner-box', 'Panel\BannerBoxController');
Route::controller('Pv3/banner-brand', 'Panel\BannerBrandController');
Route::controller('Pv3/banner-sub', 'Panel\BannerSubController');
Route::controller('Pv3/banner-element', 'Panel\BannerElementController');
Route::controller('Pv3/order', 'Panel\OrderController');
Route::controller('Pv3/statistics', 'Panel\StatisticsController');
Route::controller('Pv3/coupon', 'Panel\CouponController');
Route::controller('Pv3/newsletter', 'Panel\NewsletterController');
});
