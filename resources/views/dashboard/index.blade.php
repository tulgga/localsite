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
                        <ul>
                            <li><span class="num">{{$h!=null ?$h->birth: 0}}</span><span class="title">Төрөлт</span></li>
                            <li><span class="num">{{$h!=null ?$h->die: 0}}</span><span class="title">Нас баралт</span></li>
                            <li><span class="num">{{$h!=null ?$h->inspection: 0}}</span><span class="title">Үзлэг</span></li>
                            <li><span class="num">{{$h!=null ?$h->call_near: 0}}</span><span class="title">Ойрын дуудлага</span></li>
                            <li><span class="num">{{$h!=null ?$h->call_remote : 0 }}</span><span class="title">Холын дуудлага</span></li>
                            <li><span class="num">{{$h!=null ?$h->ytt: 0}}</span><span class="title">ЯТТусламж</span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6"></div>
                <div class="col-sm-3"></div>
            </div>
        </div>
    </body>
</html>

