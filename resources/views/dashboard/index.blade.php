<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @yield('meta')
        <link rel="stylesheet" href="{{ asset('main/zar/css/bootstrap.min.css')}}">
        <script src="{{ asset('main/zar/js/jquery-3.2.1.min.js') }}"></script>
        <script src="{{ asset('main/zar/js/popper.js') }}"></script>
        <script src="{{ asset('main/zar/js/bootstrap.min.js') }}"></script>
        <link href="{{ asset('/dashboard/index.css') }}" rel="stylesheet" type="text/css">

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <title>DASHBOARD</title>

        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    </head>
    <body class="full-height">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-3">
                    <div class="box">
                        <h1 class="title"><img src="{{asset('main/doctor.png')}}"/> <span>Эрүүл мэндийн салбар</span></h1>
                        <ul class="grid-list-item clearfix">
                            <li><div class="item"><span class="num">{{$h!=null ?$h->birth: 0}}</span><span class="title">Төрөлт</span></div></li>
                            <li><div class="item"><span class="num">{{$h!=null ?$h->die: 0}}</span><span class="title">Нас баралт</span></div></li>
                            <li><div class="item"><span class="num">{{$h!=null ?$h->inspection: 0}}</span><span class="title">Үзлэг</span></div></li>
                            <li><div class="item"><span class="num">{{$h!=null ?$h->call_near: 0}}</span><span class="title">Ойрын дуудлага</span></div></li>
                            <li><div class="item"><span class="num">{{$h!=null ?$h->call_remote : 0 }}</span><span class="title">Холын дуудлага</span></div></li>
                            <li><div class="item"><span class="num">{{$h!=null ?$h->ytt: 0}}</span><span class="title">ЯТТусламж</span></div></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="col-sm-6 p-sm-0">
                    <div class="box">
                        <h1 class="title"><img src="{{asset('main/police.png')}}"/> <span>Цагдаагийн газар</span></h1>
                        <div class="row">
                            <div class="col-sm-6 pr-sm-0">
                                <h6 style="padding: 0 15px;text-transform: uppercase;color: #ff7900;text-align: right;margin: 0 0 -13px;">Гэмт хэрэг</h6>
                                <ul class="grid-list-item clearfix">
                                    <li><div class="item"><span class="num">{{$h!=null ?$h->birth: 0}}</span><span class="title">Төрөлт</span></div></li>
                                    <li><div class="item"><span class="num">{{$h!=null ?$h->die: 0}}</span><span class="title">Нас баралт</span></div></li>
                                    <li><div class="item"><span class="num">{{$h!=null ?$h->inspection: 0}}</span><span class="title">Үзлэг</span></div></li>
                                    <li><div class="item"><span class="num">{{$h!=null ?$h->call_near: 0}}</span><span class="title">Ойрын дуудлага</span></div></li>
                                    <li><div class="item"><span class="num">{{$h!=null ?$h->call_remote : 0 }}</span><span class="title">Холын дуудлага</span></div></li>
                                    <li><div class="item"><span class="num">{{$h!=null ?$h->ytt: 0}}</span><span class="title">ЯТТусламж</span></div></li>
                                </ul>
                            </div>
                            <div class="col-sm-6 pl-sm-0">
                                <h6 style="padding: 0 15px;text-transform: uppercase;color: #ff7900;text-align: right;margin: 0 0 -13px;">Захиргааны зөрчил</h6>
                                <ul class="grid-list-item clearfix">
                                    <li><div class="item"><span class="num">{{$h!=null ?$h->birth: 0}}</span><span class="title">Төрөлт</span></div></li>
                                    <li><div class="item"><span class="num">{{$h!=null ?$h->die: 0}}</span><span class="title">Нас баралт</span></div></li>
                                    <li><div class="item"><span class="num">{{$h!=null ?$h->inspection: 0}}</span><span class="title">Үзлэг</span></div></li>
                                    <li><div class="item"><span class="num">{{$h!=null ?$h->call_near: 0}}</span><span class="title">Ойрын дуудлага</span></div></li>
                                    <li><div class="item"><span class="num">{{$h!=null ?$h->call_remote : 0 }}</span><span class="title">Холын дуудлага</span></div></li>
                                    <li><div class="item"><span class="num">{{$h!=null ?$h->ytt: 0}}</span><span class="title">ЯТТусламж</span></div></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="box">
                        <h1 class="title"><img src="{{asset('main/emergency.png')}}"/> <span>Онцгой байдлын газар</span></h1>
                        <ul class="grid-list-item clearfix">
                            <li><div class="item"><span class="num">{{$h!=null ?$h->birth: 0}}</span><span class="title">Төрөлт</span></div></li>
                            <li><div class="item"><span class="num">{{$h!=null ?$h->die: 0}}</span><span class="title">Нас баралт</span></div></li>
                            <li><div class="item"><span class="num">{{$h!=null ?$h->inspection: 0}}</span><span class="title">Үзлэг</span></div></li>
                            <li><div class="item"><span class="num">{{$h!=null ?$h->call_near: 0}}</span><span class="title">Ойрын дуудлага</span></div></li>
                            <li><div class="item"><span class="num">{{$h!=null ?$h->call_remote : 0 }}</span><span class="title">Холын дуудлага</span></div></li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

