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
    <link href="{{ asset('main/sub/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('main/sub/css/bootstrap-grid.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('style/css/customs.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('style/font-awesome/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <!-- Javascript -->
    <script src="{{ asset('main/sub/js/jquery-2.1.1.min.js')}}" type="text/javascript"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</head>
<body style="padding: 0 10px">
<div class="row menu_layout">
    <div class="container text-center">
        <div class="logo"><img src="style/images/index-logo.png"></div>
        <div class="row">
            <ul class="col-sm-6 left-menu">
                <li><a href="!"><i class="fa fa-home"></i> Үндсэн веб хуудас</a></li>
                <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-list-ul"></i> Сумдын веб хуудас</a></li>
                <li><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg-2"><i class="fa fa-sitemap"></i> Агентлагуудын холбоос</a></li>


            </ul>
            <ul class="col-sm-6 right-menu">
                <li><a href="http://eservice.bayankhongor.gov.mn/" target="_blank"><i class="fa fa-folder-o"></i> ТӨРИЙН ҮЙЛЧИЛГЭЭ</a></li>
                <li><a href="http://zar.bayankhongor.gov.mn" target="_blank"><i class="fa fa-cube"></i> ЗАРЫН НЭГДСЭН САН</a></li>
                <li><a href="{{asset('!#/report')}}" target="_blank"><i class="fa fa-lightbulb-o"></i> Санал хүсэлт, өргөдөл гомдол</a></li>

            </ul>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div id="parallax">
    <div class="sky">
        <img id="sky" src="{{asset('style/images/sky.png')}}"/>
    </div>
    <div class="bg_main">
        <img id="bg_main" src="{{asset('style/images/bg_main.png')}}"/>
    </div>
    <div class="flag">
        <img id="flag" src="{{asset('style/images/flag.png')}}"/>
    </div>
    <div class="soyombo">
        <img id="soyombo" src="{{asset('style/images/soyombo.png')}}"/>
    </div>
</div>
<script>
    $(document).ready(function () {
        var soyombo = document.getElementById('soyombo');
        var flag = document.getElementById('flag');
        var sky = document.getElementById('sky');
        //var bg_main = document.getElementById('bg_main');
        soyombo.homePos = { x: soyombo.offsetLeft };
        flag.homePos = { x: flag.offsetLeft };
        sky.homePos = { x: sky.offsetLeft };
       // bg_main.homePos = { x: bg_main.offsetLeft };

        $('.menu_layout').mousemove(function (e) {
            parallax(e, soyombo, -150);
            parallax(e, flag, 400);
            parallax(e, sky, 50);
            //parallax(e, bg_main, 400);
        });
    });

    function parallax(e, target, layer) {
        var x = target.homePos.x - (e.pageX - target.homePos.x) / layer;
        $(target).offset({ left : x });
    };
</script>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content sumd">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Сумдын холбоос</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="row">
                    @foreach($sumuud as $domain)
                        @if(!$domain->id == 0)
                            <li class="col-6">
                                <a href="http://{{$domain->domain}}.{{env('SUB_DOMAIN')}}" target="_blank">@if($domain->favicon)<img src="{{ asset('uploads/'.$domain->favicon)}}">@else<img src="{{ asset('uploads/favicon/XnjMhMUg3enV21GhLYDopC2L6uHsuQK0BqjTjCjP.png')}}">@endif {{$domain->name}}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg-2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content sumd">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Аймгийн хэлтэс агентлагууд</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="row">
                    @foreach ($links as $link)
                        <li class="col-sm-6"> <a target="_blank" href="{{$link->link}}">@if($domain->image)<img src="{{ asset('uploads/'.$domain->image)}}">@else<img src="{{ asset('images/soyombo.png')}}">@endif {{$link->name}}</a> </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
</body>
</html>
