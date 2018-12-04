<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="icon" type="image/x-icon" href="{{$favicon}}"/>
    <title>{{$config['meta']['title']}}</title>
    <meta name="keywords" content="{{$config['meta']['keywords']}}">
    <meta name="description" content="{{$config['meta']['title']}}">

    <meta property="og:title" content="{{$config['meta']['title']}}">
    <meta property="og:image" content="{{$favicon}}">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:description" content="{{$config['meta']['description']}}">
    <!-- Styles -->
    {{$mainConfig['google_analytics']}}
    <link href="{{ url('style/css/customs.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('style/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('style/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
</head>
<body>
<div class="row">
    <div class="container text-center">
        <div class="row logo"><img src="style/images/index-logo.png"></div>
        <div class="row">
            <ul class="col-sm-6 left-menu">
                <li><a href="!"><i class="fa fa-home"></i> Үндсэн веб хуудас</a></li>
                <li><a href="#"><i class="fa fa-folder-o"></i> Лавлагаа мэдээлэл</a></li>
                <li><a href="#"><i class="fa fa-cube"></i> Шилэн дансны мэдээлэл</a></li>
            </ul>
            <ul class="col-sm-6 right-menu">
                <li><a href="#"><i class="fa fa-list-ul"></i> Сумдын веб хуудас</a></li>
                <li><a href="#"><i class="fa fa-sitemap"></i> Агентлагуудын холбоос</a></li>
                <li><a href="#"><i class="fa fa-lightbulb-o"></i> Санал хүсэлт, өргөдөл гомдол</a></li>
            </ul>
        </div>
    </div>
</div>
</body>
</html>
