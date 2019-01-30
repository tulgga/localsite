<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('main/volunteer/images/favicon.png')}}">
    @yield('meta')
    <link rel="stylesheet" href="{{asset('main/volunteer/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('main/volunteer/fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('main/volunteer/style.css')}}">
    {{--Font--}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">

</head>
<body>
<div class="header">
    <div class="container">
        <div class="row">
        <div class="col-sm-5"><img src="{{asset('main/volunteer/images/logo.png')}}" title="Volunteer | Сайн дурынхан"/></div>
        <div class="col-sm-7">
            <nav class="navbar navbar-expand-lg navbar-dark p-0" style="top: 50%;transform: translateY(-50%);">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{asset("")}}">Эхлэл</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{asset("volunteer")}}">Сайн дурын ажлууд</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{asset("people")}}">Хувь хүн</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{asset("organization")}}">Байгууллага</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{asset("contact")}}">Холбогдох</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        </div>
    </div>
</div>
@yield('content')

{{--Javascript--}}
<script src="{{ asset('main/volunteer/js/jquery-2.1.1.min.js') }}"></script>
<script src="{{ asset('main/volunteer/js/bootstrap.js') }}"></script>
</body>
</html>
