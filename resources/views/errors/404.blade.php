<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8">
        <title>404 - Sayfa Bulunamadı</title>
        <meta name="googlebot" content="noindex, nofollow" />
        <meta name="robots" content="noindex, nofollow" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,700,800,400,600" rel="stylesheet" />
        <style type="text/css">
        <!--
        body {
            font-family: 'Open Sans', sans-serif;
            font-weight: normal;
            font-size:15px;
        }
        .number {
            background-color: #ACACAC;
            border-radius: 100px;
            width:55px;
            height:55px;
            display: inline-block;
            color:#fff;
            font-size:38px;
        }
        -->
        </style>
        {!! $settings->tracing_head_code !!}
    </head>
    <body>
        
        {!! $settings->tracing_body_after_code !!}
        <div style="text-align:center; margin-top:200px;">
            <a href="{{ URL::to('/') }}"><img alt="{{ $settings->title }}" src="{{ URL::to($designs->logo) }}" border="0" /></a>
            <h1><span class="number">4</span> <span class="number">0</span> <span class="number">4</span></h1>
            <h1 style="color:#606060;">SAYFA BULUNAMADI !</h1>
            <h2>Aradığınız link sitemizde mevcut değil veya <br>yayından kaldırılmış olabilir.</h2>
            <a href="{{ URL::to('/') }}" style="color:#808080;">ANASAYFAYA DÖN</a>
        </div>
        {!! $settings->tracing_body_before_code !!}
        
    </body>
</html>